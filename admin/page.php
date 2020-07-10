<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php' ?>
<?php if (!isset($_GET['pageid']) || $_GET['pageid']==NULL) {
  header("location:index.php");
}else{
 $pageid= $_GET['pageid'];
}
?>
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
      $updatePage = "UPDATE tbl_page SET
      name = '$name',
      body = '$body'
      WHERE id = '$pageid'";

      $up_page_rows = $obj->update($updatePage);
      if ($up_page_rows) {
       echo "<span class='success'>data uPDATE Successfully. </span>";
     }else {
       echo "<span class='error'>data  Not uPDATE !</span>";
     }
   }



 }
 ?>
 <div class="block"> 
   <?php 
   $query = "select * from tbl_page where id = $pageid ";
   $pages  = $obj->select($query);
   if ( $pages) {
    while ($getpage = $pages->fetch_assoc()) {



      ?>              
      <form action="" method="POST" >
        <table class="form">

          <tr>
            <td>
              <label>name</label>
            </td>
            <td>
              <input type="text" name="name" value="<?php echo $getpage['name'] ?>" class="medium" />
            </td>
          </tr>

          <tr>
            <td style="vertical-align: top; padding-top: 9px;">
              <label>Content</label>
            </td>
            <td>
              <textarea class="tinymce" name="body" style="width: 70%;height: 165px;"> <?php echo $getpage['body'] ?>  </textarea>
            </td>
          </tr>

          <tr>
            <td></td>
            <td>
              <input type="submit" name="submit" Value="Save" />
              <a onclick="return confirm('Are YOU SURE DELETE THIS?')" href="page_delete.php?delpage=<?php echo $getpage['id']; ?>" title="">Delete</a>
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
