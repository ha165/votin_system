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
        $positions = Position::all();
        $candidates = Candidate::all();
        $elections = Election::all();
        $voterCount = User::where('role', 'voter')->count();
        $parties = Party::all();
        $allparties = $parties->count();
        $allcandidates = $candidates->count();
        
        if (auth()->user()->role == 'admin') {
             $results = [];

        foreach ($candidates as $candidate) {
            $votes = Vote::where('candidate_id', $candidate->id)->get();
            $results[$candidate->id] = [
                'candidate' => $candidate,
                'vote_count' => $votes->count(),
            ];
        }
            return view('admin.pages.index', compact('allcandidates', 'allparties','elections','voterCount','positions','results'));
        } elseif (auth()->user()->role == 'voter') {
            return view('voters.index', compact('candidates','elections'));
        } else {
            return redirect()->route('login');
        }

    }
}
