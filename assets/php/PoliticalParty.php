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

class PoliticalParty {
    //declare variables
    private $config, $db, $util, $partyId, $initials, $name, $adder;
    
    function __construct($partyId) {
	$this->config = new Config();
	
	$this->db = new DataBase($this->config->getDbConfig());
	$this->db->connect($this->config->getDbConfig());

	if($this->db->error()) {
	    header('HTTP/1.1 500 Sorry. Try Again!');
	    die();
	}

	$this->util = new Utility();
	
	$sql = "SELECT * FROM POLITICALPARTY WHERE partyId = '$partyId'";
	$query = new Query($sql, $this->db->getConnectionID());
	
	if($query->error()) {
	    header('HTTP/1.1 500 Error Initialising Party.');
	    die();
	}
	
	$row = $query->fetchRow();
	
	$this->setId($row[0]);
	$this->setInitials($row[1]);
	$this->setName($row[2]);
	$this->setAdder($row[3]);
    }
    
    private function setId($id) {
	$this->partyId = $id;
    }
    
    public function getId() {
	return $this->partyId;
    }
    
    private function setInitials($initials) {
	$this->initials = $initials;
    }
    
    public function getInitials() {
	return $this->initials;
    }
    
    private function setName($name) {
	$this->name = $name;
    }
    
    public function getName() {
	return $this->name;
    }
    
    private function setAdder($adder) {
	$this->adder = $adder;
    }
    
    public function getAdder() {
	return $this->adder;
    }
    
    public static function getParties($connection) {
	$parties = array();
	
	$sql = "SELECT * FROM POLITICALPARTY";
	$query = new Query($sql, $connection);
	
	if($query->error()) {
	    header('HTTP/1.1 500 Couldnt get parties. Try Again!');
	    echo $query->getError();
	    return FALSE;
	}
	
	while($row = $query->fetchRow()) {
	    $party = array();
	    
	    $party["id"] = $row[0];
	    $party["initials"] = $row[1];
	    $party["name"] = $row[2];
	    $party["adder"] = $row[3];
	    
	    array_push($parties, $party);
	}
	
	return $parties;
    }
    
    public function getCandidate($electionId) {
	$candidate = array();
	
	$electionId = $this->util->data_filter($electionId, $this->db->getConnectionID());
	
	if(empty($electionId)) {
	    header('HTTP/1.1 500 Fields empty. Try Again!');return FALSE;
	}
	
	$sql = "SELECT aspirant, deputy, gender, age, qualification FROM CANDIDATE "
		. "WHERE partyId = '$this->partyId' AND electionId = '$electionId'";
	$query = new Query($sql, $this->db->getConnectionID());
	
	if($query->error()) {
	    header('HTTP/1.1 500 Couldnt get candidate. Try Again!');
	    echo $query->getError();
	    return FALSE;
	}
	
	$row = $query->fetchRow();
	
	$candidate["aspirant"] = $row[0];
	$candidate["deputy"] = $row[1];
	$candidate["gender"] = $row[2];
	$candidate["age"] = $row[3];
	$candidate["qualification"] = $row[4];
	
	return $candidate;
    }
}

