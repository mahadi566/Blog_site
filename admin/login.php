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
				$username = $fm->validation($_POST['username']);
				$password = $fm->validation(md5($_POST['password']));

			    $username =	mysqli_real_escape_string($obj->link, $username);
			    $password =	mysqli_real_escape_string($obj->link, $password);

			    $query = "select * from tbl_user where name ='$username' AND password = '$password'";
			    $result = $obj->select($query);
			    if ($result != false) {
			    	$valu =mysqli_fetch_array($result);
			    	$row =mysqli_num_rows($result);
			    	if ($row>0) {
			    		Session::set("login", true);
			    		Session::set("Username", $valu['name']);
			    		Session::set("UserId", $valu['id']);
			    		Session::set("Userrole", $valu['role']);
			    		
			    		header("location:index.php");
			    		
			    	}else{
			    		echo "No Resuld Found";
			    	}
			    }else{
			    		echo "User or Password Not Match";
			    }
			}
		 ?>




		<form action="login.php" method="post">
			<h1>Admin Login</h1>
			<div>
				<input type="text" placeholder="Username" required="" name="username"/>
			</div>
			<div>
				<input type="password" placeholder="Password" required="" name="password"/>
			</div>
			<div>
				<input type="submit" value="Log in" />
			</div>
		</form><!-- form -->
		<div class="button">
			<a href="fergetpass.php">Forget Password</a>
		</div>
		<div class="button">
			<a href="#">Training with live project</a>
		</div><!-- button -->
	</section><!-- content -->
</div><!-- container -->
</body>
</html>