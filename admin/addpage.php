<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php' ?>

<div class="grid_10">
  
  <div class="box round first grid">
    <h2>Add New Post</h2>
    <?php 

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
     
     $name = mysqli_real_escape_string($obj->link, $_POST['name']);
     $body = mysqli_real_escape_string($obj->link, $_POST['body']);
    

     if (empty($name) || empty($body)  ) {
       echo "<span class='error'> fill Empty !</span>";
     } else{
      $query = "INSERT INTO tbl_page (name,body) VALUES('$name','$body')";

      $inserted_rows = $obj->insert($query);
      if ($inserted_rows) {
       echo "<span class='success'>page Create Successfully. </span>";
     }else {
       echo "<span class='error'>page  Not Create !</span>";
     }
   }



 }
 ?>
 <div class="block">               
   <form action="" method="POST" enctype="multipart/form-data">
    <table class="form">
     
      <tr>
        <td>
          <label>name</label>
        </td>
        <td>
          <input type="text" name="name" placeholder="Enter Post Title..." class="medium" />
        </td>
      </tr>
      
      <tr>
        <td style="vertical-align: top; padding-top: 9px;">
          <label>Content</label>
        </td>
        <td>
          <textarea class="tinymce" name="body" style="width: 70%;height: 165px;"></textarea>
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
