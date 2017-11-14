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
require_once(ROOT_PATH . 'assets/php/User.php');

class Moderator extends User {
    private $config, $db, $util, $moderatorId;
    
    function __construct($moderatorId) {
	parent::__construct();
	
	$this->config = new Config();
	
	$this->db = new DataBase($this->config->getDbConfig());
	$this->db->connect($this->config->getDbConfig());

	if($this->db->error()) {
	    header('HTTP/1.1 500 Sorry. Try Again!');
	    die();
	}

	$this->util = new Utility();
	
	$this->init($moderatorId);
    }
    
    private function init($moderatorId) {
	$sql = "SELECT * FROM MODERATOR WHERE moderatorId = '$moderatorId'";
	$query = new Query($sql, $this->db->getConnectionID());
	
	if($query->error()) {
	    header('HTTP/1.1 500 Error Initialising Moderator.');
	    return FALSE;
	}
	
	if($query->numRows() <= 0) {
	    header('HTTP/1.1 500 No Such Moderator.');
	    return FALSE;
	}
	
	$row = $query->fetchRow();
	$this->setId($row[0]);
	$this->setName($row[1]);
	$this->setEmail($row[2]);
	$this->setPassword($row[3]);
	$this->setImageUrl($row[4]);
	$this->setLastLogin($row[5]);
	$this->setStatus($row[6]);
	
	$this->moderatorId = $this->getId();
	
	return TRUE;
    }
    
    public function changePassword($oldPass, $newPass, $confPass) {
	parent::changePassword($oldPass, $newPass, $confPass);
	
	if($this->getPassword() != md5($oldPass)) {
	    header('HTTP/1.1 500 Sorry. Try Again!');
	    return FALSE;
	}
	
	if($newPass != $confPass) {
	    header('HTTP/1.1 500 Password do not match');
	    return FALSE;
	}
	
	if(strlen($newPass) < 6) {
	    header('HTTP/1.1 500 Password is too short');
	    return FALSE;
	}
	
	$hashPass = md5($newPass);
	
	$sql = "UPDATE MODERATOR SET password = '$hashPass' WHERE moderatorId = '$this->moderatorId'";
	$query = new Query($sql, $this->db->getConnectionID());
	
	if($query->error()) {
	    header('HTTP/1.1 500 Coudnt update password. Try Again!');
	    echo $query->getError();
	    die();
	}
	
	$succes = 1;
	echo json_encode($succes);
	
	return TRUE;
    }

    public function addImageUrl($url) {
	parent::addImageUrl($url);
	
	$sql = "UPDATE MODERATOR SET imageUrl = '$url' WHERE moderatorId = '$this->moderatorId'";
	$query = new Query($sql, $this->db->getConnectionID());
	
	if($query->error()) {
	    header('HTTP/1.1 500 Couldnt update image url. Try Again!');
	    echo $query->getError();
	    return FALSE;
	}
	
	if($query->affectedRows() <= 0) {
	    header('HTTP/1.1 500 image Url Update wasnt successful. Try Again!');
	    return FALSE;
	}
	
	$succes = 1;
	echo json_encode($succes);
	
	return TRUE;
    }
    
    public function addPoliticalParty($i, $n) {
	$initials = $this->util->data_filter($i, $this->db->getConnectionID());
	$name = $this->util->data_filter($n, $this->db->getConnectionID());
	
	if(empty($initials) || empty($name)) {
	    header('HTTP/1.1 500 Fields empty. Try Again!');
	    return FALSE;
	}
	
	$sql = "INSERT INTO POLITICALPARTY(initials, name, addedBy) "
		. "VALUES('$initials','$name','$this->moderatorId')";
	$query = new Query($sql, $this->db->getConnectionID());
	
	if($query->error()) {
	    header('HTTP/1.1 500 Couldnt add political party. Try Again!');
	    echo $query->getError();
	    return FALSE;
	}
	
	$succes = 1;
	echo json_encode($succes);
	
	return TRUE;
    }
    
