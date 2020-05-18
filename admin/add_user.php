<?php include("includes/header.php"); ?>
<?php if(!$session->isSignedIn()) { redirect("login.php"); } ?>
<?php

//$message = " ";

$user = new User();
if(isset($_POST['create'])){


    if($user){

        $user->userName  = $_POST['userName'];
        $user->firstName = $_POST['firstName'];
        $user->lastName = $_POST['lastName'];
        $user->password = $_POST['password'];

        $user->setFile($_FILES['userImage']);
        $user->uploadPhoto();
        $user->save();
    } // end nested if

} // end if



   

 //$users = user::findAll(); 

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

<form action="" method="post" enctype="multipart/form-data">                  
    <div class="col-md-6 col-md-offset-3">

        <div class="form-group">
            <label for="userImage">User Image</label>
            <input type="file" name="userImage" >
        </div>
        
        <div class="form-group">
            <label for="userName">User Name</label>
            <input type="text" name="userName" class="form-control">
        </div>


        <div class="form-group">
            <label for="firstName">First Name</label>
            <input type="text" name="firstName" class="form-control">
        </div>

        <div class="form-group">
            <label for="lastName">Last Name</label>
            <input type="text" name="lastName" class="form-control">
        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password" class="form-control">
        </div>

        <div class="form-group">
            <input type="submit" name="create" class="btn btn-primary pull-right">
        </div>


 

    </div><!--  end col-md-8 -->

</form>  


                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

  <?php include("includes/footer.php"); ?>