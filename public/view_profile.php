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
    <link rel="stylesheet" href="style.css"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="upload-page">

<header class="hero">
    <img src="image/masthead.png" alt="DOST Logo" />
</header>

<div class="container mt-5">
    <?php if (!empty($entry)): ?>
        <main class="upload-main container">
            <div class="card phase1-card">
                <div class="card-body">
                    <h2 class="form-title text-center mb-4">Training Profile</h2>
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
                    <div class="mt-4">
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
                    </div>
                    <a href="index.php" class="back-button mt-3">Back to Home</a>
                </div>
            </div>
        </main>
    <?php endif; ?>
</div>

<script src="function.js"></script>
</body>
</html>
