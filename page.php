<?php include'inc/header.php';?>
<?php if (!isset($_GET['pageid']) || $_GET['pageid']==NULL) {
  header("location:404.php");
}else{
 $pageid= $_GET['pageid'];
}
?>
	<div class="contentsection contemplete clear">
		<div class="maincontent clear">
			<div class="about">
	 <?php 
   $query = "select * from tbl_page where id = $pageid ";
   $pages  = $obj->select($query);
   if ( $pages) {
    while ($getpage = $pages->fetch_assoc()) {



      ?> 
				<h2><?php echo $getpage['name']; ?> </h2>
	
				<p><?php echo $getpage['body']; ?></p>

	<?php } }else{
		header('location:404.php');
	} ?>

		</div>
		
			
			
	</div>
<?php include 'inc/sliedbar.php' ?>
	<?php include'inc/footer.php';?>
</body>
</html>