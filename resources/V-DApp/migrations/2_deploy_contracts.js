const Voting = artifacts.require("Voting");

module.exports = function(deployer) {
  deployer.deploy(Voting, ["Candidate 1", "Candidate 2", "Candidate 3"]);
};
