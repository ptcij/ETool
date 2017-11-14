<?php
/*
 * @package 
 * @author Faruk Nasir
 * @copyright (c) Faruk Nasir
 * @license GNU 
 * @link https://twitter/frknasir/
 */

// Class to perform SQL (MySQLi) queries:
class Query 
{
    private $_connectionID;
    private $_sql = '';
    private $_result = 0;
    private $_errno = 0;
    private $_error = '';

    // Constructor:
    function __construct($sql, $connectionID) 
    {
        $this->_sql = trim($sql);
        $this->_connectionID = $connectionID;
        $this->_result = mysqli_query($this->_connectionID,$this->_sql);
        if(!$this->_result) 
        {
            $this->_errno = mysqli_errno($this->_connectionID);
            $this->_error = mysqli_error($this->_connectionID);
        }
    }

    // Returns true if an error occured:
    function error() 
    {
        // Returns true if the Result-ID is valid:
        return !(bool)($this->_result);
    }

    // Returns an Error-String:
    function getError() 
    {
        if($this->error()) 
        {
            $str  = 'Query: '	 .$this->_sql  ."\n";
            $str .= 'Error-Report: '	.$this->_error."\n";
            $str .= 'Error-Code: '.$this->_errno;
        } 
        
        else 
        {
            $str = "No errors.";
        }
        return $str;
    }

    // fetch array:
    function fetchArray() 
    {
        if($this->error()) 
        {
            return null;
        } 
        
        else 
        {
            return mysqli_fetch_array($this->_result);
        }
    }
    
    // fetch row:
    function fetchRow() 
    {
        if($this->error()) 
        {
            return null;
        } 
        
        else 
        {
            return mysqli_fetch_row($this->_result);
        }
    }

    // Returns the number of rows (SELECT or SHOW):
    function numRows() 
    {
        if($this->error()) 
        {
            return null;
        } 
        
        else 
        {
            return mysqli_num_rows($this->_result);
        }
    }
    
    //returns affected rows
    function affectedRows() 
    {
        if($this->error()) {
            return null;
        }
        
        else {
            return mysqli_affected_rows($this->_connectionID);
        }
    }
	
    // Returns last inserted id
    function getLastInsertedId() 
    {
        if($this->error()) 
        {
            return null;
        } 
        
        else 
        {
            return mysqli_insert_id($this->_connectionID);
        }
    }

    // Frees the memory:
    function free() 
    {
        free($this->_result);
    }	
}
?>