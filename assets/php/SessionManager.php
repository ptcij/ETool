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

class SessionManager {
    private $citizenId, $moderatorId;

    // Constructor:
    function __construct() {
	if(isset($_SESSION['citizenId'])) {
	    $this->setCitizenId($_SESSION['citizenId']);
	}
	
	if(isset($_SESSION['moderatorId'])) {
	    $this->setModeratorId($_SESSION['moderatorId']);
	}
    }
    
    private function setCitizenId($citizenId) {
	$this->citizenId = $citizenId;
    }
    
    public function getCitizenId() {
	return $this->citizenId;
    }
    
    private function setModeratorId($moderatorId) {
	$this->moderatorId = $moderatorId;
    }
    
    public function getModeratorId() {
	return $this->moderatorId;
    }
    
    //check if Citizen is logged in
    public function isCitizenLoggedIn() {
        if(isset($_SESSION["citizenLoggedIn"]) && $_SESSION["citizenLoggedIn"] == TRUE) {
            return TRUE;
        } 
	
	return FALSE;
    }
    
    //check if Moderator is logged in
    public function isModeratorLoggedIn() {
	if(isset($_SESSION["moderatorLoggedIn"]) && $_SESSION["moderatorLoggedIn"] == TRUE) {
            return TRUE;
        } 
	
	return FALSE;
    }
    
    public function logoutCitizen() {
	unset($_SESSION['citizenLoggedIn']);
	unset($_SESSION['citizenId']);
	header("Location: /");
    }
    
    public function logoutModerator() {
	unset($_SESSION['moderatorLoggedIn']);
	unset($_SESSION['moderatorId']);
	header("Location: /cms");
    }
}

?>

