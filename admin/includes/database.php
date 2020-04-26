<?php
require_once("new_config.php");
class Database{

	public $connection;

	function __construct(){
		$this->openDbConnection();
	} //calling function automatically using constrruct


	public function openDbConnection(){
		//$this->connection = mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);
		$this->connection = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);
		//created object for connection
		if($this->connection->connect_errno){
			die("Dabase connection Failed" . $this->connection->connect_error);

		}
	} //end opendDbConnection

	public function query($sql){
		$result = $this->connection->query($sql);
		$this->confirmQuery($result);
		
		return $result;

	}// end query

	private function confirmQuery($result){
		if(!$result){
			die("DB Query Failed" . $this->connection->error);
		}
	} //end confirm_query

	public function  scapeString($string){
		$scapedString = $this->connection->real_escape_string($string);
		return $scapestring;
	} //end scapestring

	public function theInsertId(){
		return $this->connection->insert_id;
	}
} // end Database class

$database = new Database(); //inatantiat Database class


 
?>