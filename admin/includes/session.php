<?php

class Session{

private $signedIn =  false;
public $userId;


	function _construct(){
		session_start();
		$this->checkTheLogin();
	}// end __construct

	public function isSignedIn(){
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