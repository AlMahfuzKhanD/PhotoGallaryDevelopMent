<?php
class User extends DbObject {

	protected static $dbTable = "users";
	protected static $dbTableFields = array('userName', 'password', 'firstName', 'lastName', 'userImage');
	public $id;
	public $userName;
	public $firstName;
	public $lastName;
	public $password;
	public $userImage;

	public $uploadDirectory = "images";
	public $imagePlaceHolder = "http://placehold.it/400x400&text=image";


	public function imagePlaceHolder(){
		return empty($this->userImage) ? $this->imagePlaceHolder : $this->uploadDirectory.DS.$this->userImage;
	} //end image place holder  

	

	

	public static function verifyUser($userName,$password){
		global $database;
		$userName = $database->scapeString($userName);
		$password = $database->scapeString($password);
		$sql = "SELECT * FROM " . self::$dbTable ." WHERE ";
		$sql .= "userName = '{$userName}' ";
		$sql .= "AND password = '{$password}' ";
		$sql .= "LIMIT 1";

		$theResultArray = self::findByQuery($sql);

		return !empty($theResultArray) ? array_shift($theResultArray) : false;
	}

	

	

	

} //end User class


?>