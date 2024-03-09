<?php include('config/constants.php');?>




<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Registration Page</title>
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

  .registration-container {
    background-color: #fff;
    padding: 20px;
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    max-width: 300px;
    width: 100%;
  }

  .registration-container h2 {
    text-align: center;
    margin-bottom: 20px;
  }

  .registration-container input[type="text"],
  .registration-container input[type="password"] {
    width: 100%;
    padding: 10px;
    margin-bottom: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    box-sizing: border-box;
  }

  .registration-container input[type="submit"] {
    width: 100%;
    padding: 10px;
    background-color: #007bff;
    color: #fff;
    border: none;
    border-radius: 5px;
    cursor: pointer;
  }

  @media screen and (max-width: 400px) {
    .registration-container {
      max-width: 90%;
    }
  }
</style>
</head>
<body>

<div class="registration-container">
  <h2>Registration</h2>
  <form action="#" method="post">
    <input type="text" name="username" placeholder="Username" required>
    <input type="password" name="password" placeholder="Password" required>
    <input type="password" name="confirm_password" placeholder="Confirm Password" required>
    <input type="email" name="email" placeholder="Email" required>
    <br><br>
    <input type="submit" name="submit" value="Register">
  </form>
</div>

</body>
</html>

<?php 
  //process the value from form and save it in data base
  //check whether the subit button is click
    if(isset($_POST['submit'])) 
    {
        //button clicks
        echo" botton clicked";
        
        //get the data from form
        
        $username =mysqli_real_escape_string($conn,$_POST['username']) ;
        $password =mysqli_real_escape_string($conn,$_POST['password']) ;
        $raw_password=md5($_POST['confirm_password']);
        $confirm_password =mysqli_real_escape_string($conn,$raw_password) ; //password encrypted with md5
        $email=mysqli_real_escape_string($conn,$_POST['email']);

        //sql quary to save the data into database
        $sql="INSERT INTO tbl_user SET
            username='$username',
            password='$password',
            confirm_password='$confirm_password',
            email='$email'
        ";
       
        
        

        //execute quary and saving data into dba
        $res = mysqli_query($conn,$sql) or die(mysqli_error());

        //check whether the (quary is executed) data is inserted or not and display appropriate message 
        if($res==TRUE)
        {
            //data inserted 
            //echo"dta in ";
            //create a session
            $_SESSION['add']="<div class='success'>Registered successfully</div>";
            //redirect page to manage admin
            header("location:".SITEURL.'user_login.php');
        }
        else
        {
            //fail to inserted
            $_SESSION['add']="<div class='error'>Failed to register</div>";
            //redirect page to add admin
            header("location:".SITEURL.'user_login.php');
        }

    }

?>
