<?php include('partials/menu.php');?>
<div class="main-content">
    <div class="wrapper">
        <h1>Add food</h1>
        <br><br>

        <?php
        if(isset($_SESSION['upload']))
        {
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        }
        ?>

        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title :</td>
                    <td>
                        <input type="text" name="title" placeholder="Title of the food">    
                    </td>
                </tr>
                <tr>
                    <td>Description :</td>
                    <td>
                       <textarea name="description" cols="30" rows="5" placeholder="description of the food"></textarea>   
                    </td>
                </tr>

                <tr>
                    <td>Price :</td>
                    <td>
                       <input type="number" name="price" >   
                    </td>
                </tr>

                <tr>
                    <td>Image :</td>
                    <td>
                        <input type="file" name="image" >    
                    </td>
                </tr>

                <tr>
                    <td>Category :</td>
                    <td>
                        <select name="category">


                        <?php 
                            //create the php code to display categories from database
                            //1.create sql to get all active categories from database

                            $sql="SELECT * FROM tbl_category WHERE active='Yes'";
                            
                            //excute the quary 

                            $res=mysqli_query($conn,$sql);

                            //count rows to check  whether we have category or not 
                            $count=mysqli_num_rows($res);

                            //if count is greater then zero ,we have categories else we do not have categories
                            if($count>0)
                            {
                                //we have categoies
                                while($row=mysqli_fetch_assoc($res))
                                {
                                    //get the details of the category
                                    $id=$row['id'];
                                    $title=$row['title'];
                                    ?>
                                     <option value="<?php echo $id;?>"><?php echo  $title ;?></option>
                                    <?php
                                }

                            }
                            else
                            {
                                //we do not have category
                                ?>
                                 <option value="0">no category found</option>

                                <?php
                            }                   


                            //2.display on  dropdown 
                        ?>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td>Featured :</td>
                    <td>
                        <input type="radio" name="featured" value="Yes">Yes
                        <input type="radio" name="featured" value="No">No

                    </td>
                </tr>

                <tr>
                    <td>Active :</td>
                    <td>
                        <input type="radio" name="active" value="Yes">Yes
                        <input type="radio" name="active" value="No">No
                    </td>
                </tr>
                
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add food" class="btn-secondary">
                    </td>
                </tr>

            </table>
        </form>

        <?php 
            //check whether the button is clicked or not 
            if(isset($_POST['submit']))
            {
                //add the food in database
                //echo "oh";
                //1.get the data from the from
                $title=$_POST['title'];
                $description =$_POST['description'];
                $price=$_POST['price'];
                $category=$_POST['category'];
                
                $active=$_POST['active'];

                //check whether radio button for featured and active are checked or not
                if(isset($_POST['featured']))
                {
                    $featured=$_POST['featured'];
                }
                else
                {
                    $featured="No";// setting default value as no 
                }

                if(isset($_POST['active']))
                {
                    $active=$_POST['active'];
                }
                else
                {
                    $active="No"; // setting default value as no 
                }
                //2.upload the image if  selected
                //check whether the selected image is clicked or not and upload the image only if the  image is selected
                if(isset($_FILES['image']['name']))
                {
                    //get the details of the selected image 
                    $image_name=$_FILES['image']['name'];

                    //check whether the image is selected or not and upload image only if selected
                    if($image_name!="")
                    {
                        //image is selected
                        //A.rename the image
                        //get the extention of selected image(jpg,png,gif,etc)  
                        $ext=end(explode(".",$image_name));

                        //create the new image name
                        $image_name="Food-Name-".rand(0000,9999).".".$ext; //new image name may be "Food-Name-6766.jpg"
                        //B.upload the image
                        //get the src path and destiantion path 

                        //source path is the current loaction of the image
                        $src=$_FILES['image']['tmp_name'];

                        //destination path for the image to be uploaded 
                        $dst ="../images/food/".$image_name;

                        //finally upload the image
                        $upload=move_uploaded_file($src,$dst);
                        
                        //check whether image is uploaded or not 
                        if($upload==false)
                        {
                            //fail to upload the image 
                            //redirect to add food with the error message
                            $_SESSION['upload']="<div class='error'>Fail to upload the image .</div>";
                            header('location:'.SITEURL.'admin/add-food.php');
                            //stop the process
                            die();
                        }
                    }
                } 
                else
                {
                    $image_name="";//setting deafault value as blank
                }

                //3.insert into the data base 

                //create a sql quary to save or add food 
                //  ''  no need for numeric values
                $sql2="INSERT INTO tbl_food SET
                    title='$title',
                    description='$description',
                    price=$price,    
                    image_name='$image_name',
                    category_id=$category,
                    featured='$featured',
                    active='$active'
                ";

                //execte the quary 
                $res2=mysqli_query($conn,$sql2);
                //check  whether data inserted or not
                if($res2==true)
                {
                    //data inserted successfully
                    $_SESSION['add']="<div class='success'>Food added successfully .</div>";
                    header('location:'.SITEURL.'admin/manage-food.php');
                } 
                else
                {
                    //fail to insert data 
                    $_SESSION['add']="<div class='error'>Fail to add food.</div>";
                    header('location:'.SITEURL.'admin/manage-food.php');
                }
                //4.redirect with message to manage food page
            }
        ?>
    </div>
</div>

<?php include('partials/footer.php');?>