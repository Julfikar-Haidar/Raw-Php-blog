<?php include'inc/header.php'; ?>
<?php include'inc/sidebar.php'; ?>
<?php 
$userrole=session::get('userrole');
$userid=session::get('userid');
?>

<div class="grid_10">

    <div class="box round first grid">
        <h2>Update Post</h2>
        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $fullName = mysqli_real_escape_string($db->link, $_POST['name']);
            $username = mysqli_real_escape_string($db->link, $_POST['username']);
            $email    = mysqli_real_escape_string($db->link, $_POST['email']);
            $details  = mysqli_real_escape_string($db->link, $_POST['details']);
            
            $query = "UPDATE tbl_user
            SET 
            name='$fullName',username='$username',email='$email',details='$details' where id='$userid'";
            $update_row = $db->update($query);

            if ($update_row) {
                echo "<span class='success'>Data Updated Successfully. </span>";
            }else {
                echo "<span class='error'>Data Not Updated !</span>";
            }
        }
            
        
        ?>
        <div class="block">    
            <?php
            $query = "select *from tbl_user where id='$userid' AND role='$userrole'";
            $getpost = $db->select($query);
            if ($getpost) {
                while ($getresult = $getpost->fetch_assoc()) {
                    ?>

                    <form action="" method="post" enctype="multipart/form-data">
                        <table class="form">

                            <tr>
                                <td>
                                    <label>Name</label>
                                </td>
                                <td>
                                    <input type="text" name="name" value="<?php echo $getresult['name']; ?>" class="medium" />
                                </td>
                            </tr>
                              <tr>
                                <td>
                                    <label>User Name</label>
                                </td>
                                <td>
                                    <input type="text" name="username" value="<?php echo $getresult['username']; ?>" class="medium" />
                                </td>
                            </tr>
                              <tr>
                                <td>
                                    <label>User Email</label>
                                </td>
                                <td>
                                    <input type="text" name="email" value="<?php echo $getresult['email']; ?>" class="medium" />
                                </td>
                            </tr>

                            <tr>
                                <td style="vertical-align: top; padding-top: 9px;">
                                    <label>User Details</label>
                                </td>
                                <td>
                                    <textarea class="tinymce" name="details"><?php echo $getresult['details']; ?> </textarea>
                                </td>
                            </tr>
                             <tr>
                                <td></td>
                                <td>
                                    <input type="submit" name="submit" Value="Update" />
                                </td>
                            </tr>
                          
                        </table>
                    </form>
                <?php }} // first if and while loop end?> 

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

