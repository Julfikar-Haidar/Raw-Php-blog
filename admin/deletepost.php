<?php

include'../lib/session.php';
session::checksession();
?>
<?php include'../config/config.php'; ?>
<?php include'../lib/Database.php'; ?>
<?php include'../helpers/format.php'; ?>

<?php

$db = new Database();
?>


<?php

//delete post process
if (!isset($_GET['deletepost']) || $_GET['deletepost'] == NULL) {

    echo "<script>window.location='postlist.php';</script>";
} else {
    $deletepost = $_GET['deletepost']; //id hold

    $query = "select *from tbl_post where id='$deletepost'";
    $getdata = $db->select($query);
    if ($getdata) {
        while ($result = $getdata->fetch_assoc()) {
            $deletepath = $result['image']; //data hold on image
            unlink($deletepath); //delete from uploads and server
        }
    }
    $delquery = "delete from tbl_post where id='$deletepost'";
    $deletedata = $db->delete($delquery);
    if ($deletedata) {
        echo "<script> alert('Data Deleted successfully'); </script>";
        echo "<script>window.location='postlist.php'; </script>";
    } else {
        echo "<script> alert('Data Not deleted'); </script>";
        echo "<script>window.location='postlist.php'; </script>";
    }
}
?>
