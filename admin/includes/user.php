<?php
class User {

	public $id;
	public $userName;
	public $firstName;
	public $lastName;
	public $password;

	public static function findAllUsers(){
		return  self::findThisQuery("SELECT * FROM users");
	} //end findAllUser method

	public static function findUsersById($userId){
		$resultSet = self::findThisQuery("SELECT * FROM users WHERE id =$userId LIMIT 1");
		$userFound = mysqli_fetch_array($resultSet); // fetching data and saving int in a variable
		return $userFound; //sending data
	} //end findUserById method

	public static function findThisQuery($sql){ //this method for query
		global $database; // making database object global
		$resultSet = $database->query($sql); // executing query method from database class and catching query using $sql variable
		return $resultSet; // returning resultSet
	} //end findThisQuery

	public static function instantiation($foundUser){
		$theObject = new self;
		$theObject->id = $foundUser['id'];
        $theObject->userName = $foundUser['userName'];
        $theObject->firstName = $foundUser['firstName'];
        $theObject->lastName = $foundUser['lastName'];
        return $theObject;
	}


} //end User class
?>