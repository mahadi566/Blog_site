<?php include 'inc/header.php' ?>
<?php include 'inc/sidebar.php' ?>


<div class="grid_10">
	<div class="box round first grid">
		<h2>Post List</h2>
		<?php 
		if (isset($_GET['deeltid'])) {
			$delId = $_GET['deeltid'];
			if ($delId) {
				$query = "delete  from tbl_post where id = $delId";
				$result = $obj->delete($query);
				if ($result) {

					echo "Delete Success...";
				}else{
					echo "Delete Not Success...";
				}
			}
		}
		?>
		<div class="block">  
			<table class="data display datatable" id="example">
				<thead>
					<tr>
						<th width="5%">No</th>
						<th width="15%">Post Title</th>
						<th width="20%">Description</th>
						<th width="10%">Category</th>
						<th width="10%">Image</th>
						<th width="10%">Author</th>
						<th width="10%">Tags</th>
						<th width="10%">Date</th>
						<th width="10%">Action</th>
					</tr>
				</thead>
				<tbody>
					<?php 
					$query = "SELECT tbl_post.*,tbl_cat.name FROM tbl_post
					INNER JOIN tbl_cat
					ON tbl_post.cat = tbl_cat.id 
					ORDER BY tbl_post.title DESC";

					$result = $obj->select($query);
					if ($result) {
						$i=0;
						while ($postlis = $result->fetch_assoc()) {
							$i++;

							?>
							<tr class="odd gradeX">
								<td><?php echo $i ;?></td>
								<td><?php echo $postlis['title'] ?></td>
								<td><?php echo $fm->textShorten($postlis['body'],50) ?></td>
								<td><?php echo $postlis['name'] ?></td>
								<td><img src="<?php echo $postlis['image'] ?>" alt="" style="width: 60px;height: 60px;"></td>
								<td><?php echo $postlis['author'] ?></td>
								<td><?php echo $postlis['tage'] ?></td>
								<td><?php echo $postlis['date'] ?></td>

								<td>
									<a href="viewpst.php?viewid=<?php echo $postlis['id'] ?>">view</a>

						<?php 
							if (Session::get('UserId') == $postlis['userId'] || Session::get('Userrole') == '0') {?>||
									<a href="postedt.php?editid=<?php echo $postlis['id'] ?>"> Edit</a> || <a onclick="return confirm('are you sure')" href="?deeltid=<?php echo $postlis['id'] ?>">Delete</a>
						<?php	}
						 ?>
									
								</td>
							</tr>
						<?php } } ?>	
					</tbody>
				</table>

			</div>
		</div>
	</div>
	<div class="clear">
	</div>
</div>
<div class="clear">
</div>
<script type="text/javascript">
	$(document).ready(function () {
		setupLeftMenu();
		$('.datatable').dataTable();
		setSidebarHeight();
	});
</script>
<?php include 'inc/footer.php' ?>

</body>
</html>
