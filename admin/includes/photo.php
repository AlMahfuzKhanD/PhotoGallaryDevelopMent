<?php
class Photo extends DbObject{

	protected static $dbTable = "photos";
	protected static $dbTableFields = array('title', 'description', 'fileName', 'type', 'size');
	public $photoId;
	public $title;
	public $description;
	public $fileName;
	public $type;
	public $size;

	public $tmpPath;
	public $uploadDirectory = "images";
	public $errors = array();

	public $uploadErrorArray = array(

		UPLOAD_ERR_OK => "There is no error.",
		UPLOAD_ERR_INI_SIZE => "The uploaded file exceds the upload_max_filesize directive in php.ini.",
		UPLOAD_ERR_FORM_SIZE => "The uploaded file exceds the MAX_FILE_SIZE directive that was specified in the HTML file.",
		UPLOAD_ERR_PARTIAL => "The uploaded file was only partially uploaded.",
		UPLOAD_ERR_NO_FILE => "No file was uploaded.",
		UPLOAD_ERR_NO_TMP_DIR => "Missing a temporary folder.",
		UPLOAD_ERR_CANT_WRITE => "Failed to write file to disk.",
		UPLOAD_ERR_EXTENSION => "A PHP extension stopped the file upload."

	); // end array

	//this is passing $_FIlES['uploaded_file'] as an argument

	public function setFile($file){

		if(empty($file) || !$file || !is_array($file)){
			$this->error[] = "There was no file uploaded here";
			return false;
		}else if($file['error'] != 0){
			$this->error[] = $this->upload_error_array[$file['error']];
			return false;
		}else{

			$this->fileName = basename($file['name']);
			$this->tmpPath = basename($file['tmpName']);
			$this->type = basename($file['type']);
			$this->size = basename($file['size']);

		} // end if else 

		

	} // end setFile

	public function save(){

		if($this->photoId){
			$this->update();
		}else{
			if(!empty($this->error)){
				return false;
			} // end nested if

			if(empty($this->fileName) || empty($this->tmpPath)){
				$this->error[] = "the file not available";
				return false;
			}

			$targetPath = SITE_ROOT . DS . 'admin' .DS. $this->uploadDirectory .DS. $this->fileName;
			if(file_exists($targetPath)){
				$this->error[] = "The file {$this->fileName} already exists";
				return false;
			}

			if(move_uploaded_file($this->tmpPath, $targetPath)){
				if($this->create()){
					unset($this->tmpPath);
					return true;
				}
			}else{
				$this->error[] = "the file directory probably does not have permission";
				return false;
			}

			

		} // end if else


	} //end photoSave



} // end of photo class 
?>