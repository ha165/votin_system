// SPDX-License-Identifier: MIT 
// VoteContract.sol
pragma solidity ^0.8.0;

contract VoteContract {
    struct Vote {
        address voter;
        uint256 positionId;
        uint256 candidateId;
    }

    mapping(address => bool) public hasVoted;
    mapping(uint256 => Vote) public votes;
    uint256 public voteCount;

    function vote(uint256 _positionId, uint256 _candidateId) external {
        require(!hasVoted[msg.sender], "You have already voted.");
        
        votes[voteCount] = Vote(msg.sender, _positionId, _candidateId);
        voteCount++;
        hasVoted[msg.sender] = true;
    }
}
