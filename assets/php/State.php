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

require(ROOT_PATH . 'assets/php/classes.php');

class State {
    //declare variables
    private $config, $db, $util, $stateId, $stateName;
    
    // Constructor:
    function __construct($stateId) {
	$this->config = new Config();
	
	$this->db = new DataBase($this->config->getDbConfig());
	$this->db->connect($this->config->getDbConfig());

	if($this->db->error()) {
	    header('HTTP/1.1 500 Sorry. Try Again!');
	    die();
	}

	$this->util = new Utility();
	
	$sql = "SELECT * FROM STATE WHERE stateId = '$stateId'";
	$query = new Query($sql, $this->db->getConnectionID());
	
	if($query->error()) {
	    header('HTTP/1.1 500 Error Initialising State.');
	    die();
	}
	
	$row = $query->fetchRow();
	
	$this->setStateId($row[0]);
	$this->setStateName($row[1]);
    }
    
    private function setStateId($stateId) {
	$this->stateId = $stateId;
    }
    
    public function getStateId() {
	return $this->stateId;
    }
    
    private function setStateName($stateName) {
	$this->stateName = $stateName;
    }
    
    public function getStateName() {
	return $this->stateName;
    }
    
    public function getLocalGCount() {
	$sql = "SELECT COUNT(*) FROM LOCALGOV WHERE stateId = '$this->stateId'";
	$query = new Query($sql, $this->db->getConnectionID());
	
	if($query->error()) {
	    header('HTTP/1.1 500 Something went wrong.');
	    echo $query->getError();
	    return FALSE;
	}
	
	$row = $query->fetchRow();
	$count = $row[0];
	
	return $count;
    }
    
    public function getRACount() {
	$sql = "SELECT COUNT(REGISTRATIONAREA.raId) FROM REGISTRATIONAREA, STATE, LOCALGOV "
		. "WHERE REGISTRATIONAREA.localGovId = LOCALGOV.localGovId AND "
		. "LOCALGOV.stateId = STATE.stateId AND STATE.stateId = '$this->stateId'";
	$query = new Query($sql, $this->db->getConnectionID());
	
	if($query->error()) {
	    header('HTTP/1.1 500 Something went wrong.');
	    echo $query->getError();
	    return FALSE;
	}
	
	$row = $query->fetchRow();
	$count = $row[0];
	
	return $count;
    }
    
    public function getPUCount() {
	$sql = "SELECT COUNT(POLLINGUNIT.puId) FROM POLLINGUNIT, REGISTRATIONAREA, STATE, LOCALGOV "
		. "WHERE POLLINGUNIT.raId = REGISTRATIONAREA.raId AND REGISTRATIONAREA.localGovId = LOCALGOV.localGovId AND "
		. "LOCALGOV.stateId = STATE.stateId AND STATE.stateId = '$this->stateId'";
	$query = new Query($sql, $this->db->getConnectionID());
	
	if($query->error()) {
	    header('HTTP/1.1 500 Something went wrong.');
	    echo $query->getError();
	    return FALSE;
	}
	
	$row = $query->fetchRow();
	$count = $row[0];
	
	return $count;
    }
    
    public function getLocalGovernments() {
	$localGovernments = array();
	
	$sql = "SELECT localGovId, localGovName FROM LOCALGOV WHERE stateId = '$this->stateId'";
	$query = new Query($sql, $this->db->getConnectionID());
	
	if($query->error()) {
	    header('HTTP/1.1 500 Couldnt get local governments.!');
	    echo $query->getError();
	    return FALSE;
	}
	
	while($row = $query->fetchRow()) {
	    $localGovernment = array();
	    
	    $localGovernment['id'] = $row[0];
	    $localGovernment['name'] = $row[1];
	    
	    array_push($localGovernments, $localGovernment);
	}
	
	echo json_encode($localGovernments);
	return $localGovernments;
    }
    
    public function getLocalGovs() {
	$localGovernments = array();
	
	$sql = "SELECT localGovId, localGovName FROM LOCALGOV WHERE stateId = '$this->stateId'";
	$query = new Query($sql, $this->db->getConnectionID());
	
	if($query->error()) {
	    header('HTTP/1.1 500 Couldnt get local governments.!');
	    echo $query->getError();
	    return FALSE;
	}
	
	while($row = $query->fetchRow()) {
	    $localGovernment = array();
	    
	    $localGovernment['id'] = $row[0];
	    $localGovernment['name'] = $row[1];
	    
	    array_push($localGovernments, $localGovernment);
	}
	
	return $localGovernments;
    }
}

