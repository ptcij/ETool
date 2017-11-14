<?php
/*
 * @package 
 * @author Faruk Nasir
 * @copyright (c) Faruk Nasir
 * @license GNU 
 * @link https://twitter/frknasir/
 */

// Class to initialize the MySQL DataBase connection:
class DataBase 
{
    private $_connectionID;
    private $_errno = 0;
    private $_error = '';
    private $_dbName;
    
    //constructor
    function __construct($dbConnectionConfig) 
    {
        $this->_connectionID = $this->connect($dbConnectionConfig);
        $this->_dbName = $dbConnectionConfig['name'];
    }
	
    // Method to connect to the DataBase server:
    function connect($dbConnectionConfig) 
    {
        $this->_connectionID = mysqli_connect(
            $dbConnectionConfig['host'],
            $dbConnectionConfig['user'],
            $dbConnectionConfig['pass'],
            $dbConnectionConfig['name']
        );
        
        if(!$this->_connectionID) 
        {
            $this->_errno = mysqli_connect_errno();
            $this->_error = mysqli_connect_error();
            return false;
        }
            return true;
    }
	
    // Method to determine if an error has occured:
    function error() 
    {
        return (bool)$this->_error;
    }
	
    // Method to return the error report:
    function getError() 
    {
        if($this->error()) 
        {
            $str = 'Error-Report: '	.$this->_error."\n";
            $str .= 'Error-Code: '.$this->_errno."\n";
        } 
        
        else 
        {
            $str = 'No errors.'."\n";
        }
        
        return $str;		
    }
	
    // Method to return the connection identifier:
    function getConnectionID() 
    {
        return $this->_connectionID;
    }
	
    // Method to prevent SQL injections:
    function makeSafe($value) 
    {
        return "'".$this->_connectionID->escape_string($value)."'";
    }

    // Method to perform SQL queries:
    function sqlQuery($sql) 
    {
        return new MySQLiQuery($sql, $this->_connectionID);
    }

    // Method to retrieve the current DataBase name:
    function getName() 
    {
        return $this->_dbName;
    }

    // Method to retrieve the last inserted ID:
    function getLastInsertedID() 
    {
        return $this->_connectionID->insert_id;
    }
}
?>