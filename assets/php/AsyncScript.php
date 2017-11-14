<?php
    ob_start();
    session_start();
    // Path to the root directory:
    define('ROOT_PATH', $_SERVER['DOCUMENT_ROOT'] . '/');

    require_once(ROOT_PATH . 'assets/php/classes.php');
    require_once(ROOT_PATH . 'assets/php/Moderator.php');
    require_once(ROOT_PATH . 'assets/php/LocalGov.php');
    require_once(ROOT_PATH . 'assets/php/RegistrationArea.php');

    if($_POST) {
	$util = new Utility();
	$config = new Config();
	$db = new DataBase($config->getDbConfig());
	$db->connect($config->getDbConfig());
	$sessionManager = new SessionManager();

	$type = $util->data_filter($_POST['type'], $db->getConnectionID());

	switch($type) {
	    case "getLocalG" :
		$stateId = $util->data_filter($_POST['stateId'], $db->getConnectionID());
		if(empty($stateId)) {
		    header('HTTP/1.1 500 empty state Id');
		    die();
		}

		$state = new State($stateId);

		$state->getLocalGovernments();
		break;
	    case "changePass" :
		$citizen = new Citizen($sessionManager->getCitizenId());
		$oldPass = $util->data_filter($_POST["oldPass"], $db->getConnectionID());
		$newPass = $util->data_filter($_POST["newPass"], $db->getConnectionID());
		$confPass = $util->data_filter($_POST["confPass"], $db->getConnectionID());
		
		if(empty($oldPass) || empty($newPass) || empty($confPass)) {
		    header('HTTP/1.1 500 empty fields');
		    die();
		}
		$citizen->changePassword($oldPass, $newPass, $confPass);
		break;
	    case "changeModeratorPass" :
		$moderator = new Moderator($sessionManager->getModeratorId());
		$oldPass = $util->data_filter($_POST["oldPass"], $db->getConnectionID());
		$newPass = $util->data_filter($_POST["newPass"], $db->getConnectionID());
		$confPass = $util->data_filter($_POST["confPass"], $db->getConnectionID());
		
		if(empty($oldPass) || empty($newPass) || empty($confPass)) {
		    header('HTTP/1.1 500 empty fields');
		    die();
		}
		$moderator->changePassword($oldPass, $newPass, $confPass);
		break;
	    case "saveModeratorImageLink" :
		$moderator = new Moderator($sessionManager->getModeratorId());
		$url = $util->data_filter($_POST["url"], $db->getConnectionID());
		if (empty($url)) {
		    header('HTTP/1.1 500 Something is wrong.');
		    die();
		}
		
		$targetFolder = $_SERVER['DOCUMENT_ROOT'] . "/assets/img/moderators/";

		//$url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
		$tokens = explode('/', $moderator->getImageUrl());
		//get the uuid of the carousel - it is the first in the array 
		//of the exploded row
		$uuid = $tokens[0];
		//join the target folder with the $uuid to get the final target
		$target = join('/', array($targetFolder, $uuid));
		
		
		if(is_dir($target)) {
		    foreach (scandir($target) as $item) {
			if ($item == "." || $item == "..")
			    continue;
			if (is_dir($item)) {
			    $this->removeDir($item);
			} else {
			    unlink(join(DIRECTORY_SEPARATOR, array($target, $item)));
			}
		    }
		    rmdir($target);
		}
		
		$moderator->addImageUrl($url);
		break;
	    case "saveCitizenImageLink" :
		$citizen = new Citizen($sessionManager->getCitizenId());
		$url = $util->data_filter($_POST["url"], $db->getConnectionID());
		if (empty($url)) {
		    header('HTTP/1.1 500 Something is wrong.');
		    die();
		}
		
		$targetFolder = $_SERVER['DOCUMENT_ROOT'] . "/assets/img/citizens/";

		//$url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
		$tokens = explode('/', $citizen->getImageUrl());
		//get the uuid of the carousel - it is the first in the array 
		//of the exploded row
		$uuid = $tokens[0];
		//join the target folder with the $uuid to get the final target
		$target = join('/', array($targetFolder, $uuid));
		
		
		if(is_dir($target)) {
		    foreach (scandir($target) as $item) {
			if ($item == "." || $item == "..")
			    continue;
			if (is_dir($item)) {
			    $this->removeDir($item);
			} else {
			    unlink(join(DIRECTORY_SEPARATOR, array($target, $item)));
			}
		    }
		    rmdir($target);
		}
		
		$citizen->addImageUrl($url);
		break;
	    case "addParty" :
		$moderator = new Moderator($sessionManager->getModeratorId());
		$moderator->addPoliticalParty($_POST["initials"], $_POST["name"]);
		break;
	    case "deleteParty" :
		$moderator = new Moderator($sessionManager->getModeratorId());
		$moderator->deletePoliticalParty($_POST["partyId"]);
		break;
	    case "addElection" :
		$moderator = new Moderator($sessionManager->getModeratorId());
		$moderator->addElection($_POST["title"], $_POST["ptype"], 
			$_POST["state"], $_POST["regVoters"], $_POST["acrVoters"], 
			$_POST["votesCast"], $_POST["validVotes"], $_POST["rejVotes"], 
			$_POST["date"], $_POST["hashtag"]);
		break;
	    case "updateElection" :
		$moderator = new Moderator($sessionManager->getModeratorId());
		$moderator->updateElection($_POST["electionId"], $_POST["title"], $_POST["regVoters"], $_POST["acrVoters"], 
			$_POST["votesCast"], $_POST["validVotes"], $_POST["rejVotes"], 
			$_POST["date"], $_POST["hashtag"]);
		break;
	    case "addCandidate" :
		$moderator = new Moderator($sessionManager->getModeratorId());
		$moderator->addCandidate($_POST["partyId"], $_POST["electionId"], 
			$_POST["aspirant"], $_POST["deputy"], $_POST["gender"], 
			$_POST["age"], $_POST["qualification"]);
		break;
	    case "deleteCandidate" :
		$moderator = new Moderator($sessionManager->getModeratorId());
		$moderator->deleteCandidate($_POST["partyId"], $_POST["electionId"]);
		break;
	    case "addUpdate" :
		$moderator = new Moderator($sessionManager->getModeratorId());
		$moderator->addUpdate($_POST["electionId"], $_POST["title"], $_POST["description"]);
		break;
	    case "deleteUpdate" :
		$moderator = new Moderator($sessionManager->getModeratorId());
		$moderator->deleteUpdate($_POST["updateId"], $_POST["electionId"]);
		break;
	    case "getRAs" :
		$localGovId = $util->data_filter($_POST["localGovId"], $db->getConnectionID());
		
		if(empty($localGovId)) {
		    header('HTTP/1.1 500 empty localgov Id');
		    die();
		}

		$localGov = new LocalGov($localGovId);

		$localGov->getRegAreas();
		break;
	    case "getPUs" :
		$raId = $util->data_filter($_POST["raId"], $db->getConnectionID());
		
		if(empty($raId)) {
		    header('HTTP/1.1 500 empty RA Id');
		    die();
		}

		$regArea = new RegistrationArea($raId);

		$regArea->getPollingUnits();
		break;
	    case "addResultPU" :
		$moderator = new Moderator($sessionManager->getModeratorId());
		$moderator->addResultPU($_POST["partyId"], $_POST["electionId"], 
			$_POST["levelId"], $_POST["votes"]);
		break;
	    case "addResultRA" :
		$moderator = new Moderator($sessionManager->getModeratorId());
		$moderator->addResultRA($_POST["partyId"], $_POST["electionId"], 
			$_POST["levelId"], $_POST["votes"]);
		break;
	    case "addResultLG" :
		$moderator = new Moderator($sessionManager->getModeratorId());
		$moderator->addResultLG($_POST["partyId"], $_POST["electionId"], 
			$_POST["levelId"], $_POST["votes"]);
		break;
	    default :
		return;
	}
    }
?>

