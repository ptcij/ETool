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

class User {
    //declare variables
    private $id, $name, $email, $password, $imageUrl, 
	    $lastLogin, $status;

    // Constructor:
    function __construct() {
	
    }
    
    protected function setId($id) {
	$this->id = $id;
    }
    
    public function getId() {
	return $this->id;
    }
    
    protected function setName($name) {
	$this->name = $name;
    }
    
    public function getName() {
	return $this->name;
    }
    
    protected function setEmail($email) {
	$this->email = $email;
    }
    
    public function getEmail() {
	return $this->email;
    }
    
    protected function setPassword($password) {
	$this->password = $password;
    }
    
    public function getPassword() {
	return $this->password;
    }
    
    protected function setImageUrl($imageUrl) {
	$this->imageUrl = $imageUrl;
    }
    
    public function getImageUrl() {
	return $this->imageUrl;
    }
    
    protected function setLastLogin($lastLogin) {
	$this->lastLogin = $lastLogin;
    }
    
    public function getLastLogin() {
	return $this->lastLogin;
    }
    
    protected function setStatus($status) {
	$this->status = $status;
    }
    
    public function getStatus() {
	return $this->status;
    }
    
    public function changePassword($oldPass, $newPass, $confPass) {
	
    }
    
    public function addImageUrl($url) {
	
    }
}

