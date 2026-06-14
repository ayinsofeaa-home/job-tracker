<?php
require 'config.php';

$id = $_GET['id'];

$stmt = $conn->prepare("DELETE FROM applications WHERE id=?");
$stmt->bind_param("i", $id);    
$stmt->execute();

header("Location: index.php");
exit;
?>