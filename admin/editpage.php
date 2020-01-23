<?php include'inc/header.php'; ?>
<?php include'inc/sidebar.php'; ?>

<?php
if (!isset($_GET['pageid']) || $_GET['pageid'] == NULL) {

    header("Location:index.php");
} else {

    $pageId = $_GET['pageid'];// send id hold
}
?>
<div class="grid_10">

    <div class="box round first grid">
        <h2>Edit Page</h2>
        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name   = mysqli_real_escape_string($db->link, $_POST['name']);
            $body   = mysqli_real_escape_string($db->link, $_POST['body']);
            $userid = mysqli_real_escape_string($db->link, $_POST['userid']);

     
            if ($name == ""|| $body == "" ) {
                echo "<span class='error'>File must not be empty!..</span>";
            }  else {
                 $query = "UPDATE  tbl_page
                SET 
                name='$name',body='$body',userid='$userid' where id='$pageId'";
                    $update_row = $db->update($query);
                $inserted_rows = $db->insert($query);
              
                if ($inserted_rows) {
                    echo "<span class='success'>Update Page Successfully. </span>";
                } else {
                    echo "<span class='error'>Page Not Updated !</span>";
                }
            }
        }
        ?>
        <div class="block">   
 <?php //data show from table on id
        $query="select *from  tbl_page where id='$pageId'";
        $pageshow=$db->select($query);
        if($pageshow){
            while ($result=$pageshow->fetch_assoc()){
                
        ?>            
            <form action="" method="post" enctype="multipart/form-data">
                <table class="form">

                    <tr>
                        <td>
                            <label>Name</label>
                        </td>
                        <td>
                            <input type="text" name="name" value="<?php echo $result['name']; ?>" class="medium" />
                        </td>
                    </tr>

                    <tr>
                        <td style="vertical-align: top; padding-top: 9px;">
                            <label>Content</label>
                        </td>
                        <td>
                            <textarea class="tinymce"  name="body">
                                <?php echo $result['body']; ?>
                            </textarea>
                        </td>
                    </tr>
                     <tr>
                       
                        <td>
                            <input type="hidden" name="userid" value="<?php echo(session::get('userid')); ?>" class="medium" />
                        </td>
                    </tr>
                   
                    <tr>
                        <td></td>
                        <td>
                             <?php
                         if(session::get('userid')==$result['userid']||session::get('userrole')=='1'){ ?>
                            <input type="submit" name="submit" Value="Update" />
                            <span class="del_page"><a onclick="return confirm('Are you sure to Delete this page')" href="deletepage.php?del_page=<?php echo $result['id'];?>">Delete</a></span>
                         <?php }?>
                        </td>
                    </tr>
                </table>
            </form>
        <?php }} ?>
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

