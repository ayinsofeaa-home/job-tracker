<?php
require 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $company = $_POST['company'];
    $role = $_POST['role']; 
    $status = $_POST['status'];
    $date_applied = $_POST['date_applied'];
    $deadline = $_POST['deadline'];
    $notes = $_POST['notes'];

    $stmt = $conn->prepare("INSERT INTO applications (company, role, status, date_applied, deadline, notes) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $company, $role, $status, $date_applied, $deadline, $notes);
    $stmt->execute();

    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="style.css">
    <title>Add Application</title>  
</head>
<body>
    <h1>Add New Application</h1>
    <div class="form-container">
    <form method="POST">
        <label>Company:</label><br>
        <input type="text" name="company" required><br><br>

        <label>Role:</label><br>
        <input type="text" name="role" required><br><br>

        <label>Status:</label><br>
        <select name="status" required>
            <option value="Applied">Applied</option>
            <option value="Interview">Interviewing</option>
            <option value="Offer">Offered</option>
            <option value="Rejected">Rejected</option>
        </select><br><br>

        <label>Date Applied:</label><br>
        <input type="date" name="date_applied" required><br><br>

        <label>Deadline:</label><br>
        <input type="date" name="deadline"><br><br>

        <label>Notes:</label><br>
        <textarea name="notes"></textarea><br><br>

        <button type="submit">Add Application</button> 
    </form>
    </div>
    <br>
    <a href="index.php">Back to List</a>
</body>
</html>