    public function deletePoliticalParty($id) {
	$partyId = $this->util->data_filter($id, $this->db->getConnectionID());
	
	if(empty($partyId)) {
	    header('HTTP/1.1 500 Fields empty. Try Again!');
	    return FALSE;
	}
	
	$sql = "DELETE FROM POLITICALPARTY WHERE partyId = '$partyId'";
	$query = new Query($sql, $this->db->getConnectionID());
	
	if($query->error()) {
	    header('HTTP/1.1 500 Couldnt delete political party. Try Again!');
	    echo $query->getError();
	    return FALSE;
	}
	
	$succes = 1;
	echo json_encode($succes);
	
	return TRUE;
    }
    
    public function addElection($ttl, $typ, $stt, $rv, $av, $vc, $vlv, $rjv, $dt, $ht) {
	$title = $this->util->data_filter($ttl, $this->db->getConnectionID());
	$type = $this->util->data_filter($typ, $this->db->getConnectionID());
	$state = $this->util->data_filter($stt, $this->db->getConnectionID());
	$regVoters = $this->util->data_filter($rv, $this->db->getConnectionID());
	$acrVoters = $this->util->data_filter($av, $this->db->getConnectionID());
	$votesCast = $this->util->data_filter($vc, $this->db->getConnectionID());
	$validVotes = $this->util->data_filter($vlv, $this->db->getConnectionID());
	$rejVotes = $this->util->data_filter($rjv, $this->db->getConnectionID());
	$date = $this->util->data_filter($dt, $this->db->getConnectionID());
	$hashtag = $this->util->data_filter($ht, $this->db->getConnectionID());
	
	if(empty($title) || empty($type) || empty($state) || empty($date) ) {
	    header('HTTP/1.1 500 Fields empty. Try Again!');
	    return FALSE;
	}
	
	$sql = "INSERT INTO ELECTION(title, type, stateId, registeredVoters, "
		. "accreditedVoters, votesCast, validVotes, rejectedVotes, date, hashtag, addedBy) "
		. "VALUES('$title', '$type', '$state', '$regVoters', '$acrVoters', "
		. "'$votesCast', '$validVotes', '$rejVotes', '$date', '$hashtag', '$this->moderatorId')";
	$query = new Query($sql, $this->db->getConnectionID());
	
	if($query->error()) {
	    header('HTTP/1.1 500 Couldnt add election. Try Again!');
	    echo $query->getError();
	    return FALSE;
	}
	
	$succes = 1; echo json_encode($succes);
	
	return TRUE;
    }
    
    public function updateElection($eId, $ttl, $rv, $av, $vc, $vlv, $rjv, $dt, $ht) {
	$electionId = $this->util->data_filter($eId, $this->db->getConnectionID());
	$title = $this->util->data_filter($ttl, $this->db->getConnectionID());
	$regVoters = $this->util->data_filter($rv, $this->db->getConnectionID());
	$acrVoters = $this->util->data_filter($av, $this->db->getConnectionID());
	$votesCast = $this->util->data_filter($vc, $this->db->getConnectionID());
	$validVotes = $this->util->data_filter($vlv, $this->db->getConnectionID());
	$rejVotes = $this->util->data_filter($rjv, $this->db->getConnectionID());
	$date = $this->util->data_filter($dt, $this->db->getConnectionID());
	$hashtag = $this->util->data_filter($ht, $this->db->getConnectionID());
	
	if(empty($eId) || empty($title) || empty($date) ) {
	    header('HTTP/1.1 500 Fields empty. Try Again!');
	    return FALSE;
	}
	
	$sql = "UPDATE ELECTION SET title = '$title', registeredVoters = '$regVoters', "
		. "accreditedVoters = '$acrVoters', "
		. "votesCast = '$votesCast', validVotes = '$validVotes', "
		. "rejectedVotes = '$rejVotes', date = '$date', hashtag = '$hashtag' "
		. "WHERE electionId = '$electionId'";
	$query = new Query($sql, $this->db->getConnectionID());
	
	if($query->error()) {
	    header('HTTP/1.1 500 Couldnt add election. Try Again!');
	    echo $query->getError();
	    return FALSE;
	}
	
	$succes = 1; echo json_encode($succes);
	
	return TRUE;
    }
    
