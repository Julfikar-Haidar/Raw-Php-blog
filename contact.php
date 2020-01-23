<?php include'inc/header.php'; ?>
<?php 

 if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $f_name = $fm->validation($_POST['f_name']);
    $l_name = $fm->validation($_POST['l_name']);
    $email = $fm->validation($_POST['email']);
    $body = $fm->validation($_POST['body']);

    $f_name = mysqli_real_escape_string($db->link, $f_name);
    $l_name = mysqli_real_escape_string($db->link, $l_name);
    $email = mysqli_real_escape_string($db->link, $email);
    $body = mysqli_real_escape_string($db->link, $body);
    
    $error="";
    if(empty($f_name)){
        $error="FirstName Must Not be Empty !";
    }elseif (empty($l_name)) {
        $error="LastName Must Not be Empty !";
    }elseif (empty($email)) {
        $error="Email Must Not be Empty !";
    }elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error="Invalid Email Address";
    }elseif (empty($body)) {
       $error="Message Field Not Empty !"; 
    }else{
        
    $query = "INSERT INTO tbl_contact(f_name,l_name,email,body) VALUES('$f_name','$l_name','$email','$body')";
    $inserted_rows = $db->insert($query);

    if ($inserted_rows) {
        $msg="Message Sent Successfully"; 
    } else {
          $error="Message Not Send!"; 
    }
    }
 }
?>


<div class="contentsection contemplete clear">
    <div class="maincontent clear">
        <div class="about">
            <h2>Contact us</h2>
            <?php 
            if(isset($error)){
                echo "<span class='error'>$error</span>";
            }
            if(isset($msg)){
                echo "<span class='success'>$msg</span>";
            }
            ?>
            <form action="" method="post">
                <table>
                    <tr>
                        <td>Your First Name:</td>
                        <td>
                            <input type="text" name="f_name" placeholder="Enter first name"/>
                        </td>
                    </tr>
                    <tr>
                        <td>Your Last Name:</td>
                        <td>
                            <input type="text" name="l_name" placeholder="Enter Last name"/>
                        </td>
                    </tr>

                    <tr>
                        <td>Your Email Address:</td>
                        <td>
                            <input type="email" name="email" placeholder="Enter Email Address" />
                        </td>
                    </tr>
                    <tr>
                        <td>Your Message:</td>
                        <td>
                            <textarea name="body"></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <input type="submit" name="submit" value="Send"/>
                        </td>
                    </tr>
                </table>
                <form>				
                    </div>

                    </div>
                    <?php include'inc/sidebar.php'; ?>
                    <?php include'inc/footer.php'; ?>