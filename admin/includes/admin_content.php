<div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Admin
                            <small>Subheading</small>
                        </h1>

                        <?php 
                        
                        $reslut = User::findAllUsers();
                        while($row = mysqli_fetch_array($reslut)){
                            echo  $row['id'] . " " . $row['userName'] . "<br>";
                        
                        }
                        $foundUser = User::findUsersById(3);
                        echo  $foundUser['id'] . " " . $foundUser['userName'] . "<br>";
                        
                        
                        ?>

                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="index.html">Dashboard</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-file"></i> Blank Page
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->