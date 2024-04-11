<?php

$localhost = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "ecommerce_db";

// db connection
$conn = new mysqli($localhost, $username, $password, $dbname);

// check connection
if ($conn->connect_error) {
  die("Connection Failed : " . $conn->connect_error);
} else {
  // echo "Successfully connected";
}

?>