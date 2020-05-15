<?php

class Session{

public $signedIn =  false;
public $userId;
public $message;
public $count;



	function __construct(){
		session_start();
		$this->visitorCount();
		$this->checkTheLogin();
		$this->checkMessage();

	}// end __construct

	public function visitorCount(){

		if(isset($_SESSION['count'])){

			return $this->count = $_SESSION['count']++;

		} else{

			return $_SESSION['count'] = 1;

		}// end if else

	} // end visitor coutn

	public function message($msg=""){
		if(!empty($msg)){
			$_SESSION['message'] = $msg;

		}else{
			return $this->message;
		}
	} // end message

	private function checkMessage(){
		if(isset($_SESSION['message'])){
			$this->message = $_SESSION['message'];
			unset($_SESSION['message']);
		}else{
			$this->message = "";
		}
	} //end checkMessage

	public function isSignedIn(){ //getter method
		return $this->signedIn;
	}//end isSignedIn

	public function login($user){
		if($user){
			$this->userId = $_SESSION['userId'] = $user->id;
			$this->signedIn = true;
		}
	}//end login

	public function logout(){
		unset($_SESSION['userId']);
		unset($this->userId);
		$this->signedIn = false;
	} //end logout

	private function checkTheLogin(){

		if(isset($_SESSION['userId'])){
			$this->userId = $_SESSION['userId'];
			$this->signedIn = true;
		}else{
			unset($this->userId);
			$this->signedIn = false;
		}//end if else

	}//end checkTheLogin

} //end class Session 

$session = new Session();






?>