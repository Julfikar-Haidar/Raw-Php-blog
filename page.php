<?php include'inc/header.php'; ?>
<?php
   $page = mysqli_real_escape_string($db->link, $_GET['page']);//security

if (!isset($page) || $page == NULL) {

    header("Location:404.php");
} else {

    $pageId = $page; // send id hold
}
?>
  <?php
//data show from table on id
            $query = "select *from  tbl_page where id='$pageId'";
            $pageshow = $db->select($query);
            if ($pageshow) {
                while ($result = $pageshow->fetch_assoc()) {
                    ?> 

<div class="contentsection contemplete clear">
    <div class="maincontent clear">
        <div class="about">
           
                    <h2><?php echo $result['name']; ?></h2>
                    <?php echo $result['body']; ?>
            
                </div>
            </div>
<?php }}  else {
    header("Location:404.php");
} ?>
            <?php include'inc/sidebar.php'; ?>
            <?php include'inc/footer.php'; ?>
	
