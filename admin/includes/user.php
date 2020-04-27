<?php
class User {

	public static function findAllUsers(){
		global $database; // making database object global
		$reslutSet = $database->query("SELECT * FROM users"); // executing query method from database class
		return $reslutSet; // returning result for execution
	} //end findUser method
	public static function findUsersById(){
		global $database; // making database object global
		$reslutSet = $database->query("SELECT * FROM users WHERE id = 1"); // executing query method from database class
		return $reslutSet; // returning result for execution
	} //end findUser method
} //end User class
?>