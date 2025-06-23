<?php
include ('database.php');
$message = '';
$id= $_GET['id'];

$select_user = "SELECT * FROM users WHERE id = '$id'";
$sql = $conn->prepare($select_user);
$sql->execute();
$data = $sql->fetchAll(PDO::FETCH_OBJ);
foreach($data as $row) 

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
               <p>Thank you for registering, <?php echo $row->user_name; ?>. You can now <a href="index.php?page=Login">login</a></p>
            </div>
        </div></div>
        <div class="col-md-4"></div>
    </div>
</div>