<?php include'inc/header.php'; ?>
<?php include'inc/sidebar.php';?>

<?php if (!isset($_GET['catid']) || $_GET['catid'] == NULL) {
    echo "<script> window.location='catlist.php'; </script>";
   // or // header("location:catlist.php");
}else{
    $id = $_GET['catid'];
} ?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Edited Category</h2>
        <div class="block copyblock">
         <?php 
         if ($_SERVER['REQUEST_METHOD'] == 'POST') {
             $name = $_POST['name'];
             $name = mysqli_real_escape_string($obj->link, $name);
             if (empty($name)) {
                 echo " Fild Not must be empty !!";
             }else{
                 $qurey = "UPDATE tbl_cat SET 
                    name = '$name'
                    where id = $id
                 ";
                 $result = $obj->insert($qurey);
                 if ( $result) {
                     echo "Success Update Catagori";
                 }else{
                     echo "Not Update Catagori";
                 }
             }
         }

         ?>

         <?php 
            $query= "select * from tbl_cat where id = $id";
            $result = $obj->select($query);
            if ($result) {
                while ($editcat =  $result->fetch_assoc()) {
          ?>
         <form action="" method="post">
            <table class="form">					
                <tr>
                    <td>
                        <input type="text" name="name" value="<?php echo $editcat['name'] ?>" class="medium" />
                    </td>
                </tr>
                <tr> 
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
<?php include 'inc/footer.php' ?>
</body>
</html>
