<?php include'inc/header.php'; ?>
<?php include'inc/sidebar.php'; ?>

<div class="grid_10">

    <div class="box round first grid">
        <h2>Update Site Title and Description</h2>
        
        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            
            $title=$fm->validation($_POST['title']);
            $slogan=$fm->validation($_POST['slogan']);
            $title = mysqli_real_escape_string($db->link,$title);
            $slogan = mysqli_real_escape_string($db->link, $slogan);
            

            $permited = array('png');
            $file_name = $_FILES['logo']['name'];
            $file_size = $_FILES['logo']['size'];
            $file_temp = $_FILES['logo']['tmp_name'];

            $div = explode('.', $file_name);
            $file_ext = strtolower(end($div));
            $same_image = 'logo' . '.' . $file_ext;
            $uploaded_image = "uploads/" . $same_image;


            if ($title == "" || $slogan == "") {
                echo "<span class='error'>File must not be empty!..</span>";
            } else {

                //its works only when i fullfill uper condition not empty any field...

                if (!empty($file_name)) { //just validation file found then its work
                    if ($file_size > 1048567) {
                        echo "<span class='error'>Image Size should be less then 1MB!</span>";
                    } elseif (in_array($file_ext, $permited) === false) {
                        echo "<span class='error'>You can upload only:-" . implode(', ', $permited) . "</span>";
                    } else {
                        move_uploaded_file($file_temp, $uploaded_image);
                        $query = "UPDATE  title_slogan
                SET 
                title='$title',slogan='$slogan',logo='$uploaded_image' where id='1'";
                        $update_row = $db->update($query);

                        if ($update_row) {
                            echo "<span class='success'>Data Updated Successfully. </span>";
                        } else {
                            echo "<span class='error'>Data Not Updated !</span>";
                        }
                    }
                } else { //No submitted image before used image used then its work
                    $query = "UPDATE  title_slogan
                SET 
                title='$title',slogan='$slogan' where id='1'";
                    $update_row = $db->update($query);

                    if ($update_row) {
                        echo "<span class='success'>Data Updated Successfully. </span>";
                    } else {
                        echo "<span class='error'>Data Not Updated !</span>";
                    }
                }
            }
        }
        ?>
        
        <?php //data show from table
        $query="select *from  title_slogan where id='1'";
        $blog_title=$db->select($query);
        if($blog_title){
            while ($result=$blog_title->fetch_assoc()){
                
        ?>
        <div class="block sloginblock"> 
            <div class="fromleftside">
            <form action="" method="post" enctype="multipart/form-data">
                <table class="form">					
                    <tr>
                        <td>
                            <label>Website Title</label>
                        </td>
                        <td>
                            <input type="text" value="<?php echo $result['title'];?>"  name="title" class="medium" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Website Slogan</label>
                        </td>
                        <td>
                            <input type="text" value="<?php echo $result['slogan'];?>"  name="slogan" class="medium" />
                        </td>
                    </tr>
                     <tr>
                        <td>
                            <label>Upload Image</label>
                        </td>
                        <td>
                            <input type="file" name="logo" />
                        </td>
                    </tr>

                    <tr>
                        <td>
                        </td>
                        <td>
                            <input type="submit" name="submit" Value="Update" />
                        </td>
                    </tr>
                </table>
            </form>
            </div>
            <div class="fromrightside">
                <img src="<?php echo $result['logo'];?>" alt="logo"/>    
            </div>
        </div>
        <?php }} //end if & while loop?>
    </div>
</div>
<?php include'inc/footer.php'; ?>
