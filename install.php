  <?php
/*
 * @package 
 * @author Faruk Nasir
 * @copyright (c) Faruk Nasir
 * @license GNU 
 * @link https://twitter/frknasir/
 */

// Path to the root directory:
define('ROOT_PATH', dirname($_SERVER['SCRIPT_FILENAME']).'/');

// Include Class libraries:
require(ROOT_PATH.'assets/php/classes.php');

class Installer 
{
    private $db, $config;
    
    function __construct() {
        $this->config = new Config();
	
	$this->db = new DataBase($this->config->getDbConfig());
	$this->db->connect($this->config->getDbConfig());

	if($this->db->error()) {
	    echo $this->db->getError();
	    die();
	}
    }
    
   
    function getTBLQueries() 
    {
	$queries = array();
        $index = 0;
        // Retrieve the queries from the SQL file:
        $lines = file(ROOT_PATH.'queries.sql');
        // Stop if an error occurs:
        if(!$lines) {
            echo 'Failed to load queries from file (queries.sql).';
            die();
        }
    
        foreach($lines as $line) 
        {
            if(empty($line)) 
            {
                continue;
            }
            $line = trim($line);
            if(count($queries) <= $index) 
            {
                array_push($queries, $line."\n");
            } 
            else 
            {
                $queries[$index] .= $line."\n";	
            }
            // Create a new array item for each query:
            if(substr($line, -1) == ';') {
                $index++;
            }
        }
        return $queries;
    }

    function createDataBaseTables($printSuccessConfirmation = true) 
    {
        $queries = $this->getTBLQueries();
        foreach ($queries as $sql) 
        {
            // Create a new SQL query:
            $query = new Query($sql, $this->db->getConnectionID());
            // Stop if an error occurs:
            if ($query->error()) 
            {
                echo $query->getError();
                die();
            }
        }
        if ($printSuccessConfirmation) 
        {
            // Print a success confirmation:
            echo 'Database tables created successfully - please delete this file (install.php).';
        }
    }
}

// Initialize the chat installer:
$installer = new Installer($config);

// Create the database tables:
$installer->createDataBaseTables();
?>