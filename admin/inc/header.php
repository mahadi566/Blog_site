<?php include'../lib/session.php';
  Session::checkSession();
?>

<?php include'../config/config.php';?>
<?php include'../helpers/formet.php';?>
<?php include'../lib/Database.php';?>


<?php
   $obj = new Database;
   $fm = new formet;


  //set headers to NOT cache a page
  header("Cache-Control: no-cache, must-revalidate"); //HTTP 1.1
  header("Pragma: no-cache"); //HTTP 1.0
  header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); 
  // Date in the past
  //or, if you DO want a file to cache, use:
  header("Cache-Control: max-age=2592000"); 
//30days (60sec * 60min * 24hours * 30days)



?>

<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <title> Admin</title>
    <link rel="stylesheet" type="text/css" href="css/reset.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="css/text.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="css/grid.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="css/layout.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="css/nav.css" media="screen" />
    <link href="css/table/demo_page.css" rel="stylesheet" type="text/css" />
    <!-- BEGIN: load jquery -->
    <script src="js/jquery-1.6.4.min.js" type="text/javascript"></script>
    <script type="text/javascript" src="js/jquery-ui/jquery.ui.core.min.js"></script>
    <script src="js/jquery-ui/jquery.ui.widget.min.js" type="text/javascript"></script>
    <script src="js/jquery-ui/jquery.ui.accordion.min.js" type="text/javascript"></script>
    <script src="js/jquery-ui/jquery.effects.core.min.js" type="text/javascript"></script>
    <script src="js/jquery-ui/jquery.effects.slide.min.js" type="text/javascript"></script>
    <script src="js/jquery-ui/jquery.ui.mouse.min.js" type="text/javascript"></script>
    <script src="js/jquery-ui/jquery.ui.sortable.min.js" type="text/javascript"></script>
    <script src="js/table/jquery.dataTables.min.js" type="text/javascript"></script>
    <!-- END: load jquery -->
    <script type="text/javascript" src="js/table/table.js"></script>
    <script src="js/setup.js" type="text/javascript"></script>
	 <script type="text/javascript">
        $(document).ready(function () {
            setupLeftMenu();
		    setSidebarHeight();
        });
    </script>

</head>
<body>
    <div class="container_12">
        <div class="grid_12 header-repeat">
            <div id="branding">
                <div class="floatleft logo">
                    <img src="img/livelogo.png" alt="Logo" />
				</div>
				<div class="floatleft middle">
					<h1>Training with live project</h1>
					<p>www.trainingwithliveproject.com</p>
				</div>
                <div class="floatright">
    <?php 
            $userSessionId=Session::get('UserId');
            $query = "select * from tbl_user where id = $userSessionId" ;
            $result = $obj->select($query);
            $name =  $result->fetch_assoc();
     ?>
                    <div class="floatleft">



                        <img style="width: 30px;height: 30px;border-radius: 50%;"
                         src="
                          <?php 
                                 $image =  $name['image'] ;
                                 if ($image) {
                                  echo $image;
                                 }else{
                                  echo 'img/img-profile.jpg';
                                 }
                               ?>" 

                         alt="Profile Pic" />
                      </div>





                    <div class="floatleft marginleft10">
                        <?php if (isset($_GET['action']) && $_GET['action'] == "logout") {
                           Session::destroy();
                           header("location:login.php");
                        } ?>
                        <ul class="inline-ul floatleft">
                          
                            <li title="<?php  echo $name['name'] ;?>">
                              <?php 
                                 $manname =  $name['man_name'] ;
                                 $usersname =  $name['name'] ;
                               
                                 if ($manname) {
                                  echo $manname;
                                 }else{
                                  echo $usersname ;
                                 }
                               ?>
                            </li>
                            <li><a href="?action=logout">Logout</a></li>
                        </ul>
                    </div>
                </div>
                <div class="clear">
                </div>
            </div>
        </div>
        <div class="clear">
        </div>
        <div class="grid_12">
            <ul class="nav main">
                <li class="ic-dashboard"><a href="index.php"><span>Dashboard</span></a> </li>
                <li class="ic-form-style"><a href="porfile.php"><span>User Profile</span></a></li>
				<li class="ic-typography"><a href="changepassword.php"><span>Change Password</span></a></li>
				<li class="ic-grid-tables"><a href="inbox.php"><span>Inbox
<?php 
        $query = "select * from tbl_contact where status='0'";
         $result = $obj->select($query);
         if ($result) {
            $row = mysqli_num_rows($result);
            echo "[".$row."]";
         }else{
            echo "[0]";
         }
 ?>
                </span></a></li>
                <?php 
                    if (Session::get('Userrole') == '0') {?>
                     <li class="ic-charts"><a href="Add_User.php"><span>Add User</span></a></li>
                 <?php    }
                 ?>
                
                 <li class="ic-charts"><a href="User_list.php"><span>User List</span></a></li>
            </ul>
        </div>