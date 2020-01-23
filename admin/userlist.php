<?php include'inc/header.php'; ?>
<?php include'inc/sidebar.php'; ?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Category List</h2>
        <?php 
        if(isset($_GET['deleteuser'])){
            $deleteId=$_GET['deleteuser'];
            $query="delete from tbl_user where id='$deleteId'";
            $deletecat=$db->delete($query);
            if($deletecat){
                echo "<span class='success'>User Deleted Successfully !</span>";
            }  else {
            echo "<span class='error'>User not Delete !</span>";    
            }
        }
        ?>
        <div class="block">        
            <table class="data display datatable" id="example">
                <thead>
                    <tr>
                        <th>Serial No.</th>
                        <th> Name</th>
                        <th> User Name</th>
                        <th> Email</th>
                        <th> Details</th>
                        <th> User Role</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                   $i=0;
                    $query="SELECT *FROM tbl_user order by id desc";
                    $category=$db->select($query);
                    if($category){
                          
                        while ($result=$category->fetch_assoc()){
                          
                    $i++;
                    ?>
                    <tr class="odd gradeX">
                        <td><?php echo $i;?></td>
                        <td><?php echo $result['name'];?></td>
                        <td><?php echo $result['username'];?></td>
                        <td><?php echo $result['email'];?></td>
                        <td><?php echo $fm->textshorten($result['details'],30);?></td>
                        <td><?php 
                        if($result['role']=='1'){
                            echo 'Admin';
                        }elseif($result['role']=='2'){
                              echo 'Editor';
                        }elseif($result['role']=='3'){
                              echo 'Author';
                        }
                        
                        ?></td>
                        <td><a href="viewuser.php?viewuser=<?php echo $result['id'];?>">View</a> 
                            <?php 
                            if(session::get('userrole')=='1'){?>

                         ||<a onclick="return confirm('Are you sure to Delete')"href="?deleteuser=<?php echo $result['id'];?>">Delete</a></td>
                        <?php }  ?>
                    </tr>
                    <?php }} ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<script type="text/javascript">

    $(document).ready(function () {
        setupLeftMenu();

        $('.datatable').dataTable();
        setSidebarHeight();


    });
</script>

<?php include'inc/footer.php'; ?>


