<?php include'inc/header.php'; ?>
<?php include'inc/sidebar.php'; ?>
<div class="grid_10">

    <div class="box round first grid">
        <h2>Update Copyright Text</h2>
        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            
            $note=$fm->validation($_POST['note']);
           
            
            $note = mysqli_real_escape_string($db->link,$note);
        if ($note == "") {
                echo "<span class='error'>File must not be empty!..</span>";
            }  else {
                
             $query = "UPDATE  tbl_copyright
                SET 
                note='$note' where id='1'";
                    $update_row = $db->update($query);

                    if ($update_row) {
                        echo "<span class='success'>Data Updated Successfully. </span>";
                    } else {
                        echo "<span class='error'>Data Not Updated !</span>";
                    }
            }
            }
        ?>
        <?php //data show from table
        $query="select *from  tbl_copyright where id='1'";
        $copyright=$db->select($query);
        if($copyright){
            while ($result=$copyright->fetch_assoc()){
                
        ?>
        <div class="block copyblock"> 
                 <form action="" method="post" enctype="multipart/form-data">

                <table class="form">					
                    <tr>
                        <td>
                            <input type="text" value="<?php echo $result['note'];?>" name="note" class="large" />
                        </td>
                    </tr>

                    <tr> 
                        <td>
                            <input type="submit" name="submit" Value="Update" />
                        </td>
                    </tr>
                </table>
            </form>
        </div>
        <?php }}?>
    </div>
</div>
<?php include'inc/footer.php'; ?>
