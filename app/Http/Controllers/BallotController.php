<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Web3\Web3;
use Web3\Contract;
use Web3\Utils;
use App\Models\Vote;

class BallotController extends Controller
{
    public function saveLeader(Request $request)
    {
        // Initialize Web3 instance
        $web3 = new Web3('http://localhost:7545'); // Assuming Ganache is running on this port
        // Load contract ABI and address
        $abifile = storage_path('resources\voting-dapp\build\contracts\VoteContract.json');
        $abi = json_decode(file_get_contents($abifile), true);
        $contractAddress = '0x1Ed16B42423aDf74DE7042dFC4fb1302dB7b26D6';

        // Instantiate contract
        $contract = new Contract($web3->provider, $abi);
        $contract->at($contractAddress);

        // Call vote function on smart contract
        $response = $contract->send('vote', [$request->position_id, $request->candidate_id]);

        // Process response or handle errors

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
