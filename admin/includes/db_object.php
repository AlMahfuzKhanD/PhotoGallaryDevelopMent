<?php

class DbObject{
	public static function findAll(){
		return  self::findThisQuery("SELECT * FROM " . self::$dbTable ."");
	} //end findAllUser method

	public static function findById($userId){
		$theResultArray = self::findThisQuery("SELECT * FROM " . self::$dbTable ." WHERE id =$userId LIMIT 1");

		return !empty($theResultArray) ? array_shift($theResultArray) : false; //catching first item of the array or return false

		
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
		$objectProperties = get_object_vars($this); // collecting oproerties
        return array_key_exists($theAttribute, $objectProperties); //it will return key exists or not


	} //end of hasTheAttribute


} //end of class DbObject


?>