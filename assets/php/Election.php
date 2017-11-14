<?php
/*
* @package
* @author Faruk Nasir
* @copyright (c) Faruk Nasir
* @license GNU
* @link https://twitter.com/frknasir
*/

//path to the root directory
//define('ROOT_PATH', dirname($_SERVER['SCRIPT_FILENAME']).'/');
//include class libraries
ob_start();
session_start();
// Path to the root directory:
define('ROOT_PATH', $_SERVER['DOCUMENT_ROOT'] . '/');

require_once(ROOT_PATH . 'assets/php/classes.php');
require_once(ROOT_PATH . 'assets/php/State.php');
require_once(ROOT_PATH . 'assets/php/ElectionType.php');
require_once(ROOT_PATH . 'assets/php/PoliticalParty.php');

class Election {
    //declare variables
    private $config, $db, $util, $id, $title, $typeId, $type, $state, $stateId, 
	    $date, $regVoters, $acrVoters, $votesCast, $validVotes, $rejVotes, 
	    $dateAdded, $hashtag, $adder;
    
    // Constructor:
    function __construct($id) {
	$this->id = $id;
	$this->config = new Config();
	
	$this->db = new DataBase($this->config->getDbConfig());
	$this->db->connect($this->config->getDbConfig());

	if($this->db->error()) {
	    header('HTTP/1.1 500 Sorry. Try Again!');
	    die();
	}

	$this->util = new Utility();
	
	$this->initParams($id);
    }
    
    private function initParams($id) {
	$sql = "SELECT * FROM ELECTION WHERE electionId = '$id'";
	$query = new Query($sql, $this->db->getConnectionID());
	
	if($query->error()) {
	    header('HTTP/1.1 500 Error Initialising Election.');
	    die();
	}
	
	$row = $query->fetchRow();
	$this->setId($row[0]);
	$this->setTitle($row[1]);
	
	$this->setTypeId($row[2]);
	$type = new ElectionType($row[2]);
	$this->setType($type->getTypeName());
	
	$this->setStateId($row[3]);
	$state = new State($row[3]);
	$this->setState($state->getStateName());
	
	$this->setRegVoters($row[4]);
	$this->setAcrVoters($row[5]);
	$this->setVotesCast($row[6]);
	$this->setValidVotes($row[7]);
	$this->setRejVotes($row[8]);
	$this->setDate($row[9]);
	$this->setDateAdded($row[10]);
	$this->setHashtag($row[11]);
	$this->setAdder($row[12]);
    }
    
    private function setId($id) {
	$this->id = $id;
    }
    
    public function getId() {
	return $this->id;
    }
    
    private function setTitle($title) {
	$this->title = $title;
    }
    
    public function getTitle() {
	return $this->title;
    }
    
    private function setTypeId($typeId) {
	$this->typeId = $typeId;
    }
    
    public function getTypeId() {
	return $this->typeId;
    }
    
    private function setType($type) {
	$this->type = $type;
    }
    
    public function getType() {
	return $this->type;
    }
    
    private function setStateId($stateId) {
	$this->stateId = $stateId;
    }
    
    public function getStateId() {
	return $this->stateId;
    }
    
    private function setState($state) {
	$this->state = $state;
    }
    
    public function getState() {
	return $this->state;
    }
    
    private function setDate($date) {
	$this->date = $date;
    }
    
    public function getDate() {
	return $this->date;
    }
    
    private function setRegVoters($regVoters) {
	$this->regVoters = $regVoters;
    }
    
    public function getRegVoters() {
	return $this->regVoters;
    }
    
    private function setAcrVoters($acrVoters) {
	$this->acrVoters = $acrVoters;
    }
    
    public function getAcrVoters() {
	return $this->acrVoters;
    }
    
    private function setVotesCast($votesCast) {
	$this->votesCast = $votesCast;
    }
    
    public function getVotesCast() {
	return $this->votesCast;
    }
    
    private function setValidVotes($validVotes) {
	$this->validVotes = $validVotes;
    }
    
    public function getValidVotes() {
	return $this->validVotes;
    }
    
    private function setRejVotes($rejVotes) {
	$this->rejVotes = $rejVotes;
    }
    
    public function getRejVotes() {
	return $this->rejVotes;
    }

    private function setDateAdded($dateAdded) {
	$this->dateAdded = $dateAdded;
    }
    
    public function getDateAdded() {
	return $this->dateAdded;
    }
    
    private function setHashtag($hashtag) {
	$this->hashtag = $hashtag;
    }
    
    public function getHashtag() {
	return $this->hashtag;
    }
    
    private function setAdder($adder) {
	$this->adder = $adder;
    }
    
    public function getAdder() {
	return $this->adder;
    }
    
