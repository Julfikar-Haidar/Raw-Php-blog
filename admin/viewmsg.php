<?php include'inc/header.php'; ?>
<?php include'inc/sidebar.php'; ?>

<?php
if (!isset($_GET['msg']) || $_GET['msg'] == NULL) {

            
    echo "<script>window.location='inbox.php';</script>";
} else {

    $id = $_GET['msg'];// send id hold
}
?>
<div class="grid_10">

    <div class="box round first grid">
        <h2>View Message</h2>
        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            
    echo "<script>window.location='inbox.php';</script>";
        }
        ?>
        <div class="block">               
            <form action="" method="post" enctype="multipart/form-data">
                <table class="form">
                    <?php
                    $query="SELECT *FROM tbl_contact where id='$id'";
                    $contact=$db->select($query);
                    if($contact){
                          
                        while ($result=$contact->fetch_assoc()){
         
                    ?>

                    <tr>
                        <td>
                            <label>Name</label>
                        </td>
                        <td>
                            <input type="text"  readonly  value="<?php echo $result['f_name'].''.$result['l_name'];?>" class="medium" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Email</label>
                        </td>
                        <td>
                            <input type="text" readonly value=" <?php echo $result['email']; ?> "class="medium" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Date</label>
                        </td>
                        <td>
                            <input type="text" readonly  value="<?php echo $fm->formateDate($result['date']); ?>" class="medium" />
                        </td>
                    </tr>

                    <tr>
                        <td style="vertical-align: top; padding-top: 9px;">
                            <label>Message</label>
                        </td>
                        <td>
                            <textarea class="tinymce" >
                                <?php echo $result['body']; ?>
                            </textarea>
                        </td>
                    </tr>
                   
                    <tr>
                        <td></td>
                        <td>
                            <input type="submit" name="submit" Value="Yes" />
                        </td>
                    </tr>
                    <?php }} ?>
                </table>
            </form>
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

