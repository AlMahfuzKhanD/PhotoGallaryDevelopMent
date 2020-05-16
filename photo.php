<?php include("includes/header.php"); ?>
<!-- body -->

<?php
require_once("admin/includes/init.php");

if(empty($_GET['id'])){
    redirect("index.php");
}

$photo = Photo::findById($_GET['id']);


if(isset($_POST['submit'])){

    $author = trim($_POST['author']);
    $body = trim($_POST['body']);

    $newComment = Comment::createComment($photo->id, $author,$body);
    if($newComment && $newComment->save()){

        redirect("photo.php?id={$photo->id}");
    } else{

        $message = "There was some problems saving comment";

    } //end nested if elsse
    

}else{
    $author = "";
    $body = "";
} //end if else

$comments = Comment::findTheComments($photo->id);


?>



            <!-- Blog Post Content Column -->
            <div class="col-lg-12">

                <!-- Blog Post -->

                <!-- Title -->
                <h1><?php echo $photo->title; ?></h1>

                <!-- Author -->
                <p class="lead">
                    by <a href="#">Al Mahfuz</a>
                </p>

                <hr>

                <!-- Date/Time -->
                <p><span class="glyphicon glyphicon-time"></span> Posted on August 24, 2013 at 9:00 PM</p>

                <hr>

                <!-- Preview Image -->
                <img class="img-responsive" src="admin/<?php echo $photo->picturePath();?>" alt="No Image">

                <hr>

                <!-- Post Content -->
                <p class="lead"><?php echo $photo->caption; ?></p>
                <p><?php echo $photo->description; ?></p>
                

                <hr>

                <!-- Blog Comments -->

                

                <!-- Comments Form -->
                <div class="well">
                    <h4>Leave a Comment:</h4>
                    <form role="form" method="post">

                        <div class="form-group">
                            <input type="text" name="author" class="form-control" placeholder="Your Name">
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" rows="3" name="body" placeholder="Your Comments"></textarea>
                        </div>
                        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>

                <hr>

                <!-- Posted Comments -->

                <?php foreach($comments as $comment):?>

                <!-- Comment -->
                <div class="media">
                    <a class="pull-left" href="#">
                        <img class="media-object" src="http://placehold.it/64x64" alt="">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading"><?php echo $comment->author; ?>
                            <small>August 25, 2014 at 9:30 PM</small>
                        </h4>
                        <?php echo $comment->body; ?>
                    </div>
                </div>

            <?php endforeach;?>



                

            </div>
 <!-- Blog Sidebar Widgets Column -->
            <!-- <div class="col-md-4">
 -->
            
                 <?php //include("includes/sidebar.php"); ?>



        </div>
        <!-- /.row -->

        <?php include("includes/footer.php"); ?>

            