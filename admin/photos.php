 <?php include("includes/header.php"); ?>
 <?php if(!$session->isSignedIn()) { redirect("login.php"); } ?>
 <?php  

 $photos = Photo::findAll(); 

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
                            Photos
                            
                        </h1>
                        <p class="bg-success"><?php echo $message; ?></p>
                        
    <div class="col-md-12">
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>Photo</th>
                    <th>Id</th>
                    <th>File Name</th>
                    <th>Title</th>
                    <th>Size</th>
                    <th>type</th>
                    <th>Comment</th>
                    
                </tr>
            </thead>
            <tbody>

                <?php foreach ($photos as $photo) : ?>

                <tr>
                    <td><img class="admin_photo_thumbnail" src="<?php echo $photo->picturePath(); ?>" alt="no image">

                    <div class="actionLink">
                        <a href="delete_photo.php?id=<?php echo $photo->id; ?>">Delete</a>
                        <a href="edit_photo.php?id=<?php echo $photo->id; ?>">Edit</a>
                        <a href="../photo.php?id=<?php echo $photo->id; ?>">View</a>
                    </div>

                    </td>
                    <td><?php echo $photo->id; ?></td>
                    <td><?php echo $photo->fileName; ?></td>
                    <td><?php echo $photo->title; ?></td>
                    <td><?php echo $photo->size; ?></td>
                    <td><?php echo $photo->type; ?></td>
                    <td><a href="photo_comments.php?id=<?php echo $photo->id; ?>">
                        <?php $comments = Comment::findTheComments($photo->id);
                        echo count($comments); ?>
                    </a></td>
               
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