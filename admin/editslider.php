<?php include'inc/header.php'; ?>
<?php include'inc/sidebar.php'; ?>

<?php
if (!isset($_GET['sliderid']) || $_GET['sliderid'] == NULL) {

    header("Location:sliderlist.php");
} else {

    $sliderid = $_GET['sliderid'];// send id hold
}
?>

<div class="grid_10">

    <div class="box round first grid">
        <h2>Update Post</h2>
        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $title = mysqli_real_escape_string($db->link, $_POST['title']);
            $link  = mysqli_real_escape_string($db->link, $_POST['link']);



            $permited = array('jpg', 'jpeg', 'png', 'gif');
            $file_name = $_FILES['image']['name'];
            $file_size = $_FILES['image']['size'];
            $file_temp = $_FILES['image']['tmp_name'];

            $div = explode('.', $file_name);
            $file_ext = strtolower(end($div));
            $unique_image = substr(md5(time()), 0, 10) . '.' . $file_ext;
            $uploaded_image = "uploads/slider/" . $unique_image;


            if ($title == "") {
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
                        $query = "UPDATE tbl_slider
                SET 
                title='$title',image='$uploaded_image',link='$link' where id='$sliderid'";
                        $update_row = $db->update($query);

                        if ($update_row) {
                            echo "<span class='success'>Data Updated Successfully. </span>";
                        } else {
                            echo "<span class='error'>Data Not Updated !</span>";
                        }
                    }
                } else { //No submitted image before used image used then its work
                    $query = "UPDATE tbl_slider
                SET 
                title='$title',link='$link' where id='$sliderid'";
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
        <div class="block">    
            <?php
            $query = "select *from tbl_slider where id='$sliderid'";
            $getpost = $db->select($query);
            if ($getpost) {
                while ($getresult = $getpost->fetch_assoc()) {
                    ?>

                    <form action="" method="post" enctype="multipart/form-data">
                        <table class="form">

                            <tr>
                                <td>
                                    <label>Title</label>
                                </td>
                                <td>
                                    <input type="text" name="title" value="<?php echo $getresult['title']; ?>" class="medium" />
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <label>Upload New Image</label>
                                </td>
                                <td>
                                    <img src="<?php echo $getresult['image']; ?>" class="image_resize"/>

                                    <input type="file" name="image" />
                                </td>
                            </tr>
                             <tr>
                        <td>
                            <label>Link</label>
                        </td>
                        <td>
                            <input type="text" name="link" value="<?php echo $getresult['link']; ?>" class="medium" />
                        </td>
                    </tr>

                            <tr>
                                <td></td>
                                <td>
                                    <input type="submit" name="submit" Value="Save" />
                                </td>
                            </tr>
                        </table>
                    </form>
                <?php }
            } // first if and while loop end?> 

        </div>
    </div>
</div>
<!--LoadTinyMCE-->
<script src="js/tiny-mce/jquery.tinymce.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function () {
        setupTinyMCE();
        setDatePicker('date-picker');
        $('input[type="checkbox"]').fancybutton();
        $('input[type="radio"]').fancybutton();
    });
</script>
<!--LoadTinyMCE-->

<?php include'inc/footer.php'; ?>

