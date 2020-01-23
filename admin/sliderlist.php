<?php include'inc/header.php'; ?>
<?php include'inc/sidebar.php'; ?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Post List</h2>
       
        <div class="block">  
            <table class="data display datatable" id="example">
                <thead>
                    <tr>
                         <th>No</th>
                        <th >Slider Title</th>
                        <th>Image</th>
                        <th >Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php //inner join two table post && category table
                    $query="select *from tbl_slider";
                    $slider=$db->select($query);
                    if($slider){
                        $i=0;
                        while ($result=$slider->fetch_assoc()){
                        $i++;
                    ?>
                    <tr class="odd gradeX">
                        <td><?php echo $i ;?></td>
                        <td><?php echo $result['title'] ;?></td>
                        <td class="center"><img src="<?php echo$result['image'] ;?>" height="50px" width="60px"</td>
                        <td>
                         <?php
                         if(session::get('userrole')=='1'){ ?>
                         
                            <a href="editslider.php?sliderid=<?php echo $result['id']; ?>">Edit</a> ||
                            <a onclick="return confirm('Are you sure to Delete')" href="deleteslider.php?deleteslider=<?php echo $result['id']; ?>">Delete</a></td>
                            
                         <?php }?>
                    </tr>
                   
                 <?php }}////end if and while loop ?>
                  
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