    public static function getUpcoming($connection) {
	$elections = array();
	
	$sql = "SELECT electionId, title, type, `date` FROM ELECTION WHERE `date` >= CURRENT_TIMESTAMP";
	$query = new Query($sql, $connection);
	
	if($query->error()) {
	    header('HTTP/1.1 500 Couldnt load upcoming election. Try Again!');
	    echo $query->getError();
	    return FALSE;
	}
	
	while($row = $query->fetchRow()) {
	    $election = array();
	    
	    $election["electionId"] = $row[0];
	    $election["title"] = $row[1];
	    $election["type"] = $row[2];
	    $election["date"] = $row[3];
	    
	    array_push($elections, $election);
	}
	
	return $elections;
    }
    
    public static function getAll($connection, $offset, $limit) {
	$elections = array();
	
	$sql = "SELECT electionId, title, type, `date` FROM ELECTION ORDER BY `date` DESC LIMIT $offset, $limit";
	$query = new Query($sql, $connection);
	
	if($query->error()) {
	    header('HTTP/1.1 500 Couldnt load elections. Try Again!');
	    echo $query->getError();
	    return FALSE;
	}
	
	while($row = $query->fetchRow()) {
	    $election = array();
	    
	    $election["electionId"] = $row[0];
	    $election["title"] = $row[1];
	    $election["type"] = $row[2];
	    $election["date"] = $row[3];
	    
	    array_push($elections, $election);
	}
	
	return $elections;
    }
    
    public function getCandidates() {
	$candidates = array();
	
	$sql = "SELECT * FROM CANDIDATE WHERE electionId = '$this->id'";
	$query = new Query($sql, $this->db->getConnectionID());
	
	if($query->error()) {
	    header('HTTP/1.1 500 Couldnt load candidates. Try Again!');
	    echo $query->getError();return FALSE;
	}
	
	while($row = $query->fetchRow()) {
	    $candidate = array();
	    
	    $party = new PoliticalParty($row[0]);
	    $candidate["party"] = $party->getInitials();
	    $candidate["partyId"] = $row[0];
	    $candidate["electionId"] = $row[1];
	    $candidate["aspirant"] = $row[2];
	    $candidate["deputy"] = $row[3];
	    $candidate["gender"] = $row[4];
	    $candidate["age"] = $row[5];
	    $candidate["qualification"] = $row[6];
	    
	    array_push($candidates, $candidate);
	}
	
	return $candidates;
    }
    
    public function getUpdates($offset, $limit) {
	$updates = array();
	
	$sql = "SELECT * FROM ELECTIONUPDATE WHERE electionId = '$this->id' ORDER BY "
		. "dateAdded DESC LIMIT $offset, $limit";
	$query = new Query($sql, $this->db->getConnectionID());
	
	if($query->error()) {
	    header('HTTP/1.1 500 Couldnt load updates. Try Again!');
	    echo $query->getError();
	    return FALSE;
	}
	
	while($row = $query->fetchRow()) {
	    $update = array();
	    
	    $update["id"] = $row[0];
	    $update["electionId"] = $row[1];
	    $update["title"] = $row[2];
	    $update["desc"] = $row[3];
	    $update["date"] = $row[4];
	    
	    array_push($updates, $update);
	}
	
	return $updates;
    }
    
    public function getResultsCountLG() {
	$sql = "SELECT DISTINCT localGovId FROM RESULTLG WHERE electionId = '$this->id'";
	$query = new Query($sql, $this->db->getConnectionID());
	
	if($query->error()) {
	    header('HTTP/1.1 500 something went wrong.');
	    echo $query->getError();
	    return FALSE;
	}
	
	$count = $query->numRows();
	
	return $count;
    }
    
    public function getResultsCountRA() {
	$sql = "SELECT DISTINCT raId FROM RESULTRA WHERE electionId = '$this->id'";
	$query = new Query($sql, $this->db->getConnectionID());
	
	if($query->error()) {
	    header('HTTP/1.1 500 something went wrong.');
	    echo $query->getError();
	    return FALSE;
	}
	
	$count = $query->numRows();
	
	return $count;
    }
    
    public function getResultsCountPU() {
	$sql = "SELECT DISTINCT puId FROM RESULTPU WHERE electionId = '$this->id'";
	$query = new Query($sql, $this->db->getConnectionID());
	
	if($query->error()) {
	    header('HTTP/1.1 500 something went wrong.');
	    echo $query->getError();
	    return FALSE;
	}
	
	$count = $query->numRows();
	
	return $count;
    }
    
