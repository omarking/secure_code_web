<?php
class Connection
{
		public $db;

	public function __construct(){

		try {
			$this ->db = new PDO("mysql:host=localhost; dbname=locateme2","root","12345");
			
		} catch (PDOException $e) {
			echo "Error -->0: " .$e->getMessage();
		}

	}		

public function CloseConnection(){
$this->db= null;

}

}





?>
