<?php include("includes/init.php"); ?>
<?php if(!$session->isSignedIn()) { redirect("login.php"); } ?>

<?php

if(empty($_GET['id'])){

    redirect("photo_comments.php"); 
}

$comment = Comment::findById($_GET['id']);

if($comment){
    $comment->delete();
    redirect("photo_comments.php?id={$comment->photoId}");
}else{
    redirect("photo_comments.php?id={$comment->photoId}");
}


 ?>