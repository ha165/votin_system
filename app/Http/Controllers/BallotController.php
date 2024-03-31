<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vote;
use App\Models\Candidate;
use App\Models\Position;
use App\Models\Election;
use Carbon\Carbon;

class BallotController extends Controller
{
    public function saveLeader(Request $request)
    {
        try {
            // Validate the request data
            $request->validate([
                'position_id' => 'required|exists:positions,id',
                'candidate_id' => 'required|exists:candidates,id',
            ]);

            // Get the active election ID based on the current date
            $activeElectionId = Election::where('start', '<=', now())
                ->where('end', '>=', now())
                ->value('id');

            if (!$activeElectionId) {
                // No active election found, return with an error message
                return redirect()->back()->with('error', 'There is no active election currently.');
            }

            // Check if the user has already voted for this position in the active election
            $existingVote = Vote::where('voter_id', auth()->user()->id)
                ->where('election_id', $activeElectionId)
                ->where('position_id', $request->position_id)
                ->first();

            if ($existingVote) {
                // User has already voted for this position in the active election, return with an error message
                return redirect()->back()->with('error', 'You have already voted for this position in the current election.');
            }

            // Store the vote in the database with the active election ID
            Vote::create([
                'voter_id' => auth()->user()->id,
                'election_id' => $activeElectionId,
                'position_id' => $request->position_id,
                'candidate_id' => $request->candidate_id,
                // You can also store the party ID if needed
            ]);

            // Redirect back with success message
            return redirect()->back()->with('success', 'Your vote has been recorded successfully in the current election.');
        } catch (\Exception $e) {
            // Handle any exceptions that occur during the voting process
            return redirect()->back()->with('error', 'An error occurred while saving your vote. Please try again later.');
        }
    }

    public function showResults()
    {
        try {
            // Get the active election
            $activeElection = Election::where('start', '<=', Carbon::now())
                ->where('end', '>=', Carbon::now())
                ->first();

            // Check if an active election exists
            if (!$activeElection) {
                return redirect()->back()->with('error', 'The election results are not available at the moment.');
            }

            // Get all positions
            $positions = Position::all();

            // Prepare an array to store results
            $results = [];

            // Iterate through positions and count votes for each candidate
            foreach ($positions as $position) {
                $candidates = Candidate::where('position_id', $position->id)->get();
                foreach ($candidates as $candidate) {
                    $voteCount = Vote::where('position_id', $position->id)
                        ->where('candidate_id', $candidate->id)
                        ->count();
                    $results[$position->title][] = [
                        'photo' => asset('storage/' . $candidate->photo),
                        'name' => $candidate->name,
                        'votes' => $voteCount,
                    ];
                }
            }

            // Sort the results by vote count for each position
            foreach ($results as &$positionResult) {
                arsort($positionResult);
            }

            return view('voters.ballot.result', compact('results'));
        } catch (\Exception $e) {
            // Handle any exceptions that occur while retrieving the election results
            return redirect()->back()->with('error', 'An error occurred while fetching the election results. Please try again later.');
        }
    }
}