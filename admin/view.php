<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php' ?>
<?php if (!isset($_GET['viewid']) || $_GET['viewid']==NULL) {
  header("location:index.php");
}else{
 $viewid = $_GET['viewid'];
}
?>

<?php 
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
   echo "<script> window.location = 'inbox.php' </script> ";
  }
 ?>


<div class="grid_10">
  
  <div class="box round first grid">
    <h2>Add New Post</h2>
  <?php 
      $query = "select * from tbl_contact where id = $viewid";
      $result = $obj->select($query);
      if ($result) {
       $viewquery = $result->fetch_assoc();
      }
   ?>
 <div class="block">               
   <form action="" method="POST" enctype="multipart/form-data">
    <table class="form">
     
      <tr>
        <td>
          <label>Name</label>
        </td>
        <td>
          <input type="text" readonly  value="<?php echo  $viewquery['fname'] .' '. $viewquery['lname'] ;?>" class="medium" />
        </td>
      </tr>

        <tr>
        <td>
          <label>Email</label>
        </td>
        <td>
          <input type="text" readonly value="<?php echo  $viewquery['email'];?>" class="medium" />
        </td>
      </tr>

        <tr>
        <td>
          <label>Date</label>
        </td>
        <td>
          <input type="text" readonly value="<?php echo  $fm->messdate($viewquery['date']);?>" class="medium" />
        </td>
      </tr>
      
  
      <tr>
        <td style="vertical-align: top; padding-top: 9px;">
          <label>Content</label>
        </td>
        <td>
          <textarea  style="width: 700px; height: 150px;"> <?php echo  $viewquery['message'];?> </textarea>
        </td>
      </tr>

   
    
      <tr>
        <td></td>
        <td>
          <input type="submit" name="submit" Value="Ok" />
          <a href="reply.php?replyid=<?php echo $viewid ?>" title="">Reply</a>
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
