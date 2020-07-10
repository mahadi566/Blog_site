<?php include 'inc/header.php' ?>
<?php include 'inc/sidebar.php' ?>
<div class="grid_10">

    <div class="box round first grid">
        <h2>Update Copyright Text</h2>
        <div class="block copyblock">
          <?php   
          if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $footer =$fm->validation($_POST['footer']);
          $fotr = mysqli_real_escape_string($obj->link, $footer);
           

           if (empty($fotr) ) {
            echo "Fill Empty";
        }else{
          $up_socile= "UPDATE tbl_footer 
                   SET
                   footer = '$fotr'
                   WHERE id = 1";
                   $so_update = $obj->update($up_socile);
           if ($so_update) {
            echo " Update Success";
        }else{
            echo " Update Not Success";

        }
    }
}else{
    echo "not REQUEST METHOD";
}
?> 
<form action="" method="post">
    <table class="form">
        <?php 
        $query = "select * from tbl_footer";
        $result = $obj->select($query);
        $copywrite = $result->fetch_assoc();


        ?>  					
        <tr>
            <td>
                <input type="text" value="<?php echo $copywrite['footer'] ?>" name="footer" class="large" />
            </td>
        </tr>

        <tr> 
            <td>
                <input type="submit" name="submit" Value="Update" />
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
