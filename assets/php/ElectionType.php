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

class ElectionType {
    //declare variables
    private $config, $db, $util, $typeId, $typeName;
    
    // Constructor:
    function __construct($typeId) {
	$this->config = new Config();
	
	$this->db = new DataBase($this->config->getDbConfig());
	$this->db->connect($this->config->getDbConfig());

	if($this->db->error()) {
	    header('HTTP/1.1 500 Sorry. Try Again!');
	    die();
	}

	$this->util = new Utility();
	
	$sql = "SELECT * FROM ELECTIONTYPE WHERE typeId = '$typeId'";
	$query = new Query($sql, $this->db->getConnectionID());
	
	if($query->error()) {
	    header('HTTP/1.1 500 Error Initialising Election Type.');
	    die();
	}
	
	$row = $query->fetchRow();
	
	$this->setTypeId($row[0]);
	$this->setTypeName($row[1]);
    }
    
    private function setTypeId($typeId) {
	$this->typeId = $typeId;
    }
    
    public function getTypeId() {
	return $this->typeId;
    }
    
    private function setTypeName($typeName) {
	$this->typeName = $typeName;
    }
    
    public function getTypeName() {
	return $this->typeName;
    }
}

