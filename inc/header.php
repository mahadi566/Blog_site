
<?php include'config/config.php';?>
<?php include'helpers/formet.php';?>
<?php include'lib/Database.php';?>


<?php
$obj = new Database;
$fm = new formet;
?>

<!DOCTYPE html>
<html>
<head>

	<?php 
	if (isset($_GET['pageid'])) {
		$pageNo = $_GET['pageid'];
		$query = "select * from tbl_page where id = $pageNo";
		$page = $obj->select($query);
		if ($page) {
			while ($allPage = $page->fetch_assoc()) {?>
				<title><?php echo $allPage['name'];?> - <?php echo title; ?></title>
			<?php } } }

			elseif (isset($_GET['id'])) {
				$pageNo = $_GET['id'];
				$query = "select * from tbl_post where id = $pageNo";
				$page = $obj->select($query);
				if ($page) {
					while ($allPage = $page->fetch_assoc()) {?>
						<title><?php echo $allPage['title'];?> - <?php echo title; ?></title>
					<?php } } }

					elseif (isset($_GET['catagory'])) {
						$pageNo = $_GET['catagory'];
						$query = "select * from tbl_cat where id = $pageNo";
						$page = $obj->select($query);
						if ($page) {
							while ($allPage = $page->fetch_assoc()) {?>
								<title><?php echo $allPage['name'];?> - <?php echo title; ?></title>
							<?php } } }




							else{?>
								<title><?php echo $fm->title();?> - <?php echo title; ?></title>
							<?php } ?>


							<meta name="language" content="English">
							<meta name="description" content="It is a website about education">
	<?php 
				if (isset($_GET['id'])) {
					$key = $_GET['id'];
					$result = "select * from tbl_post where id = $key";
					$keyword = $obj->select($result);
					if ($keyword) {
						while ($meta = $keyword->fetch_assoc()) {?>
							<meta name="keywords" content="<?php echo $meta['tage']; ?>">
			<?php	} }else{?>
<meta name="keywords" content="<?php echo KEYWORDS; ?>">
		<?php		}
}
	 ?>
							
							<meta name="author" content="Delowar">
							<link rel="stylesheet" href="font-awesome-4.5.0/css/font-awesome.css">	
							<link rel="stylesheet" href="css/nivo-slider.css" type="text/css" media="screen" />
							<link rel="stylesheet" href="style.css">
							<script src="js/jquery.js" type="text/javascript"></script>
							<script src="js/jquery.nivo.slider.js" type="text/javascript"></script>

							<script type="text/javascript">
								$(window).load(function() {
									$('#slider').nivoSlider({
										effect:'random',
										slices:10,
										animSpeed:500,
										pauseTime:5000,
		startSlide:0, //Set starting Slide (0 index)
		directionNav:false,
		directionNavHide:false, //Only show on hover
		controlNav:false, //1,2,3...
		controlNavThumbs:false, //Use thumbnails for Control Nav
		pauseOnHover:true, //Stop animation while hovering
		manualAdvance:false, //Force manual transitions
		captionOpacity:0.8, //Universal caption opacity
		beforeChange: function(){},
		afterChange: function(){},
		slideshowEnd: function(){} //Triggers after all slides have been shown
	});
								});
							</script>
						</head>

						<body>
							<div class="headersection templete clear">
								<a href="index.php">
									<?php 
									$query = "select * from band_logo where id = 1";
									$result = $obj->select($query);
									$banner = $result->fetch_assoc()
									?>
									<div class="logo">
										<img src="admin/<?php echo $banner['logo'] ?>" alt="Logo"/>
										<h2><?php echo $banner['title'] ?></h2>
										<p><?php echo $banner['description'] ?></p>
									</div>
								</a>
								<div class="social clear"> 
									<div class="icon clear">

										<?php 
										$query = "select * from social";
										$result = $obj->select($query);
										$socil_link = $result->fetch_assoc();


										?> 
										<a href="<?php echo $socil_link['fb'] ?>" target="_blank"><i class="fa fa-facebook"></i></a>
										<a href="<?php echo $socil_link['tw'] ?>" target="_blank"><i class="fa fa-twitter"></i></a>
										<a href="<?php echo $socil_link['ln'] ?>" target="_blank"><i class="fa fa-linkedin"></i></a>
										<a href="<?php echo $socil_link['gp'] ?>" target="_blank"><i class="fa fa-google-plus"></i></a>
									</div>
									<div class="searchbtn clear">
										<form action="search.php" method="get">
											<input type="text" name="search" placeholder="Search keyword..."/>
											<input type="submit" name="submit" value="Search"/>
										</form>
									</div>
								</div>
							</div>
							<div class="navsection templete">

								<?php 
								$path = $_SERVER['SCRIPT_FILENAME'];
								$rightPage = basename($path, '.php');
								?>
								<ul>
									<li><a <?php if ($rightPage == 'index') {echo 'id="active"';} ?>
									href="index.php">Home</a></li>

									<?php 
									$query = "select * from tbl_page ";
									$page = $obj->select($query);
									if ($page) {
										while ($allPage = $page->fetch_assoc()) {
											?>
											<li><a
												<?php 
												if (isset($_GET['pageid'])  && $_GET['pageid'] == $allPage['id']) {
													echo 'id="active"';
												}
												?>
												href="page.php?pageid=<?php echo $allPage['id']; ?>"><?php echo $allPage['name']; ?></a> </li>
											<?php } } ?>

											<li><a <?php if ($rightPage == 'contact_us') {
												echo 'id="active"';
											} ?> href="contact_us.php">Contact</a></li>
										</ul>
									</div>