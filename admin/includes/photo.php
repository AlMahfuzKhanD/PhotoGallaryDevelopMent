<?php
class Photo extends DbObject{

	protected static $dbTable = "photos";
	protected static $dbTableFields = array('photoTitle', 'photoDescription', 'photoFIleName', 'photoType', 'photoSize');
	public $photoId;
	public $photoTitle;
	public $photoDescription;
	public $photoFIleName;
	public $photoType;
	public $photoSize;

	public $tmpPath;
	public $uploadDirectory = "images";
	public $customErrors = array();

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



} // end of photo class 
?>