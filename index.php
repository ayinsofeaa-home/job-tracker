<?php
require 'config.php';

$filter = $_GET['status'] ?? '';

if ($filter && in_array($filter, ['Applied','Interview','Offer','Rejected'])) {
    $stmt = $conn->prepare("SELECT * FROM applications WHERE status=? ORDER BY id DESC");
    $stmt->bind_param("s", $filter);
    $stmt->execute();
    $result = $stmt->get_result();
} else {
    $result = $conn->query("SELECT * FROM applications ORDER BY id DESC");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="style.css">
    <title>Job Tracker</title>
</head>
<body>
    <h1>Job Applications</h1>
    <a href="add.php">Add New Application</a>
    <form method="GET">
        <label for="status">Filter by Status:</label>
        <select name="status" id="status">
            <option value="">All</option>
            <option value="Applied" <?= $filter === 'Applied' ? 'selected' : '' ?>>Applied</option>
            <option value="Interview" <?= $filter === 'Interview' ? 'selected' : '' ?>>Interviewing</option>
            <option value="Offer" <?= $filter === 'Offer' ? 'selected' : '' ?>>Offered</option>
            <option value="Rejected" <?= $filter === 'Rejected' ? 'selected' : '' ?>>Rejected</option>
        </select>
        <button type="submit">Filter</button>
    </form>
    <table border="1" cellpadding="10">
        <tr>
            <th>Company</th>
            <th>Role</th>
            <th>Status</th>
            <th>Date Applied</th>
            <th>Deadline</th>
            <th>Notes</th>
            <th>Actions</th>
        </tr>
        <?php if ($result->num_rows === 0): ?>
            <tr><td colspan="7">No applications found.</td></tr>
        <?php else: ?>
            <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= htmlspecialchars($row['company']) ?></td>
                <td><?= htmlspecialchars($row['role']) ?></td>
                <td><span class="status-<?= $row['status'] ?>"><?= htmlspecialchars($row['status']) ?></span></td>
                <td><?= htmlspecialchars($row['date_applied']) ?></td>
                <td><?= htmlspecialchars($row['deadline']) ?></td>
                <td><?= htmlspecialchars($row['notes']) ?></td>
                <td>
                    <a href="edit.php?id=<?= $row['id'] ?>">Edit</a> |
                    <a href="delete.php?id=<?= $row['id'] ?>">Delete</a>
                </td>
            </tr>
            <?php endwhile; ?>
        <?php endif; ?>
    </table>

    <?php $conn->close(); ?>
</body>
</html>