<?php
require_once '../config/config.php';

if (!isset($_SESSION['hr_id'])) die("Access denied.");

if (isset($_GET['action'], $_GET['id'])) {
    $id = (int)$_GET['id'];
    $new_status = $_GET['action'] === 'approve' ? 'Approved' : 'Rejected';
    $stmt = $pdo->prepare("UPDATE training_entries SET status = ? WHERE id = ?");
    $stmt->execute([$new_status, $id]);
    header('Location: hr_dashboard.php');
    exit;
}

$stmt = $pdo->query("
    SELECT te.*, sd.file_name, sd.file_path
    FROM training_entries te
    LEFT JOIN supporting_docs sd ON te.id = sd.training_entry_id
    ORDER BY te.id DESC
");
$entries = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>HR Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
    <h2>HR Dashboard</h2>
    <p>
        <a href="export.php" class="btn btn-success btn-sm">Download CSV</a>
        <a href="hr_logout.php" class="btn btn-danger btn-sm">Logout</a>
    </p>

    <table class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th>Name</th><th>Email</th><th>Type</th><th>Title</th>
                <th>Dates</th><th>Hours</th><th>Institution</th>
                <th>Status</th><th>Proof</th><th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($entries as $e): ?>
                <tr>
                    <td><?= htmlspecialchars($e['staff_name']) ?></td>
                    <td><?= htmlspecialchars($e['staff_email']) ?></td>
                    <td><?= htmlspecialchars($e['staff_type']) ?></td>
                    <td><?= htmlspecialchars($e['title']) ?></td>
                    <td><?= htmlspecialchars($e['start_date']) ?> to <?= htmlspecialchars($e['end_date']) ?></td>
                    <td><?= htmlspecialchars($e['hours']) ?></td>
                    <td><?= htmlspecialchars($e['institution']) ?></td>
                    <td><?= htmlspecialchars($e['status']) ?></td>
                    <td>
                        <?php if ($e['file_path']): ?>
                            <a href="<?= htmlspecialchars($e['file_path']) ?>" target="_blank">View</a>
                        <?php endif; ?>
                    </td>
                    <td>
                        <?php if ($e['status'] === 'Pending'): ?>
                            <a href="?action=approve&id=<?= $e['id'] ?>" class="btn btn-success btn-sm">Approve</a>
                            <a href="?action=reject&id=<?= $e['id'] ?>" class="btn btn-danger btn-sm">Reject</a>
                        <?php else: ?> - <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
</body>
</html>
