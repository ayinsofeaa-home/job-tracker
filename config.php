<?php
$host = "acela.proxy.rlwy.net";
$port = 46575;
$user = "root";
$pass = "MWMKrUDesaKhsjJwzslxFMDNmFzbShGu";
$dbname = "railway";

$conn = new mysqli($host, $user, $pass, $dbname, $port);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully!";
?>