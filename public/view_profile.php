<?php
require_once '../config/config.php';

$message = '';
$uniqueCode = '';
$entry = null;
$docs = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $code = trim($_POST['code']);

    $stmt = $pdo->prepare("SELECT * FROM training_entries WHERE staff_email = ? AND unique_code = ?");
    $stmt->execute([$email, $code]);
    $entry = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$entry) {
        header("Location: index.php?error=notfound");
        exit;
    }

    $stmt = $pdo->prepare("SELECT * FROM supporting_docs WHERE training_entry_id = ?");
    $stmt->execute([$entry['id']]);
    $docs = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $entry['docs'] = $docs;
} else {
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Training Profile</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background-color: #f4f6f9;
      color: #1a1a1a;
    }

    .hero {
      background-color: #13296b;
      padding: 1rem 2rem;
    }

    .hero img {
      height: 50px;
    }

    .card {
      border-radius: 10px;
      box-shadow: 0 0 12px rgba(0, 0, 0, 0.05);
    }

    .form-title {
      color: #13296b;
      font-weight: 600;
      font-size: 2.25rem;
    }

    .form-label {
      font-weight: 500;
      font-size: 0.95rem;
    }

    .btn-custom {
      background-color: #13296b;
      color: white;
      font-size: 0.85rem;
      padding: 0.35rem 0.75rem;
      border-radius: 5px;
      transition: 0.2s ease-in-out;
      white-space: nowrap;
    }

    .btn-custom:hover {
      background-color: #4b95eb;
      color: white;
    }

    .back-button {
      display: inline-block;
      margin-top: 1.5rem;
      color: #13296b;
      text-decoration: none;
      font-weight: 500;
    }

    .back-button:hover {
      text-decoration: underline;
    }

    .section-title {
      margin-top: 2rem;
      color: #4b95eb;
      font-size: 1.1rem;
      font-weight: 600;
    }
    footer {
      text-align: center;
      font-size: .8rem;
      color: #777;
      padding: 0.75rem 1rem;
    }   
  </style>
</head>
<body>

<header class="hero">
  <img src="image/masthead.png" alt="DOST Logo">
</header>

<div class="container my-5">
  <?php if (!empty($entry)): ?>
    <main class="mx-auto" style="max-width: 800px;">
      <div class="card p-4">
        <h2 class="form-title text-center mb-4">Training Profile</h2>

        <!-- Personal Info -->
        <h5 class="section-title">Personal Information</h5>
        <div class="row g-3">
          <div class="col-md-6">
            <label class="form-label">Name</label>
            <input type="text" value="<?= htmlspecialchars($entry['staff_name']) ?>" class="form-control" disabled>
          </div>
          <div class="col-md-6">
            <label class="form-label">Email</label>
            <input type="text" value="<?= htmlspecialchars($entry['staff_email']) ?>" class="form-control" disabled>
          </div>
        </div>

        <!-- Training Details -->
        <h5 class="section-title">Training Details</h5>
        <div class="row g-3">
          <div class="col-md-6">
            <label class="form-label">Training Title</label>
            <input type="text" value="<?= htmlspecialchars($entry['title']) ?>" class="form-control" disabled>
          </div>
          <div class="col-md-6">
            <label class="form-label">Institution</label>
            <input type="text" value="<?= htmlspecialchars($entry['institution']) ?>" class="form-control" disabled>
          </div>
          <div class="col-md-6">
            <label class="form-label">Role</label>
            <input type="text" value="<?= htmlspecialchars($entry['role']) ?>" class="form-control" disabled>
          </div>
          <div class="col-md-6">
            <label class="form-label">Employment Type</label>
            <input type="text" value="<?= htmlspecialchars($entry['staff_type']) ?>" class="form-control" disabled>
          </div>
        </div>

        <!-- Schedule -->
        <h5 class="section-title">Training Schedule</h5>
        <div class="row g-3">
          <div class="col-md-6">
            <label class="form-label">Start Date</label>
            <input type="text" value="<?= htmlspecialchars($entry['start_date']) ?>" class="form-control" disabled>
          </div>
          <div class="col-md-6">
            <label class="form-label">End Date</label>
            <input type="text" value="<?= htmlspecialchars($entry['end_date']) ?>" class="form-control" disabled>
          </div>
          <div class="col-md-6">
            <label class="form-label">Hours</label>
            <input type="text" value="<?= htmlspecialchars($entry['hours']) ?>" class="form-control" disabled>
          </div>
        </div>

        <!-- Other Info -->
        <h5 class="section-title">Other Details</h5>
        <div class="row g-3">
          <div class="col-md-6">
            <label class="form-label">Learning & Development</label>
            <input type="text" value="<?= htmlspecialchars($entry['learning_and_development']) ?>" class="form-control" disabled>
          </div>
          <div class="col-md-6">
            <label class="form-label">Unique Code</label>
            <input type="text" value="<?= htmlspecialchars($entry['unique_code']) ?>" class="form-control" disabled>
          </div>
          <div class="col-md-6">
            <label class="form-label">Status</label>
            <input type="text" value="<?= htmlspecialchars($entry['status']) ?>" class="form-control" disabled>
          </div>
          <div class="col-md-6">
            <label class="form-label">Created At</label>
            <input type="text" value="<?= htmlspecialchars($entry['created_at']) ?>" class="form-control" disabled>
          </div>
        </div>

        <!-- Supporting Documents -->
        <h5 class="section-title">Supporting Documents</h5>
        <ul class="mt-2">
  <?php foreach ($entry['docs'] as $doc): ?>
    <li class="d-flex align-items-center gap-0 mb-1 flex-wrap">
      <span style="min-width: 90px;">Certificate:</span>
      <?php if (!empty($doc['certificate_path'])): ?>
        <a href="<?= htmlspecialchars($doc['certificate_path']) ?>" target="_blank" class="btn btn-custom btn-sm">View</a>
      <?php else: ?>
        <span class="text-muted">Not available</span>
      <?php endif; ?>
    </li>
    <li class="d-flex align-items-center gap-0 mb-1 flex-wrap">
      <span style="min-width: 90px;">Entry Plan:</span>
      <?php if (!empty($doc['plan_path'])): ?>
        <a href="<?= htmlspecialchars($doc['plan_path']) ?>" target="_blank" class="btn btn-custom btn-sm">View</a>
      <?php else: ?>
        <span class="text-muted">Not available</span>
      <?php endif; ?>
    </li>
  <?php endforeach; ?>
</ul>
        <a href="index.php?clear=1" class="back-button">Back to Home</a>
      </div>
    </main>
  <?php endif; ?>
</div>
  <footer>
    &copy; 2025 DOST X. All rights reserved.
  </footer>
</body>
</html>
