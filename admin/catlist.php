<?php include'inc/header.php'; ?>
<?php include'inc/sidebar.php'; ?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Category List</h2>
        <?php 
        if(isset($_GET['deletecat'])){
            $deleteId=$_GET['deletecat'];
            $query="delete from tbl_category where id='$deleteId'";
            $deletecat=$db->delete($query);
            if($deletecat){
                echo "<span class='success'>Category Deleted Successfully !</span>";
            }  else {
            echo "<span class='error'>Category not Delete !</span>";    
            }
        }
        ?>
        <div class="block">        
            <table class="data display datatable" id="example">
                <thead>
                    <tr>
                        <th>Serial No.</th>
                        <th>Category Name</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                   $i=0;
                    $query="SELECT *FROM tbl_category order by id desc";
                    $category=$db->select($query);
                    if($category){
                          
                        while ($result=$category->fetch_assoc()){
                          
                    $i++;
                    ?>
                    <tr class="odd gradeX">
                        <td><?php echo $i;?></td>
                        <td><?php echo $result['name'];?></td>
                        <td>
                            <a href="editcat.php?editcat=<?php echo $result['id'];?>">View</a> 
                         <?php if(session::get('userid')==$result['userid']||session::get('userrole')=='2'||session::get('userrole')=='1'){ ?>

                            ||<a href="editcat.php?editcat=<?php echo $result['id'];?>">Edit</a> 
                            || <a onclick="return confirm('Are you sure to Delete')"href="?deletecat=<?php echo $result['id'];?>">Delete</a>
                        <?php }  ?>
                        </td>
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


