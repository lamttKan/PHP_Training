<?php
$servername = "localhost";
$username = "lamlam";
$password = "123";
$dbname = 'arsenalsquad';
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";
?>