<?php
$host = "thomas.proxy.rlwy.net";
$port = 54407;
$user = "root";
$pass = "fMhVmKLZfrxfAfcMOwOSXoMiSpziLMKZ";
$dbname = "railway";

$conn = new mysqli($host, $user, $pass, $dbname, $port);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>