<?php include'inc/header.php'; ?>
<?php include'inc/sidebar.php'; ?>

<?php
if (!isset($_GET['viewpost']) || $_GET['viewpost'] == NULL) {

    header("Location:postlist.php");
} else {

    $editpostId = $_GET['viewpost'];// send id hold
}
?>

<div class="grid_10">

    <div class="box round first grid">
        <h2>Update Post</h2>
        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
         echo "<script>window.location='postlist.php';</script>";
        }
        ?>
        <div class="block">    
            <?php
            $query = "select *from tbl_post where id='$editpostId' order by id desc";
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
                                    <input type="text" name="title" readonly value="<?php echo $getresult['title']; ?>" class="medium" />
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
                                    <label>Image</label>
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
                                    <input type="text" name="tags" readonly value="<?php echo $getresult['tags']; ?>" class="medium" />
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>Author</label>
                                </td>
                                <td>
                                    <input type="text" name="author" readonly value="<?php echo $getresult['author']; ?>" class="medium" />
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>
                                    <input type="submit" name="submit" Value="Seen" />
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

