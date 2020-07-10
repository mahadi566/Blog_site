<?php include 'inc/header.php' ?>
<?php include 'inc/sidebar.php' ?>


<div class="grid_10">
	<div class="box round first grid">
		<h2>Post List</h2>
		<?php 
		if (isset($_GET['deeltid'])) {
			$delId = $_GET['deeltid'];
			if ($delId) {
				$query = "delete  from tbl_user where id = $delId";
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
						<th width="15%">Name</th>
						<th width="20%">User Name</th>
						<th width="10%">Email</th>
						<th width="10%">Detelis</th>
						<th width="10%">role</th>
						<th width="10%">Photo</th>
						<th width="10%">Action</th>
					</tr>
				</thead>
				<tbody>
					<?php 
					$query = "select * from tbl_user order by id desc";
					$result = $obj->select($query);

					if ($result) {
						$i=0;
						while ($postlis = $result->fetch_assoc()) {
							$i++;

							?>
							<tr class="odd gradeX">
								<td><?php echo $i ;?></td>
								<td><?php echo $postlis['man_name'] ?></td>
								<td><?php echo $postlis['name'] ?></td>
								<td><?php echo $postlis['email'] ?></td>
								<td><?php echo $fm->textShorten($postlis['detals'],30) ?></td>
								<td>
									<?php
									   if ($postlis['role'] == 0 ) {
									   	echo "admin";
									   }elseif ( $postlis['role'] ==1 ) {
									   	echo "authord";
									   }elseif ($postlis['role'] == 2) {
									   	echo "editor";
									   }
									 ?>
									
								</td>
								<td><img src="<?php echo $postlis['image'] ?>" alt="" style="width: 60px;height: 60px;"></td>
								

								<td><a href="userview.php?viewid=<?php echo $postlis['id'] ?>">view</a>

									<?php 
										if (Session::get('Userrole') == '0') {?>
										|| <a onclick="return confirm('are you sure')" href="?deeltid=<?php echo $postlis['id'] ?>">Delete</a>
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
