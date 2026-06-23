<?php
require 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $stmt = $pdo->prepare("INSERT INTO applications (company, role, status, date_applied, deadline, notes) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->execute([
        $_POST['company'],
        $_POST['role'],
        $_POST['status'],
        $_POST['date_applied'],
        $_POST['deadline'],
        $_POST['notes']
    ]);
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Add Application</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Add New Application</h1>
    <div class="form-container">
        <form method="POST">
            <label>Company:</label>
            <input type="text" name="company" required><br><br>

            <label>Role:</label>
            <input type="text" name="role" required><br><br>

            <label>Status:</label>
            <select name="status">
                <option value="Applied">Applied</option>
                <option value="Interview">Interview</option>
                <option value="Offer">Offer</option>
                <option value="Rejected">Rejected</option>
            </select><br><br>

            <label>Date Applied:</label>
            <input type="date" name="date_applied"><br><br>

            <label>Deadline:</label>
            <input type="date" name="deadline"><br><br>

            <label>Notes:</label>
            <textarea name="notes"></textarea><br><br>

            <button type="submit">Add Application</button>
        </form>
    </div>
    <br>
    <a href="index.php">Back to list</a>
</body>
</html>
