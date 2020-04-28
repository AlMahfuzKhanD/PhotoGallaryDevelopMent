<?php
class User {

	public static function findAllUsers(){
		global $database; // making database object global
		$reslutSet = $database->query("SELECT * FROM users"); // executing query method from database class
		return $reslutSet; // returning result for execution
	} //end findAllUser method

	public static function findUsersById($userId){
		global $database;
		$resultSet = $database->query("SELECT * FROM users WHERE id =$userId LIMIT 1"); // executing query
		$userFound = mysqli_fetch_array($resultSet); // fetching data and saving int in a variable
		return $userFound; //sending data
	} //end findUserById method
} //end User class
?>