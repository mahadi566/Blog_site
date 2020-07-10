<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php' ?>
<?php if (!isset($_GET['editid']) || $_GET['editid']==NULL) {
  header("location:postlist.php");
}else{
 $editid= $_GET['editid'];
}
?>

<div class="grid_10">

  <div class="box round first grid">
    <h2>Update Post</h2>

    <?php 
       $query = "select * from tbl_post where id = $editid ";
        $opo  = $obj->select($query);
         $idrow = $opo->fetch_assoc(); 
    
 

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

     $title = mysqli_real_escape_string($obj->link, $_POST['title']);
     $cat = mysqli_real_escape_string($obj->link, $_POST['cat']);
     $body = mysqli_real_escape_string($obj->link, $_POST['body']);
     $tage = mysqli_real_escape_string($obj->link, $_POST['tage']);
     $author = mysqli_real_escape_string($obj->link, $_POST['author']);
     $userId = mysqli_real_escape_string($obj->link, $_POST['userId']);
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
    $immg = "UPDATE tbl_post SET
      cat = '$cat',
      title = '$title',
      body = '$body',
      image = '$uploaded_image',
      author = '$author',
      tage = '$tage',
      userId = '$userId'
      WHERE id = '$editid'";

      $inserted_rows = $obj->update($immg);
      if ($inserted_rows) {
       echo "<span class='success'>data and image Inserted Successfully. </span>";
     }else {
       echo "<span class='error'>data and image Not Inserted !</span>";
     }
      

    }else{
      $query = "UPDATE tbl_post SET
      cat = '$cat',
      title = '$title',
      body = '$body',
      author = '$author',
      tage = '$tage',
      userId = '$userId'

      WHERE id = '$editid'";

      $inserted_rows = $obj->update($query);
      if ($inserted_rows) {
       echo "<span class='success'>Post Update Successfully. </span>";
     }else {
       echo "<span class='error'>Post Not Update !</span>";
     }
   }

 }
 ?>
 
 <div class="block">   
   <?php 
   $query = "select * from tbl_post where id = $editid order by id desc";
   $slc_query = $obj->select($query);
   if ($slc_query) {
    while ( $post_reg =$slc_query->fetch_assoc()) {


      ?>            
      <form action="" method="POST" enctype="multipart/form-data">
        <table class="form">

          <tr>
            <td>
              <label>Title</label>
            </td>
            <td>
              <input type="text" name="title" value="<?php echo $post_reg['title']; ?>" class="medium" />
            </td>
          </tr>

          <tr>
            <td>
              <label>Category</label>
            </td>
            <td>
              <select id="select" name="cat" >
                <option>select option</option>
                <?php 
                $query = "select * from tbl_cat ";
                $result = $obj->select($query);
                if ($result) {
                 while ($cetlis = $result->fetch_assoc()) {
                   ?>
                   <option
                   <?php 
                   if ( $post_reg['cat']==$cetlis['id']) {?>
                     selected='selected'
                   <?php } ?>

                   value="<?php echo $cetlis['id'] ?>"><?php echo $cetlis['name'] ?></option>
                 <?php } } ?>
               </select>
             </td>
           </tr>



           <tr>
            <td>
              <label>Upload Image</label>
            </td>
            <td>
              <img src="<?php echo $post_reg['image']; ?>" alt="nai" style="width: 672px;height: 264px;">
              <input style="float: right;" type="file" value="<?php echo $post_reg['image']; ?>" name="image" />
            </td>
          </tr>
          <tr>
            <td style="vertical-align: top; padding-top: 9px;">
              <label>Content</label>
            </td>
            <td>
              <textarea class="tinymce" name="body" style="width: 700px;height: 150px;"><?php echo $post_reg['body']; ?></textarea>
            </td>
          </tr>
          <tr>
            <td>
              <label>tags</label>
            </td>
            <td>
              <input type="text" name="tage" value="<?php echo $post_reg['tage']; ?>" class="medium" />
            </td>
          </tr>
          <tr>
            <td>
              <label>author</label>
            </td>
            <td>
              <input type="text" name="author" value="<?php echo $post_reg['author']; ?>" class="medium" />
              <input type="hidden" readonly name="userId" value="<?php echo Session::get('UserId')?>" class="medium" />
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
