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

	public function setFile($file){

		if(empty($file) || !$file || !is_array($file)){
			$this->errors[] = "There was no file uploaded here";
			return false;
		}else if($file['error'] != 0){
			$this->errors[] = $this->upload_errors_array[$file['error']];
			return false;
		}else{

			$this->userImage = basename($file['name']);
			$this->tmpPath = $file['tmp_name'];
			$this->type = $file['type'];
			$this->size = $file['size'];

		} // end if else 

		

	} // end setFile



	public function uploadPhoto(){

		
			if(!empty($this->errors)){
				return false;
			} // end nested if

			if(empty($this->userImage) || empty($this->tmpPath)){
				$this->errors[] = "the file not available";
				return false;
			}

			//$targetPath = SITE_ROOT . DS . 'admin' .DS. $this->uploadDirectory .DS. $this->userImage;
			$targetPath = $this->uploadDirectory. DS .$this->userImage;
			if(file_exists($targetPath)){
				$this->errors[] = "The file {$this->userImage} already exists";
				return false;
			}

			//"images/$this->userImage"

			if(move_uploaded_file($this->tmpPath, $targetPath)){
				
					unset($this->tmpPath);
					return true;
				
			}else{
				$this->errors[] = "the file directory probably does not have permission";
				return false;
			}

			

		


	} //end photoSave


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
	} // end verify user

	public function picturePath(){
		return $this->uploadDirectory.DS.$this->userImage;
	} // end picturepath

	public function deleteUser(){
		if($this->delete()){
			$targetPath = $this->picturePath();

			return unlink($targetPath) ? true :false;
			
		}else{
			return false;
		} // end else if
	} // end deletePhoto

	public function ajaxSaveUserImage($userImage, $user_id){

		global $database;

		$userImage = $database->scapeString($userImage);
		$user_id = $database->scapeString($user_id);


		$this->userImage = $userImage;
		$this->id = $user_id;
		

		$sql = "UPDATE ". self::$dbTable . " SET  userImage = '{$this->userImage}' ";
		$sql .= "WHERE id = {$this->id} ";
		$updateImage = $database->query($sql);

		echo $this->imagePlaceHolder();

	} // end of ajaxSaveUserImage

	

	

	

} //end User class


?>