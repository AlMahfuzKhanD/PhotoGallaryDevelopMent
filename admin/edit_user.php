<?php include("includes/header.php"); ?>
<?php if(!$session->isSignedIn()) { redirect("login.php"); } ?>
<?php

//$message = " ";

if(empty($_GET['id'])){
    redirect("users.php");
}else{
   
    $user = User::findById($_GET['id']);

    if(isset($_POST['update'])){

        if($user){

            $user->userName  = $_POST['userName'];
            $user->firstName = $_POST['firstName'];
            $user->lastName = $_POST['lastName'];
            $user->password = $_POST['password'];

            if(empty($_FILES['userImage'])){
                $user->save();
            }else{
                $user->setFile($_FILES['userImage']);

                $user->uploadPhoto();
                $user->save();
                redirect("edit_user.php?id={$user->id}");
            }

            
        } // end nested if

    }

} // end if else




   



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
<div class="col-md-6">
    <img class="img-responsive" src="<?php echo $user->imagePlaceHolder();?>" alt="No Image">
</div>
<form action="" method="post" enctype="multipart/form-data">                  
    <div class="col-md-6">

        <div class="form-group">
            <label for="userImage">User Image</label>
            <input type="file" name="userImage" >
            
        </div>
        
        <div class="form-group">
            <label for="userName">User Name</label>
            <input type="text" name="userName" class="form-control" value="<?php echo $user->userName; ?>">
        </div>


        <div class="form-group">
            <label for="firstName">First Name</label>
            <input type="text" name="firstName" class="form-control"  value="<?php echo $user->firstName; ?>">
        </div>

        <div class="form-group">
            <label for="lastName">Last Name</label>
            <input type="text" name="lastName" class="form-control"  value="<?php echo $user->lastName; ?>">
        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password" class="form-control"  value="<?php echo $user->password; ?>">
        </div>
        <div class="info-box-delete pull-left">
        <a  href="delete_user.php?id=<?php echo $user->id; ?>" class="btn btn-danger ">Delete</a>   
        </div>

        <div class="form-group">
            <input type="submit" name="update" class="btn btn-primary pull-right" value="Update">
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