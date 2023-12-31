<?php include('../config/constants.php'); ?>

<html class="bg">
    <head>
        <title> login -food order system</title>
        <link rel="stylesheet" href="../css/admin.css">
    </head>

    <body>
        
    
        <div class="login">
            <h1 class="text-center">login</h1>

            <br><br>

            <?php 
                //display the messaage if the login is successful
                if(isset($_SESSION['login']))
                {
                    echo $_SESSION['login'];
                    unset ($_SESSION['login']);
                    
                }
                if(isset($_SESSION['no-login-message']))
                {
                    echo $_SESSION['no-login-message'];
                    unset($_SESSION['no-login-message']);
                }
            ?>

            <?php 
                //display the messaage if the login is failed
                if(isset($_SESSION['login']))
                {
                    echo $_SESSION['login'];
                    unset ($_SESSION['login']);
                    
                }
            ?>

            <!--login form start here -->
            <form action="" method="POST" class="col">
                Username :
                <input type="text" name="username" placeholder="enter username ">
                passsword:
                <input type="password" name="password" placeholder="enter password ">
                <br><br>

                <input type="submit" name="submit"  value="login" class="btn-primary">
            </form>
            <!--login form end here -->
            
            <p class="text-center">
                created by  <a href="www">madhu</a>
            </p>
        </div>
    </body>
</html>

<?php 
    //check the submit button is clicked or not 
    if(isset($_POST['submit']))
    {
        // process for login 
        //1. get the data from login form 
        $username = $_POST['username'];
        $password = md5($_POST['password']);

        //2. sql to check whether the user with user name and password is exist or not 
        $sql = "SELECT *FROM tbl_admin WHERE username='$username' AND PASSWORD = '$password'";

        //3.excute the quary
        $res =mysqli_query($conn,$sql);

        //4.count the rows to check the whether the user is exist or not
        $count= mysqli_num_rows($res);

        if ($count==1)
        {
            //user available and login success
            $_SESSION['login'] ="<div class='success'>Login successful </div>";
            $_SESSION['user'] =$username;  //this is to check whether the user is loged in or not and logot will unset it
            //redirect to home page /dashboard
            header('location:'.SITEURL.'admin/');
        }
        else
        {
            // user not available   and login fail 
            $_SESSION['login'] ="<div class='error text-center' >username or password did not match </div>";
            //redirect to home page /dashboard
            header('location:'.SITEURL.'admin/login.php');


        }

    }
?>