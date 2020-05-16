<?php
class Comment extends DbObject { 

	protected static $dbTable = "comments";
	protected static $dbTableFields = array('id', 'photoId', 'fileName', 'author', 'body');
	public $id;
	public $photoId;
	public $fileName;
	public $author;
	public $body;
	public $uploadDirectory = "images";


	public static function createComment($photoId,$fileName, $author="John", $body=""){

		if(!empty($photoId) && !empty($fileName) && !empty($author) && !empty($body)){

			$comment = new Comment();

			$comment->photoId = (int)$photoId;
			$comment->fileName = $fileName;
			$comment->author  = $author;
			$comment->body    = $body;

			return $comment;

		} else{
			return false;
		}//end if else

		

	} // end createComment

	public static function findTheComments($photoId=0){

			global $database;

			$sql = "SELECT * FROM " . self::$dbTable;
			$sql .= " WHERE photoId = " . $database->scapeString($photoId);
			$sql .= " ORDER BY photoId ASC";

			return self::findByQuery($sql);

		} // end findTheComments

		public function picturePath(){
		return $this->uploadDirectory.DS.$this->fileName;
	}



	

} //end Comment class


?>