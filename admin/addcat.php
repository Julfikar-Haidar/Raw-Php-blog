<?php include'inc/header.php'; ?>
<?php include'inc/sidebar.php'; ?>


<div class="grid_10">

    <div class="box round first grid">
        <h2>Add New Category</h2>
        <div class="block copyblock"> 
            <?php 
            if($_SERVER['REQUEST_METHOD']=='POST'){
                $name  =$fm->validation($_POST['name']);
                $userid=$fm->validation($_POST['userid']);
                
                $name  =  mysqli_real_escape_string($db->link,$name);
                $userid=  mysqli_real_escape_string($db->link,$userid);
                if(empty($name)){
                    echo "<span class='error'>Field must no be empty !</span>";
                }  else {
                $query="INSERT INTO  tbl_category (name,userid)VALUES('$name','$userid')";
                $categoryInsert=$db->insert($query);
                if($categoryInsert){
                    echo  "<span class='success'>Category Inserted Successfully !</span>";
                }  else {
                   echo  "<span class='error'>Category not Inserted </span>";
                }
                }
            }
            
            ?>
            <form action="addcat.php" method="post">
                <table class="form">					
                    <tr>
                        <td>
                            <input type="text" name="name" placeholder="Enter Category Name..." class="medium" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="hidden" name="userid" value="<?php echo(session::get('userid'));  ?>" class="medium" />
                        </td>
                    </tr>
                    <tr> 
                        <td>
                            <input type="submit" name="submit" Value="Save" />
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
</div>
<?php include'inc/footer.php'; ?>