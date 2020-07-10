<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php' ?>
<?php 
    $sessionid   = Session::get('UserId');
    $sessionrole = Session::get('Userrole');
 ?>


<div class="grid_10">

  <div class="box round first grid">
    <h2>Update Post</h2>

    <?php 
       $query = "select * from tbl_user where id = $sessionid ";
        $opo  = $obj->select($query);
         $idrow = $opo->fetch_assoc(); 
    
 

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

     $name = mysqli_real_escape_string($obj->link, $_POST['name']);
     $email = mysqli_real_escape_string($obj->link, $_POST['email']);
    
     $detels = mysqli_real_escape_string($obj->link, $_POST['detels']);
     


     $permited  = array('jpg', 'jpeg', 'png', 'gif');
     $file_name = $_FILES['image']['name'];
     $file_size = $_FILES['image']['size'];
     $file_temp = $_FILES['image']['tmp_name'];

     $div = explode('.', $file_name);
     $file_ext = strtolower(end($div));
     $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
     $uploaded_image = "upload/".$unique_image;


     if ($file_size > 1) {
       if (file_exists($idrow['image']) && !empty($idrow['image'])) {
        unlink($idrow['image']);
      
      }
      move_uploaded_file($file_temp, $uploaded_image);
    $query   = "UPDATE tbl_user
               SET
              man_name = '$name',
              email = '$email',
              detals = '$detels',
              image = '$uploaded_image'

              WHERE id = '$sessionid'";

      $inserted_rows = $obj->update($query);
      if ($inserted_rows) {
       echo "<span class='success'>Profile and image Update Successfully. </span>";
     }else {
       echo "<span class='error'>Profile and image Not Update !</span>";
     }
      

    }
    else{


      $query = "UPDATE tbl_user SET
      man_name = '$name',
      email = '$email',
      detals = '$detels'

      WHERE id = '$sessionid'";

      $inserted_rows = $obj->update($query);
      if ($inserted_rows) {
       echo "<span class='success'>Profile Update Successfully. </span>";
     }else {
       echo "<span class='error'>Profile Update  Feild !</span>";
     }

    }

 }
 ?>
 
 <div class="block">   
   <?php 
   $query = "select * from tbl_user where id = '$sessionid' AND role = '$sessionrole'";
   $slc_query = $obj->select($query);
   if ($slc_query) {
    while ( $post_reg =$slc_query->fetch_assoc()) {


      ?>            
      <form action="" method="POST" enctype="multipart/form-data">
        <table class="form">

          <tr>
            <td>
              <label>Name</label>
            </td>
            <td>
              <input type="text" name="name" value="<?php echo $post_reg['man_name']; ?>" class="medium" />
            </td>
          </tr>

          <tr>
            <td>
              <label>Email</label>
            </td>
            <td>
              <input type="email" name="email" value="<?php echo $post_reg['email']; ?>" class="medium" />
            </td>
          </tr>

          






           <tr>
            <td>
              <label>Upload Image</label>
            </td>
            <td>
              <img src="<?php echo $post_reg['image']; ?>" alt="nai" style="width: 248px;height: 264px;">
              <input type="file" value="<?php echo $post_reg['image']; ?>" name="image" />
            </td>
          </tr>

          <tr>
            <td style="vertical-align: top; padding-top: 9px;">
              <label>Content</label>
            </td>
            <td>
              <textarea class="tinymce" name="detels" style="width: 700px;height: 150px;"><?php echo $post_reg['detals']; ?></textarea>
            </td>
          </tr>

         
          <tr>
            <td></td>
            <td>
              <input type="submit" name="submit" Value="Save" />
            </td>
          </tr>
        </table>
      </form>
    <?php } } ?>
  </div>
</div>
</div>
<div class="clear">
</div>
</div>
<div class="clear">
</div>
<?php include'inc/footer.php'; ?>
</body>
</html>
