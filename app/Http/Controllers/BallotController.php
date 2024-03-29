<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Web3\Web3;
use Web3\Contract;
use Web3\Utils;
use App\Models\Vote;
use Illuminate\Support\Facades\Log; // Import Log facade

class BallotController extends Controller
{
    protected $web3;
    protected $contract;

    public function __construct()
    {
        // Initialize web3 connection
        $this->web3 = new Web3('http://localhost:7545'); // Assuming Ganache is running on localhost
        // Load contract ABI and address
        $abiPath = base_path('resources/voting-dapp/build/contracts/Ballot.json'); // Update path
        $abi = json_decode(file_get_contents($abiPath), true);
        $contractAddress = '0x1Ed16B42423aDf74DE7042dFC4fb1302dB7b26D6'; // Update with your contract address
        // Initialize contract instance
        $this->contract = new Contract($this->web3->provider, $abi);
        $this->contract->at($contractAddress);
    }

    public function saveLeader(Request $request)
    {
        // Validate the request data
        $request->validate([
            'position_id' => 'required|numeric',
            'candidate_id' => 'required|numeric', 
        ]);

        // Check if the user has already voted for this position
        $existingVote = Vote::where('voter_id', auth()->user()->id)
                            ->where('position_id', $request->position_id)
                            ->first();

        if ($existingVote) {
            // User has already voted for this position, return with an error message
            return redirect()->back()->with('error', 'You have already voted for this position.');
        }

        // Send vote transaction to the smart contract
        try {
            $this->contract->send('vote', [$request->candidate_id], function ($err, $tx) use ($request) {
                if ($err !== null) {
                    // Log the error message
                    Log::error('Failed to send vote transaction: ' . $err->getMessage());
                    // Redirect with error message
                    return redirect()->back()->with('error', 'Failed to record vote.');
                }
                // Remaining code for successful transaction
            });
        } catch (\Exception $e) {
            // Log the exception
            Log::error('Exception while sending vote transaction: ' . $e->getMessage());
            // Redirect with error message
            return redirect()->back()->with('error', 'Failed to record vote.');
        }
    }
}
