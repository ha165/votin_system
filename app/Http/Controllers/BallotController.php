<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\BlockchainService;

class BallotController extends Controller
{
    protected $blockchainService;

    public function __construct(BlockchainService $blockchainService)
    {
        $this->blockchainService = $blockchainService;
    }

    public function saveLeader(Request $request)
    {
        // Validate the request data
        $request->validate([
            'position_id' => 'required|exists:positions,id',
            'candidate_id' => 'required|exists:candidates,id',
        ]);

        // Check if the user has already voted for this position
        $hasVoted = $this->blockchainService->hasVoted(auth()->user()->id, $request->position_id);

        if ($hasVoted) {
            // User has already voted for this position, return with an error message
            return redirect()->back()->with('error', 'You have already voted for this position.');
        }

        // Submit vote to the blockchain
        $this->blockchainService->submitVote(auth()->user()->id, $request->position_id, $request->candidate_id);

        // Redirect back with success message
        return redirect()->back()->with('success', 'Your vote has been recorded successfully.');
    }
}
