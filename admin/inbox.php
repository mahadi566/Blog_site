<?php include 'inc/header.php' ?>
<?php include 'inc/sidebar.php' ?>

<div class="grid_10">

	<div class="box round first grid">
		<h2> Inbox</h2>
		<div class="block">  
			<?php if (isset($_GET['seenid'])) {
				$seenid = $_GET['seenid'];
				$mess= "UPDATE tbl_contact 
				SET
				status='1'
				WHERE id = $seenid";
				$so_update = $obj->update($mess);
				if ($so_update) {
					echo "Message Seen Success";
					
				}else{
					echo "Message Seen Felid";
				}
			} ?> 
			<table class="data display datatable" id="example" style="text-align: left;">
				<thead>
					<tr>
						<th width="5%">Serial No.</th>
						<th width="15%">Name</th>
						<th width="15%">Email</th>
						<th width="35%">Message</th>
						<th width="15%">date</th>
						<th width="15%" style="text-align: center;">Action</th>
					</tr>
				</thead>
				<tbody>
					<?php 
					$query = "select * from tbl_contact where status='0' order by id desc";
					$result = $obj->select($query);
					if ($result) {
						$i=0;
						while ($sendMess = $result->fetch_assoc()) {
							$i++;

							?>
							<tr class="odd gradeX" >
								<td><?php echo $i; ?></td>
								<td><?php echo $sendMess['fname'] .' '. $sendMess['lname'] ;?></td>
								<td><?php echo $sendMess['email']; ?></td>
								<td><?php echo $fm->textShorten($sendMess['message'],115); ?></td>
								<td><?php echo $fm->messdate($sendMess['date']); ?></td>
								<td style="text-align: center;">
									<a href="view.php?viewid= <?php echo $sendMess['id']; ?>">view</a>   
									<a style="margin-left: 5px;margin-right: 5px; " href="reply.php?replyid= <?php echo $sendMess['id']; ?>">reply</a>  
									<a onclick="return confirm('are your sure move by seen box')" href="?seenid= <?php echo $sendMess['id']; ?>">seen</a>   
								</td>
							</tr>
						<?php } } ?>	
					</tbody>
				</table>
			</div>
		</div>
	</div>



	<div class="grid_10">
		<div class="box round first grid">
			<h2>Seen Inbox</h2>

<?php if (isset($_GET['dellid'])) {
	$dellid = $_GET['dellid'];
	$delmes = "DELETE FROM tbl_contact  WHERE id = $dellid ";
	$result = $obj->delete($delmes);
	if ($result) {
		echo "Message Delete Success";
	}else{
		echo "Message Delet Failed";
	}
} ?>

			<div class="block">        
				<table class="data display datatable" id="example" style="text-align: left;">
					<thead>
						<tr>
							<th width="10%">Serial No.</th>
							<th width="15%">Name</th>
							<th width="15%">Email</th>
							<th width="35%">Message</th>
							<th width="15%">date</th>
							<th width="10%" style="text-align: center;">Action</th>
						</tr>
					</thead>
					<tbody>
						<?php 
						$query = "select * from tbl_contact where status='1' order by id desc";
						$result = $obj->select($query);
						if ($result) {
							$i=0;
							while ($sendMess = $result->fetch_assoc()) {
								$i++;

								?>
								<tr class="odd gradeX" >
									<td><?php echo $i; ?></td>
									<td><?php echo $sendMess['fname'] .' '. $sendMess['lname'] ;?></td>
									<td><?php echo $sendMess['email']; ?></td>
									<td><?php echo $fm->textShorten($sendMess['message'],115); ?></td>
									<td><?php echo $fm->messdate($sendMess['date']); ?></td>
									<td style="text-align: center;">
										<a onclick="return confirm('are your sure Delete Message')" href="?dellid= <?php echo $sendMess['id']; ?>">Delete</a>  
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
	<?php include 'inc/footer.php' ?>
</body>
</html>
