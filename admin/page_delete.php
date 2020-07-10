<?php include'../lib/session.php';
  Session::checklogin();
?>
<?php include'../config/config.php';?>
<?php include'../lib/Database.php';?>

<?php 
   $obj = new Database;
?>




<?php if (!isset($_GET['delpage']) || $_GET['delpage']==NULL) {
  header("location:index.php");
}else{
 $pageid= $_GET['delpage'];
 $delquery= "delete from tbl_page where id = $pageid";
 $delDAta =$obj->delete($delquery);
 if ($delDAta) {
 	echo "<script>alert('page delet successfull');</script>";
 	echo "<script>window.location='index.php';</script>";

 }else{
 	echo "<script>alert('page delet successfull');</script>";
 	echo "<script>window.location='index.php;</script>";
 }

}
?>