    public function addCandidate($partyId, $electionId, $aspirant, $deputy, $gender, 
	    $age, $qualification) {
	$party = $this->util->data_filter($partyId, $this->db->getConnectionID());
	$electionId = $this->util->data_filter($electionId, $this->db->getConnectionID());
	$aspirant = $this->util->data_filter($aspirant, $this->db->getConnectionID());
	$deputy = $this->util->data_filter($deputy, $this->db->getConnectionID());
	$gender = $this->util->data_filter($gender, $this->db->getConnectionID());
	$age = $this->util->data_filter($age, $this->db->getConnectionID());
	$qualification = $this->util->data_filter($qualification, $this->db->getConnectionID());
	
	if(empty($party) || empty($electionId) || empty($aspirant) || empty($deputy) || 
		empty($gender) || empty($age) || empty($qualification)) {
	    header('HTTP/1.1 500 Fields empty. Try Again!');return FALSE;
	}
	
	$sql = "INSERT INTO CANDIDATE(partyId, electionId, aspirant, deputy, gender, "
		. "age, qualification, addedBy) VALUES('$party', '$electionId', "
		. "'$aspirant', '$deputy', '$gender', '$age', '$qualification', '$this->moderatorId')";
	$query = new Query($sql, $this->db->getConnectionID());
	
	if($query->error()) {
	    header('HTTP/1.1 500 Couldnt add candidate. Try Again!');
	    echo $query->getError();return FALSE;
	}
	
	$succes = 1; echo json_encode($succes);return TRUE;
    }
    
    public function deleteCandidate($partyId, $electionId) {
	$party = $this->util->data_filter($partyId, $this->db->getConnectionID());
	$electionId = $this->util->data_filter($electionId, $this->db->getConnectionID());
	
	if(empty($party) || empty($electionId)) {
	    header('HTTP/1.1 500 Fields empty. Try Again!');return FALSE;
	}
	
	$sql = "DELETE FROM CANDIDATE WHERE partyId = '$party' AND electionId = '$electionId'";
	$query = new Query($sql, $this->db->getConnectionID());
	
	if($query->error()) {
	    header('HTTP/1.1 500 Couldnt delete candidate. Try Again!');
	    echo $query->getError();return FALSE;
	}
	
	$succes = 1; echo json_encode($succes);return TRUE;
    }
    
    public function addUpdate($electionId, $title, $description) {
	$electionId = $this->util->data_filter($electionId, $this->db->getConnectionID());
	$title = $this->util->data_filter($title, $this->db->getConnectionID());
	$description = $this->util->data_filter($description, $this->db->getConnectionID());
	
	if(empty($electionId) || empty($title) || empty($description)) {
	    header('HTTP/1.1 500 Fields empty. Try Again!');return FALSE;
	}
	
	$sql = "INSERT INTO ELECTIONUPDATE(electionId, title, description, addedBy) "
		. "VALUES('$electionId', '$title', '$description', '$this->moderatorId')";
	$query = new Query($sql, $this->db->getConnectionID());
	
	if($query->error()) {
	    header('HTTP/1.1 500 Couldnt add update. Try Again!');
	    echo $query->getError();return FALSE;
	}
	
	$succes = 1; echo json_encode($succes);return TRUE;
    }
    
    public function deleteUpdate($uId, $eId) {
	$updateId = $this->util->data_filter($uId, $this->db->getConnectionID());
	$electionId = $this->util->data_filter($eId, $this->db->getConnectionID());
	
	if(empty($updateId) || empty($electionId)) {
	    header('HTTP/1.1 500 Fields empty. Try Again!');return FALSE;
	}
	
	$sql = "DELETE FROM ELECTIONUPDATE WHERE updateId = '$updateId' AND "
		. "electionId = '$electionId'";
	$query = new Query($sql, $this->db->getConnectionID());
	
	if($query->error()) {
	    header('HTTP/1.1 500 Couldnt delete update. Try Again!');
	    echo $query->getError();return FALSE;
	}
	
	$succes = 1; echo json_encode($succes);return TRUE;
    }
    
