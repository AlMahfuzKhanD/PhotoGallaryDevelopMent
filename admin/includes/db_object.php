<?php

class DbObject {

	public $errors = array();

	public $uploadErrorsArray = array(

		UPLOAD_ERR_OK => "There is no errors.",
		UPLOAD_ERR_INI_SIZE => "The uploaded file exceds the upload_max_filesize directive in php.ini.",
		UPLOAD_ERR_FORM_SIZE => "The uploaded file exceds the MAX_FILE_SIZE directive that was specified in the HTML file.",
		UPLOAD_ERR_PARTIAL => "The uploaded file was only partially uploaded.",
		UPLOAD_ERR_NO_FILE => "No file was uploaded.",
		UPLOAD_ERR_NO_TMP_DIR => "Missing a temporary folder.",
		UPLOAD_ERR_CANT_WRITE => "Failed to write file to disk.",
		UPLOAD_ERR_EXTENSION => "A PHP extension stopped the file upload."

	); // end array

	


	public static function findAll(){
		return  static::findByQuery("SELECT * FROM " . static::$dbTable ."");
	} //end findAllUser method

	public static function findById($id){
		$theResultArray = static::findByQuery("SELECT * FROM " . static::$dbTable ." WHERE id =$id LIMIT 1");

		return !empty($theResultArray) ? array_shift($theResultArray) : false; //catching first item of the array or return false

		
	} //end findUserById method

	public static function findByQuery($sql){ //this method for query
		global $database; // making database object global

		$resultSet = $database->query($sql); // executing query method from database class and catching query using $sql variable

		$theObjectArray = array(); // empty array for putting objects

		while($row = mysqli_fetch_array($resultSet)){
			$theObjectArray[] = static::instantiation($row);
		}

		return $theObjectArray; // returning array value
	} //end findByQuery

	public static function instantiation($userRecord){

		$callingClass = get_called_class();
		$theObject = new $callingClass;

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
		foreach (static::$dbTableFields as $dbField) {
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
		$sql = "INSERT INTO " . static::$dbTable ." (" . implode(",",array_keys($properties)) . ") ";
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


		$sql = "UPDATE " . static::$dbTable ." SET ";
		$sql .= implode(", ",$propertyPairs);
		$sql .= " WHERE id= " . $database->scapeString($this->id) ;

		$database->query($sql);
	
		return (mysqli_affected_rows($database->connection) == 1) ? true : false;

	} // end of update()

	public function delete(){
		global $database;
		$sql = "DELETE FROM " . static::$dbTable ." " ;
		$sql .= "WHERE id= " . $database->scapeString($this->id) ." ";
		$sql .= " LIMIT 1";
		
		$database->query($sql);
	
		return (mysqli_affected_rows($database->connection) == 1) ? true : false;
		
	} // end of delete()

	// public function picturePathAll(){
	// 	$photo = new Photo();
	// 	global $photo;
	// 	return $photo->picturePath();
	// }

	public static function countAll(){

		global $database;

		$sql = "SELECT COUNT(*) FROM " . static::$dbTable;
		$resultSet = $database->query($sql);
		$row = mysqli_fetch_array($resultSet);
		return array_shift($row);

	} // end countAll


} //end of class DbObject


?>