<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php' ?>

<div class="grid_10">
  
  <div class="box round first grid">
    <h2>Add New Post</h2>
    <?php 

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

     if (empty($title) || empty($cat) || empty($body) || empty($tage) || empty($author) || empty($file_name) ) {
       echo "<span class='error'> fill Empty !</span>";
     }elseif ($file_size >1048567) {
       echo "<span class='error'>Image Size should be less then 1MB!
       </span>";
     } elseif (in_array($file_ext, $permited) === false) {
       echo "<span class='error'>You can upload only:-"
       .implode(', ', $permited)."</span>";
     } else{
      move_uploaded_file($file_temp, $uploaded_image);
      $query = "INSERT INTO tbl_post(cat,title,body,image,author,tage,userId) VALUES('$cat','$title','$body','$uploaded_image','$author','$tage','$userId')";

      $inserted_rows = $obj->insert($query);
      if ($inserted_rows) {
       echo "<span class='success'>Post Inserted Successfully. </span>";
     }else {
       echo "<span class='error'>Post Not Inserted !</span>";
     }
   }



 }
 ?>
 <div class="block">               
   <form action="" method="POST" enctype="multipart/form-data">
    <table class="form">
     
      <tr>
        <td>
          <label>Title</label>
        </td>
        <td>
          <input type="text" name="title" placeholder="Enter Post Title..." class="medium" />
        </td>
      </tr>
      
      <tr>
        <td>
          <label>Category</label>
        </td>
        <td>
          <select id="select" name="cat">
            <option value="">select option</option>
            <?php 
            $query = "select * from tbl_cat ";
            $result = $obj->select($query);
            if ($result) {
             while ($cetlis = $result->fetch_assoc()) {
               ?>
               <option value="<?php echo $cetlis['id'] ?>"><?php echo $cetlis['name'] ?></option>
             <?php } } ?>
           </select>
         </td>
       </tr>
       
       
       
       <tr>
        <td>
          <label>Upload Image</label>
        </td>
        <td>
          <input type="file" name="image" />
        </td>
      </tr>
      <tr>
        <td style="vertical-align: top; padding-top: 9px;">
          <label>Content</label>
        </td>
        <td>
          <textarea class="tinymce" name="body"></textarea>
        </td>
      </tr>
      <tr>
        <td>
          <label>tags</label>
        </td>
        <td>
          <input type="text" name="tage" placeholder="Enter tage" class="medium" />
        </td>
      </tr>
      <tr>
        <td>
          <label>author</label>
        </td>
        <td>
          <input type="text" readonly name="author" value="<?php echo Session::get('Username')?>" class="medium" />

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
