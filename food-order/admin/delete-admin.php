<?php 

    //incude constant.php file here
    include('../config/constants.php');
    //get the id of admin to be deleted
        echo $id= $_GET['id'];

    //create sql quary to delete admin

        $sql="DELETE FROM tbl_admin WHERE id =$id";
    //execute the quary
        $res =mysqli_query($conn,$sql);

    //check whether the quary excuted successfully or not 
        if($res==true)
        {
            //quary executed successfully
            //echo"Admin Deleted";
            //create SESSION variable to display message
            $_SESSION['delete']="<div class='success'>Admin deleted successfully.</div>";
            //redirect to manage admin page
            header('location:'.SITEURL.'admin/manage-admin.php');
        
        }
        else
        {
            //fail to delete
            //echo"failed to delete admin";

            $_SESSION['delete']="<div class='error'>fail to delete , please try again later.</div>";
            //redirect to manage admin page
            header('location:'.SITEURL.'admin/manage-admin.php');
        }
    //redirect to manage admin page with message (success/error)


?>