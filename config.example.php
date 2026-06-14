<?php
$host = "your-db-host";
$port = 3306;
$user = "root";
$pass = "your-db-password";
$dbname = "your-db-name";

$conn = new mysqli($host, $user, $pass, $dbname, $port);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>