<?php include'inc/header.php'; ?>
<?php include'inc/sidebar.php'; ?>

<?php 
if(!isset($_GET['editcat'])|| $_GET['editcat']==NULL){
    header("Location:catlist.php");
}  else {
    
     $categoryid=$_GET['editcat'];//id recived from editcat
}
?>


<div class="grid_10">

    <div class="box round first grid">
        <h2>Update Category</h2>
        <div class="block copyblock"> 
            <?php
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $name  = $fm->validation($_POST['name']);
                $userid=$fm->validation($_POST['userid']);

                $name  = mysqli_real_escape_string($db->link, $name);
                $userid=  mysqli_real_escape_string($db->link,$userid);

                if (empty($name)) {
                    echo "<span class='error'>Field must no be empty !</span>";
                } else {
                    $query = "UPDATE tbl_category
                            SET 
                            name='$name',userid='$userid' where id='$categoryid'";
                    $updatecategory = $db->update($query);
                    if ($updatecategory) {
                        echo "<span class='success'>Category Updated Successfully !</span>";
                    } else {
                        echo "<span class='error'>Category not Updated </span>";
                    }
                }
               
            }
            ?>
            
            <?php 
            $query="SELECT *FROM  tbl_category WHERE id='$categoryid' order by id desc";
            $category=$db->select($query);
            $result=$category->fetch_assoc();
            
            ?>
            <form action="" method="post">
                <table class="form">					
                    <tr>
                        <td>
                            <input type="text" name="name" value="<?php echo $result['name'];?>" class="medium" />
                        </td>
                    </tr>
                     <tr>
                        <td>
                            <input type="hidden" name="userid" value="<?php echo(session::get('userid'));  ?>" class="medium" />
                        </td>
                    </tr>
                    <tr> 
                        <td>
                            <?php if(session::get('userrole')=='1'||session::get('userrole')=='2'){?>
                            <input type="submit" name="submit" Value="Update" />
                            <?php }?>
                        </td>
                    </tr>
                </table>
            </form>
            
        </div>
    </div>
</div>
<?php include'inc/footer.php'; ?>