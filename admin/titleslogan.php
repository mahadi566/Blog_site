<?php include 'inc/header.php' ?>
<?php include 'inc/sidebar.php' ?>
<style>
    .leftside{float: left;width: 70%;}
    .rightside{float: left;width: 20%;}
    .rightside img{height: 165px;}
</style>



<div class="grid_10">

    <div class="box round first grid">
        <h2>Update Site Title and Description</h2>
        <?php  
        $query = "select * from band_logo where id = 1";
        $opo  = $obj->select($query);
        $baner_result = $opo->fetch_assoc(); 

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $title =$fm->validation($_POST['title']);
            $description = $fm->validation($_POST['description']);
        $title = mysqli_real_escape_string($obj->link, $title);
     $description = mysqli_real_escape_string($obj->link, $description);

            $permited  = array('jpg', 'jpeg', 'png', 'gif');
            $file_name = $_FILES['logo']['name'];
            $file_size = $_FILES['logo']['size'];
            $file_temp = $_FILES['logo']['tmp_name'];

            $div = explode('.', $file_name);
            $file_ext = strtolower(end($div));
            $unique_image = 'logo'.'.'.$file_ext;
            $uploaded_image = "upload/".$unique_image;

            if ($file_size > 1)  {
             if (file_exists($baner_result['logo']) && !empty($baner_result['logo'])) {
                unlink($baner_result['logo']);
            }
            move_uploaded_file($file_temp, $uploaded_image);
            $baner_update = "UPDATE band_logo SET
            title ='$title',
            description ='$description',
            logo ='$uploaded_image'
            WHERE id =1 ";

            $ban_updt = $obj->update($baner_update);
            if ($ban_updt) {
             echo "Successfully Update";
         }else{
            echo "Not Update";
        }
    }else{
      $baner_update = "UPDATE  band_logo SET
      title ='$title',
      description ='$description'

      WHERE id =1 ";

      $ban_updt = $obj->update($baner_update);
      if ($ban_updt) {
         echo "Successfully Update ";
     }else{
        echo "Not Update";
    }
}
}
?>    
<div class="block sloginblock"> 
    <?php 
    $query = "select * from band_logo where id = 1";
    $result = $obj->select($query);

    if ($result) {
     while ($baner_result = $result->fetch_assoc()) {


       ?>
       <div class="leftside">  

         <form action="" method="post" enctype="multipart/form-data">
            <table class="form">					
                <tr>
                    <td>
                        <label>Website Title</label>
                    </td>
                    <td>
                        <input type="text" value="<?php echo $baner_result['title'] ?>"  name="title" class="medium" />
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Website Slogan</label>
                    </td>
                    <td>
                        <input type="text" value="<?php echo $baner_result['description'] ?>" name="description" class="medium" />

                    </td>
                </tr>

                <tr>
                    <td>
                      <label>Upload Image</label>
                  </td>
                  <td>
                      <input type="file" name="logo" />
                  </td>
              </tr>


              <tr>
                <td>
                </td>
                <td>
                    <input type="submit" name="submit" Value="Update" />
                </td>
            </tr>
        </table>
    </form>
</div>
<div class="rightside">
 <img src="<?php echo $baner_result['logo'] ?>" alt="logo">
</div>
<?php } } ?>
</div>
</div>
</div>
<div class="clear">
</div>
</div>
<div class="clear">
</div>
<?php include 'inc/footer.php' ?>
</body>
</html>