    public function getTotalVotesLG($partyId) {
	$partyId = $this->util->data_filter($partyId, $this->db->getConnectionID());
	
	if(empty($partyId)) {
	    header('HTTP/1.1 500 something went wrong.');
	    return FALSE;
	}
	
	$sql = "SELECT SUM(votes) FROM RESULTLG WHERE partyId = '$partyId' AND "
		. "electionId = '$this->id'";
	$query = new Query($sql, $this->db->getConnectionID());
	
	if($query->error()) {
	    header('HTTP/1.1 500 couldnt get results.');
	    echo $query->getError();
	    return FALSE;
	}
	
	if($query->numRows() <= 0) {
	    return "Not Available";
	}
	
	$row = $query->fetchRow();
	
	return $row[0];
    }
    
    public function getTotalVotesRA($partyId) {
	$partyId = $this->util->data_filter($partyId, $this->db->getConnectionID());
	
	if(empty($partyId)) {
	    header('HTTP/1.1 500 something went wrong.');
	    return FALSE;
	}
	
	$sql = "SELECT SUM(votes) FROM RESULTRA WHERE partyId = '$partyId' AND "
		. "electionId = '$this->id'";
	$query = new Query($sql, $this->db->getConnectionID());
	
	if($query->error()) {
	    header('HTTP/1.1 500 couldnt get results.');
	    echo $query->getError();
	    return FALSE;
	}
	
	if($query->numRows() <= 0) {
	    return "Not Available";
	}
	
	$row = $query->fetchRow();
	
	return $row[0];
    }
    
    public function getTotalVotesPU($partyId) {
	$partyId = $this->util->data_filter($partyId, $this->db->getConnectionID());
	
	if(empty($partyId)) {
	    header('HTTP/1.1 500 something went wrong.');
	    return FALSE;
	}
	
	$sql = "SELECT SUM(votes) FROM RESULTPU WHERE partyId = '$partyId' AND "
		. "electionId = '$this->id'";
	$query = new Query($sql, $this->db->getConnectionID());
	
	if($query->error()) {
	    header('HTTP/1.1 500 couldnt get results.');
	    echo $query->getError();
	    return FALSE;
	}
	
	if($query->numRows() <= 0) {
	    return "Not Available";
	}
	
	$row = $query->fetchRow();
	
	return $row[0];
    }
    
    public function getPartyVotesLG($pId, $lId) {
	$partyId = $this->util->data_filter($pId, $this->db->getConnectionID());
	$localGovId = $this->util->data_filter($lId, $this->db->getConnectionID());
	
	if(empty($partyId) || empty($localGovId)) {
	    header('HTTP/1.1 500 something went wrong.');
	    return FALSE;
	}
	
	$sql = "SELECT votes FROM RESULTLG WHERE partyId = '$partyId' AND "
		. "electionId = '$this->id' AND localGovId = '$localGovId'";
	$query = new Query($sql, $this->db->getConnectionID());
	
	if($query->error()) {
	    header('HTTP/1.1 500 couldnt get results.');
	    echo $query->getError();
	    return FALSE;
	}
	
	if($query->numRows() <= 0) {
	    return "Not Available";
	}
	
	$row = $query->fetchRow();
	
	return $row[0];
    }
    
    public function getPartyVotesRA($pId, $rId) {
	$partyId = $this->util->data_filter($pId, $this->db->getConnectionID());
	$raId = $this->util->data_filter($rId, $this->db->getConnectionID());
	
	if(empty($partyId) || empty($raId)) {
	    header('HTTP/1.1 500 something went wrong.');
	    return FALSE;
	}
	
	$sql = "SELECT votes FROM RESULTRA WHERE partyId = '$partyId' AND "
		. "electionId = '$this->id' AND raId = '$raId'";
	$query = new Query($sql, $this->db->getConnectionID());
	
	if($query->error()) {
	    header('HTTP/1.1 500 couldnt get results.');
	    echo $query->getError();
	    return FALSE;
	}
	
	if($query->numRows() <= 0) {
	    return "Not Available";
	}
	
	$row = $query->fetchRow();
	
	return $row[0];
    }
    
    public function getPartyVotesPU($pId, $poId) {
	$partyId = $this->util->data_filter($pId, $this->db->getConnectionID());
	$puId = $this->util->data_filter($poId, $this->db->getConnectionID());
	
	if(empty($partyId) || empty($puId)) {
	    header('HTTP/1.1 500 something went wrong.');
	    return FALSE;
	}
	
	$sql = "SELECT votes FROM RESULTPU WHERE partyId = '$partyId' AND "
		. "electionId = '$this->id' AND puId = '$poId'";
	$query = new Query($sql, $this->db->getConnectionID());
	
	if($query->error()) {
	    header('HTTP/1.1 500 couldnt get results.');
	    echo $query->getError();
	    return FALSE;
	}
	
	if($query->numRows() <= 0) {
	    return "Not Available";
	}
	
	$row = $query->fetchRow();
	
	return $row[0];
    }
}