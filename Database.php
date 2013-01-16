<?php

class Database
{
  private  $servername;
	private  $username;
	private  $password;
	private  $database;
	private  $connection;
	
	// Constructor for Database
	public function __construct($servername, $username, $password, $database) 
	{
		$this->servername = $servername;
		$this->username = $username;
		$this->password = $password;
		$this->database = $database;
	}

	// Getters and Setters
	public function setServerName($servername)
	{
		$this->servername = $servername;
	}

	public function getServerName()
	{
		return $this->servername;
	}

	public function setUserName($username)
	{
		$this->username = $username;
	}

	public function getUserName()
	{
		return $this->username;
	}

	public function setDatabase($database)
	{
		$this->database = $database;
	}

	public function getDatabase()
	{
		return $this->database;
	}

	// Connection to Check if a valid connection object is present for the DataBaseServer class instance
	public function connectionStatus()
	{
		return $this->connection->connect_errno;
	}

	// Connection Routine with MySql.
	public function connect()
	{
		$this->connection = new mysqli($this->servername, $this->username, $this->password,  $this->database);
	}


	// Wrappers around the Cryptic MySql Routines for the CRUD Routines
	public function insert($table, $values)
	{
		$statement = "INSERT INTO ".$table." values( ".implode(",", $values)." )";
		echo $statement;
		return $this->connection->query($statement);
	}
	public function select($table, $predicate)
	{
		$statement = "SELECT * FROM ".$table." WHERE ".$predicate;
		echo $statement;
		return  $this->connection->query($statement);
	}

	public function selectAll($table)
	{
		$statement = "SELECT * FROM ".$table;
		echo $statement;
		return $this->connection->query($statement);
	}

	public function update($table, $subject, $predicate)
	{
		$statement = "UPDATE ".$table." SET ".$subject." WHERE ".$predicate;
		echo $statement;
		return $this->connection->query($statement);
	}

	public function delete($table, $predicate)
	{
		$statement = "DELETE FROM ".$table." WHERE ".$predicate;
		echo $statement;
		return $this->connection->query($statement);
	}

	public function disconnect()
	{
		$this->connection->close();
	}

	public function __destruct()
	{
		$this->disconnect();
	}
}

?>
