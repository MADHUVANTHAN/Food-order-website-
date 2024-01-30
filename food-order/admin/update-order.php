<?php  include('partials/menu.php')?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update order</h1>
        <br><br>

        <?php 
            //check whether id is check or not
            if(isset($_GET['id']))
            {
                //get the order details
                $id=$_GET['id'];

                //get all other deatils based on $id line 13
                //sql quary to get the order details
                $sql="SELECT * FROM tbl_order WHERE id=$id";

                //execute the quary 
                $res=mysqli_query($conn,$sql);

                //count the rows
                $count=mysqli_num_rows($res);

                if($count==1)
                {
                    //detail available 
                    $row=mysqli_fetch_assoc($res);
                    
                    
                    $food=$row['food'];
                    $price=$row['price'];
                    $qty=$row['qty'];
                    $status=$row['status'];
                    $customer_name=$row['customer_name'];
                    $customer_contact=$row['customer_contact'];
                    $customer_email=$row['customer_email'];
                    $customer_address=$row['customer_address'];

                }
                else
                {
                    //detail unavailable
                    //redirect to manage order page
                    header('location:'.SITEURL.'admin/manage-order.php');
                }
            }
            else
            {
                //redirect to manage order page 
                header('location:'.SITEURL.'admin/manage-order.php');
            }

        ?>

        <form action="" method="post">
            <table class="tbl30">
                <tr>
                    <td>Food name</td>
                    <td><?php echo $food ;?></td>
                </tr>
                <tr>
                    <td>price</td>
                    <td><?php echo $price ;?></td>
                </tr>
                <tr>
                    <td>qty</td>
                    <td>
                        <input type="number" name="qty" value="<?php echo $qty ;?>">
                    </td>
                </tr>
                <tr>
                    <td>status</td>
                    <td>
                        <select name="status" >
                            <option <?php if($status=="ordered"){ echo "selected";}?> value="ordered">Ordered</option>
                            <option <?php if($status=="On delivery"){ echo "selected";}?> value="On delivery">On delivery</option>
                            <option <?php if($status=="delivered"){ echo "selected";}?> value="delivered">Deliveyed</option>
                            <option <?php if($status=="cancelled"){ echo "selected";}?> value="cancelled">cancelled</option>
                            
                        </select>
                    </td>
                </tr>

                <tr>
                    <td>Customer name :</td>
                    <td>
                        <input type="text" name="customer_name" value="<?php echo $customer_name ;?>">
                    </td>
                </tr>

                <tr>
                    <td>customer_contact :</td>
                    <td>
                        <input type="text" name="customer_contact" value="<?php echo $customer_contact;?>">
                    </td>
                </tr>
                <tr>
                    <td>Customer email :</td>
                    <td>
                        <input type="text" name="customer_email" value="<?php echo $customer_email ;?>">
                    </td>
                </tr>

                <tr>
                    <td>Customer address:</td>
                    <td>
                        <textarea name="customer_address" cols="30" rows="5"><?php echo $customer_address ;?></textarea>
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id;?>">
                        <input type="hidden" name="price" value="<?php echo $price;?>">
                        <input type="submit" name="submit" value="update order" class="btn-secondary">
                    </td>
                </tr>

            </table>
        </form>

        <?php 
            //check whether update button is clicked or not
            if(isset($_POST['submit']))
            {
                //echo "clicked";
                //get all the values from the form
                $id=$_POST['id'];
                $price=$_POST['price'];
                $qty=$_POST['qty'];
                $total=$price*$qty;
                $status=$_POST['status'];
                $customer_name=$_POST['customer_name'];
                $customer_contact=$_POST['customer_contact'];
                $customer_email=$_POST['customer_email'];
                $customer_address=$_POST['customer_address'];
                
                //update the valuse
                $sql2="UPDATE tbl_order SET 
                    qty=$qty,
                    total=$total,
                    status='$status',
                    customer_name='$customer_name',
                    customer_contact='$customer_contact',
                    customer_email='$customer_email',
                    customer_address='$customer_address'
                    WHERE id=$id
                ";
                //execute the quary 
                $res2=mysqli_query($conn,$sql2);

                //chewc whether update or not
                //and redirect to manage order with message
                if($res2==true)
                {
                    //updated
                    $_SESSION['update']="<div class='success'>category updated order .</div>";
                    header('location:'.SITEURL.'admin/manage-order.php');
                }
                else
                {
                    //fail to update
                    $_SESSION['update']="<div class='error'>fail to update order .</div>";
                    header('location:'.SITEURL.'admin/manage-order.php');
                }
            }
        ?>
    </div>

</div>
<?php  include('partials/footer.php')?>