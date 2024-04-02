<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Election;
use App\Models\Candidate;
use App\Models\Party;
use App\Models\User;
use App\Models\Vote;
use App\Models\Position;

class DashboardController extends Controller
{
    public function index()
    {
        $userRole = auth()->user()->role;

        if ($userRole == 'admin') {
            return $this->adminDashboard();
        } elseif ($userRole == 'voter') {
            return $this->voterDashboard();
        } else {
            return redirect()->route('login');
        }
    }

    private function adminDashboard()
    {
        $positions = Position::all();
        $elections = Election::all();
        $voterCount = User::where('role', 'voter')->count();
        $parties = Party::all();
        $allparties = $parties->count();

        // Array to store results for each position
        $results = [];

        // Calculate results for each position
        foreach ($positions as $position) {
            // Retrieve candidates for the current position
            $candidates = Candidate::where('position_id', $position->id)->get();

            // Calculate total votes for the position
            $totalVotes = Vote::whereIn('candidate_id', $candidates->pluck('id'))->count();

            // Calculate percentages for each candidate
            foreach ($candidates as $candidate) {
                $candidateVotes = Vote::where('candidate_id', $candidate->id)->count();
                $percentage = $totalVotes > 0 ? ($candidateVotes / $totalVotes) * 100 : 0;

                // Generate the URL of the candidate photo using the asset() helper
                $photoUrl = asset('storage/' . $candidate->photo);

                // Store candidate results
                $results[$position->id][] = [
                    'candidate' => $candidate,
                    'votes' => $candidateVotes,
                    'percentage' => $percentage,
                    'photo_url' => $photoUrl, // Add the photo URL to the results array
                ];
            }
        }

        $allcandidates = Candidate::count();

        return view('admin.pages.index', compact('allcandidates', 'allparties', 'elections', 'voterCount', 'positions', 'results', 'parties'));
    }

    private function voterDashboard()
    {
        $candidates = Candidate::all();
        $elections = Election::all();

        return view('voters.index', compact('candidates', 'elections'));
    }
}
