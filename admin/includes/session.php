<?php

class Session{

private $signedIn;
public $userId;


	function _construct(){
		session_start();
	}// end __construct

	private function checkTheLogin(){

		if(isset($_SESSION['userId'])){
			$this->userId = $_SESSION['userId'];
			$this->signedIn = true;
		}else{
			unset($this->userId);
			$this->signedIn = false;
		}//end if else

	}
} //end class Session 

$session = new Session();

?>