<?php
$servername = "localhost";
$username = "root";
$password = "";
$dataset = "flutter-php";

try {
  $conn = new PDO("mysql:host=$servername;dbname=$dataset", $username, $password);
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 // echo "Connected successfully";
} catch(PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}
?>
