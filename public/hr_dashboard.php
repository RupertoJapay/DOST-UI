<?php
require_once '../config/config.php';
if (!isset($_SESSION['hr_id'])) die("Access denied.");

// Fetch training entries and supporting docs
$filterType = isset($_GET['staff_type']) ? $_GET['staff_type'] : '';
$status = isset($_GET['status']) ? $_GET['status'] : '';
$search = isset($_GET['search']) ? trim($_GET['search']) : '';

$params = [];
$where = [];

if ($filterType === 'COS' || $filterType === 'Permanent') {
    $where[] = 'te.staff_type = ?';
    $params[] = $filterType;
}
if ($status === 'Pending' || $status === 'Completed') {
    $where[] = 'te.status = ?';
    $params[] = $status;
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
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>HR Dashboard</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <style>
    :root {
      --primary: #13296b;
      --accent: #4b95eb;
      --muted: #6c757d;
    }

    html, body {
      margin: 0;
      padding: 0;
      min-height: 100vh;
      font-family: 'Segoe UI', sans-serif;
      background: linear-gradient(145deg, #e6ecf7, #ffffff);
      overflow-x: hidden;
    }

    .hero {
      background-color: var(--primary);
      height: 80px;
      display: flex;
      align-items: center;
      padding: 0 1.5rem;
      box-shadow: 0 4px 12px rgba( 0, 0, 0, 0.1 );
    }

    .hero img {
      max-height: 50px;
    }

    .page-title {
      margin-top: 1.5rem;
      margin-bottom: 0rem;
    }

    .page-title h2 {
      color: var(--primary);
      font-weight: 600;
      margin-bottom: 0.25rem;
    }

    .btn-custom {
      background-color: var(--primary);
      color: #fff;
      border: none;
      border-radius: 6px;
      padding: 4px 12px;
      font-size: 0.875rem;
      transition: 0.3s ease;
    }

    .btn-custom:hover {
      background-color: var(--accent);
      color: #ffffff;
    }

    .section {
      margin-bottom: 1rem;
    }

    .filter-card,
    .table-card {
      background-color: #ffffff;
      border-radius: 5px;
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
      padding: 1.25rem;
    }

    .custom-table {
      font-size: 0.75rem;
      table-layout: auto;
      width: 100%;
      min-width: 1200px;          /* Ensures table is wide enough for scroll */
    }

    .custom-table thead {
      background-color: var(--primary);
      color: #fff;
    }

    .custom-table th,
    .custom-table td {
      vertical-align: middle;
      padding: 12px 18px;         /* Balanced spacing */
      white-space: nowrap;        /* Prevents text from wrapping */
      text-overflow: ellipsis;    /* Shows ... if text is too long */
      overflow: hidden;           /* Hides overflow text */
      max-width: 220px;           /* Prevents columns from getting too wide */
      text-align: center;
      font-size: 1rem;
      background: #fff;
      color: #222;
    }

    .custom-table th {
      position: sticky;
      top: 0;
      z-index: 2;
      background-color: var(--primary);
      color: #fff;
      font-size: 1.05rem;
      font-weight: 600;
      letter-spacing: 0.5px;
      box-shadow: 0 2px 4px rgba(19,41,107,0.04);
    }

    .custom-table tr {
      border-bottom: 1px solid #e0e0e0;
      transition: background 0.2s;
    }

    .custom-table tbody tr:hover {
      background: #f3f7fb;
    }

    .top-buttons {
      display: flex;
      justify-content: flex-end;
      gap: 0.5rem;
      margin-top: 0rem;
      margin-bottom: 0.5rem;
    }

    .filter-card .form-select,
    .filter-card .form-control,
    .filter-card .btn {
      font-size: 0.875rem;
      padding: 0.375rem 0.75rem;
      height: 2.5rem;
    }

    .table-responsive {
      max-height: 70vh;
      overflow-y: auto;
      overflow-x: auto;
      min-width: 100%;
    }

    @media (max-width: 768px) {
      .custom-table {
        font-size: 0.65rem;
      }

      .custom-table th,
      .custom-table td {
        padding: 8px 6px;
        font-size: 0.85rem;
        max-width: 120px;
      }

      .filter-card .form-label {
        font-size: 0.8rem;
      }

      .top-buttons {
        flex-direction: column;
        align-items: flex-start;
      }
    }
  </style>
</head>
<body>
  <!-- Top Header -->
  <header class="hero">
    <img src="image/masthead.png" alt="DOST Logo">
  </header>

  <div class="container">
    <!-- Page Title -->
    <div class="page-title">
      <div class="row align-items-center">
        <div class="col-md-6">
          <h2>HR Dashboard</h2>
          <p class="text-muted">DOST X – Training Impact Assessment Portal</p>
        </div>
        <div class="col-md-6 text-md-end top-buttons">
          <a href="export.php" class="btn btn-custom">Download</a>
          <a href="hr_logout.php" class="btn btn-outline-secondary btn-sm">Logout</a>
        </div>
      </div>
    </div>

    <!-- Filter Section -->
    <div class="filter-card mb-3">
      <form method="GET">
        <div class="row g-2 align-items-end">
          <div class="col-md-3">
            <label for="typeFilter" class="form-label">Employment Type</label>
            <select name="staff_type" id="typeFilter" class="form-select">
              <option value="">Show All</option>
              <option value="COS" <?= (isset($_GET['staff_type']) && $_GET['staff_type'] === 'COS') ? 'selected' : '' ?>>COS</option>
              <option value="Permanent" <?= (isset($_GET['staff_type']) && $_GET['staff_type'] === 'Permanent') ? 'selected' : '' ?>>Permanent</option>
            </select>
          </div>
          <div class="col-md-3">
            <label for="statusFilter" class="form-label">Status</label>
            <select name="status" id="statusFilter" class="form-select">
              <option value="">Show All</option>
              <option value="Pending" <?= (isset($_GET['status']) && $_GET['status'] === 'Pending') ? 'selected' : '' ?>>Pending</option>
              <option value="Completed" <?= (isset($_GET['status']) && $_GET['status'] === 'Completed') ? 'selected' : '' ?>>Completed</option>
            </select>
          </div>
          <div class="col-md-4">
            <label for="search" class="form-label">Search Unique Code</label>
            <input type="text" name="search" class="form-control" placeholder="e.g. ABC123" value="<?= htmlspecialchars($_GET['search'] ?? '') ?>" />
          </div>
          <div class="col-md-2">
            <label class="form-label d-block">&nbsp;</label>
            <button type="submit" class="btn btn-custom w-100">Search</button>
          </div>
        </div>
      </form>
    </div>

    <!-- Table Section -->
    <div class="section table-card">
      <div class="table-responsive">
        <table class="table table-bordered table-hover align-middle custom-table">
          <thead>
            <tr>
              <th>Name</th>
              <th>Code</th>
              <th>Email</th>
              <th>Training</th>
              <th>Role</th>
              <th>Type</th>
              <th>Dates</th>
              <th>Hours</th>
              <th>Training Type</th>
              <th>Institution</th>
              <th>Created</th>
              <th>Status</th>
              <th>Reminder</th>
              <th>Certificate</th>
              <th>Entry Plan</th>
              <th>Rating</th>
              <th>Feedback</th>
              <th>Submitted</th>
            </tr>
          </thead>
          <tbody>
            <?php if (count($entries) === 0): ?>
              <tr>
                <td colspan="18" class="text-center text-muted">No code found</td>
              </tr>
            <?php else: ?>
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
                  <td><?= $e['reminder_sent'] ? '✅' : '❌' ?></td>
                  <td>
                    <?php if ($e['certificate_path']): ?>
                      <a href="<?= htmlspecialchars($e['certificate_path']) ?>" target="_blank">View</a>
                    <?php else: ?>No file<?php endif; ?>
                  </td>
                  <td>
                    <?php if ($e['plan_path']): ?>
                      <a href="<?= htmlspecialchars($e['plan_path']) ?>" target="_blank">View</a>
                    <?php else: ?>No file<?php endif; ?>
                  </td>
                  <td><?= htmlspecialchars($e['rating'] ?? 'N/A') ?></td>
                  <td><?= htmlspecialchars($e['feedback'] ?? 'No feedback') ?></td>
                  <td><?= htmlspecialchars($e['submitted_at'] ?? 'N/A') ?></td>
                </tr>
              <?php endforeach; ?>
            <?php endif; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <script src="function.js"></script>
</body>
</html>
