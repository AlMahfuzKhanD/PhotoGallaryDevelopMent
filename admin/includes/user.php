<?php
class User extends DbObject {

	protected static $dbTable = "users";
	protected static $dbTableFields = array('userName', 'password', 'firstName', 'lastName');
	public $id;
	public $userName;
	public $firstName;
	public $lastName;
	public $password;

	

	

	public static function verifyUser($userName,$password){
		global $database;
		$userName = $database->scapeString($userName);
		$password = $database->scapeString($password);
		$sql = "SELECT * FROM " . self::$dbTable ." WHERE ";
		$sql .= "userName = '{$userName}' ";
		$sql .= "AND password = '{$password}' ";
		$sql .= "LIMIT 1";

		$theResultArray = self::findThisQuery($sql);

		return !empty($theResultArray) ? array_shift($theResultArray) : false;
	}

	

	protected function properties(){ //this function will pull out all the  properties of the class
		foreach (self::$dbTableFields as $dbField) {
			if(property_exists($this, $dbField)){
				$properties[$dbField] = $this->$dbField;
			}
		}
        return $properties;

	} //end of properties

	protected function cleanProperties(){
		global $database;
		$cleanProperties = array();
		foreach ($this->properties() as $key => $value) {
			$cleanProperties[$key] = $database->scapeString($value);
		}

		return $cleanProperties;


	} //end cleanProperties

	public function save(){ // this function will  check if the uid is already in the database or not. if existed id it will execute update()
		return isset($this->id) ? $this->update() : $this->create();
	} //end save()

	public function create(){
		global $database;
		$properties = $this->cleanProperties();
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

		$properties = $this->cleanProperties();
		$propertyPairs = array();

		foreach ($properties as $key => $value) {
			$propertyPairs[] =  "{$key}='{$value}'";
		}


		$sql = "UPDATE " . self::$dbTable ." SET ";
		$sql .= implode(", ",$propertyPairs);
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