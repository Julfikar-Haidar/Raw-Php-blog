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
if (!isset($_GET['deleteslider']) || $_GET['deleteslider'] == NULL) {

    echo "<script>window.location='sliderlist.php';</script>";
} else {
    $deleteslider = $_GET['deleteslider']; //id hold

    $query = "select *from tbl_slider where id='$deleteslider'";
    $getdata = $db->select($query);
    if ($getdata) {
        while ($result = $getdata->fetch_assoc()) {
            $deletepath = $result['image']; //data hold on image
            unlink($deletepath); //delete from uploads and server
        }
    }
    $delquery = "delete from tbl_slider where id='$deleteslider'";
    $deletedata = $db->delete($delquery);
    if ($deletedata) {
        echo "<script> alert('Data Deleted successfully'); </script>";
        echo "<script>window.location='sliderlist.php'; </script>";
    } else {
        echo "<script> alert('Data Not deleted'); </script>";
        echo "<script>window.location='sliderlist.php'; </script>";
    }
}
?>
