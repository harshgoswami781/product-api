<?php
include ('database.php');
$message = '';
if (isset($_POST['submit'])) {
    $username = $_POST['yourname'];
    $useremail = $_POST['youremail'];
    $usermobile = $_POST['yourmobile'];
    $userpassword = $_POST['password'];
    $confirmpassword = $_POST['confirmpassword'];

    $encrypted_password = md5($userpassword);

    if($userpassword == $confirmpassword) {
    $sql = "INSERT INTO users (user_name, user_email, user_mobile, user_password)
      VALUES ('$username', '$useremail', '$usermobile','$encrypted_password')";
        // use exec() because no results are returned
      $conn->exec($sql); 
      $last_id = $conn->lastInsertId();

      header("Location: index.php?page=Thankyou&id=$last_id");
    } else {
        $message = 'Password & Confirm Password do not match';
    }
}
?>

  <body style="background: linear-gradient(90deg, rgba(7, 174, 234, 1.000) 0.000%, rgba(43, 245, 152, 1.000) 100.000%);">
<!-- Admin Panel HTML Codes Will Be Written Here(Starts)-->
<div class="container-fluid">
    <div class="row" style="padding-top: 5%;">
        <div class="col-md-4"></div>
        <div class="col-md-4" style="text-align: center; background-color: white; border-radius: 20px; padding: 10px;">
            <div class="row">
            <div class="col-md-12" style="padding-bottom: 10px;"></div><img src="assets/img/sewa.png" alt="Image Description" height="100"></div>
            

            <div class="col-md-12"><span style="font-size: 18px; font-weight: 100;">Register A New Account</span>
        <?php 
        if($message != '') {
            echo "<br>";
            echo "<span style='color: red;'>$message</span>";
        }
        
        ?>
        </div>
            <div class="col-md-12">
                <form method="post" action="">
                    <div class="row">
                        <div class="col-md-12" style="text-align: left; font-size: 14px; font-weight: 200; padding: 20px 20px 10px 20px;">
                            <label>Your Name</label>
                            <input type="text" name="yourname" placeholder="Userame" class="form-control">
                        </div>
                        <div class="col-md-12" style="text-align: left; font-size: 14px; font-weight: 200; padding: 10px 20px 10px 20px;">
                            <label>Your Email(Email Will Be The Username)</label>
                            <input type="email" name="youremail" placeholder="Email Id" class="form-control">
                        </div>
                        <div class="col-md-12" style="text-align: left; font-size: 14px; font-weight: 200; padding: 10px 20px 10px 20px;">
                            <label>Your Mobile</label>
                            <input type="number" name="yourmobile" placeholder="10 Digit Mobile Number" class="form-control">
                        </div>
                        <div class="col-md-12" style="text-align: left; font-size: 14px; font-weight: 200; padding: 10px 20px 10px 20px;">
                            <label>Your Password</label>
                            <input type="password" name="password" placeholder="Password" class="form-control">
                        </div>
                        <div class="col-md-12" style="text-align: left; font-size: 14px; font-weight: 200; padding: 10px 20px 10px 20px;">
                            <label>Confirm Password</label>
                            <input type="password" name="confirmpassword" placeholder="Confirm Password" class="form-control">
                        </div>
                        <div class="col-md-12" style="text-align: center; font-size: 14px; font-weight: 200; padding: 10px 20px 10px 20px;">
                            <button type="submit" class="btn btn-warning" name="submit">Register Now</button>
                        </div>
                        <div class="col-md-12" style="text-align: center; font-size: 14px; font-weight: 200; padding: 0px 20px 10px 20px;">
                            <div class="row">

                                <div class="col-md-12" style="text-align: center; font-size: 12px; font-weight: 100;"><a href="index.php" style="text-decoration: none; color: black;">Already Have An Account? Login Now</a></div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div></div>
        <div class="col-md-4"></div>
    </div>
</div>