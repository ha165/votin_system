<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vote;

class BallotController extends Controller
{
    public function saveLeader(Request $request)
    {
        // Validate the request data
        $request->validate([
            'position_id' => 'required|exists:positions,id',
            'candidate_id' => 'required|exists:candidates,id', 
        ]);

        // Check if the user has already voted for this position
        $existingVote = Vote::where('voter_id', auth()->user()->id)
                            ->where('position_id', $request->position_id)
                            ->first();

        if ($existingVote) {
            // User has already voted for this position, return with an error message
            return redirect()->back()->with('error', 'You have already voted for this position.');
        }

        // Store the vote in the database
        Vote::create([
            'voter_id' => auth()->user()->id,
            'election_id' => 5, // Change this to your actual election ID
            'position_id' => $request->position_id,
            'candidate_id' => $request->candidate_id,
            // You can also store the party ID if needed
        ]);

        // Redirect back with success message
        return redirect()->back()->with('success', 'Your vote has been recorded successfully.');
    }
}
