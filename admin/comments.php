<?php include("includes/header.php"); ?>
 <?php if(!$session->isSignedIn()) { redirect("login.php"); } ?>
 <?php  

 $comments = Comment::findAll(); 

 ?>


        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            
            
            <!-- Top Menu Items -->
            <?php include("includes/top_nav.php"); ?>


            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <?php include("includes/side_nav.php"); ?>
            <!-- /.navbar-collapse -->
        </nav>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            comments
                        </h1>

                        <a href="add_comment.php" class="btn btn-primary">Add comment</a>


                        
    <div class="col-md-12">
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Author</th>
                    <th>Body</th>
                    
                    
                    
                </tr>
            </thead>
            <tbody>

                <?php foreach ($comments as $comment) : ?>

                <tr>

                   <!--  <td><img class="admin_photo_thumbnail" src="<?php //echo Photo::picturePath(); ?>" alt="no image">
                    </td>  -->

                    <td><?php echo $comment->id; ?></td>
                    
                    
                    <td><?php echo $comment->author; ?>

                        <div class="actionssLink">
                            <a href="delete_comment.php?id=<?php echo $comment->id; ?>">Delete</a>
                        </div>
                        
                    </td>
                    <td><?php echo $comment->body; ?></td>
                   
                </tr>
            <?php endforeach; ?>
                
            </tbody>
        </table> <!-- end table -->

    </div><!--  end col-md-12 -->

                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

  <?php include("includes/footer.php"); ?>