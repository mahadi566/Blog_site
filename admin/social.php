<?php include 'inc/header.php' ?>
<?php include 'inc/sidebar.php' ?>




<div class="grid_10">

    <div class="box round first grid">
        <h2>Update Social Media</h2>

        <?php 
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
           $fb =$fm->validation($_POST['fb']);
           $tw =$fm->validation($_POST['tw']);
           $ln =$fm->validation($_POST['ln']);
           $gp =$fm->validation($_POST['gp']);

           $fb = mysqli_real_escape_string($obj->link, $fb);
           $tw = mysqli_real_escape_string($obj->link, $tw);
           $ln = mysqli_real_escape_string($obj->link, $ln);
           $gp = mysqli_real_escape_string($obj->link, $gp);

           if ( empty($fb) || empty($tw) || empty($ln) || empty($gp) ) {
            echo "Fill Empty";
        }else{
           $up_socile= "UPDATE social 
                   SET
                   fb = '$fb',
                   tw = '$tw',
                   ln = '$ln',
                   gp = '$gp'
                   WHERE id = 1";
                   $so_update = $obj->update($up_socile);
           if ($so_update) {
            echo "socil link Update Success";
        }else{
            echo "socil link Update Not Success";

        }
    }



}
?>
<div class="block">  

 <form action="" method="post">
     <?php 
     $query = "select * from social";
     $result = $obj->select($query);
     $socil_link = $result->fetch_assoc();


     ?>  
     <table class="form">					
        <tr>
            <td>
                <label>Facebook</label>
            </td>
            <td>
                <input type="text" name="fb" value="<?php echo $socil_link['fb'] ?>" class="medium" />
            </td>
        </tr>
        <tr>
            <td>
                <label>Twitter</label>
            </td>
            <td>
                <input type="text" name="tw" value="<?php echo $socil_link['tw'] ?>" class="medium" />
            </td>
        </tr>

        <tr>
            <td>
                <label>LinkedIn</label>
            </td>
            <td>
                <input type="text" name="ln" value="<?php echo $socil_link['ln'] ?>" class="medium" />
            </td>
        </tr>

        <tr>
            <td>
                <label>Google Plus</label>
            </td>
            <td>
                <input type="text" name="gp" value="<?php echo $socil_link['gp'] ?>" class="medium" />
            </td>
        </tr>

        <tr>
            <td></td>
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