    public function addResultPU($pId, $eId, $poId, $v) {
	$partyId = $this->util->data_filter($pId, $this->db->getConnectionID());
	$electionId = $this->util->data_filter($eId, $this->db->getConnectionID());
	$puId = $this->util->data_filter($poId, $this->db->getConnectionID());
	$votes = $this->util->data_filter($v, $this->db->getConnectionID());
	
	if(empty($partyId) || empty($electionId) || empty($puId) || $votes == "" ) {
	    header('HTTP/1.1 500 Fields empty. Try Again!');return FALSE;
	}
	
	$s = "SELECT * FROM RESULTPU WHERE partyId = '$partyId' AND electionId = '$electionId' AND "
		. "puId = '$puId'";
	$q = new Query($s, $this->db->getConnectionID());
	
	if($q->error()) {
	    header('HTTP/1.1 500 Something went wrong!');echo $query->getError();return FALSE;
	}
	
	if($q->numRows() > 0) {
	    $sql = "UPDATE RESULTPU SET votes = '$votes' WHERE partyId = '$partyId' AND "
		    . "electionId = '$electionId' AND puId = '$puId'";
	} else {
	    $sql = "INSERT INTO RESULTPU(partyId, electionId, puId, votes, addedBy) VALUES('$partyId', '$electionId', "
		. "'$puId', '$votes', '$this->moderatorId')";
	}
	
	$query = new Query($sql, $this->db->getConnectionID());
	
	if($query->error()) {
	    header('HTTP/1.1 500 Couldnt add result. Try Again!');echo $query->getError();return FALSE;
	}
	
	$succes = 1; echo json_encode($succes);return TRUE;
    }
    
    public function addResultRA($pId, $eId, $rId, $v) {
	$partyId = $this->util->data_filter($pId, $this->db->getConnectionID());
	$electionId = $this->util->data_filter($eId, $this->db->getConnectionID());
	$raId = $this->util->data_filter($rId, $this->db->getConnectionID());
	$votes = $this->util->data_filter($v, $this->db->getConnectionID());
	
	if(empty($partyId) || empty($electionId) || empty($raId) || $votes == "" ) {
	    header('HTTP/1.1 500 Fields empty. Try Again!');return FALSE;
	}
	
	$sql = "INSERT INTO RESULTRA(partyId, electionId, raId, votes, addedBy) VALUES('$partyId', '$electionId', "
		. "'$raId', '$votes', '$this->moderatorId')";
	$query = new Query($sql, $this->db->getConnectionID());
	
	if($query->error()) {
	    header('HTTP/1.1 500 Couldnt add result. Try Again!');echo $query->getError();return FALSE;
	}
	
	$succes = 1; echo json_encode($succes);return TRUE;
    }
    
    public function addResultLG($pId, $eId, $lgId, $v) {
	$partyId = $this->util->data_filter($pId, $this->db->getConnectionID());
	$electionId = $this->util->data_filter($eId, $this->db->getConnectionID());
	$localGovId = $this->util->data_filter($lgId, $this->db->getConnectionID());
	$votes = $this->util->data_filter($v, $this->db->getConnectionID());
	
	if(empty($partyId) || empty($electionId) || empty($localGovId) || $votes == "" ) {
	    header('HTTP/1.1 500 Fields empty. Try Again!');return FALSE;
	}
	
	$sql = "INSERT INTO RESULTLG(partyId, electionId, localGovId, votes, addedBy) VALUES('$partyId', '$electionId', "
		. "'$localGovId', '$votes', '$this->moderatorId')";
	$query = new Query($sql, $this->db->getConnectionID());
	
	if($query->error()) {
	    header('HTTP/1.1 500 Couldnt add result. Try Again!');echo $query->getError();return FALSE;
	}
	
	$succes = 1; echo json_encode($succes);return TRUE;
    }
}
