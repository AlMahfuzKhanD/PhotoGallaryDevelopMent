 <?php include("includes/header.php"); ?>
 <?php if(!$session->isSignedIn()) { redirect("login.php"); } ?>
 <?php  

 $users = User::findAll(); 

 ?>


        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.html">SB Admin</a>
            </div>
            
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
                            users
                            <small>Subheading</small>
                        </h1>
                        
    <div class="col-md-12">
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Photo</th>
                    <th>User Name</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    
                    
                </tr>
            </thead>
            <tbody>

                <?php foreach ($users as $user) : ?>

                <tr>
                    <td><?php echo $user->id; ?></td>
                    <td><img class="admin_user_thumbnail userImage" src="<?php echo $user->imagePlaceHolder(); ?>" alt="no image"></td>
                    
                    <td><?php echo $user->userName; ?>

                        <div class="actionssLink">
                            <a href="delete_user.php?id=<?php echo $user->id; ?>">Delete</a>
                            <a href="edit_user.php?id=<?php echo $user->id; ?>">Edit</a>
                            <a href="view_user.php?id=<?php echo $user->id; ?>">View</a>
                        </div>
                        
                    </td>
                    <td><?php echo $user->firstName; ?></td>
                    <td><?php echo $user->lastName; ?></td>
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