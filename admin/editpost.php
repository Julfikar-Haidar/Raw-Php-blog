<?php include'inc/header.php'; ?>
<?php include'inc/sidebar.php'; ?>

<?php
if (!isset($_GET['editpost']) || $_GET['editpost'] == NULL) {

    header("Location:postlist.php");
} else {

    $editpostId = $_GET['editpost'];// send id hold
}
?>

<div class="grid_10">

    <div class="box round first grid">
        <h2>Update Post</h2>
        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $title = mysqli_real_escape_string($db->link, $_POST['title']);
            $cat = mysqli_real_escape_string($db->link, $_POST['cat']);
            $body = mysqli_real_escape_string($db->link, $_POST['body']);
            $tags = mysqli_real_escape_string($db->link, $_POST['tags']);
            $author = mysqli_real_escape_string($db->link, $_POST['author']);
            $userid= mysqli_real_escape_string($db->link, $_POST['userid']);


            $permited = array('jpg', 'jpeg', 'png', 'gif');
            $file_name = $_FILES['image']['name'];
            $file_size = $_FILES['image']['size'];
            $file_temp = $_FILES['image']['tmp_name'];

            $div = explode('.', $file_name);
            $file_ext = strtolower(end($div));
            $unique_image = substr(md5(time()), 0, 10) . '.' . $file_ext;
            $uploaded_image = "uploads/" . $unique_image;


            if ($title == "" || $cat == "" || $body == "" || $tags == "" || $author == "") {
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
                        $query = "UPDATE tbl_post
                SET 
                cat='$cat',title='$title',body='$body',image='$uploaded_image',author='$author',tags='$tags',userid='$userid' where id='$editpostId'";
                        $update_row = $db->update($query);

                        if ($update_row) {
                            echo "<span class='success'>Data Updated Successfully. </span>";
                        } else {
                            echo "<span class='error'>Data Not Updated !</span>";
                        }
                    }
                } else { //No submitted image before used image used then its work
                    $query = "UPDATE tbl_post
                SET 
                cat='$cat',title='$title',body='$body',author='$author',tags='$tags',userid='$userid' where id='$editpostId'";
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
            $query = "select *from tbl_post where id='$editpostId'";
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
                                    <label>Category</label>
                                </td>
                                <td>
                                    <select id="select" name="cat">
                                        <option value="1">Select Category</option>
                                        <?php
                                        $query = "select *from tbl_category";
                                        $category = $db->select($query);
                                        if ($category) {
                                            while ($result = $category->fetch_assoc()) {
                                                ?>
                                                <option 
                                                <?php if ($getresult['cat'] == $result['id']) { ?>

                                                        selected="selected"  
                                                    <?php } //selected loop end ?>  value="<?php echo $result['id']; ?>"><?php echo $result['name']; ?> </option>
                                                    <?php
                                                }
                                            }  //2nd category if and while loop end
                                            ?>
                                    </select>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <label>Upload Image</label>
                                </td>
                                <td>
                                    <img src="<?php echo $getresult['image']; ?>" class="image_resize"/>

                                    <input type="file" name="image" />
                                </td>
                            </tr>
                            <tr>
                                <td style="vertical-align: top; padding-top: 9px;">
                                    <label>Content</label>
                                </td>
                                <td>
                                    <textarea class="tinymce" name="body"><?php echo $getresult['body']; ?> </textarea>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>Tags</label>
                                </td>
                                <td>
                                    <input type="text" name="tags" value="<?php echo $getresult['tags']; ?>" class="medium" />
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>Author</label>
                                </td>
                                <td>
                                    <input type="text" name="author" value="<?php echo $getresult['author']; ?>" class="medium" />
                                    <input type="hidden" name="userid" value="<?php echo(session::get('userid'));  ?>" class="medium" />
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

