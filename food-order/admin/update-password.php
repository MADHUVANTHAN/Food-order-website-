<?php include('partials/menu.php');?>
<div class="main-contant">
    <div class="wrapper">
        <h1>change password</h1>
        <br><br>

        <?php 
            if(isset($_GET['id']))
            {
                $id=$_GET['id'];
            }
        ?>

         <form action="" method="POST">

         <Table class="tbl-30">
            <tr>
                <td>old password:</td>
                <td>
                    <input type="password" name="current_password" placeholder="current password">
                </td>
            </tr> 
            <tr>
                <td>New password</td>
                <td>
                    <input type="password" name="new_password" placeholder="New password">
                </td>
            </tr>
            <tr>
                <td>Confirm password</td>
                <td>
                    <input type="password" name="confirm_password" placeholder="Confirm password">
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <input type="hidden" name="id" value="<?php echo $id;?>">
                    <input type="submit" name="submit" value="change password" class="btn-secondary">

                </td>
            </tr>


         </Table>
         </form>       
    </div>
</div>

<?php 
    //check whether the submit button is click or not
    if(isset($_POST['submit']))
    {
        //echo "ok";

        //get the data from form
        $id=$_POST['id'];
        $current_password=md5($_POST['current_password']);
        $new_password=md5($_POST['new_password']);
        $confirm_password=md5($_POST['confirm_password']);

        //check whether the user with current password exist or not
        $sql="SELECT * FROM tbl_admin WHERE id=$id AND password='$current_password'";

        //execute the quary 
        $res =mysqli_query($conn,$sql);
        if($res==true)
        {
            //check data is available or not
            $count=mysqli_num_rows($res);
            if($count==1)
            {
                //uesr exists and password will be changed
                //echo "user found";

                //check whether the new password and confirm password match or not
                if($new_password==$confirm_password)
                {
                    //update password
                    $sql2="UPDATE tbl_admin SET 
                        PASSWORD = '$new_password'
                        WHERE id =$id
                    ";

                    //execute the quary
                    $res2=mysqli_query($conn,$sql2);
                    //check whether the quary executed or not 
                    if($res==true)
                    {
                        //display success message
                        //redirect to the admin page with error message
                        $_SESSION['change-password']="<div class='success'>password changed successfully. </div>";

                        //redirect to the user
                        header('location:'.SITEURL.'admin/manage-admin.php');
                    }
                    else
                    {
                       //display error message 
                       //redirect to the admin page with error message
                        $_SESSION['change-password']="<div class='error'>fail to change. </div>";

                        //redirect to the user
                        header('location:'.SITEURL.'admin/manage-admin.php');
                    }
                }
                else
                {
                    //redirect to the admin page with error message
                    $_SESSION['pwd-not-match']="<div class='error'>pwd-not-match. </div>";

                    //redirect to the user
                    header('location:'.SITEURL.'admin/manage-admin.php');
                }
            }
            else
            {
                //user does not exist set message and redirect
                $_SESSION['user-not-found']="<div class='error'>user not found. </div>";

                //redirect to the user
                header('location:'.SITEURL.'admin/manage-admin.php');
            }
        }
        
        //check whther the new password and  confirm password  match or not

        //check password if all above is true
    }
?>

<?php include('partials/footer.php');?>