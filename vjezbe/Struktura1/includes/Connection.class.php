<?php

/*** S: Singleton class which connects to the database ***/
class Connection {
	private $_connection;

	private $_hostname = "localhost";
	private $_username = "";
	private $_password = "";
  private $_database = "";
  private $_port = "";

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
		$this->_connection = new mysqli($this->_host, $this->_username, 
			$this->_password, $this->_database, $this->_port);
	
		// Write that we can't connect to the database if we have an error
		if(mysqli_connect_error()) {
			trigger_error("Failed to connect to MySQL: " . mysql_connect_error(),
				 E_USER_ERROR);
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