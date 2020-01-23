<?php include'inc/header.php'; ?>
<?php include'inc/sidebar.php'; ?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Inbox</h2>
        <?php 
        if(isset($_GET['seenmsg'])){
            $seenid=$_GET['seenmsg'];
             $query = "UPDATE tbl_contact
                            SET 
                            status='1' where id='$seenid'";
                    $msgseen = $db->update($query);
                    if ($msgseen) {
                        echo "<span class='success'>Message Seen Successfully !</span>";
                    } else {
                        echo "<span class='error'>Message not Seen </span>";
                    }
        }
   
        ?>
        <div class="block">        
            <table class="data display datatable" id="example">
                <thead>
                    <tr>
                        <th>Serial No.</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Message</th>
                        <th>Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                   $i=0;
                    $query="SELECT *FROM tbl_contact where status='0' order by id desc";
                    $contact=$db->select($query);
                    if($contact){
                          
                        while ($result=$contact->fetch_assoc()){
                          
                    $i++;
                    ?>
                    <tr class="odd gradeX">
                        <td><?php echo $i; ?></td>
                        <td><?php echo $result['f_name'].' '.$result['l_name']; ?></td>
                        <td><?php echo $result['email']; ?></td>
                        <td><?php echo $fm->textshorten($result['body'],50); ?></td>
                        <td><?php echo $fm->formateDate($result['date']); ?></td>
                        <td>
                            <a href="viewmsg.php?msg=<?php echo $result['id']; ?>">View</a> ||
                            <a href="replymsg.php?repmsg=<?php echo $result['id']; ?>">Reply</a>||
                            <a onclick="return confirm('Are you sure to Move Seen Box')" href="?seenmsg=<?php echo $result['id']; ?>">Seen</a>
                        </td>
                    </tr>
                    <?php }} ?>
                 
                </tbody>
            </table>
        </div>
    </div>
    
    
    
     <div class="box round first grid">
        <h2>Seen Message</h2>
        
    <?php 
//delete post process
        if(isset($_GET['delid'])){
          
             $deletepmsg=$_GET['delid'];//id hold
             
             $delquery="delete from  tbl_contact where id='$deletepmsg'";
             $deletedata=$db->delete($delquery);
             if($deletedata){
                echo "<span class='success'>Message Delete Successfully...!</span>";
             }else {
              
                echo "<span class='error'>Message Not Delete  !</span>";
             }
        }
        //Message unseen part and move inbox table
          if(isset($_GET['unseen'])){
            $unseen=$_GET['unseen'];
             $query = "UPDATE tbl_contact
                            SET 
                            status='0' where id='$unseen'";
                    $msgunseen = $db->update($query);
                    if ($msgunseen) {
                        echo "<span class='success'>Message Move Successfully Inbox Table !</span>";
                    } else {
                        echo "<span class='error'>Message not Move </span>";
                    }
        }
        
        //Draft Box send
         if(isset($_GET['draft'])){
            $draft=$_GET['draft'];
             $query = "UPDATE tbl_contact
                            SET 
                            status='2' where id='$draft'";
                    $draftbox = $db->update($query);
                    if ($draftbox) {
                        echo "<span class='success'>Message Received DraftBox...</span>";
                    } else {
                        echo "<span class='error'>Message not Received DraftBox  </span>";
                    }
        }
        ?>
        <div class="block">        
            <table class="data display datatable" id="example">
                <thead>
                    <tr>
                        <th>Serial No.</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Message</th>
                        <th>Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                   $i=0;
                    $query="SELECT *FROM tbl_contact where status='1' order by id desc";
                    $contact=$db->select($query);
                    if($contact){
                          
                        while ($result=$contact->fetch_assoc()){
                          
                    $i++;
                    ?>
                    <tr class="odd gradeX">
                        <td><?php echo $i; ?></td>
                        <td><?php echo $result['f_name'].''.$result['l_name']; ?></td>
                        <td><?php echo $result['email']; ?></td>
                        <td><?php echo $fm->textshorten($result['body'],50); ?></td>
                        <td><?php echo $fm->formateDate($result['date']); ?></td>
                        <td>
                            <a onclick="return confirm('Are you sure to delete');" href="?delid=<?php echo $result['id']; ?>">Delete</a>||
                            <a onclick="return confirm('Are you sure to Move Inbox Again ');" href="?unseen=<?php echo $result['id']; ?>">Unseen</a>||
                            <a onclick="return confirm('Are you sure to Move Draft Box ');" href="?draft=<?php echo $result['id']; ?>">Draft</a>
                            
                        </td>
                    </tr>
                    <?php }} ?>
                 
                </tbody>
            </table>
        </div>
    </div>
    
    
    
    <div class="box round first grid">
        <h2>Draft Message</h2>
        
    <?php 
//delete post process
        if(isset($_GET['delid'])){
          
             $deletepmsg=$_GET['delid'];//id hold
             
             $delquery="delete from  tbl_contact where id='$deletepmsg'";
             $deletedata=$db->delete($delquery);
             if($deletedata){
                echo "<span class='success'>Message Delete Successfully...!</span>";
             }else {
              
                echo "<span class='error'>Message Not Delete  !</span>";
             }
        }
        //Message un seen part and move inbox table
          if(isset($_GET['unseen'])){
            $unseen=$_GET['unseen'];
             $query = "UPDATE tbl_contact
                            SET 
                            status='0' where id='$unseen'";
                    $msgunseen = $db->update($query);
                    if ($msgunseen) {
                        echo "<span class='success'>Message Move Successfully Inbox Table !</span>";
                    } else {
                        echo "<span class='error'>Message not Move </span>";
                    }
        }
        ?>
        <div class="block">        
            <table class="data display datatable" id="example">
                <thead>
                    <tr>
                        <th>Serial No.</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Message</th>
                        <th>Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                   $i=0;
                    $query="SELECT *FROM tbl_contact where status='2' order by id desc";
                    $contact=$db->select($query);
                    if($contact){
                          
                        while ($result=$contact->fetch_assoc()){
                          
                    $i++;
                    ?>
                    <tr class="odd gradeX">
                        <td><?php echo $i; ?></td>
                        <td><?php echo $result['f_name'].''.$result['l_name']; ?></td>
                        <td><?php echo $result['email']; ?></td>
                        <td><?php echo $fm->textshorten($result['body'],50); ?></td>
                        <td><?php echo $fm->formateDate($result['date']); ?></td>
                        <td>
                            <a onclick="return confirm('Are you sure to delete');" href="?delid=<?php echo $result['id']; ?>">Delete</a>||
                            <a onclick="return confirm('Are you sure to Move Inbox Again ');" href="?unseen=<?php echo $result['id']; ?>">Unseen</a>
                            
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
