<?php
class Comment extends DbObject { 

	protected static $dbTable = "comments";
	protected static $dbTableFields = array('photoId', 'author', 'body');
	public $id;
	public $photoId;
	public $author;
	public $body;
	

} //end Comment class


?>