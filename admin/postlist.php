<?php include'inc/header.php'; ?>
<?php include'inc/sidebar.php'; ?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Post List</h2>
       
        <div class="block">  
            <table class="data display datatable" id="example">
                <thead>
                    <tr>
                         <th width="5%">No</th>
                        <th width="15%">Post Title</th>
                        <th width="15%">Description</th>
                        <th width="10%">Category</th>
                        <th width="10%">Image</th>
                        <th width="10%">Tag</th>
                        <th width="10%">Author</th>
                        <th width="10%">Date</th>
                        <th width="15%">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php //inner join two table post && category table
                    $query="select tbl_post.*,tbl_category.name from tbl_post INNER JOIN tbl_category ON 
                            tbl_post.cat=tbl_category.id order by tbl_post.id DESC";
                    $post=$db->select($query);
                    if($post){
                        $i=0;
                        while ($result=$post->fetch_assoc()){
                        $i++;
                    ?>
                    <tr class="odd gradeX">
                        <td><?php echo $i ;?></td>
                        <td><?php echo $result['title'] ;?></td>
                        <td><?php echo $fm->textshorten($result['body'],50) ;?></td>
                        <td class="center"><?php echo$result['name'] ;?></td>
                        <td class="center"><img src="<?php echo$result['image'] ;?>" height="50px" width="60px"</td>
                        <td class="center"><?php echo$result['tags'] ;?></td>
                        <td class="center"><?php echo$result['author'] ;?></td>
                        <td class="center"><?php echo $fm->formateDate($result['date']) ;?></td>
                        <td>
                            <a href="viewpost.php?viewpost=<?php echo $result['id']; ?>">View</a> 
                         <?php
                         if(session::get('userid')==$result['userid']||session::get('userrole')=='1'){ ?>
                         
                           || <a href="editpost.php?editpost=<?php echo $result['id']; ?>">Edit</a> ||
                            <a onclick="return confirm('Are you sure to Delete')" href="deletepost.php?deletepost=<?php echo $result['id']; ?>">Delete</a></td>
                            
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
