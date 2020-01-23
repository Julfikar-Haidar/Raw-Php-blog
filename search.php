<?php include'inc/header.php'; ?>



<?php
 $search = mysqli_real_escape_string($db->link, $_GET['search']);

if (!isset($search) || $search == NULL) {
    header("Location:404.php");
} else {
    $search = $search;
}
?>
<div class="contentsection contemplete clear">
    <div class="maincontent clear">
        <?php
        $query = "SELECT * FROM tbl_post WHERE title LIKE '%$search%' or body LIKE '%$search%' or author LIKE '%$search'";
        $post = $db->select($query);
        if ($post) {
            while ($result = $post->fetch_assoc()) {
                ?>

                <div class="samepost clear">
                    <h2><a href="post.php?id=<?php echo $result['id']; ?>"><?php echo $result['title']; ?></a></h2>
                    <h4><?php echo $fm->formateDate($result['date']); ?> <a href="post.php?id=<?php echo $result['id']; ?>"><?php echo $result['author']; ?></a></h4>
                    <a href="#"><img src="admin/<?php echo $result['image']; ?>" alt="post image"/></a>
                    <?php echo $fm->textshorten($result['body']); ?>
                    <div class="readmore clear">
                        <a href="post.php?id=<?php echo $result['id']; ?>">Read More</a>
                    </div>
                </div>


                <?php
            }
        } else {
            ?>
        <p class="searchresult">No Search Result Found !!</p>

        <?php } ?>

    </div>


    <?php include'inc/sidebar.php'; ?>
    <?php include'inc/footer.php'; ?>