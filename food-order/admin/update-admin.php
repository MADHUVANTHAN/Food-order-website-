<?php include('partials/menu.php'); ?>

<div class="main-contant">
    <div class="wrapper">
        <h1>update admin</h1>
        <br><br>

        <?php 
            // get the id from selected admin
            $id=$_GET['id'];

            // create sql quary
            $sql="SELECT *FROM tbl_admin WHERE id=$id";

            //execute the quary
            $res=mysqli_query($conn,$sql);

            //check whether quary is execute or not
            if($res==true)
            {
                //check whether the data is available or not 
                $count=mysqli_num_rows($res);
                //check whether we have admin data or not
                if($count==1)
                {
                    //get the detials
                    $row=mysqli_fetch_assoc($res);

                    $full_name=$row['full_name'];
                    $username=$row['username'];

                }
                else
                {
                    //redirect to manage admin
                    header('location:'.SITEURL.'admin/manage-admin.php');
                }


            }

        ?>


        <form action="" method="POST">
        <table class="tbl-30">
            <tr>
                <td>Full Name :</td>
                <td> <input type="text" name="full_name" value="<?php echo $full_name;?>"> </td>
                
                
            </tr>
            <tr>
                <td>User Name :</td>
                <td> <input type="text" name="username" value="<?php echo $username;?>"></td>
            </tr>

            <tr>
                <td colspan="2">
                    <input type="hidden" name="id" value="<?php echo $id;?>">
                     <input type="submit" name="submit" value="update admin" class="btn-secondary">
                </td>
            </tr>
                
            
        </table>
    </form>
    </div>
</div>

<?php 
    //check whether the submit button click or not 
    if(isset($_POST['submit']))
    {
        echo "button clicked";
        // get all the values from form to update id
        $id=$_POST['id'];
        $full_name=$_POST['full_name'];
        $username=$_POST['username']; 
        
        //create a sql quary to update admin 
        $sql="UPDATE tbl_admin SET
        full_name ='$full_name',
        username ='$username'
        WHERE id ='$id'
        ";

        //execute the quary
        $res =mysqli_query($conn,$sql);


        //check whether the quary executed or not
        if ($res==true)
        {
            //quary executed and admin updated
            $_SESSION['update']="<div class='success'>Admin updated successfully</div>";
            //we need to redirect to manage page 
            header('location:'.SITEURL.'admin/manage-admin.php');
        }
        else
        {
            //fail to update admin
            $_SESSION['update']="<div class='error'>Admin not updated successfully</div>";
            //we need to redirect to manage page 
            header('location:'.SITEURL.'admin/manage-admin.php');

        }
    }
?>


<?php include('partials/footer.php');?>