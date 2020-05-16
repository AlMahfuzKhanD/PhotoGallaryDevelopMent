<?php include("includes/header.php"); ?>

<?php

$photos = Photo::findAll();

?>


        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-12">
                <div class="thumbnails row">

                <?php foreach ($photos as $photo): ?>


                    

                        <div class="col-xs-6 col-md-3">

                            <a class="thumbnail" href="">
                                
                                <img class="homePagePhoto img-responsive" src="admin/<?php echo $photo->picturePath();?>" alt="">

                            </a>
                            
                        </div> <!-- end col-xs-6 col-md-12
                         -->
                   


                <?php endforeach; ?>
            </div> <!-- end row -->

    
</div> <!-- col-md-12 -->




            <!-- Blog Sidebar Widgets Column -->
            <!-- <div class="col-md-4"> -->

            
                 <?php //include("includes/sidebar.php"); ?>



        </div>
        <!-- /.row -->

        <?php include("includes/footer.php"); ?>
