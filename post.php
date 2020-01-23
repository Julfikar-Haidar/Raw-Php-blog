<?php include'inc/header.php'; ?>

<?php
 $postshow = mysqli_real_escape_string($db->link, $_GET['id']);

if (!isset($postshow) || $postshow == NULL) {
    header("Location:404.php");
} else {
    $id = $postshow;
}
?>
<div class="contentsection contemplete clear">
    <div class="maincontent clear">
        <div class="about">
            <?php
            $query = "select * from tbl_post where id='$id'";
            $post = $db->select($query);
            if ($post) {
                while ($result = $post->fetch_assoc()) {
                    ?>
                    <h2><?php echo $result['title']; ?></h2>
                    <h4><?php echo $fm->formateDate($result['date']); ?> <a href="post.php?id=<?php echo $result['id']; ?>"><?php echo $result['author']; ?></a></h4>
                    <img src="admin/<?php echo $result['image']; ?>" alt="MyImage"/>
                    <?php echo $result['body']; ?>


                    <div class="relatedpost clear">
                        <h2>Related articles</h2>
                        <?php
                        $catid = $result['cat'];
                        $queryrelated = "select * from tbl_post where cat='$catid' order by rand()limit 4";
                        $relatedpost = $db->select($queryrelated);
                        if ($relatedpost) {
                            while ($result = $relatedpost->fetch_assoc()) {
                                ?>
                                <a href="post.php?id=<?php echo $result['id']; ?>"><img src="admin/<?php echo $result['image']; ?>" alt="post image"/></a>
                            <?php
                            }
                        } else {
                            echo "No Related Post found!!";
                        }
                        ?>
                    </div>
                <?php
                }
            } else {
                header("Location:404.php");
            }
            ?>
        </div>

    </div>

<?php include'inc/sidebar.php'; ?>
<?php include'inc/footer.php'; ?>