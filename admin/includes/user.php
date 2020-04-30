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

		$theObjectArray = array(); // empty array for putting objects

		while($row = mysqli_fetch_array($resultSet)){
			$theObjectArray[] = self::instantiation($row);
		}

		return $theObjectArray; // returning array value
	} //end findThisQuery

	public static function instantiation($userRecord){
		$theObject = new self;

		//this is manual way of  fetching data
		// $theObject->id = $user['id'];
		//$theObject->userName = $user['userName'];
		//$theObject->firstName = $user['firstName'];
		//$theObject->lastName = $user['lastName'];

		foreach ($userRecord as $theAttribute => $value) {
			if($theObject->hasTheAttribute($theAttribute)){
				$theObject->$theAttribute = $value;
			}
		}


        return $theObject;
	} // end instantiation

	private  function hasTheAttribute($theAttribute){
		$objectProperties = get_object_vars($this); // checking oproerties
        return array_key_exists($theAttribute, $objectProperties); //it will return key exists or not


	}


} //end User class
?>