<?php include'inc/header.php'; ?>
<?php include'inc/sidebar.php'; ?>
<?php
        if (!isset($_GET['viewuser'])&&$_GET['viewuser']==NULL) {
          echo "<script>window.location='userlist.php';</script>";       
        }  else {
               $viewuser=$_GET['viewuser'];
        }
            
        
        ?>
<div class="grid_10">

    <div class="box round first grid">
        <h2>View User</h2>
        <?php
        if ($_SERVER['REQUEST_METHOD']=='POST') {
            echo "<script>window.location='userlist.php';</script>";
        }
        
        ?>
        <div class="block">    
            <?php
            $query = "select *from tbl_user where id='$viewuser'";
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
                                    <input type="text" name="name" readonly value="<?php echo $getresult['name']; ?>" class="medium" />
                                </td>
                            </tr>
                              <tr>
                                <td>
                                    <label>User Name</label>
                                </td>
                                <td>
                                    <input type="text" name="username" readonly value="<?php echo $getresult['username']; ?>" class="medium" />
                                </td>
                            </tr>
                              <tr>
                                <td>
                                    <label>User Email</label>
                                </td>
                                <td>
                                    <input type="text" name="email" readonly value="<?php echo $getresult['email']; ?>" class="medium" />
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
                                    <input type="submit" name="submit" Value="Ok" />
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

