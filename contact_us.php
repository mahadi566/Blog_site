<?php include 'inc/header.php' ?>

	<?php 
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
         	$fname =$fm->validation($_POST['fname']) ;
			$lname = $fm->validation($_POST['lname']);
			$emails = $fm->validation($_POST['email']);
			$email = filter_var($emails, FILTER_SANITIZE_EMAIL);
			$message = $fm->validation($_POST['message']);
			

		    $fname =mysqli_real_escape_string($obj->link, $fname);
		    $lname =mysqli_real_escape_string($obj->link, $lname);
		    $email =mysqli_real_escape_string($obj->link, $email);
		    $message =mysqli_real_escape_string($obj->link, $message);

		   

		    if (empty($fname)) {
		    	$error =  "Fast Name empty";
		    }elseif (empty($lname)) {
		    	$error =  "Last Name empty";
		    }elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		    	$error =  "email empty";
		    }elseif (empty($message)) {
		    	$error =  "message empty";
		    }else{
		    	$query = "INSERT INTO tbl_contact(fname,lname,email,message)VALUES('$fname','$lname','$email','$message')";
		    $result = $obj->insert($query);
		    if ($result) {
		    	$mass = "Message Send Success";
		    }else{
		    	$error = "Massage Send Faild !";
		    }
		    }
		    

		}
	 ?>

	 



	<div class="contentsection contemplete clear">
		<div class="maincontent clear">
			<div class="about">
				<h2>Contact us</h2>
<?php if (isset($mass)) {
	echo "<p style='color:green;font-size:.8rem;'>$mass</p>";
}if (isset($error)) {
	echo "<p style='color:red;font-size:.8rem;'>$error</p>";
}
?>

			<form action="" method="post">
				<table>
				<tr>
					<td>Your First Name:</td>
					<td>
					<input type="text" name="fname" placeholder="Enter first name" />
					</td>
					
				</tr>
				<tr>
					<td>Your Last Name:</td>
					<td>
					<input type="text" name="lname" placeholder="Enter Last name" />
					</td>
					
				</tr>
				
				<tr>
					<td>Your Email Address:</td>
					<td>
					<input type="email" name="email" placeholder="Enter Email Address" />
					</td>
					
				</tr>
				<tr>
					<td>Your Message:</td>
					<td>
					<textarea name="message"></textarea>
					</td>
					
				</tr>
				<tr>
					<td></td>
					<td>
					<input type="submit" name="submit" value="Submit"/>
					</td>
				</tr>
		</table>
	<form>				
 </div>

		</div>
		
			
			<?php include 'inc/sliedbar.php' ?>
	</div>

	<?php include'inc/footer.php';?>



</body>
</html>