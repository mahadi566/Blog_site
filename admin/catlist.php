<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php' ?>


<div class="grid_10">
	<div class="box round first grid">
		<h2>Category List</h2>
		<?php 
		if (isset($_GET['delid'])) {
			$delId = $_GET['delid'];
			if ($delId) {
				$query = "delete  from tbl_cat where id = $delId";
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
						<th>Serial No.</th>
						<th>Category Name</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php 
					$query = "select * from tbl_cat ";
					$result = $obj->select($query);
					if ($result) {
						$i=0;
						while ($catlis = $result->fetch_assoc()) {
							$i++;
							?>
							<tr class="odd gradeX">
								<td><?php echo $i; ?></td>
								<td><?php echo $catlis['name'] ?></td>
								<td><a href="editcat.php?catid=<?php echo $catlis['id'] ?>">Edit</a> || <a onclick="return confirm('Are your suer')" href="?delid=<?php echo $catlis['id'] ?>">Delete</a></td>
							</tr>
						<?php } }else{
						echo "Empty catagory list";
						} ?>
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
<?php include 'inc/footer.php'; ?>
</body>
</html>
