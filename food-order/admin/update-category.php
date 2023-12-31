<?php include('partials/menu.php')?>
<div class="main-content">
    <div class="wrapper">
        <h1>Update category</h1>

        <br><br>

        <?php 
            //check whether the id is set or not
            if(isset($_GET['id']))
            {
                //get the id and orther details
                //echo "eg";
                $id=$_GET['id'];
                //create sql quary get all other details
                $sql="SELECT * FROM tbl_category WHERE id=$id";
                //execute the quary 
                $res =mysqli_query($conn,$sql);

                //count the rows to check whether the id is valid or not
                $count =mysqli_num_rows($res);

                if($count==1)
                {
                    //get all the data
                    $row =mysqli_fetch_assoc($res);
                    $title=$row['title'];
                    $current_image=$row['image_name'];
                    $featured=$row['featured'];
                    $active=$row['active'];

                }
                else
                {
                    //redirect to  manage category with session
                    $_SESSION['no-category-found']="<div class='error'>category not found</div>";
                    header('location:'.SITEURL.'admin/manage-category.php');
                }
            }
            else
            {
                //redirect to the menu
                header('location:'.SITEURL.'admin/manage-category.php');
            }
        ?>
        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title</td>
                    <td>
                        <input type="text"  name="title" value="<?php echo $title;?>">
                    </td>
                </tr>
                <tr>
                    <td>Current image:</td>
                    <td>
                        <?php
                            if($current_image!="")
                            {
                                //display the image
                                ?>
                                <img src="<?php echo SITEURL;?>images/category/<?php echo $current_image;?>"width="150px" >
                                <?php
                            }
                            else
                            {
                                //display message
                                echo"<div class='error'>image not added .</div>";
                            }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>New image</td>
                    <td>
                        <input type="file" name="image"  >
                    </td>
                </tr>
                <tr>
                    <td>Featured</td>
                    <td>
                        <input <?php if($featured=="Yes"){echo "checked" ;} ?> type="radio" name="featured" value="Yes">Yes
                        <input <?php if($featured=="No"){echo "checked" ;} ?> type="radio" name="featured" value="No">No
                    </td>
                </tr>
                <tr>
                    <td>Active</td>
                    <td>
                        <input <?php if($active=="Yes"){echo "checked" ;} ?> type="radio" name="active" value="Yes">Yes
                        <input <?php if($active=="No"){echo "checked" ;} ?> type="radio" name="active" value="No">No
                    </td>
                </tr>

                <tr>
                    <td>
                        <input type="hidden" name="current_image" value="<?php echo $current_image;?>">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="update  category" class="btn-secondary">
                    </td>
                </tr>


            </table>
        </form>


        <?php
            if(isset($_POST['submit']))
            {
                //echo "clicked";
                //1.get all the values from our form
                $id=$_POST['id'];
                $title=$_POST['title'];
                $current_image=$_POST['current_image'];
                $featured=$_POST['featured'];
                $active=$_POST['active'];

                //2.update the new image if selected
                //check whether image is selected or not
                if(isset($_FILES['image']['name']))
                {
                    //get the image detials
                    $image_name=$_FILES['image']['name'];

                    //check whether the image available or not
                    if($image_name!="")
                    {
                        //image avilable

                        //a .upload the new image

                        //auto rename our inamge
                        //get the exetention of our image(jpg,png,etc) eg :food 1 .jpg
                        $ext =end(explode('.',$image_name));

                        //rename the image
                        $image_name ="Food_Category_".rand(000,999).'.'.$ext;  // change the name of the image ,eg Food_Category_001.png


                        $source_path=$_FILES['image']['tmp_name'];
                        
                        $destination_path= "../images/category/".$image_name;
                    
                        //finally upload the image
                        $upload=move_uploaded_file($source_path,$destination_path);

                        //check whether the image is uploaded or not
                        //if the image is  not uploaded then we will stop the process and redirect with the error message
                        if ($upload==false)
                        {
                            //set message 
                            $_SESSION['upload']="<div class='error'>fail to upload the image.</div>";
                            //redirect to add category page
                            header('location:'.SITEURL.'admin/manage-category.php');
                            //stop the process
                            die();
                        }
                        // b.remove the current image if available
                        if($current_image!="")
                        {
                            $remove_path="../images/category/".$current_image;
                            $remove=unlink($remove_path);

                            //check whther the image is removed or not
                            //if failed to remove then display message and stop the process
                            if($remove==false)
                            {
                                //failed to remove image
                                $_SESSION['failed-remove']="<div class='error'>failed to remove current image .</div>";
                                header('location:'.SITEURL.'admin/manage-category.php');
                                die(); //stop the process
                            }

                        }

                    }
                    else
                    {
                        $image_name=$current_image;
                    }
                }
                else
                {
                    $image_name=$current_image;
                }

                //3.update the data base
                $sql2="UPDATE tbl_category SET
                    title='$title',
                    image_name='$image_name',
                    featured='$featured',
                    active='$active'
                    WHERE id=$id
                ";
                //execute the quary
                $res2=mysqli_query($conn,$sql2);

                //4.redirect to manage category with message

                //check whether the quary execute or not
                if($res2==true)
                {
                    //category update
                    $_SESSION['update']="<div class='success'>category updated sucessfully .</div>";
                    header('location:'.SITEURL.'admin/manage-category.php');
                }
                else
                {
                    //faile to update category
                    $_SESSION['update']="<div class='error'>fail to update category .</div>";
                    header('location:'.SITEURL.'admin/manage-category.php');
                }
            }
        ?>
    </div>
</div>
<?php include('partials/footer.php')?>