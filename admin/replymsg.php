<?php include'inc/header.php'; ?>
<?php include'inc/sidebar.php'; ?>

<?php
if (!isset($_GET['repmsg']) || $_GET['repmsg'] == NULL) {

            
    echo "<script>window.location='inbox.php';</script>";
} else {

    $id = $_GET['repmsg'];// send id hold
}
?>
<div class="grid_10">

    <div class="box round first grid">
        <h2>Reply Message</h2>
        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        $to = $fm->validation($_POST['tomail']);
        $from = $fm->validation($_POST['fromemail']);
        $subject = $fm->validation($_POST['subject']);
        $message = $fm->validation($_POST['message']);
        
        $sendmail=  mail($to, $subject, $message,$from);//mail sending finction
        
        if($sendmail){
            echo "<span class='succeess'>Message send successfully..</span>";
        }  else {
            echo "<span class='error'>Message Not send ..</span>";

        }
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
                            <label>To</label>
                        </td>
                        <td>
                            <input type="text" name="tomail" readonly value=" <?php echo $result['email']; ?> "class="medium" />
                        </td>
                    </tr>
                     <tr>
                        <td>
                            <label>From</label>
                        </td>
                        <td>
                            <input type="text" name="fromemail" value="" placeholder="Enter yor Email...."class="medium" />
                        </td>
                    </tr>
                    
                    <tr>
                        <td>
                            <label>Subject</label>
                        </td>
                        <td>
                            <input type="text"  name="subject" placeholder="Enter yor subject...."class="medium" />
                        </td>
                    </tr>

                    <tr>
                        <td style="vertical-align: top; padding-top: 9px;">
                            <label>Message</label>
                        </td>
                        <td>
                            <textarea class="tinymce" name="message" >
                                
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

