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

class LocalGov {
    //declare variables
    private $config, $db, $util, $localGovId, $localGovName, $stateId;
    
    // Constructor:
    function __construct($localGovId) {
	$this->config = new Config();
	
	$this->db = new DataBase($this->config->getDbConfig());
	$this->db->connect($this->config->getDbConfig());

	if($this->db->error()) {
	    header('HTTP/1.1 500 Sorry. Try Again!');
	    die();
	}

	$this->util = new Utility();
	
	$sql = "SELECT * FROM LOCALGOV WHERE localGovId = '$localGovId'";
	$query = new Query($sql, $this->db->getConnectionID());
	
	if($query->error()) {
	    header('HTTP/1.1 500 Error Initialising LocalGovernment.');
	    die();
	}
	
	$row = $query->fetchRow();
	
	$this->setLocalGovId($row[0]);
	$this->setStateId($row[1]);
	$this->setLocalGovName($row[2]);
    }
    
    private function setLocalGovId($localGovId) {
	$this->localGovId = $localGovId;
    }
    
    public function getLocalGovId() {
	return $this->localGovId;
    }
    
    private function setLocalGovName($localGovName) {
	$this->localGovName = $localGovName;
    }
    
    public function getLocalGovName() {
	return $this->localGovName;
    }
    
    private function setStateId($stateId) {
	$this->stateId = $stateId;
    }
    
    public function getStateId() {
	return $this->stateId;
    }
    
    public function getRegAreas() {
	$regAreas = array();
	
	$sql = "SELECT raId, raName FROM REGISTRATIONAREA WHERE localGovId = '$this->localGovId'";
	$query = new Query($sql, $this->db->getConnectionID());
	
	if($query->error()) {
	    header('HTTP/1.1 500 Couldnt get Registration Areas.!');
	    echo $query->getError();
	    return FALSE;
	}
	
	while($row = $query->fetchRow()) {
	    $regArea = array();
	    
	    $regArea['id'] = $row[0];
	    $regArea['name'] = $row[1];
	    
	    array_push($regAreas, $regArea);
	}
	
	echo json_encode($regAreas);
	
	return $regAreas;
    }
    
    public function getRAs() {
	$regAreas = array();
	
	$sql = "SELECT raId, raName FROM REGISTRATIONAREA WHERE localGovId = '$this->localGovId'";
	$query = new Query($sql, $this->db->getConnectionID());
	
	if($query->error()) {
	    header('HTTP/1.1 500 Couldnt get Registration Areas.!');
	    echo $query->getError();
	    return FALSE;
	}
	
	while($row = $query->fetchRow()) {
	    $regArea = array();
	    
	    $regArea['id'] = $row[0];
	    $regArea['name'] = $row[1];
	    
	    array_push($regAreas, $regArea);
	}
	
	return $regAreas;
    }
}

