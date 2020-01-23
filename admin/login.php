<?php
include'../lib/session.php';
session::checkLogin();  //session start method call and check login
?>
<?php include'../config/config.php'; ?>
<?php include'../lib/Database.php'; ?>
<?php include'../helpers/format.php'; ?>

<?php
$db = new Database();
$fm = new format();
?>
<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="css/stylelogin.css" media="screen" />
</head>
<body>
    <div class="container">
        <section id="content">
            <?php
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {

                $username = $fm->validation($_POST['username']);
                $password = $fm->validation(md5($_POST['password']));

                $username = mysqli_real_escape_string($db->link, $username);
                $password = mysqli_real_escape_string($db->link, $password);

                $query = "SELECT *FROM tbl_user WHERE username='$username' AND password='$password'";

                $result = $db->select($query);
                if ($result != false) {
                    $value=$result->fetch_assoc();
                    //$value = mysqli_fetch_array($result);
                   // $row = mysqli_num_rows($result);already done in databasemethod numrow that's why not need to chec
                        session::set("login", true);
                        session::set("username", $value['username']);
                        session::set("userid", $value['id']);
                        session::set("userrole", $value['role']);
                        header("Location:index.php");
                } else {
                    echo "<span style='color:red;font-size:18px;'>Username And Password Not Match </span>";
                }
            }
            ?>
            <form action="login.php" method="post">
                <h1>Admin Login</h1>
                <div>
                    <input type="text" placeholder="Username" required="" value="Julfikar" name="username"/>
                </div>
                <div>
                    <input type="password" placeholder="Password" required="" value="123" name="password"/>
                </div>
                <div>
                    <input type="submit" value="Login" />
                </div>
            </form><!-- form -->
             <div class="button">
                <a href="forgotpass.php">Forgotten Password</a>
            </div><!-- button -->
            <div class="button">
                <a href="#">GOOGLE</a>
            </div><!-- button -->
        </section><!-- content -->
    </div><!-- container -->
</body>
</html>