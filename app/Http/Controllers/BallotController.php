<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Web3\Web3;
use Web3\Contract;
use Illuminate\Support\Facades\Log;

use function React\Promise\Timer\timeout;

class BallotController extends Controller
{
    public function saveLeader(Request $request)
    {
        // Validate the request data
        $request->validate([
            'position_id' => 'required|numeric',
            'candidate_id' => 'required|numeric',
        ]);

        // Connect to the local Ganache server
        $web3 = new Web3('http://localhost:7545');

        // Hardcoded default account
        $defaultAccount = '0x1Ed16B42423aDf74DE7042dFC4fb1302dB7b26D6';

        // Load the compiled smart contract ABI
        $contractPath = base_path('resources/v-DApp/build/contracts/Ballot.json');
        $contractJson = file_get_contents($contractPath);
        $contractData = json_decode($contractJson, true);
        $contractABI = $contractData['abi'];
        $contractAddress = '0x5898d87f49fB38e2d7Fcdb2E4462FDF0DB2105e5';

        try {
            // Create a contract instance and directly interact with it
            $deployedContract = new Contract($web3->provider, $contractABI, $contractAddress);

            // Call the saveLeader function on the smart contract
            $positionId = $request->input('position_id');
            $candidateId = $request->input('candidate_id');
            
            // Construct the function call data and handle asynchronously
            $deployedContract->at($contractAddress)->call('saveLeader', $positionId, $candidateId, ['from' => $defaultAccount], function ($err, $result) {
                if ($err !== null) {
                    // Log the error
                    Log::error('Error saving leader: ' . $err->getMessage());

                    // Redirect back with a more specific error message
                    return redirect()->back()->with('error', 'An error occurred while recording your vote. Please try again later.');
                } else {
                    // Check if the transaction was successful
                    if ($result) {
                        // Redirect back with success message
                        return redirect()->back()->with('success', 'Your vote has been recorded successfully.');
                    } else {
                        // Redirect back with an error message
                        return redirect()->back()->with('error', 'Failed to record your vote.');
                    }
                }
            });
        } catch (\Exception $e) {
            // Log the error
            Log::error('Error saving leader: ' . $e->getMessage());
            
            // Redirect back with a more specific error message
            return redirect()->back()->with('error', 'An error occurred while recording your vote. Please try again later.');
        }
    }
}
