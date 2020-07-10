<div class="sidebar clear">
			<div class="samesidebar clear">
				<h2>Categories</h2>
					<ul>
	<?php 
			$query = "select * from tbl_cat";
			$result = $obj->select($query);
			if ($result) {
				while ($catg = $result->fetch_assoc()) {
	 ?>
				
						<li><a href="posts.php?catagory=<?php echo $catg['id']  ?>"><?php echo $catg['name'] ;?></a></li>
							<?php }}else{
								echo " No Catagory !!";
							} ?>			
					</ul>

			</div>
			
			<div class="samesidebar clear">
				<h2>Latest articles</h2>
					<div class="popular clear">
						<h3><a href="#">Post title will be go here..</a></h3>
<?php
 $query = "SELECT * FROM tbl_post ORDER BY id DESC LIMIT 5";
 $result = $obj->select($query);
 if ($result) {
 	while ($recPost = $result->fetch_assoc()) {

 ?><li style="list-style: none;">
					<a href="post.php?id=<?php echo $recPost['id']?>"><img src="admin/<?php echo $recPost['image']?>" alt="post image"/></a>
						<p>
						<?php echo  $fm->textShorten($recPost['body'],100);?>
					</p>
			</li>


<?php } }else{
	header("location: 404.php");
} ?>

					</div>
					
					
	
			</div>
			
		</div>