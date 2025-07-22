<?php
require_once '../config/config.php';

$message = '';
$entries = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['lookup'])) {
    $email = trim($_POST['email']);
    $code = trim($_POST['unique_code']);

    $stmt = $pdo->prepare("SELECT * FROM training_entries WHERE staff_email = ? AND unique_code = ?");
    $stmt->execute([$email, $code]);
    $entries = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (empty($entries)) {
        $message = "No matching training entries found!";
    } else {
        foreach ($entries as &$entry) {
            $stmt = $pdo->prepare("SELECT * FROM supporting_docs WHERE training_entry_id = ?");
            $stmt->execute([$entry['id']]);
            $entry['docs'] = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
    }
}

if (isset($_POST['feedback_submit'])) {
    $training_id = (int)$_POST['training_id'];
    $rating = (int)$_POST['rating'];
    $comments = trim($_POST['feedback']);

    $stmt = $pdo->prepare("INSERT INTO impact_assessments (training_entry_id, rating, feedback) VALUES (?, ?, ?)");
    $stmt->execute([$training_id, $rating, $comments]);

    $pdo->prepare("UPDATE training_entries SET status = 'Completed' WHERE id = ?")->execute([$training_id]);

    $message = "Impact feedback submitted! Thank you.";
    $entries = [];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Training Impact Assessment</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
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
      font-size: 2rem;
    }

    .form-label {
      font-weight: 500;
      font-size: 0.95rem;
    }

    .btn-custom {
      background-color: #13296b;
      color: white;
      font-size: 0.9rem;
      padding: 0.4rem 0.9rem;
      border-radius: 5px;
      transition: 0.2s ease-in-out;
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
  <main class="mx-auto" style="max-width: <?= empty($entries) ? '500px' : '800px' ?>;">
    <div class="card p-4">
      <h2 class="form-title text-center mb-4">Training Impact Assessment</h2>
      <?php if (!empty($message)): ?>
        <div class="alert alert-info text-center"> <?= htmlspecialchars($message) ?> </div>
      <?php endif; ?>

      <?php if (empty($entries)): ?>
        <form method="POST" class="needs-validation" novalidate>
          <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control" required>
            <div class="invalid-feedback">Please enter your email.</div>
          </div>
          <div class="mb-3">
            <label class="form-label">Training Entry Code</label>
            <input type="text" name="unique_code" class="form-control" required>
            <div class="invalid-feedback">Please enter your unique code.</div>
          </div>
          <button type="submit" name="lookup" class="btn btn-custom w-100">Find my Training Entry</button>
        </form>
        <a href="index.php" class="back-button">Back to Home</a>
      <?php endif; ?>

      <?php if (!empty($entries)): ?>
        <?php foreach ($entries as $entry): ?>
          <h5 class="section-title">Personal Information</h5>
          <div class="row g-3">
            <div class="col-md-6"><label class="form-label">Name</label><input type="text" value="<?= htmlspecialchars($entry['staff_name']) ?>" class="form-control" disabled></div>
            <div class="col-md-6"><label class="form-label">Email</label><input type="text" value="<?= htmlspecialchars($entry['staff_email']) ?>" class="form-control" disabled></div>
          </div>

          <h5 class="section-title">Training Details</h5>
          <div class="row g-3">
            <div class="col-md-6"><label class="form-label">Training Title</label><input type="text" value="<?= htmlspecialchars($entry['title']) ?>" class="form-control" disabled></div>
            <div class="col-md-6"><label class="form-label">Institution</label><input type="text" value="<?= htmlspecialchars($entry['institution']) ?>" class="form-control" disabled></div>
            <div class="col-md-6"><label class="form-label">Role</label><input type="text" value="<?= htmlspecialchars($entry['role']) ?>" class="form-control" disabled></div>
            <div class="col-md-6"><label class="form-label">Employment Type</label><input type="text" value="<?= htmlspecialchars($entry['staff_type']) ?>" class="form-control" disabled></div>
          </div>

          <h5 class="section-title">Training Schedule</h5>
          <div class="row g-3">
            <div class="col-md-6"><label class="form-label">Start Date</label><input type="text" value="<?= htmlspecialchars($entry['start_date']) ?>" class="form-control" disabled></div>
            <div class="col-md-6"><label class="form-label">End Date</label><input type="text" value="<?= htmlspecialchars($entry['end_date']) ?>" class="form-control" disabled></div>
            <div class="col-md-6"><label class="form-label">Hours</label><input type="text" value="<?= htmlspecialchars($entry['hours']) ?>" class="form-control" disabled></div>
          </div>

          <h5 class="section-title">Other Details</h5>
          <div class="row g-3">
            <div class="col-md-6"><label class="form-label">Learning & Development</label><input type="text" value="<?= htmlspecialchars($entry['learning_and_development']) ?>" class="form-control" disabled></div>
            <div class="col-md-6"><label class="form-label">Unique Code</label><input type="text" value="<?= htmlspecialchars($entry['unique_code']) ?>" class="form-control" disabled></div>
            <div class="col-md-6"><label class="form-label">Status</label><input type="text" value="<?= htmlspecialchars($entry['status']) ?>" class="form-control" disabled></div>
            <div class="col-md-6"><label class="form-label">Created At</label><input type="text" value="<?= htmlspecialchars($entry['created_at']) ?>" class="form-control" disabled></div>
          </div>

          <h5 class="section-title">Supporting Documents</h5>
          <ul class="mt-2">
            <?php foreach ($entry['docs'] as $doc): ?>
              <li class="mb-1">Certificate: <?php if (!empty($doc['certificate_path'])): ?><a href="<?= htmlspecialchars($doc['certificate_path']) ?>" target="_blank" class="btn btn-custom btn-sm">View</a><?php else: ?><span class="text-muted">Not available</span><?php endif; ?></li>
              <li class="mb-1">Entry Plan: <?php if (!empty($doc['plan_path'])): ?><a href="<?= htmlspecialchars($doc['plan_path']) ?>" target="_blank" class="btn btn-custom btn-sm">View</a><?php else: ?><span class="text-muted">Not available</span><?php endif; ?></li>
            <?php endforeach; ?>
          </ul>

          <h5 class="section-title">Feedback & Rating</h5>
          <form method="POST" class="mt-3">
            <input type="hidden" name="training_id" value="<?= htmlspecialchars($entry['id']) ?>">
            <div class="mb-3">
              <label class="form-label">Rating (1–5)</label>
              <input type="number" name="rating" min="1" max="5" class="form-control" required>
            </div>
            <div class="mb-3">
              <label class="form-label">Feedback</label>
              <textarea name="feedback" class="form-control" rows="3"></textarea>
            </div>
            <button type="submit" name="feedback_submit" class="btn btn-custom w-100">Submit</button>
          </form>
          <a href="index.php" class="back-button">Back to Home</a>
        <?php endforeach; ?>
      <?php endif; ?>
    </div>
  </main>
  <footer>
    &copy; 2025 DOST X. All rights reserved.
  </footer>
</div>
</body>
</html>