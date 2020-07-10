<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php' ?>
<?php if (!isset($_GET['replyid']) || $_GET['replyid']==NULL) {
  header("location:index.php");
}else{
 $replyid = $_GET['replyid'];
}
?>



<div class="grid_10">

  <div class="box round first grid">
    <h2>Add New Post</h2>
    <?php 
    $query = "select * from tbl_contact where id = $replyid";
    $result = $obj->select($query);
    if ($result) {
     $viewquery = $result->fetch_assoc();
   }
   ?>

   <?php 
   if ($_SERVER['REQUEST_METHOD'] == 'POST') {
     $to =$fm->validation($_POST['to']);
     $from =$fm->validation($_POST['from']);
     $subject =$fm->validation($_POST['subject']);
     $message =$fm->validation($_POST['message']);
     $sendmail = mail($to, $subject, $message, $from);
     if ($sendmail) {
       echo "Message Send Success";
     }else{
      echo "Message Send Fail";
    }
  }
  ?>



  <div class="block">               
   <form action="" method="POST" enctype="multipart/form-data">
    <table class="form">

      <tr>
        <td>
          <label>to</label>
        </td>
        <td>
          <input type="email" readonly name="to" value="<?php echo $viewquery['email']; ?>"  class="medium" />
        </td>
      </tr>
      <tr>
        <td>
          <label>from</label>
        </td>
        <td>
          <input type="email" name="from"  placeholder="enter your email"  class="medium" />
        </td>
      </tr>


      <tr>
        <td>
          <label>subject</label>
        </td>
        <td>
          <input type="text"  name="subject" placeholder="subject  "  class="medium" />
        </td>
      </tr>
      

      <tr>
        <td style="vertical-align: top; padding-top: 9px;">
          <label>Content</label>
        </td>
        <td>
          <textarea  style="width: 700px; height: 150px;" name="message">  </textarea>
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
