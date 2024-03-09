<?php 

    //you need to delete the user name


    
    // include constant.php for SITEURL
    include('config/constants.php');
    //destroy the session
    session_destroy(); //unset $_SESSION['user']
    //redirect to the login page
    header('location:'.SITEURL.'index.php');
        
?>