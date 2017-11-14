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

class RegistrationArea {
    //declare variables
    private $config, $db, $util, $id, $name, $localGovId;
    
    // Constructor:
    function __construct($id) {
	$this->config = new Config();
	
	$this->db = new DataBase($this->config->getDbConfig());
	$this->db->connect($this->config->getDbConfig());

	if($this->db->error()) {
	    header('HTTP/1.1 500 Sorry. Try Again!');
	    die();
	}

	$this->util = new Utility();
	
	$sql = "SELECT * FROM REGISTRATIONAREA WHERE raId = '$id'";
	$query = new Query($sql, $this->db->getConnectionID());
	
	if($query->error()) {
	    header('HTTP/1.1 500 Error Initialising State.');
	    die();
	}
	
	$row = $query->fetchRow();
	
	$this->setId($row[0]);
	$this->setName($row[1]);
	$this->setLocalGovId($row[2]);
    }
    
    private function setId($id) {
	$this->id = $id;
    }
    
    public function getId() {
	return $this->id;
    }
    
    private function setName($name) {
	$this->name = $name;
    }
    
    public function getName() {
	return $this->name;
    }
    
    private function setLocalGovId($localGovId) {
	$this->localGovId = $localGovId;
    }
    
    public function getLocalGovId() {
	return $this->localGovId;
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
    
    public function getPollingUnits() {
	$pollingUnits = array();
	
	$sql = "SELECT puId, puCode FROM POLLINGUNIT WHERE raId = '$this->id'";
	$query = new Query($sql, $this->db->getConnectionID());
	
	if($query->error()) {
	    header('HTTP/1.1 500 Couldnt get Polling Units.!');
	    echo $query->getError();
	    return FALSE;
	}
	
	while($row = $query->fetchRow()) {
	    $pollingUnit = array();
	    
	    $pollingUnit['id'] = $row[0];
	    $pollingUnit['code'] = $row[1];
	    
	    array_push($pollingUnits, $pollingUnit);
	}
	
	echo json_encode($pollingUnits);
	
	return $pollingUnits;
    }
}

