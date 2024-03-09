<?php 
    // include constant.php for SITEURL
    include('../config/constants.php');
    //destroy the session
    session_destroy(); //unset $_SESSION['user']
    //redirect to the login page
    header('location:'.SITEURL.'admin/login.php');
?>