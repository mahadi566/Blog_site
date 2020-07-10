<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php' ?>
<?php if (!isset($_GET['viewid']) || $_GET['viewid']==NULL) {
  header("location:postlist.php");
}else{
 $viewid= $_GET['viewid'];
}
?>

<div class="grid_10">

  <div class="box round first grid">
    <h2>Update Post</h2>

    <?php 
       $query = "select * from tbl_post where id = $viewid ";
        $opo  = $obj->select($query);
         $idrow = $opo->fetch_assoc(); 
    
 

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
echo "<script> window.location='postlist.php'; </script>";
 

 }
 ?>
 
 <div class="block">   
   <?php 
   $query = "select * from tbl_post where id = $viewid ";
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
              <input type="text" readonly name="title" value="<?php echo $post_reg['title']; ?>" class="medium" />
            </td>
          </tr>

          <tr>
            <td>
              <label>Category</label>
            </td>
            <td>
              <select id="select" name="cat"  readonly>
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
              
            </td>
          </tr>
          <tr>
            <td style="vertical-align: top; padding-top: 9px;">
              <label>Content</label>
            </td>
            <td>
              <textarea  class="tinymce" name="body" style="width: 700px;height: 150px;"><?php echo $post_reg['body']; ?></textarea>
            </td>
          </tr>
          <tr>
            <td>
              <label>tags</label>
            </td>
            <td>
              <input readonly type="text" name="tage" value="<?php echo $post_reg['tage']; ?>" class="medium" />
            </td>
          </tr>
          <tr>
            <td>
              <label>author</label>
            </td>
            <td>
              <input readonly type="text" name="author" value="<?php echo $post_reg['author']; ?>" class="medium" />
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
