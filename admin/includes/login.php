<?php require_once("init.php"); ?>
<?php 

if($session->isSignedIn()){
	redirect("index.php");
}

if(isset($_POST['submit'])){

	$userName = trim($_POST['userName']);
	$password = trim($_POST['password']);

	// method to check database user
	$userFound = User::verifyUser($userName,$password);


	if($userFound){
		$session->login($userFound);
		redirect("index.php");
	}else{
		$theMessage = "Your password or username are incorrect";
	}
	 
}else{
	$userName = null;
	$password = null;
}

?>