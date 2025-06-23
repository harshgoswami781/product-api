<?php

include ('database.php');
$message = '';

if (isset($_POST['submit'])) {
    $useremail = $_POST['useremail'] ?? '';
    $userpassword = $_POST['password'] ?? '';
    $encrypted_password = md5($userpassword); // Encrypt using MD5

    // Validate email and password are not empty
    if (!empty($useremail) && !empty($userpassword)) {
        // Use parameterized query to prevent SQL injection
        $select_user = "SELECT * FROM users WHERE user_email = :email AND user_password = :password LIMIT 1";
        $sql = $conn->prepare($select_user);
        $sql->bindParam(':email', $useremail);
        $sql->bindParam(':password', $encrypted_password); // ✅ Use the encrypted version
        $sql->execute();

        $row = $sql->fetch(PDO::FETCH_OBJ); // Single user object

        if ($row) {
            // Login successful
            $_SESSION['session_id'] = $row->id;
            $_SESSION['session_name'] = $row->user_name;
            $_SESSION['session_email'] = $row->user_email;
            $_SESSION['session_mobile'] = $row->user_mobile;

            header("Location: index.php?page=Dashboard");
            exit();
        } else {
            $message = "Invalid email or password.";
        }
    } else {
        $message = "Please enter both email and password.";
    }
}
?>





<body>
<!-- Admin Panel HTML Codes Will Be Written Here(Starts)-->
<div class="container-fluid">
<div class="row" style="padding-top: 10%;">
<div class="col-md-4"></div>
<div class="col-md-4" style="text-align: center; background-color: white; border-radius: 20px; padding: 10px;">
<div class="row">
<div class="col-md-12" style="padding-bottom: 10px;"></div><img src="assets/img/sewa.png" alt="Image Description" height="100"></div>


<div class="col-md-12"><span style="font-size: 18px; font-weight: 100;">Login To Your Account</span></div>
<div class="col-md-12">
<form method="POST">
<div class="row">
<div class="col-md-12" style="text-align: left; font-size: 14px; font-weight: 200; padding: 20px 20px 10px 20px;">
<label>Your Email</label>
<input type="email" name="useremail" placeholder="Email" class="form-control">
</div>
<div class="col-md-12" style="text-align: left; font-size: 14px; font-weight: 200; padding: 20px 20px 10px 20px;">
<label>Your Password</label>
<input type="password" name="password" placeholder="Password" class="form-control">
</div>
<div class="col-md-12" style="text-align: center; font-size: 14px; font-weight: 200; padding: 20px 20px 10px 20px;">
<!--
<a href="index.php?page=Authenticate" class="btn btn-warning">Login Now</a>
-->
<button name="submit" class="btn btn-warning">Login Now</button>
</div>
<div class="col-md-12" style="text-align: center; font-size: 14px; font-weight: 200; padding: 0px 20px 10px 20px;">
<div class="row">
<div class="col-md-6" style="text-align: left; font-size: 12px; font-weight: 100;"><a href="index.php?page=Register" style="text-decoration: none; color: black;">No Account? Register Now</a></div>
<div class="col-md-6" style="text-align: right; font-size: 12px; font-weight: 100;"><a href="index.php?page=ForgotPassword" style="text-decoration: none; color: black;">Forgot Password?</a></div>
</div>
</div>
</div>
</form>
</div>
</div></div>
<div class="col-md-4"></div>
</div>
</div>

