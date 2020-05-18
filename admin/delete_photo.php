<?php include("includes/init.php"); ?>
<?php if(!$session->isSignedIn()) { redirect("login.php"); } ?>

<?php

if(empty($_GET['id'])){

    redirect("photos.php"); 
}

$photo = Photo::findById($_GET['id']);

if($photo){
	$session->message("The Photo has been deleted");
    $photo->deletePhoto();
    redirect("photos.php");
}else{
    redirect("photos.php");
}


 ?>