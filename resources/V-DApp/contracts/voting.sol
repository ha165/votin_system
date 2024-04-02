// SPDX-License-Identifier: MIT
pragma solidity ^0.8.0;

contract Voting {
    struct Candidate {
        string name;
        uint256 voteCount;
    }

    mapping(uint256 => Candidate) public candidates;
    mapping(address => bool) public voters;

    uint256 public candidateCount;
    bool public votingClosed;

    event Voted(address indexed voter, uint256 candidateId);
    event CandidateAdded(uint256 candidateId, string name);

    modifier onlyWhileVotingOpen() {
        require(!votingClosed, "Voting is closed");
        _;
    }

    modifier onlyValidCandidate(uint256 _candidateId) {
        require(_candidateId < candidateCount, "Invalid candidate ID");
        _;
    }

    modifier onlyUniqueVoter() {
        require(!voters[msg.sender], "You have already voted");
        _;
    }

    constructor(string[] memory _candidateNames) {
        require(_candidateNames.length > 0, "At least one candidate required");

        for (uint256 i = 0; i < _candidateNames.length; i++) {
            candidates[i] = Candidate(_candidateNames[i], 0);
            emit CandidateAdded(i, _candidateNames[i]);
        }
        candidateCount = _candidateNames.length;
    }

    function vote(uint256 _candidateId) public onlyWhileVotingOpen onlyValidCandidate(_candidateId) onlyUniqueVoter {
        candidates[_candidateId].voteCount++;
        voters[msg.sender] = true;
        emit Voted(msg.sender, _candidateId);
    }

    function closeVoting() public {
        votingClosed = true;
    }

    function getCandidateVoteCount(uint256 _candidateId) public view onlyValidCandidate(_candidateId) returns (uint256) {
        return candidates[_candidateId].voteCount;
    }
}
