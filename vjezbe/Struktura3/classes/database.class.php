<?php 


/*** S: Singleton class which connects to the database ***/
class Database {
	private $_connection;

	private $_host = "localhost";
	private $_username = "phproot";
	private $_password = "phproot2021!";
    private $_database = "pdfcreator";
    // private $_port = "";

	private static $_instance; 

    // Create instance of the class
	public static function instance() {
		
		if(!self::$_instance) { 
		    
		    // If no instance then make one here
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	// Constructor which connects to the database
	private function __construct() {
		try {
			$this->_connection = new PDO("mysql:host=$this->_host;dbname=$this->_database", $this->_username, $this->_password);
			$this->_connection->exec("set names utf8");
			// set the PDO error mode to exception
			$this->_connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			
		  } catch(PDOException $e) {
			echo "Connection failed: " . $e->getMessage();
		  }
	}

	// Magic method clone is empty to prevent duplication of connection
	private function __clone() { }

	// Get mysqli connection
	public function connect() {
		return $this->_connection;
	}
}
/*** E: Singleton class which connects to the database ***/

?>