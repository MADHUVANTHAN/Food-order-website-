<?php include('partials/menu.php');?>



<div class="main-content">
    <div class="wrapper"></div>
    <h1>Add Admin</h1>
    <br><br><br>

    <?php 
        if(isset($_SESSION['add']))         //checking whether the SESSION is set or not
        {
            echo $_SESSION['add']  ;         //display the SESSION message if set
            unset($_SESSION['add']) ;        //remove SESSTION message
        }
    ?>
    <form action="" method="POST">
        <table class="tbl-30">
            <tr>
                <td>Full Name :</td>
                <td> <input type="text" name="full_name" placeholder="Enter your Name"></td>
                
                
            </tr>
            <tr>
            <td>User Name :</td>
                <td> <input type="text" name="username" placeholder="Enter your Username"></td>
            </tr>
            <tr>
            <td>Password :</td>
                <td> <input type="password" name="password" placeholder="Enter your password"></td>
            </tr>
            <tr>
                <td colspan="2">
                    <input type="submit" name="submit" value="Add Admin" class="btn-primary">
                </td>
            </tr>
        </table>
    </form>

</div>


<?php include('partials/footer.php');?>

<?php 
  //process the value from form and save it in data base
  //check whether the subit button is click
    if(isset($_POST['submit'])) 
    {
        //button clicks
        //echo" botton clicked";
        
        //get the data from form
        $full_name = $_POST['full_name'];
        $username = $_POST['username'];
        $password = md5($_POST['password']); //password encrypted with md5

        //sql quary to save the data into database
        $sql="INSERT INTO tbl_admin SET
            full_name='$full_name',
            username='$username',
            password='$password'
        ";
       
        
        

        //execute quary and saving data into dba
        $res = mysqli_query($conn,$sql) or die(mysqli_error());

        //check whether the (quary is executed) data is inserted or not and display appropriate message 
        if($res==TRUE)
        {
            //data inserted 
            //echo"dta in ";
            //create a session
            $_SESSION['add']="Admin Added successfully";
            //redirect page to manage admin
            header("location:".SITEURL.'admin/manage-admin.php');
        }
        else
        {
            //fail to inserted
            $_SESSION['add']="Failed to Add Admin";
            //redirect page to add admin
            header("location:".SITEURL.'admin/manage-admin.php');
        }

    }

?>