<?php
require_once("new_config.php");
class Database{

	public $connection;

	function __construct(){
		$this->openDbConnection();
	} //calling function automatically using constrruct


	public function openDbConnection(){
		$this->connection = mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);
		if(mysqli_connect_errno()){
			die("Dabase connection Failed" . mysqli_error());

		}
	} //end opendDbConnection
} // end Database class

$database = new Database(); //inatantiat Database class


 
?>