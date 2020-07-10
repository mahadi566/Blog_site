<?php include'inc/header.php'; ?>
<?php include'inc/sidebar.php';?>
<?php 
        if (!Session::get('Userrole') == '0') {
            echo "<script>window.location='index.php';</script>";
        }
 ?>


<div class="grid_10">
    <div class="box round first grid">
        <h2>Add New User</h2>
        <div class="block copyblock">
         <?php 
         if ($_SERVER['REQUEST_METHOD'] == 'POST') {
             $username = $fm->validation($_POST['username']);
             $password = $fm->validation(md5($_POST['password']));
             $role     = $fm->validation($_POST['role']);
             $email     = $fm->validation($_POST['email']);

             $username = mysqli_real_escape_string($obj->link, $username);
             $password = mysqli_real_escape_string($obj->link, $password);
             $role     = mysqli_real_escape_string($obj->link, $role);
             $email     = mysqli_real_escape_string($obj->link, $email);

             if (empty($username) || empty($password) || empty($role) || empty($email) ) {
                 echo " Field Not must be empty !!";
             }else{
                $query = "SELECT * FROM tbl_user WHERE email = '$email' LIMIT 1";
                $result = $obj->select($query);
                
                if ($result == TRUE) {
                    echo "All Ready Email Exist !!";
                }else{
                 $qurey = "INSERT INTO tbl_user (name,password,email,role) VALUES('$username','$password','$email','$role')";
                 $result = $obj->insert($qurey);
                 if ( $result) {
                     echo "User  Catagori Success";
                 }else{
                     echo "User  Catagori Faild !";
                 }
             }
            }
         }

         ?>
         <form action="" method="post">
            <table class="form">					
                <tr>
                    <td>
                        <label>Username</label>
                    </td>
                    <td>
                        <input type="text" name="username" placeholder="Enter Category Username..." class="medium" />
                    </td>
                </tr>
                 <tr>
                    <td>
                        <label>Password</label>
                    </td>
                    <td>
                        <input type="password" name="password" placeholder="Enter Category Password..." class="medium" />
                    </td>
                </tr>

                <tr>
                    <td>
                        <label>Email</label>
                    </td>
                    <td>
                        <input type="email" name="email" placeholder="Enter Category Password..." class="medium" />
                    </td>
                </tr>


                 <tr>
                    <td>
                        <label>Role</label>
                    </td>
                    <td>
                        <select id="selected" style="width: 200px;" name="role">
                            <option value="">Select Role</option>
                            <option value="0">admin</option>
                            <option value="1">authord</option>
                            <option value="2">editore</option>
                        </select>
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
<?php include 'inc/footer.php' ?>
</body>
</html>
