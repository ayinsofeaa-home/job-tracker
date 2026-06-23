<?php
require 'config.php';

$id = $_GET['id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $stmt = $pdo->prepare("UPDATE applications SET company=?, role=?, status=?, date_applied=?, deadline=?, notes=? WHERE id=?");
    $stmt->execute([
        $_POST['company'],
        $_POST['role'],
        $_POST['status'],
        $_POST['date_applied'],
        $_POST['deadline'],
        $_POST['notes'],
        $id
    ]);
    header("Location: index.php");
    exit;
}

$stmt = $pdo->prepare("SELECT * FROM applications WHERE id=?");
$stmt->execute([$id]);
$row = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Edit Application</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Edit Application</h1>
    <div class="form-container">
        <form method="POST">
            <label>Company:</label>
            <input type="text" name="company" value="<?= htmlspecialchars($row['company']) ?>" required><br><br>

            <label>Role:</label>
            <input type="text" name="role" value="<?= htmlspecialchars($row['role']) ?>" required><br><br>

            <label>Status:</label>
            <select name="status">
                <?php foreach (['Applied','Interview','Offer','Rejected'] as $opt): ?>
                    <option value="<?= $opt ?>" <?= $row['status']==$opt ? 'selected' : '' ?>><?= $opt ?></option>
                <?php endforeach; ?>
            </select><br><br>

            <label>Date Applied:</label>
            <input type="date" name="date_applied" value="<?= $row['date_applied'] ?>"><br><br>

            <label>Deadline:</label>
            <input type="date" name="deadline" value="<?= $row['deadline'] ?>"><br><br>

            <label>Notes:</label>
            <textarea name="notes"><?= htmlspecialchars($row['notes']) ?></textarea><br><br>

            <button type="submit">Update</button>
        </form>
    </div>
    <br>
    <a href="index.php">Back to list</a>
</body>
</html>
