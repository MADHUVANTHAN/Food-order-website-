<?php include('../config/constants.php'); ?>

<html class="bg">
    <head>
    <title> login -food order system</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f2f2f2;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .login-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 300px;
            width: 100%;
        }

        .login-container h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .login-container input[type="text"],
        .login-container input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        .login-container input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .login-container .new-user {
            text-align: center;
            margin-top: 10px;
        }

        .login-container .new-user a {
            color: #007bff;
            text-decoration: none;
        }

        @media screen and (max-width: 400px) {
            .login-container {
            max-width: 90%;
            }
        }
    </style>
    </head>

    <body>
        
    
        <div class="login-container">
            <h1 class="text-center">login</h1>

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
                <input type="text" name="username" placeholder="enter username " required>
                passsword:
                <input type="password" name="password" placeholder="enter password " required>
                

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
        //$username = $_POST['username'];
        $username = mysqli_real_escape_string($conn,$_POST['username']);
        //$password = md5($_POST['password']);

        $raw_password = md5($_POST['password']);
        $password=mysqli_real_escape_string($conn,$raw_password);

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