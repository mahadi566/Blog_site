<?php include'../lib/session.php';
  Session::checklogin();
?>
<?php include'../config/config.php';?>
<?php include'../helpers/formet.php';?>
<?php include'../lib/Database.php';?>
<?php
   $obj = new Database;
   $fm = new formet;
?>

<!DOCTYPE html>
<head>
<meta charset="utf-8">
<title>Login</title>
    <link rel="stylesheet" type="text/css" href="css/stylelogin.css" media="screen" />
</head>
<body>
<div class="container">
	<section id="content">
		<?php 
			if ($_SERVER['REQUEST_METHOD'] == 'POST') {
				$useremail = $fm->validation($_POST['email']);

			    $email =	mysqli_real_escape_string($obj->link, $useremail);

			    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			    	echo " Email Not Valid !! ";
			    }else{

			    $query = "select * from tbl_user where email ='$email' ";
			    $result = $obj->select($query);
			    if ($result != false) {
			    	while ( $emailchac = $result->fetch_assoc()) {
			    		$Userid = $emailchac['id'];
			    		$Username = $emailchac['name'];
			    	}
			    $email = substr($email, 0,3);
			    $rend = rand(1000 , 99999);
			    $newpass = "$email$rend";
			    $password = md5($newpass);
			    $updatePassword = "UPDATE tbl_user
			                      SET 
			                      password = '$password'
			                      WHERE id = '$Userid'";
			    $fetch_email = $obj->update($updatePassword);

			    $to      = $useremail;
			    $from    = "mahadihasan2468pk@gmail.com";
			    $headers = "From : $from \n";
			    $header .= "MIME-Version: 1.0 . \r\n";
    			$header .= "Content-Transfer-Encoding: 8bit .\r\n";

			    $subject = "Your Password:";
			    $message = "Your Username :".$Username ."And your Password:".$newpass."Please visit web site www.Example.com" ;
			    

			    $sendMail = mail($to, $subject, $message, $headers);

			    if ($sendMail) {
			    	echo "Please email chack for new Password.";
			    }else{
			    	echo "Password Not Create !";
			    }

			    		
			    }else{
			    		echo "Email Not Exists";
			    }
			}
		}

	?>




		<form action="" method="post">
			<h1> Password Recovery </h1>
			
			<div>
				<input type="text" placeholder="Username" required="" name="email"/>
			</div>
			<div>
				<input type="submit" value="Log in" />
			</div>
		</form><!-- form -->
		<div class="button">
			<a href="login.php">Log In</a>
		</div>
		<div class="button">
			<a href="#">Training with live project</a>
		</div><!-- button -->
	</section><!-- content -->
</div><!-- container -->
</body>
</html>