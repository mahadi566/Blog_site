
<?php include'inc/header.php';?>
<?php include 'inc/slied.php';?>
<?php
if ( !isset($_GET['search']) || $_GET['search']==NULL) {
	header("location: 404.php");
} else{
	$search = $_GET['search'];
}
?>

<div class="contentsection contemplete clear">
	<div class="maincontent clear">
		<?php 
		$query = "select * from tbl_post where title LIKE '%$search%' OR body LIKE '%$search%'";
		$result = $obj->select($query);
		if ($result) {
			while ($catPost = $result->fetch_assoc()) {
				
				
				?>
				<div class="samepost clear">
					<h2><a href="post.php?id=<?php echo $catPost['id']?>"><?php echo $catPost['title']?></a></h2>
					<h4><?php echo $fm->facebook_time_ago($catPost['date']); ?>, By <a href="#"><?php echo $catPost['author']?></a></h4>
					<a href="post.php?id=<?php echo $catPost['id']?>"><img src="admin/<?php echo $catPost['image']?>" alt="post image"/></a>
					<p>
						<?php echo  $fm->textShorten($catPost['body'],200);?>
					</p>
					<div class="readmore clear">
						<a href="post.php?id=<?php echo $catPost['id']?>">Read More</a>
					</div>
				</div>
			<?php } } else{
				echo "Search not Found !!....";
			} ?>
			

		</div>
		<?php include 'inc/sliedbar.php' ?>
	</div>

	<?php include 'inc/footer.php' ?>
	
	
	<script type="text/javascript" src="js/scrolltop.js"></script>
</body>
</html>

