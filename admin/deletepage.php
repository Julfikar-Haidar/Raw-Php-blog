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
        if(!isset($_GET['del_page'])||$_GET['del_page']==NULL){
          
            echo "<script>window.location='index.php';</script>";
        }else{
             $deletepage=$_GET['del_page'];//id hold
             
             $delquery="delete from  tbl_page where id='$deletepage'";
             $deletedata=$db->delete($delquery);
             if($deletedata){
                echo "<script> alert('Page Deleted successfully'); </script>";
                echo "<script>window.location='index.php'; </script>";
             }  else {
                echo "<script> alert('Page Not deleted'); </script>";
                
                echo "<script>window.location='index.php'; </script>";

             }
        }
        ?>
