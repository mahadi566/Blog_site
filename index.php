
<?php include'inc/header.php';?>
<?php include 'inc/slied.php';?>


<div class="contentsection contemplete clear">
	<div class="maincontent clear">
		<!-- pagination -->
		<?php
		$per_page= 3;
		if (isset($_GET["page"])) {
			$page = $_GET["page"];
		}else{
			$page = 1;
		}
		$start_for = ($page-1) * $per_page;
		?>
		<!-- pagination -->

		<?php
		$query = "SELECT * FROM tbl_post limit $start_for,$per_page";
		$result = $obj->select($query);
		if ($result) {
			while ($post= $result->fetch_assoc()) {
				
				
				?>



				<div class="samepost clear">
					<h2><a href="post.php?id=<?php echo $post['id']?>"><?php echo $post['title']?></a></h2>
					<h4><?php echo $fm->facebook_time_ago($post['date']); ?>, By <a href="#"><?php echo $post['author']?></a></h4>
					<a href="post.php?id=<?php echo $post['id']?>"><img src="admin/<?php echo $post['image']?>" alt="post image"/></a>
					<p>
						<?php echo  $fm->textShorten($post['body'],200);?>
					</p>
					<div class="readmore clear">
						<a href="post.php?id=<?php echo $post['id']?>">Read More</a>
					</div>
				</div>
				<?php }?> <!-- end while loop -->
				<!-- pagination -->
				<?php
				$query = "SELECT * FROM tbl_post";
				$result = $obj->select($query);
				$totle_rows = mysqli_num_rows($result);
				$totle_pages = ceil($totle_rows/$per_page);

				echo "<span class='paginaton'><a href='index.php?page=1'>".'First Page'."</a>";
				for ($i=1; $i <= $totle_pages ; $i++) { 
					echo "<a href='index.php?page=".$i."'>".$i."</a>";
				};
				echo"<a href='index.php?page=$totle_pages'>".'last page'."</a></span>"
				?>
				<!-- pagination -->

			<?php }else{
				header("location:404.php");
			}?>
			

		</div>
		<?php include 'inc/sliedbar.php' ?>
	</div>

	<?php include 'inc/footer.php' ?>
	
	
	<script type="text/javascript" src="js/scrolltop.js"></script>
</body>
</html>

