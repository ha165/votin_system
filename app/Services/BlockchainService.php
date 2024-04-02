<?php

namespace App\Services;

use Web3\Web3;
use Web3\Providers\HttpProvider;
use Web3\RequestManagers\HttpRequestManager;
use Illuminate\Support\Facades\Log;

class BlockchainService
{
    protected $web3;

    public function __construct()
    {
        // Initialize web3 connection
        $this->web3 = new Web3(new HttpProvider(new HttpRequestManager('http://localhost:8545')));
    }

    public function saveVote($positionId, $candidateId)
{
    try {
        // Log a message indicating that the saveVote method has been called
        Log::debug('Calling saveVote method with positionId: ' . $positionId . ' and candidateId: ' . $candidateId);

        // Replace with your contract ABI
        $abi = json_decode(file_get_contents(base_path('resources\V-DApp\build\contracts\Voting.json')), true);
        // Replace with your contract address
        $contractAddress = '0x117b78D4912e485EB2694f5F22e1289daDEB375f';

        // Initialize contract instance
        $contract = new \Web3\Contract($this->web3->provider, $abi);

        
        // Replace with user's Ethereum account
        $from = '0xa57B2826b37c1a952058a2f925556791Ff7efF4f';

        // Send transaction
        $transaction = $this->web3->eth->sendTransaction([
            'from' => $from,
            'to' => $contractAddress,
            'data' => $contract->at($contractAddress)->getData('vote', [$positionId, $candidateId]),
        ]);

        // Log a message indicating that the transaction was successful
        Log::debug('Transaction successful. Transaction hash: ' . $transaction);

        return $transaction;
    } catch (\Exception $e) {
        // Log any exceptions that occur during the saveVote method
        Log::error('An error occurred during saveVote method: ' . $e->getMessage());

        // Re-throw the exception to propagate it
        throw $e;
    }
}
}
