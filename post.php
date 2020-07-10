<?php include 'inc/header.php' ?>
<?php
if (!isset($_GET['id']) || $_GET['id']==NULL){
	header("location: 404.php");
}else{
	$id = $_GET['id'];
}
?>
<div class="contentsection contemplete clear">
	<div class="maincontent clear">
		<div class="about">
			<?php	
			$query = "SELECT * FROM tbl_post where id =' $id'";
			$result = $obj-> select($query);
			if ($result) {
				while ($idpost = $result->fetch_assoc()) {

					?>
					<h2><?php echo $idpost['title']?></h2>
					<h4><?php echo $fm->facebook_time_ago($idpost['date']); ?>, By<?php echo $idpost['author']?></h4>
					<img src="admin/<?php echo $idpost['image']?>" alt="idpost image"/>
					<p>
						<?php echo $idpost['body'];?>
					</p>
						<!-- endwhile loop -->	

					<div class="relatedpost clear">
						<h2>Related articles</h2>
						<?php 
						$catid = $idpost['cat'];
						$query = "select * from tbl_post where cat = '$catid' order by rand()  limit  6";
						$result = $obj->select($query);
						if ($result) {
							while ($relPost = $result->fetch_assoc()) {

								?>			
								<a href="post.php?id=<?php echo $relPost['id']?>"><img src="admin/<?php echo $relPost['image']?>" alt="idpost image"/></a>
							<?php } } else{
								echo "No relative Post evilable !!";
							} ?>
						</div>

					<?php } }else{
						header("location: 404.php");
					} ?>

				</div>

			</div>
			<?php include 'inc/sliedbar.php' ?>
		</div>

		<?php include'inc/footer.php';?>
	</body>
	</html>