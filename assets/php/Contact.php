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

class Contact {

    //declare variables
    private $db, $name, $email, $subject, $message;
    private $response = array();private $util;

    // Constructor:
    function __construct($dbConfiguration) {
        $this->db = new DataBase($dbConfiguration);
        $this->db->connect($dbConfiguration);

        if ($this->db->error()) {
            header('HTTP/1.1 500 Sorry. Try Again!');
            die();
        }

        $this->util = new Utility();
    }
    
    function initVariables($name, $email, $subject, $message) {
        $this->name = $this->util->data_filter($name, $this->db->getConnectionID());
        $this->email = $this->util->data_filter($email, $this->db->getConnectionID());
        $this->subject = $this->util->data_filter($subject, $this->db->getConnectionID());
        $this->message = $this->util->data_filter($message, $this->db->getConnectionID());
    }
    
    function validateVars() {
        if(empty($this->name) || empty($this->email) || empty($this->subject) || 
                empty($this->message)) {
            header('HTTP/1.1 500 Some Required Fields Are Empty.');
            die();
        }
        
        if(!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            header('HTTP/1.1 500 Email is not valid.');
            die();
        }
    }

    function contact($name, $email, $sub, $message) {
        $this->response["success"] = 0;

        //get and initialize the post variables
        $this->initVariables($name, $email, $sub, $message);
        
        //validate variables
        $this->validateVars();

        //send mail
        $mail = new Mail();
        
        $from = 'firstplanet@starfolk.tech';
        $pass = 'yngstarfolkprg2303';
        $to = array();
        array_push($to, 'frknasir@yahoo.com', 'anne4u@yahoo.com');
        $cc = array();
        array_push($cc, 'ukaila005@yahoo.com');
        $bcc = array();
        $subject = "New Message from Contact Form";
        $body = "";
        $body_msg = "You have a new message from<br />Name: $this->name<br />Email: $this->email<br />Subject: $this->subject<br /><blockquote>$this->message</blockquote>";
        require_once($_SERVER['DOCUMENT_ROOT'] . "/blocks/mail/_MAIL_TEMP.php");
        $altbody = "Hey, First Planet. You have a new message from $this->name<<$this->email>>."
                . "The message is as follows: '$this->message'";
        
        $mail->send($from, $pass, $to, $cc, $bcc, $subject, $body, $altbody);

        //if code run reaches here, everything is good
        $this->response["success"] = 1;
        echo json_encode($this->response);
    }
}

if ($_POST) {
    $contact = new Contact($config);

    switch ($_POST['type']) {
        case "contact" :
            $contact->contact($_POST["name"],$_POST["email"],$_POST["subject"],
                    $_POST["message"]);
            break;
        default :
            return;
    }
}
