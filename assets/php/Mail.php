<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
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

// Path to the root directory:
define('ROOT', $_SERVER['DOCUMENT_ROOT'] . '/');

require(ROOT . 'assets/php/PHPMailer/PHPMailer/src/Exception.php');
require(ROOT . 'assets/php/PHPMailer/PHPMailer/src/PHPMailer.php');
require(ROOT . 'assets/php/PHPMailer/PHPMailer/src/SMTP.php');

class Mail {

    //declare variables
    private $mail;
    private $response = array();

    // Constructor:
    function __construct() {
        $this->mail = new PHPMailer(TRUE);
    }
    
    function initVariables($from, array $to, array $cc, array $bcc, $subject, $body, $altbody) {
        $this->mail->setFrom($from);
        
        //add addresses to send to
        for ($i = 0; $i < count($to); $i++) {
            $this->mail->addAddress($to[$i]);
        }
        
        //add addresses to cc
        for ($i = 0; $i < count($cc); $i++) {
            $this->mail->addCC($cc[$i]);
        }
        
        //add addresses to bcc
        for ($i = 0; $i < count($bcc); $i++) {
            $this->mail->addBCC($bcc[$i]);
        }
        
        $this->mail->Subject = $subject;
        $this->mail->Body = $body;
        $this->mail->AltBody = $altbody;
    }

    function send($from, $pass, array $to, array $cc, array $bcc, $subject, $body, $altbody) {
        try {
            //Server settings
            $this->mail->SMTPDebug = 2;                                 // Enable verbose debug output
	    //$this->mail->isSMTP();                                      // Set mailer to use SMTP
	    $this->mail->isMail();
	    $this->mail->Host = 'mail.starfolk.tech';  // Specify main and backup SMTP servers
	    $this->mail->SMTPAuth = true;                               // Enable SMTP authentication
	    $this->mail->Username = $from;                 // SMTP username
	    $this->mail->Password = $pass;                           // SMTP password
	    $this->mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
	    $this->mail->Port = 587;  
            
            //Content
            $this->mail->isHTML(true);                                  // Set email format to HTML
            
            $this->initVariables($from, $to, $cc, $bcc, $subject, $body, $altbody);
            
            $this->mail->send();
            header("HTTP/1.1 200 mail sent");
        } catch (Exception $e) {
            header("HTTP/1.1 500 Something went wrong. "
                    . "Please try again.".$this->mail->ErrorInfo);
        }
    }
}