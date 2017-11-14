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

class Auth {

    //declare variables
    private $config, $db, $util, $confirmationCode, $name, $email, $localGov, $userId;
    private $response = array();

    // Constructor:
    function __construct() {
	$this->config = new Config();
	
	$this->db = new DataBase($this->config->getDbConfig());
	$this->db->connect($this->config->getDbConfig());

	if($this->db->error()) {
	    header('HTTP/1.1 500 Server connection boo boo.');
	    echo json_encode($this->response);
	    die();
	}

	$this->util = new Utility();
    }

    private function initVars($name, $email, $localGov, $password, $cpassword) {
	$this->name = $this->util->data_filter($name, 
		$this->db->getConnectionID());
	$this->email = $this->util->data_filter($email,
		$this->db->getConnectionID());
	$this->localGov = $this->util->data_filter($localGov, 
		$this->db->getConnectionID());
	$this->password = $this->util->data_filter($password,
		$this->db->getConnectionID());
	$this->cpassword = $this->util->data_filter($cpassword,
		$this->db->getConnectionID());
    }

    private function validateVars() {
	if(empty($this->name) || empty($this->email) || empty($this->localGov) || 
		empty($this->password) || empty($this->cpassword)) {
	    header('HTTP/1.1 500 Check fields again.');
	    die();
	}

	if(!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
	    header('HTTP/1.1 500 Email is not valid.');
	    die();
	}

	if($this->password !== $this->cpassword) {
	    header('HTTP/1.1 500 Passwords do not match.');
	    die();
	}

	if(strlen($this->password) < 6) {
	    header('HTTP/1.1 500 Password is too short.');
	    die();
	}
    }

    private function userIsMember() {
	//check if user is already a member
	$checkEmailSql = "SELECT email FROM CITIZEN WHERE email = '$this->email'";
	$checkEmailQuery = new Query($checkEmailSql, $this->db->getConnectionID());

	if($checkEmailQuery->error()) {
	    header('HTTP/1.1 500 Sorry. Try Again!');
	    die();
	}

	//check if email exists in records
	if($checkEmailQuery->numRows() > 0) {
	    header('HTTP/1.1 500 Such email is already in our database.');
	    die();
	}
    }

    private function addUser() {
	//hash the password for security reasons
	$this->password = md5($this->password);

	//generate unique user Id
	$this->userId = $this->util->generateID(8);
	$this->active = 1;

	//if user is not a member, save details to the database
	$newSql = "INSERT INTO CITIZEN(citizenId, name, "
		. "email, localGovId, password) VALUES('$this->userId', '$this->name', "
		. "'$this->email', '$this->localGov', '$this->password')";
	$newQuery = new Query($newSql, $this->db->getConnectionID());

	if($newQuery->error()) {
	    header("HTTP/1.1 500 Sorry. Something went wrong. Try Again.");
	    die();
	}

	$this->confirmationCode = $this->util->generateID(20);

	$insertSql = "INSERT INTO GENCODE(citizenId, code) VALUES('$this->userId', '$this->confirmationCode')";
	$insertQuery = new Query($insertSql, $this->db->getConnectionID());
    }

    private function sendConfMail() {
	$mail = new Mail();
	$from = 'firstplanet@starfolk.tech';
	$pass = 'yngstarfolkprg2303';
	$to = array();
	array_push($to, $this->email);
	$cc = array();
	$bcc = array();
	$subject = "Email Confirmation";
	$body = "";
	$body_msg = "Your registration was successful. Please click the button below "
		. "to confirm your email. Thank You.";
	$btn_href = "/?userId=$this->userId&&confCode=$this->confirmationCode";
	$btn_name = "Confirm Email";
	require_once($_SERVER['DOCUMENT_ROOT'] . "/blocks/mail/_MAIL_TEMP_BTN.php");
	$altbody = "Your registration was successful. Copy and paste the following link to your browser to "
		. "confirm your email - /?userId=$this->userId&&confCode=$this->confirmationCode";
	$mail->send($from, $pass, $to, $cc, $bcc, $subject, $body, $altbody);
    }

