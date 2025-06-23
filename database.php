<?php
$servername = "sql101.infinityfree.com";
$username = "if0_39263982";
$password = "YR7Nv1t3RkgL6HN";
$dataset = "if0_39263982_sewa_app";

try {
  $conn = new PDO("mysql:host=$servername;dbname=$dataset", $username, $password);
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 // echo "Connected successfully";
} catch(PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}
?>
