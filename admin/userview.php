<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php' ?>
<?php if (!isset($_GET['viewid']) || $_GET['viewid']==NULL) {
 echo "<script> window.location='User_list.php'; </script>";
}else{
 $viewid = $_GET['viewid'];
}
?>


<div class="grid_10">

  <div class="box round first grid">
    <h2>Update Post</h2>

    <?php 

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    echo "<script> window.location='User_list.php'; </script>";
 }
 ?>
 
 <div class="block">   
   <?php 
   $query = "select * from tbl_user where id = '$viewid'";
   $slc_query = $obj->select($query);
   if ($slc_query) {
    while ( $post_reg =$slc_query->fetch_assoc()) {


      ?>            
      <form action="" method="POST">
        <table class="form">

          <tr>
            <td width="20%">
              <label>Name</label>
            </td>
            <td>
              <?php echo $post_reg['man_name']; ?>
            </td>
          </tr>

           <tr>
            <td>
              <label>User Name</label>
            </td>
            <td>
              <?php echo $post_reg['name']; ?>
            </td>
          </tr>

           <tr>
            <td>
              <label>email</label>
            </td>
            <td>
              <?php echo $post_reg['email']; ?>
            </td>
          </tr>

          <tr>
            <td>
              <label>Deteis</label>
            </td>
            <td>
             <?php echo $post_reg['detals']; ?>
          </tr>

           <tr>
            <td>
              <label>role</label>
            </td>
            <td>
             
                    <?php
                     if ($post_reg['role'] == 0 ) {
                      echo "admin";
                     }elseif ( $post_reg['role'] ==1 ) {
                      echo "authord";
                     }elseif ($post_reg['role'] == 2) {
                      echo "editor";
                     }
                   ?>
             
            </td>
          </tr>

          






           <tr>
            <td>
              <label>Upload Image</label>
            </td>
            <td>
              <img src="<?php echo $post_reg['image']; ?>" alt="nai" style="width: 248px;height: 264px;">
             
            </td>
          </tr>

          <tr>
            <td style="vertical-align: top; padding-top: 9px;">
              <label>Content</label>
            </td>
            <td>
              <?php echo $post_reg['detals']; ?>
            </td>
          </tr>

         
          <tr>
            <td></td>
            <td>
              <input type="submit" name="submit" Value="Ok" />
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
