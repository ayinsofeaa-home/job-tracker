<?php
require 'config.php';

$id = $_GET['id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $company = $_POST['company'];
    $role = $_POST['role']; 
    $status = $_POST['status'];
    $date_applied = $_POST['date_applied'];
    $deadline = $_POST['deadline'];
    $notes = $_POST['notes'];

    $stmt = $conn->prepare("UPDATE applications SET company=?, role=?, status=?, date_applied=?, deadline=?, notes=? WHERE id=?");
    $stmt->bind_param("ssssssi", $company, $role, $status, $date_applied, $deadline, $notes, $id);
    $stmt->execute();

    header("Location: index.php");
    exit;
}

$stmt = $conn->prepare("SELECT * FROM applications WHERE id=?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="style.css">
    <title>Edit Application</title> 
</head>
<body>  
    <h1>Edit Application</h1>
    <div class="form-container">
    <form method="POST">
        <label>Company:</label><br>
        <input type="text" name="company" value="<?= htmlspecialchars($row['company']) ?>" required><br><br>

        <label>Role:</label><br>
        <input type="text" name="role" value="<?= htmlspecialchars($row['role']) ?>" required><br><br>

        <label>Status:</label><br>
        <select name="status" required>
            <option value="Applied" <?= $row['status'] == 'Applied' ? 'selected' : '' ?>>Applied</option>
            <option value="Interview" <?= $row['status'] == 'Interview' ? 'selected' : '' ?>>Interviewing</option>
            <option value="Offer" <?= $row['status'] == 'Offer' ? 'selected' : '' ?>>Offered</option>
            <option value="Rejected" <?= $row['status'] == 'Rejected' ? 'selected' : '' ?>>Rejected</option>
        </select><br><br>

        <label>Date Applied:</label><br>
        <input type="date" name="date_applied" value="<?= htmlspecialchars($row['date_applied']) ?>" required><br><br>

        <label>Deadline:</label><br>
        <input type="date" name="deadline" value="<?= htmlspecialchars($row['deadline']) ?>"><br><br>

        <label>Notes:</label><br>
        <textarea name="notes"><?= htmlspecialchars($row['notes']) ?></textarea><br><br>

        <button type="submit">Update Application</button> 
    </form>
    </div>
    <br>
    <a href="index.php">Back to List</a>
</body>
</html>
