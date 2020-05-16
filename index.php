<?php include("includes/header.php"); ?>

<?php

$page = !empty($_GET['page']) ? (int)$_GET['page'] : 1;
$itemPerPage = 4;
$itemTotalCount = Photo::countAll();

$paginate = new Paginate($page, $itemPerPage, $itemTotalCount);

$sql = "SELECT * FROM photos ";
$sql .= "LIMIT {$itemPerPage} ";
$sql .= "OFFSET {$paginate->offset()}";

$photos = Photo::findByQuery($sql);

//$photos = Photo::findAll();

?>


        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-12">
                <div class="thumbnails row">

                <?php foreach ($photos as $photo): ?>


                    

                        <div class="col-xs-6 col-md-3">

                            <a class="thumbnail" href="photo.php?id=<?php echo $photo->id ?>">
                                
                                <img class="homePagePhoto img-responsive" src="admin/<?php echo $photo->picturePath();?>" alt="">

                            </a>
                            
                        </div> <!-- end col-xs-6 col-md-12
                         -->
                   


                <?php endforeach; ?>
            </div> <!-- end row -->


            <div class="row">
                <ul class="pagination">

                    <?php

                    if($paginate->totalPage() > 1){

                        if ($paginate->hasNext()) {
                            echo "<li class='next'><a href='index.php?page={$paginate->nextPage()}'>Next</a></li>";
                        }

                    } //end if 

                    /*****  code for page numbers  *****/

                    for($i=1;$i<=$paginate->totalPage(); $i++){

                        if($i== $paginate->currentPage){
                               echo "<li class='active'><a href='index.php?page{$i}'>$i</a></li>"; 
                        } else{

                            echo "<li><a href='index.php?page={$i}'>$i</a></li>";

                        } //end if else

                    } // end for

                  


                    

                    if ($paginate->hasPrevious()) {
                            echo "<li class='previous'><a href='index.php?page={$paginate->previousPage()}'>Previous</a></li>";
                        }


                    ?>


                    
                   
                </ul>
            </div>

    
</div> <!-- col-md-12 -->




            <!-- Blog Sidebar Widgets Column -->
            <!-- <div class="col-md-4"> -->

            
                 <?php //include("includes/sidebar.php"); ?>



        </div>
        <!-- /.row -->

        <?php include("includes/footer.php"); ?>
