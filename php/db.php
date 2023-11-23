<?php

$servername = "localhost";
$username = "root";
$password = "unknown@123";
$dbname = "user_authentication_mysqldb";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>