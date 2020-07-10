<?php include'inc/header.php'; ?>
<?php include'inc/sidebar.php';?>


<div class="grid_10">
    <div class="box round first grid">
        <h2>Add New Category</h2>
        <div class="block copyblock">
         <?php 
         if ($_SERVER['REQUEST_METHOD'] == 'POST') {
             $name = $_POST['name'];
             $name = mysqli_real_escape_string($obj->link, $name);
             if (empty($name)) {
                 echo " Fild Not must be empty !!";
             }else{
                 $qurey = "INSERT INTO tbl_cat(name) VALUES('$name')";
                 $result = $obj->insert($qurey);
                 if ( $result) {
                     echo "Success Insert Catagori";
                 }else{
                     echo "Not Insert Catagori";
                 }
             }
         }

         ?>
         <form action="" method="post">
            <table class="form">					
                <tr>
                    <td>
                        <input type="text" name="name" placeholder="Enter Category Name..." class="medium" />
                    </td>
                </tr>
                <tr> 
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
<?php include 'inc/footer.php' ?>
</body>
</html>
