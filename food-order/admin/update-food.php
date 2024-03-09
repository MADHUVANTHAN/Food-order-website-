<?php include('partials/menu.php');?>

<?php 
    //check whether id is set  or not
    if(isset($_GET['id']))
    {
        //get all details 
        $id=$_GET['id'];

        //sql quary to get the selected food
        $sql2="SELECT *FROM tbl_food WHERE id =$id ";

        //execute the quary
        $res2=mysqli_query($conn,$sql2);
        
        //get teh value based on quary execute 
        $row2=mysqli_fetch_assoc($res2);

        //get the individual valus of selected food
        $title=$row2['title'];
        $description=$row2['description'];
        $price=$row2['price'];
        $current_image=$row2['image_name'];
        $current_category=$row2['category_id'];
        $featured =$row2['featured'];
        $active=$row2['active'];
    }
    else
    {
        //redirect to manage food 
        header('location:'.SITEURL.'admin/manage-food.php');
    }
?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update food</h1>

        <br><br>
        <form action="" method="POST" enctype="multipart/form-data">
        <table class="tbl_30">
            <tr>
                <td>Title:</td>
                <td>
                    <input type="text" name="title" value="<?php echo $title ;?>">
                </td>
            </tr>
            <tr>
                <td>Description :</td>
                <td>
                    <textarea name="description"  cols="30" rows="5"><?php echo$description ;?></textarea>
                </td>
            </tr>
            
            <tr>
                    <td>Price :</td>
                    <td>
                       <input type="number" name="price" value="<?php echo $price ;?>">   
                    </td>
                </tr>

                <tr>
                    <td>Current Image :</td>
                    <td>
                            <?php 
                            if($current_image == "")
                            {
                                // image not available
                                echo "<div class='error'>Image is not available .</div>";
                            }
                            else
                            {
                                //image is available 
                                ?>
                                <img src="<?php echo SITEURL ;?>images/food/<?php echo $current_image?>" width="200px">
                                <?php
                            }
                            ?>
                    </td>
                </tr>
                <tr>
                    <td>select new image :</td>
                    <td> 
                        <input type="file" name="image">
                    </td>
                </tr>
                <tr>
                    <td>category :</td>
                    <td>
                        <select name="category" >
                            <?php 
                            //quary to get aactive category
                            $sql="SELECT*FROM tbl_category WHERE active='Yes'";
                            //execute the quary 
                            $res =mysqli_query($conn,$sql);
                            //count the rows
                            $count=mysqli_num_rows($res);

                            //check whether category available or not
                            if($count>0)
                            {
                                //category available 
                                while($row=mysqli_fetch_assoc($res))
                                {
                                    $category_title=$row['title'];
                                    $category_id=$row['id'];
                                    
                                    //echo "<option value='$category_id'>$category_title</opution>";

                                    ?>
                                        <option <?php if($current_category==$category_id){ echo "selected";}?> value="$category_id"><?php echo $category_title;?></option>
                                    <?php
                                }
                            }
                            else
                            {
                                //category not available 
                                echo "<option value='0'>$category_title</option>";
                            }


                            ?>
                            
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Featured :</td>
                    <td>
                        <input <?php if($featured=='Yes'){echo "checked";}?> type="radio" name="featured" value="Yes">Yes
                        <input <?php if($featured=='No'){echo "checked";}?> type="radio" name="featured" value="No">No
                    </td>
                </tr>
                <tr>
                    <td>active :</td>
                    <td>
                        <input <?php if($active=='Yes'){echo "checked";}?> type="radio" name="active" value="Yes">Yes
                        <input <?php if($active=='No'){echo "checked";}?> type="radio" name="active" value="No">No
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="hidden" name="id" value="<?php echo $id ;?>" >
                        <input type="hidden" name="current_image" value="<?php echo $current_image ;?>" >
                        <input type="submit" name="submit" value="Upadate food" class="btn-secondary">
                    </td>
                </tr>

        </table>
        
        </form>

        <?php
            if(isset($_POST['submit']))
            {
                //1.get all the details from the form
                $id=$_POST['id'];
                $title=$_POST['title'];
                $description=$_POST['description'];
                $price=$_POST['price'];
                $current_image=$_POST['current_image'];
                $category=$_POST['category'];

                $featured =$_POST['featured'];
                $active=$_POST['active'];
                


                //2. upload the image if selected
                //check whether upload button clicked or not
                if(isset($_FILES['image']['name']))
                {
                    //upload button clicked
                    $image_name=$_FILES['image']['name'];    //new image name

                    //check the file is available or not
                    if($image_name!="")
                    {
                        //image is available
                        //rename the image
                        $explode=explode('.',$image_name);
                        $ext=end($explode);   //get the extention of the image 
                        $image_name="Food-Name".rand(0000,9999).'.'.$ext;  //this will be rername image

                        //get the source path and destination path
                        $src_path=$_FILES['image']['tmp_name'];    //source path 
                        $des_path="../images/food/".$image_name;   //destination path

                        //upoload the image
                        $upload=move_uploaded_file($src_path,$des_path);

                        //chweck whether the image is uploaded or not 
                        if($upload==false)
                        {
                            //fail to upload
                            $_SESSION['upload']="<div class='error'>Fail to upload the new image .</div>";
                            //redirec to the manage food
                            header('location:'.SITEURL.'admin/add-food.php');

                            //stop the proccess
                            die();
                        }
                        
                        
                        //3.remove the image if new image is uploaded and current image exists 
                        //B. remove current iamge if available 
                        if($current_image!="")
                        {
                            //current image is available 
                            //remove the image 
                            $remove_path="../images/food/".$current_image;

                            $remove =unlink($remove_path);

                            //check whther the image is removed or not
                            if($remove==false)
                            {
                                //fail to remove current image 
                                $_SESSION['remove-failed']="<div class='error'>Fail to  the current image .</div>";
                                header('location:'.SITEURL.'admin/add-food.php');
                                die();
                            }
                        }
                    }
                    else
                    {
                        $image_name=$current_image; //default image when image is not available
                    }
                } 
                else
                {
                    $image_name=$current_image;  //default image when botton is not clicked 
                }

                ///4.upload the food in database
                $sql3="UPDATE tbl_food SET 
                    title='$title',
                    description='$description',
                    price='$price',
                    image_name='$image_name',
                    category_id='$category_id',
                    featured='$featured',
                    active='$active'
                    WHERE id=$id
                ";

                //execute the sql quary 
                $res3=mysqli_query($conn,$sql3);

                //check whether the quary exexcuted or not
                if($res3==true)
                {
                    //quary executed successfully
                    $_SESSION['update']="<div class='success'>Food updated successfully .</div>";
                    //redirec to the manage food
                    header('location:'.SITEURL.'admin/manage-food.php');
                }
                else
                {
                    $_SESSION['update']="<div class='error'>Fail to update food .</div>";
                    //redirec to the manage food
                    header('location:'.SITEURL.'admin/manage-food.php');
                }

                //rediect to manage food with session message
            }        
        ?>

    </div>

</div>
<?php include('partials/footer.php')?>