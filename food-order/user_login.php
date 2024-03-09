<?php include('config/constants.php'); ?>


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login Page</title>
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
  <h2>Login</h2>



  <?php
      if(isset($_SESSION['add']))
      {
          echo $_SESSION['add'];          //display SESSSION MESSAGE 
          unset($_SESSION['add']);        //Remove SESSION message
      }

      if(isset($_SESSION['login']))         //checking whether the SESSION is set or not
      {
          echo $_SESSION['login']  ;         //display the SESSION message if set
          unset($_SESSION['login']) ;        //remove SESSTION message
      }
  ?>
  
  <form action="#" method="post">
    <input type="text" name="username" placeholder="Username" required>
    <input type="password" name="password" placeholder="Password" required>
    <input type="submit" name="submit" value="Login">
    
  </form>
  <div class="new-user">
    <span>New user? </span><a href="register.php">Register here</a>
  </div>
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
        $username=$_POST['username'];
        $username = mysqli_real_escape_string($conn,$_POST['username']);

        //$password = md5($_POST['password']);
        $password=$_POST['password'];
        $password=mysqli_real_escape_string($conn,$_POST['password']);

        //2. sql to check whether the user with user name and password is exist or not 
        $sql = "SELECT * FROM tbl_user WHERE username='$username' AND password='$password'";

        //3.excute the quary
        $res =mysqli_query($conn,$sql);

        //4.count the rows to check the whether the user is exist or not
        $count= mysqli_num_rows($res);

        if ($count==1)
        {
          while($row=mysqli_fetch_assoc($res))
            {
              //get  the values from individual colomns
              $id=$row['id'];
              //$username=$_GET['username'];
              

            }
  

            //user available and login success
            $_SESSION['login'] ="<div class='success'><h1>Login successful </h1></div>";
            $_SESSION['user'] =$username;  //this is to check whether the user is loged in or not and logot will unset it
            //redirect to home page /dashboard
            header('location:'.SITEURL.'index_1.php?username=<?php echo $username;?>');
        }
        else
        {
            // user not available   and login fail 
            $_SESSION['login'] ="<div class='error text-center' >username or password did not match </div>";
            //redirect to home page /dashboard
            header('location:'.SITEURL.'user_login.php');

        }
    }
    if(isset($id))
    {
      $id=$_POST['id'];
    }
    
    

?>

