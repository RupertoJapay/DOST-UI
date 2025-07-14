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
<html>
<head>
    <meta charset="UTF-8" />
    <title>Training Impact Assessment - Phase 2</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="style.css"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="upload-page">

<!-- ✅ Consistent header like upload.php -->
<header class="hero">
    <img src="image/masthead.png" alt="DOST Logo" />
</header>

<div class="container mt-5">
<?php if (!empty($message)): ?>
    <div class="alert alert-info">
        <?= htmlspecialchars($message) ?>
    </div>
<?php endif; ?>

<?php if (empty($entries)): ?>
    <!-- ✅ Match spacing and layout -->
    <main class="upload-main container">
        <div class="card phase1-card">
            <h2 class="form-title">Find Your Training Entry</h2>
            <form method="POST" class="mb-4" id="lookupForm" novalidate>
                <label>Email:</label>
                <input type="email" name="email" class="form-control" required>
                <div class="invalid-feedback">Please enter your email.</div>

                <label>Training Entry Code:</label>
                <input type="text" name="unique_code" class="form-control" required>
                <div class="invalid-feedback">Please enter your unique code.</div>

                <button type="submit" name="lookup" class="custom-submit btn btn-primary mt-3">Find my Training Entry</button>
            </form>
            <a href="index.php" class="back-button">Back to Home</a>
        </div>
    </main>
<?php endif; ?>

<?php if (!empty($entries)): ?>
    <main class="upload-main container">
        <div class="card phase1-card">
            <div class="card-body">
                <h2 class="form-title text-center mb-4">Training Profile</h2>
                <?php foreach ($entries as $entry): ?>
                    <div class="mb-4 border-bottom pb-4">
                        <div class="row g-3">
                            <?php foreach ([
                                'staff_name' => 'Name',
                                'staff_email' => 'Email',
                                'title' => 'Training Title',
                                'role' => 'Role',
                                'staff_type' => 'Employment Type',
                                'start_date' => 'Start Date',
                                'end_date' => 'End Date',
                                'hours' => 'Hours',
                                'learning_and_development' => 'Learning and Development',
                                'institution' => 'Institution',
                                'unique_code' => 'Unique Code',
                                'status' => 'Status',
                                'created_at' => 'Created At'
                            ] as $field => $label): ?>
                                <div class="col-md-6">
                                    <label class="form-label"><?= $label ?></label>
                                    <input type="text" value="<?= htmlspecialchars($entry[$field]) ?>" class="form-control" disabled>
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <div class="mt-3">
                            <?php if (!empty($entry['docs'])): ?>
                                <p><strong>Documents:</strong></p>
                                <ul>
                                    <?php foreach ($entry['docs'] as $doc): ?>
                                        <li>
                                            Certificate:
                                            <?php if (!empty($doc['certificate_path'])): ?>
                                                <a href="<?= htmlspecialchars($doc['certificate_path']) ?>" target="_blank" class="btn btn-custom btn-sm">View</a>
                                            <?php else: ?>
                                                Not available
                                            <?php endif; ?>
                                        </li>
                                        <li>
                                            Entry Plan:
                                            <?php if (!empty($doc['plan_path'])): ?>
                                                <a href="<?= htmlspecialchars($doc['plan_path']) ?>" target="_blank" class="btn btn-custom btn-sm">View</a>
                                            <?php else: ?>
                                                Not available
                                            <?php endif; ?>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            <?php else: ?>
                                <p>No supporting documents available.</p>
                            <?php endif; ?>
                        </div>
                        <form method="POST" class="mt-3">
                            <input type="hidden" name="training_id" value="<?= htmlspecialchars($entry['id']) ?>">
                            <div class="mb-3">
                                <label class="form-label">Rating (1–5)</label>
                                <input type="number" name="rating" min="1" max="5" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Feedback</label>
                                <textarea name="feedback" class="form-control"></textarea>
                            </div>
                            <button type="submit" name="feedback_submit" class="custom-submit">Submit</button>
                        </form>
                        <a href="javascript:history.back()" class="back-button mt-3">Back</a>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </main>
<?php endif; ?>

<script src="function.js"></script>
</body>
</html>
