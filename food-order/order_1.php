<?php include("partials-front/menu_1.php");?>
<?php include("config/constants.php");?>

<?php
if($_SERVER["REQUEST_METHOD"]=="POST"){
    $name=$_POST['full-name'];
    $email=$_POST['email'];
    $address=$_POST['address'];
    $food_name=$_POST['food'];
    //$food_price=$_post['price'];
    //$quntity=$_post['qty'];

    $subject="This message from wow foods ";
    $message="ok";
    $to="wowfoods1234@gmail.com";
    $header="from $email";

    if(mail($to,$subject,$message,$header)){
        echo "ok";

    }
    else
    {
        echo "not ok";
    }


}

?>

    <?php 
        //check whether food id is set or not
        if(isset($_GET['food_id']))
        {
            //get the food id and details of the selected food
            $food_id=$_GET['food_id'];
            
            //get the detail of the selected food 
            $sql="SELECT * FROM tbl_food WHERE id =$food_id";

            //exequte the quary 
            $res=mysqli_query($conn,$sql);

            //count the rows 
            $count=mysqli_num_rows($res);

            //check whether the data is available or not 
            if($count==1)
            {
                //we have data
                //get the data from database
                $row=mysqli_fetch_assoc($res);
                $title=$row['title'];
                $price=$row['price'];
                $image_name=$row['image_name'];
            }
            else
            {
                //food not available
                //redirect to home page
                header('location:'.SITEURL);
            }

        }
        else
        {
            //redirect to the home page 
            header('location:'.SITEURL);
        }
    ?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search">
        <div class="container">
            
            <h2 class="text-center text-white">Fill this form to confirm your order.</h2>

            <form action="" method="post" class="order">
                <fieldset>
                    <legend>Selected Food</legend>

                    <div class="food-menu-img">
                        <?php 
                            //check whether the image is available or not 
                            if($image_name=="")
                            {
                                //image is not available
                                echo "<div class='error'>Image not available </div>";
                            }
                            else
                            {
                                //image is available
                                ?>
                                    <img src="<?php echo SITEURL ;?>images/food/<?php echo $image_name?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                                <?php
                            }
                        ?>

                    </div>
    
                    <div class="food-menu-desc">
                        <h3><?php echo $title ;?></h3>
                        <input type="hidden" name="food" value="<?php echo $title;?>">

                        <p class="food-price">₹<?php echo $price ;?></p>
                        <input type="hidden" name="price" value="<?php echo $price;?>">

                        <div class="order-label">Quantity</div>
                        <input type="number" name="qty" class="input-responsive" value="1" required>
                        
                    </div>

                </fieldset>
                
                <fieldset>
                    <legend>Delivery Details</legend>
                    <div class="order-label">Full Name</div>
                    <input type="text" name="full-name" placeholder="E.g. Madhu" class="input-responsive" required>

                    <div class="order-label">Phone Number</div>
                    <input type="tel" name="contact" placeholder="E.g. 9843xxxxxx" class="input-responsive" required>

                    <div class="order-label">Email</div>
                    <input type="email" name="email" placeholder="E.g. hi@madhu.com" class="input-responsive" required>

                    <div class="order-label">Address</div>
                    <textarea name="address" rows="10" placeholder="E.g. Street, City, Country" class="input-responsive" required></textarea>

                    <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
                </fieldset>

            </form>

            <?php
                //whether the submit button selected or not 
                if(isset($_POST['submit']))
                {
                    //get all the details from the form
                    $food=$_POST['food'];
                    $price=$_POST['price'];
                    $qty=$_POST['qty'];
                    $total=$price*$qty;

                    $order_date=date("y-m-d h:i:sa"); //order date
                    $status="ordered";  //ordered ,on delivery ,deliveryed ,cancelled

                    $customer_name=$_POST['full-name'];
                    $customer_contact=$_POST['contact'];
                    $customer_email=$_POST['email'];
                    $customer_address=$_POST['address'];

                    //save tthe order in data base
                    //create sql to save the data 
                    $sql2="INSERT INTO tbl_order SET 
                    food ='$food',
                    price=$price,
                    qty=$qty,
                    total=$total,
                    order_date='$order_date',
                    status ='$status',
                    customer_name='$customer_name',
                    customer_contact='$customer_contact',
                    customer_email='$customer_email',
                    customer_address='$customer_address'
                    ";

                    //execute the quary 
                    $res2=mysqli_query($conn,$sql2);
                    //check whether quary executed successfully or not 
                    if($res2==true)
                    {
                        //quary executed and order saved
                        $_SESSION['order']="<div class='success text-center'>Food ordered successfully .</div>";
                        header('location:'.SITEURL.'index_1.php');
                    }
                    else
                    {
                        //fail to save the order
                        $_SESSION['order']="<div class='error text-center'>Fail to order food .</div>";
                        header('location:'.SITEURL.'index_1.php');
                    }
                }
            ?>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->


    <?php include('partials-front/footer.php');?>