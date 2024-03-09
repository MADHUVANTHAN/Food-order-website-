<?php include("partials-front/menu_1.php");?>


<?php 
        if(isset($_SESSION['user']))         //checking whether the SESSION is set or not
        {
            echo $_SESSION['user']  ;         //display the SESSION message if set
            unset($_SESSION['user']) ;        //remove SESSTION message
        }

?>




    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <form action="<?php echo SITEURL;?>food-search.php" method="POST">
                <input type="search" name="search" placeholder="Search for Food.." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->

    <?php 
        if(isset($_SESSION['order']))         //checking whether the SESSION is set or not
        {
            echo $_SESSION['order']  ;         //display the SESSION message if set
            unset($_SESSION['order']) ;        //remove SESSTION message
        }

        if(isset($_SESSION['login']))         //checking whether the SESSION is set or not
        {
            echo $_SESSION['login']  ;         //display the SESSION message if set
            unset($_SESSION['login']) ;        //remove SESSTION message
        }

    ?>

    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>


            <?php 
                //create the sql quary to display category from database
                $sql="SELECT * FROM tbl_category WHERE active='Yes' AND featured ='Yes' LIMIT 3";
                //excute the quary 
                $res=mysqli_query($conn,$sql); 
                //count the row to check whether the category is available or not
                $count=mysqli_num_rows($res);

                if($count>0)
                {
                    //category available
                    while($row=mysqli_fetch_assoc($res))
                    {
                        //get the values like id,title,image_name
                        $id=$row['id'];
                        $title=$row['title'];
                        $image_name=$row['image_name'];
                        ?>
                            <a href="<?php echo SITEURL;?>category-foods_1.php?category_id=<?php echo $id;?>">
                                <div class="box-3 float-container">
                                    <?php 
                                    //check whether image is available or not
                                        if($image_name=="")
                                        {
                                            //display message
                                            echo "<div class='error'>Image is not available .</div>";
                                        }
                                        else
                                        {
                                            //image is available
                                            ?>

                                            <img src="<?php echo SITEURL;?>images/category/<?php echo $image_name;?>" alt="Pizza" class="img-responsive img-curve">
                                            
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
                    //category not available

                    echo "<div class='error'>Category is not available .</div>";
                }
            ?>


            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->

    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <?php 
                //getting foods from database that are active  and featured
                //sql quary
                $sql2="SELECT * FROM tbl_food WHERE active='Yes' AND featured='Yes' LIMIT 6";
                //excute the quary 
                $res2=mysqli_query($conn,$sql2);

                //count the rows
                $count2=mysqli_num_rows($res2);

                //ccheck whether food available or not
                if($count2>0)
                {
                    //food available
                    while($row=mysqli_fetch_assoc($res2))
                    {
                        //get all the values
                        $id=$row['id'];
                        $title=$row['title'];
                        $price=$row['price'];
                        $description=$row['description'];
                        $image_name=$row['image_name'];

                        ?>
                            
                            <div class="food-menu-box">
                                <div class="food-menu-img">
                                    <?php 
                                        //check whether the image available or not
                                        if($image_name=="")
                                        {
                                            //image is not avaiable
                                            echo "<div class='error'>Image is not available .</div>";
                                        }
                                        else
                                        {
                                            //image is available 
                                            ?>
                                                <img src="<?php echo SITEURL;?>images/food/<?php echo $image_name ;?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                                            <?php 
                                        }
                                    ?>

                                </div>

                                <div class="food-menu-desc">
                                    <h4><?php echo $title ;?></h4>
                                    <p class="food-price">₹<?php echo $price ;?></p>
                                    <p class="food-detail">
                                        <?php echo $description ;?>
                                    </p>
                                    <br>

                                    <a href="<?php echo SITEURL;?>order.php?food_id=<?php echo $id ;?>" class="btn btn-primary">Order Now</a>
                                    <a href="<?php echo SITEURL;?>cart.php?food_id=<?php echo $id ;?>" class="btn btn-primary">Add to cart</a>
                                </div>
                            </div>
                        <?php
                    }
                }
                else
                {
                    //food not available
                    echo "<div class ='error'>Food not available .</div>";
                }
            ?>





            <div class="clearfix"></div>

            

        </div>

        <p class="text-center">
            <a href="#">See All Foods</a>
        </p>
    </section>
    <!-- fOOD Menu Section Ends Here -->

<?php include('partials-front/footer.php');?>