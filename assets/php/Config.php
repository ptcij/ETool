<?php
/*
 * @package 
 * @author Faruk Nasir
 * @copyright (c) Faruk Nasir
 * @license GNU 
 * @link https://twitter/frknasir/
 */
//config parameters:
class Config {
    private $dbConfig = array();
    
    function __construct() {
	$this->setDbConfig('127.0.0.1', 'frknasir', 'youngprogrammer2303', 'electiontool');
    }
    
    private function setDbConfig($host, $user, $pass, $name, $link = null) {
	$this->dbConfig['dbConnection'] = array();
	$this->dbConfig['host'] = $host;
	$this->dbConfig['user'] = $user;
	$this->dbConfig['pass'] = $pass;
	$this->dbConfig['name'] = $name;
	$this->dbConfig['link'] = $link;
    }
    
    public function getDbConfig() {
	return $this->dbConfig;
    }
}
?>
