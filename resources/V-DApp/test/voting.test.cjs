// test/Voting.test.js
const Voting = artifacts.require("Voting");

contract("Voting", (accounts) => {
  let votingInstance;

  before(async () => {
    votingInstance = await Voting.new(["Candidate 1", "Candidate 2", "Candidate 3"]);
  });

  it("should initialize with correct candidates", async () => {
    const candidateCount = await votingInstance.getCandidateCount();
    assert.equal(candidateCount, 3, "Incorrect candidate count");
  });

  it("should allow voting", async () => {
    await votingInstance.vote(0, { from: accounts[0] });
    const voteCount = await votingInstance.getCandidateVoteCount(0);
    assert.equal(voteCount, 1, "Incorrect vote count for candidate 0");
  });

  it("should prevent double voting", async () => {
    try {
      await votingInstance.vote(0, { from: accounts[0] });
      assert.fail("Double voting should be prevented");
    } catch (error) {
      assert.include(error.message, "You have already voted.", "Incorrect error message");
    }
  });
});