    public function registerCitizen($name, $email, $localGov, $password, $cpassword) {
	$this->response["success"] = 0;

	//get and initialize the post variables
	$this->initVars($name, $email, $localGov, $password, $cpassword);

	//validate variables
	$this->validateVars();

	//check if user is member
	$this->userIsMember();

	//add user
	$this->addUser();

	//send email confirmation mail
	//$this->sendConfMail();

	//if code run reaches here, everything is good
	$this->response["success"] = 1;
	echo json_encode($this->response);
    }
    
    private function checkLoginVars() {
	//check if variables are empty
	if(empty($this->email)) {
	    header('HTTP/1.1 500 Email can not be empty');
	    die();
	}

	if(empty($this->password)) {
	    header('HTTP/1.1 500 Password can not be empty');
	    die();
	}

	if(!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
	    //Email is valid
	    header('HTTP/1.1 500 Email is not valid');
	    die();
	}
    }

    public function loginCitizen($email, $password) {
	$this->response["success"] = 0;

	//get and initialize the post variables
	$this->email = $this->util->data_filter($email,
		$this->db->getConnectionID());
	$this->password = $this->util->data_filter($password,
		$this->db->getConnectionID());

	//check login variables
	$this->checkLoginVars();

	//hash the password
	$this->password = md5($this->password);
	
	$checkEmailSql = "SELECT citizenId FROM CITIZEN WHERE email = '$this->email' "
		. "AND password = '$this->password' AND active = '1'";
	$checkEmailQuery = new Query($checkEmailSql, $this->db->getConnectionID());

	if($checkEmailQuery->error()) {
	    header('HTTP/1.1 500 Sorry. Try Again.');
	    die();
	}

	if($checkEmailQuery->numRows() > 0) {
	    $row = $checkEmailQuery->fetchRow();
	    $_SESSION["citizenLoggedIn"] = TRUE;
	    $_SESSION["citizenId"] = $row[0];

	    //update last login time
	    $lastLoginSql = "UPDATE CITIZEN SET lastLogin = now() WHERE email = '$this->email'";
	    $lastLoginQuery = new Query($lastLoginSql, $this->db->getConnectionID());
	} else {
	    header('HTTP/1.1 500 Something. Somewhere. Is Wrong.');
	    die();
	}

	$this->response["success"] = 1;
	echo json_encode($this->response);
    }
    
    public function loginModerator($email, $password) {
	$this->response["success"] = 0;

	//get and initialize the post variables
	$this->email = $this->util->data_filter($email,
		$this->db->getConnectionID());
	$this->password = $this->util->data_filter($password,
		$this->db->getConnectionID());

	//check login variables
	$this->checkLoginVars();

	//hash the password
	$this->password = md5($this->password);
	
	$checkEmailSql = "SELECT moderatorId FROM MODERATOR WHERE email = '$this->email' "
		. "AND password = '$this->password' AND status = '1'";
	$checkEmailQuery = new Query($checkEmailSql, $this->db->getConnectionID());

	if($checkEmailQuery->error()) {
	    header('HTTP/1.1 500 Sorry. Try Again.');
	    die();
	}

	if($checkEmailQuery->numRows() > 0) {
	    $row = $checkEmailQuery->fetchRow();
	    $_SESSION["moderatorLoggedIn"] = TRUE;
	    $_SESSION["moderatorId"] = $row[0];

	    //update last login time
	    $lastLoginSql = "UPDATE MODERATOR SET lastLogin = now() WHERE email = '$this->email'";
	    $lastLoginQuery = new Query($lastLoginSql, $this->db->getConnectionID());
	} else {
	    header('HTTP/1.1 500 Something. Somewhere. Is Wrong.');
	    die();
	}

	$this->response["success"] = 1;
	echo json_encode($this->response);
    }
}

if($_POST) {
    $auth = new Auth();

    switch($_POST['type']) {
	case "registerCitizen" :
	    $auth->registerCitizen($_POST["name"], $_POST["email"], $_POST["localGov"],  
		    $_POST["password"], $_POST["cpassword"]);
	    break;
	case "loginCitizen" :
	    $auth->loginCitizen($_POST["email"], $_POST["password"]);
	    break;
	case "loginModerator" :
	    $auth->loginModerator($_POST["email"], $_POST["password"]);
	    break;
	default :
	    return;
    }
}
?>
