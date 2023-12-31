<?php include('partials/menu.php'); ?>
        <!--Menu section ends -->


        <!--Main content section starts -->
        <div class="main-content">
            <div class="wrapper">
                <h1>Manage Admin</h1>
                <br><br><br>
                <?php 
                    if(isset($_SESSION['add']))
                    {
                        echo $_SESSION['add'];          //display SESSSION MESSAGE 
                        unset($_SESSION['add']);        //Remove SESSION message
                    }
                    if(isset($_SESSION['delete']))  
                    {
                        echo $_SESSION['delete'];
                        unset($_SESSION['delete']);
                    } 
                    
                    if(isset($_SESSION['update']))
                    {
                        echo $_SESSION['update'];
                        unset($_SESSION['update']);
                    }

                    if(isset($_SESSION['user-not-found']))
                    {
                        echo $_SESSION['user-not-found'];
                        unset($_SESSION['user-not-found']);
                    }
                    if(isset($_SESSION['pwd-not-match']))
                    {
                        echo $_SESSION['pwd-not-match'];
                        unset($_SESSION['pwd-not-match']);
                    }
                    if(isset($_SESSION['change-password']))
                    {
                        echo $_SESSION['change-password'];
                        unset($_SESSION['change-password']);
                    }
                ?>
                <br><br><br>


                <!--for button-->
                <a href="add-admin.php" class="btn-primary">Add Admin</a>

                <br><br><br>


                <table class="tbl-full">
                    <tr>
                        <th>S.N</th>
                        <th>FULL NAME</th>
                        <th>USER NAME</th>
                        <th>ACTIONS</th>
                       

                    </tr>

                        <?PHP
                        //quary to get all  admin 
                            $sql="SELECT * FROM tbl_admin ";
                        // execute the quary
                            $res=mysqli_query($conn,$sql);

                            //check whether the quary is executed 
                            if($res==TRUE)
                            {
                                //count the row to check whether we have data in data base or not
                                $count= mysqli_num_rows($res);

                                $sn=1; // assign variabl for s no :

                                //check num of rows
                                if($count>0)
                                {
                                    //we have  in data  base
                                    while($rows=mysqli_fetch_assoc($res))
                                    {
                                        //using while loop get the data from data base
                                        //add while loop will run as long as we have data in database
                                        
                                        //get individual data
                                        $id=$rows['id'];
                                        $full_name=$rows['full_name'];
                                        $username=$rows['username'];


                                        //display the value in table
                                        ?>
                                        


                                            
                                            <tr>
                                                <td><?php echo $sn++;?></td>
                                                <td><?php echo $full_name; ?></td>
                                                <td><?php echo $username; ?></td>
                                                <td>
                                                    <a href="<?php echo SITEURL;?>admin/update-password.php?id=<?php echo $id;?>" class="btn-primary">change password</a>
                                                    <a href="<?php echo SITEURL;?>admin/update-admin.php?id=<?php echo $id;?>" class="btn-secondary">Update Admin</a>
                                                    <a href="<?php echo SITEURL;?>admin/delete-admin.php?id=<?php echo $id;?>" class="btn-danger">delete Admin</a>
                                                </td>
                                            </tr>



                                        <?php

                                    }
                                }
                                else
                                {
                                    //we don't have  in data  base
                                }
                            }
                        ?>


                    
                       
                </table>
                
            </div>
        </div>

        <!--Main content section ends -->

<?php include('partials/footer.php'); ?> 