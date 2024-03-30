// SPDX-License-Identifier: MIT
pragma solidity ^0.8.19;

contract Ballot {
    struct Vote {
        address voter;
        uint256 positionId;
        uint256 candidateId;
    }

    mapping(address => bool) public hasVoted;
    Vote[] public votes;

    event VoteRecorded(address indexed voter, uint256 positionId, uint256 candidateId);

    function saveLeader(uint256 _positionId, uint256 _candidateId) public {
        require(!hasVoted[msg.sender], "You have already voted.");

        // Store the vote
        Vote memory newVote = Vote(msg.sender, _positionId, _candidateId);
        votes.push(newVote);

        // Mark voter as voted
        hasVoted[msg.sender] = true;

        // Emit an event
        emit VoteRecorded(msg.sender, _positionId, _candidateId);
    }
}