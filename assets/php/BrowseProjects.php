<?php

    ob_start();
    session_start();
    // Path to the root directory:
    define('ROOT_PATH', $_SERVER['DOCUMENT_ROOT'] . '/');

    require_once(ROOT_PATH . 'assets/php/classes.php');
    require_once(ROOT_PATH . 'assets/php/Project.php');
    
    $config = new Config();
    $db = new DataBase($config->getDbConfig());
    $db->connect($config->getDbConfig());
    $sessionManager = new SessionManager();
    
    $dbConfig = $config->getDbConfig();

    /* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
     * Easy set variables
     */

    // DB table to use
    $table = 'project';

    // Table's primary key
    $primaryKey = 'projectId';

    // Array of database columns which should be read and sent back to DataTables.
    // The `db` parameter represents the column name in the database, while the `dt`
    // parameter represents the DataTables column identifier. In this case object
    // parameter names
    $columns = array(
	array('db' => 'projectId', 'dt' => 'projectId'),
	array(
	    'db' => 'typeId', 
	    'dt' => 'type',
	    'formatter' => function( $d, $row ) {
		$type = new ProjectType($d);
		return $type->getTypeName()."(".$type->getTypeId().")";
	    }
	),
	array('db' => 'title', 'dt' => 'title'),
	array(
	    'db' => 'localGovId', 
	    'dt' => 'localGov',
	    'formatter' => function( $d, $row ) {
		$localGov = new LocalGov($d);
		return $localGov->getLocalGovName()."(".$localGov->getLocalGovId().")";
	    }
	),
	array(
	    'db' => 'localGovId', 
	    'dt' => 'state',
	    'formatter' => function( $d, $row ) {
		$localGov = new LocalGov($d);
		$state = new State($localGov->getStateId());
		return $state->getStateName()."(".$state->getStateId().")";
	    }
	),
	array(
	    'db' => 'ministryId', 
	    'dt' => 'ministry',
	    'formatter' => function( $d, $row ) {
		$ministry = new Ministry($d);
		return $ministry->getName()."(".$ministry->getId().")";
	    }
	),
	array(
	    'db' => 'agencyId', 
	    'dt' => 'agency',
	    'formatter' => function( $d, $row ) {
		$agency = new Agency($d);
		return $agency->getName()."(".$agency->getId().")";
	    }
	),
	array(
	    'db' => 'dateAdded', 
	    'dt' => 'added',
	    'formatter' => function( $d, $row ) {
		$util = new Utility();
		return $util->time_elapsed_string($d);
	    }
	),
	array(
	    'db' => 'projectId',
	    'dt' => 'actions',
	    'formatter' => function($d, $row) {
		return;
	    }
	)
    );

    // SQL server connection information
    $sql_details = array(
	'user' => $dbConfig["user"],
	'pass' => $dbConfig["pass"],
	'db' => $dbConfig["name"],
	'host' => $dbConfig["host"]
    );


    /*     * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
     * If you just want to use the basic configuration for DataTables with PHP
     * server-side, there is no need to edit below this line.
     */

    require_once(ROOT_PATH . 'assets/php/ssp.class.php');

    echo json_encode(
	    SSP::simple($_GET, $sql_details, $table, $primaryKey, $columns)
    );

    