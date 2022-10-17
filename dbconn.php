<?php
$servername = "mysql.db.mdbgo.com";
$username = "thxnura_admin";
$password = "Admin123*";
$dbname = "thxnura_exco";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
} else {
  echo "Connected successfully";
}

?>