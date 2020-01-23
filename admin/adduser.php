<?php include'inc/header.php'; ?>
<?php include'inc/sidebar.php'; ?>


<?php
if(!session::get('userrole')=='1'){
    echo "<script>window.location='index.php';</script>";
}
?>
<div class="grid_10">

    <div class="box round first grid">
        <h2>Add New Category</h2>
        <div class="block copyblock"> 
            <?php 
            if($_SERVER['REQUEST_METHOD']=='POST'){
                $username=$fm->validation($_POST['username']);
                $email=$fm->validation($_POST['email']);
                $password=$fm->validation(md5($_POST['password']));
                $role    =$fm->validation($_POST['role']);
                
                $username=  mysqli_real_escape_string($db->link,$username);
                $email=  mysqli_real_escape_string($db->link,$email);
                $password=  mysqli_real_escape_string($db->link,$password);
                $role    =  mysqli_real_escape_string($db->link,$role);
                
                if(empty($username)||empty($password)||empty($role)||empty($email)){
                    echo "<span class='error'>Field must no be empty !</span>";
                }elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    echo  "<span class='error'>Invalid Email Address </span>";    
                }else{  
                $mailquery="select *from tbl_user where email='$email' limit 1";
                $mailcheck=$db->select($mailquery);
                if($mailcheck !=FALSE){
                    echo  "<span class='error'>Email Already Exist..!</span>"; 
                } else{
                $query="INSERT INTO  tbl_user (username,email,password,role)VALUES('$username','$email','$password','$role')";
                $userInsert=$db->insert($query);
                if($userInsert){
                    echo  "<span class='success'>User Inserted Successfully !</span>";
                }else{
                   echo  "<span class='error'>User not Inserted </span>";
                }
                }
            }
            }
            
            ?>
            <form action="" method="post">
                <table class="form">					
                    <tr>
                        <td>
                            <label>Enter Name</label>
              
                        </td>
                        <td>
                            <input type="text" name="username" placeholder="Enter Your UserName..." class="medium" />
                        </td>
                    </tr>
                     <tr>
                        <td>
                            <label>Enter Email</label>
                        </td>
                        <td>
                            <input type="text" name="email" placeholder="Enter Your Email..." class="medium" />
                        </td>
                    </tr>
                     <tr>
                        <td>
                            <label>Enter Password</label>
                        </td>
                        <td>
                            <input type="text" name="password" placeholder="Enter Your Password..." class="medium" />
                        </td>
                    </tr>
                   
                    <tr>
                        <td>
                            <label>User Role</label>
                        </td>
                        <td>
                            <select id="select" name="role">
                                <option>Select User Role</option>
                                <option value="1">Admin</option>
                                <option value="2">Editor</option>
                                <option value="3">Author</option>
                             
                            </select>
                        </td>
                    </tr>
                    <tr> 
                        <td>
                            <input type="submit" name="submit" Value="Create" />
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
</div>
<?php include'inc/footer.php'; ?>