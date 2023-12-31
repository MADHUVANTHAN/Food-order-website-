<?php 
    //include constants file
    include('../config/constants.php');
    //echo "ok";
    //check whether the id and image_name value is set or not
    if(isset($_GET['id']) AND isset($_GET['image_name']))
    {
        //get the value and delete
        //echo"Get value and delete";
        $id =$_GET['id'];
        $image_name =$_GET['image_name']; 

        //remove the physical image file is available

        //delete data from database

        //redirect to the manage category page with message
        if($image_name != "")
        {
            //image is available .so remove it
            $path = "../images/category/".$image_name;

            //remove the image 
            $remove=unlink($path);

            //if faile to remove the image then add an error message
            if($remove==false)
            {
                //set the seesion message 
                $_SESSION['remove']="<div class='error'>failed to remove category image . </div>";
                //redirect to  the manage category
                header('location:'.SITEURL.'admin/manage-category.php');
                //stop the process
                die();
            }
        }

        //delete data from the data base
        //sl quary to delete the data from the data base
        $sql="DELETE FROM tbl_category WHERE id=$id";
        //execute the quary 

        $res= mysqli_query($conn,$sql);

        //check whether the data is deleted or not 
        if($res==true)
        {
            //set suscess messagea and redirect
            $_SESSION['delete']="<div class= 'success'> category deleted successfully</div>";
            //redirect to manage category
            header('location:'.SITEURL.'admin/manage-category.php');
        }
        else
        {
            //redirect to manage category page
            
            $_SESSION['delete']="<div class= 'error'>failed to delete category .</div>";
            //redirect to manage category
            header('location:'.SITEURL.'admin/manage-category.php');
        }

    }    
    else
    {
        //redirect to the manage category page
        header('location:'.SITEURL.'admin/manage-category.php');

    }
?>