<?php
class User {

	protected static $dbTable = "users";
	protected static $dbTableFields = array('userName', 'password', 'firstName', 'lastName');
	public $id;
	public $userName;
	public $firstName;
	public $lastName;
	public $password;

	public static function findAllUsers(){
		return  self::findThisQuery("SELECT * FROM users");
	} //end findAllUser method

	public static function findUsersById($userId){
		$theResultArray = self::findThisQuery("SELECT * FROM users WHERE id =$userId LIMIT 1");

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

	public static function verifyUser($userName,$password){
		global $database;
		$userName = $database->scapeString($userName);
		$password = $database->scapeString($password);
		$sql = "SELECT * FROM users WHERE ";
		$sql .= "userName = '{$userName}' ";
		$sql .= "AND password = '{$password}' ";
		$sql .= "LIMIT 1";

		$theResultArray = self::findThisQuery($sql);

		return !empty($theResultArray) ? array_shift($theResultArray) : false;
	}

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

	protected function properties(){ //this function will pull out all the  properties of the class
		foreach (self::$dbTableFields as $dbField) {
			if(property_exists($this, $dbField)){
				$properties[$dbField] = $this->$dbField;
			}
		}
        return $properties;

	} //end of properties

	public function save(){ // this function will  check if the uid is already in the database or not. if existed id it will execute update()
		return isset($this->id) ? $this->update() : $this->create();
	} //end save()

	public function create(){
		global $database;
		$properties = $this->properties();
		$sql = "INSERT INTO " . self::$dbTable ." (" . implode(",",array_keys($properties)) . ") ";
		$sql .= "VALUES ('" . implode("','",array_values($properties)) ."')";
		
		

		if($database->query($sql)){
			$this->id = $database->theInsertId();
            return true;
		}else{
            return false;
		}
	} // end of create()

	public function update(){
		global $database;
		$sql = "UPDATE " . self::$dbTable ." SET ";
		$sql .= "userName= '" . $database->scapeString($this->userName) . "', ";
		$sql .= "password= '" . $database->scapeString($this->password) . "', ";
		$sql .= "firstName= '" . $database->scapeString($this->firstName) . "', ";
		$sql .= "lastName= '" . $database->scapeString($this->lastName) . "' ";
		$sql .= " WHERE id= " . $database->scapeString($this->id) ;

		$database->query($sql);
	
		return (mysqli_affected_rows($database->connection) == 1) ? true : false;

	} // end of update()

	public function delete(){
		global $database;
		$sql = "DELETE FROM " . self::$dbTable ." " ;
		$sql .= "WHERE id= " . $database->scapeString($this->id) ." ";
		$sql .= " LIMIT 1";
		
		$database->query($sql);
	
		return (mysqli_affected_rows($database->connection) == 1) ? true : false;
		
	} // end of delete()

} //end User class


?>