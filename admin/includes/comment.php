<?php
class Comment extends DbObject { 

	protected static $dbTable = "comments";
	protected static $dbTableFields = array('id', 'photoId', 'author', 'body');
	public $id;
	public $photoId;
	public $author;
	public $body;


	public static function createComment($photoId, $author="John", $body=""){

		if(!empty($photoId) && !empty($author && !empty($body)){

			$comment = new Comment();

			$comment->photoId = (int)$photoId;
			$comment->author  = $author;
			$comment->body    = $body;

			return $comment;

		} else{
			return false;
		}//end if else

		public static function findTheComments($photoId=0){

			global $database;

			$sql = "SELECT * FROM " . self::$dbTable;
			$sql .= " WHERE photoId = " $database->scapeString($photoId);
			$sql .= " ORDER BY photoId ASC" $photoId;

			return self::findByQuery($sql);

		} // end findTheComments

	} // end createComment


	

} //end Comment class


?>