<?php include('partials/menu.php');?>
<div class="main-content"> 
    <div class="wrapper">
        <h1>Add category</h1>
        <br><br>
        
        <?php 
            if(isset($_SESSION['add']))
            {
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }
        ?>
        <br><br>
        <?php 
            if(isset($_SESSION['upload']))
            {
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }
        ?>


        <!--Add category form start -->
        <form action="" method="POST" enctype="multipart/form-data">
            <TAble class="tbl-30">
                <tr>
                    <td>Title :</td>
                    <td>
                        <input type="text" name="title" placeholder="category title">
                    </td>
                </tr>

                <tr>
                    <td>seleck image :</td>
                    <td>
                        <input type="file" name="image" >
                    </td>
                </tr>


                
                <tr>
                    <td>Featured :</td>
                    <td>
                        <input type="radio" name="featured" value="Yes">yes
                        <input type="radio" name="featured" value="No">no
                    </td>
                </tr>

                
                <tr>
                    <td>Active :</td>
                    <td>
                        <input type="radio" name="active" value="Yes">yes
                        <input type="radio" name="active" value="No">no
                    </td>
                </tr>

                <tr>
                    <td>
                        <input type="submit" name="submit" value="add-category " class="btn-secondary">
                    </td>
                </tr>
            </TAble>
        </form>
        
        <!--Add category form ends -->
        <?php 
            //check whether the submit button is clicked or not
            if(isset($_POST['submit']))
            {
                //echo "ok";

                //1.get the value from the category form

                $title =$_POST['title'];

                //for radio input ,we need to check whether the button is selected or not
                if(isset($_POST['featured']))
                {
                    //get the value from form 
                    $featured =$_POST['featured'];

                } 
                else
                {
                    //set the default value
                    $featured='No';
                }
                if(isset($_POST['active']))
                {
                    $active =$_POST['active'];

                }
                else
                {
                    $active ="No";
                }

                //check whether the image is selected or  not set the value for image name accordingly
                //print_r($_FILES['image']);
                //die(); //break the code here

                if(isset($_FILES['image']['name']))
                {
                    //uplode  the image 
                    //to upload the image name and source path and destination path
                    $image_name=$_FILES['image']['name'];

                    //upload the image only if image is selected
                    if($image_name!="")
                    {

                        
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
                            header('location:'.SITEURL.'admin/add-category.php');
                            //stop the process
                            die();
                        }
                    }
                }
                else
                {
                    //don't uplode the image and set the image_name value as blank
                    $image_name="";
                }

                //2.create the sql quary to insert the category inn the data base
                
                $sql="INSERT INTO tbl_category SET
                    title='$title',
                    image_name='$image_name',
                    featured='$featured',
                    active = '$active'
                ";


                //3.execute the quary and save in database
                $res =mysqli_query($conn,$sql);

                //check whether the quary executed or not and data added or not

                if ($res==true)
                {
                    //quary execuuted and category executed 
                    $_SESSION['add']="<div class = 'success'>Categary added successfully.</div>";
                    //redirect to manage category page
                    header('location:'.SITEURL.'admin/manage-category.php'); 
                }
                else{
                    //failed to add category
                    $_SESSION['add']="<div class = 'error'>failed to add Categary .</div>";
                    //redirect to manage category page
                    header('location:'.SITEURL.'admin/add-category.php');
                }
            } 
        ?>

    </div>
</div>
<?php include('partials/footer.php');?>