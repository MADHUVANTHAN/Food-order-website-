<?php include('partials/menu.php'); ?>


        <!--Main content section starts -->
        <div class="main-content">
            <div class="wrapper">
                <h1>DASHBOARD</h1>
                <br><br>
    
                <?php 
                    //display the messaage login is successful
                    if(isset($_SESSION['login']))
                    {
                        echo $_SESSION['login'];
                        unset ($_SESSION['login']);
                        
                    }
                ?>
                <br><br>
                <div class="col-4 text-center">
                    <?php 
                        //sql quary
                        $sql="SELECT * FROM tbl_category ";
                        //execute the quary
                        $res=mysqli_query($conn,$sql);
                        //count the rows 
                        $count=mysqli_num_rows($res);

                    ?>
                    <h1><?php echo $count ;?></h1>
                    <br>
                    category
                </div>
                <div class="col-4 text-center">
                    <?php 
                        //sql quary
                        $sql2="SELECT * FROM tbl_food ";
                        //execute the quary
                        $res2=mysqli_query($conn,$sql2);
                        //count the rows 
                        $count2=mysqli_num_rows($res2);

                    ?>
                    <h1><?php echo $count2 ;?></h1>
                    <br>
                    Foods
                </div>
                <div class="col-4 text-center">
                    <?php 
                        //sql quary
                        $sql3="SELECT * FROM tbl_order ";
                        //execute the quary
                        $res3=mysqli_query($conn,$sql3);
                        //count the rows 
                        $count3=mysqli_num_rows($res3);

                    ?>
                    <h1><?php echo $count3 ;?></h1>
                    <br>
                    Total order
                </div>
                <div class="col-4 text-center">
                    <?php 
                        //create sql quary to get total revenue generate 
                        //by useing aggregate funtion in sql
                        $sql4="SELECT sum(total) AS total FROM tbl_order WHERE status='delivered'";

                        //execute the quary 
                        $res4=mysqli_query($conn,$sql4);
                        //get the value
                        $row4=mysqli_fetch_assoc($res4);

                        //get the total revenue
                        $total=$row4['total'];
                    ?>
                    <h1>₹<?php echo $total?></h1>
                    <br>
                    Revenue generated
                </div>
                <div class="clearfix"></div>
            </div>
        </div>

        <!--Main content section ends -->
        
<?php include('partials/footer.php'); ?>        