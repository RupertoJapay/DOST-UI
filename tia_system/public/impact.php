<?php
require_once '../config/config.php';

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $training_id = (int)$_POST['training_id'];
    $rating = (int)$_POST['rating'];
    $comments = trim($_POST['comments']);

    $stmt = $pdo->prepare("INSERT INTO impact_assessments 
        (training_entry_id, rating, comments) VALUES (?, ?, ?)");
    $stmt->execute([$training_id, $rating, $comments]);

    $message = "Impact feedback submitted!";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Submit Impact Feedback</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
    <div class="card mx-auto" style="max-width: 500px;">
        <div class="card-body">
            <h3 class="card-title mb-3">Impact Feedback</h3>
            <?php if ($message) echo "<div class='alert alert-success'>$message</div>"; ?>
            <form method="POST">
                <div class="mb-3">
                    <label class="form-label">Training Entry ID</label>
                    <input type="number" name="training_id" class="form-control" required>
                    <small class="text-muted">Ask HR for your training ID.</small>
                </div>
                <div class="mb-3">
                    <label class="form-label">Rating (1-5)</label>
                    <input type="number" name="rating" min="1" max="5" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Comments</label>
                    <textarea name="comments" class="form-control"></textarea>
                </div>
                <button type="submit" class="btn btn-primary w-100">Submit Feedback</button>
            </form>
        </div>
    </div>
</div>
</body>
</html>
