<?php
require_once '../config/config.php';
if (!isset($_SESSION['hr_id'])) die("Access denied.");

// Fetch training entries and supporting docs
$filterType = isset($_GET['staff_type']) ? $_GET['staff_type'] : '';
$search = isset($_GET['search']) ? trim($_GET['search']) : '';

$params = [];
$where = [];

if ($filterType === 'COS' || $filterType === 'Permanent') {
    $where[] = 'te.staff_type = ?';
    $params[] = $filterType;
}
if ($search !== '') {
    $where[] = 'te.unique_code LIKE ?';
    $params[] = '%' . $search . '%';
}

$whereSql = '';
if (count($where) > 0) {
    $whereSql = 'WHERE ' . implode(' AND ', $where);
}

$sql = "
    SELECT te.*, sd.certificates, sd.entry_plan, sd.certificate_path, sd.plan_path, ia.rating, ia.feedback, ia.submitted_at
    FROM training_entries te
    LEFT JOIN supporting_docs sd ON te.id = sd.training_entry_id
    LEFT JOIN impact_assessments ia ON te.id = ia.training_entry_id
    $whereSql
    ORDER BY te.id DESC
";

$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$entries = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>HR Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
        }
        .dashboard-card {
            background:#fffff;
            border-radius: 8px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
            padding: 30px;
        }
        .header {
            background-color: #003366;
            color: #fff;
            padding: 20px;
            border-radius: 8px 8px 0 0;
            text-align: center;
            margin-bottom: 30px;
        }
        .btn-custom {
            background: #003366;
            color: #fff;
            border: none;
        }
        .btn-custom:hover {
            background: #0055aa;
        }
        .btn-download {
            background: #0055aa;
            color: #fff;
            border: none;
        }
        .btn-download:hover {
            background: #0077cc;
        }
        .custom-table thead {
            background-color: #003366;
            color: #fff;
        }
        .custom-table th, .custom-table td {
            vertical-align: middle;
        }
        .custom-table-header {
            background-color: #003366 !important;
            color: #fff !important;
        }
    </style>
</head>
<body class="bg-light">
<div class="container my-5">
    <div class="dashboard-card">
        <div class="header">
            <h2>HR Dashboard</h2>
        </div>
        <p class="text-center mb-4">
            <a href="export.php" class="btn btn-download btn-sm me-2">Download CSV</a>
            <a href="hr_logout.php" class="btn btn-custom btn-sm">Logout</a>
        </p>

        <form method="GET" class="mb-3 text-center">
            <label for="typeFilter" class="me-2">Filter by Employment Type:</label>
            <select name="staff_type" id="typeFilter" class="form-select d-inline-block w-auto">
                <option value="">Show All</option>
                <option value="COS" <?= (isset($_GET['staff_type']) && $_GET['staff_type'] === 'COS') ? 'selected' : '' ?>>COS</option>
                <option value="Permanent" <?= (isset($_GET['staff_type']) && $_GET['staff_type'] === 'Permanent') ? 'selected' : '' ?>>Permanent</option>
            </select>
            <div class="d-flex justify-content-center align-items-center gap-2 mb-4">
                <input type="text" name="search" class="form-control w-auto" placeholder="Search Unique Code..." value="<?= htmlspecialchars($_GET['search'] ?? '') ?>" />
                <button type="submit" class="btn btn-custom search-btn" >Search</button>
            </div>
        </form>
        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle custom-table">
                <thead class="custom-table-header text-center">
                    <tr>
                        <th>Name of Trainee</th>
                        <th>Unique Code</th>
                        <th>Email</th>
                        <th>Training Title</th>
                        <th>Role</th>
                        <th>Employment Type</th>
                        <th>Dates</th>
                        <th>Hours</th>
                        <th>Training Type</th>
                        <th>Institution</th>
                        <th>Date Created</th>
                        <th>Status</th>
                        <th>Reminder Sent</th>
                        <th>Certificate</th>
                        <th>Entry Plan</th>
                        <th>Rating</th>
                        <th>Feedback</th>
                        <th>Date Of Submission</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    <?php foreach ($entries as $e): ?>
                        <tr>
                            <td><?= htmlspecialchars($e['staff_name']) ?></td>
                            <td><?= htmlspecialchars($e['unique_code']) ?></td>
                            <td><?= htmlspecialchars($e['staff_email']) ?></td>
                            <td><?= htmlspecialchars($e['title']) ?></td>
                            <td><?= htmlspecialchars($e['role']) ?></td>
                            <td><?= htmlspecialchars($e['staff_type']) ?></td>
                            <td><?= htmlspecialchars($e['start_date']) ?> to <?= htmlspecialchars($e['end_date']) ?></td>
                            <td><?= htmlspecialchars($e['hours']) ?></td>
                            <td><?= htmlspecialchars($e['learning_and_development']) ?></td>
                            <td><?= htmlspecialchars($e['institution']) ?></td>
                            <td><?= htmlspecialchars($e['created_at']) ?></td>
                            <td><?= htmlspecialchars($e['status']) ?></td>
                            <td>
                                <?= $e['reminder_sent'] ? '✅ Sent' : '❌ Not Sent' ?>
                            </td>
                            <td>
                                <?php if ($e['certificate_path']): ?>
                                    <a href="<?= htmlspecialchars($e['certificate_path']) ?>" target="_blank" class="btn btn-custom btn-sm">View</a>
                                <?php else: ?>
                                    No file
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if ($e['plan_path']): ?>
                                    <a href="<?= htmlspecialchars($e['plan_path']) ?>" target="_blank" class="btn btn-custom btn-sm">View</a>
                                <?php else: ?>
                                    No file
                                <?php endif; ?>
                            </td>
                            <td><?= htmlspecialchars($e['rating'] ?? 'N/A') ?></td>
                            <td><?= htmlspecialchars($e['feedback'] ?? 'No feedback') ?></td>
                            <td><?= htmlspecialchars($e['submitted_at'] ?? 'N/A') ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<script src="function.js"></script>
</body>
</html>
