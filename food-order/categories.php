<?php include("partials-front/menu.php");?>



    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>


            <?php 
                //display all the categories that are active
                //sql quary
                $sql="SELECT * FROM tbl_category WHERE active='Yes'";

                //execute the quary 
                $res=mysqli_query($conn,$sql);

                //count the rows
                $count=mysqli_num_rows($res);

                //check whether category available or not
                if($count > 0)
                {
                    //categorys available
                    while($row=mysqli_fetch_assoc($res))
                    {
                        //get the value
                        $id=$row['id'];
                        $title=$row['title'];
                        $image_name=$row['image_name'];
                        ?>
                            <a href="category-foods.php">
                                <div class="box-3 float-container">
                                    <?php 
                                        if($image_name=="")
                                        {
                                            //image is not available
                                            echo "<div class='error'>Image not found .</div>";
                                        }
                                        else
                                        {
                                            //image is avilable
                                            ?>
                                            <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name;?>" alt="Pizza" class="img-responsive img-curve">
                                            <?php
                                        }
                                    ?>
                                    

                                    <h3 class="float-text text-white"><?php echo $title;?></h3>
                                </div>
                            </a>
           
                        <?php
                    }
                }
                else
                {
                    //category not avilable
                    echo "<div class='error'>Category not found .</div>";
                }
            ?>

            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->


    <?php include('partials-front/footer.php');?>
