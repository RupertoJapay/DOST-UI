<?php
require_once '../config/config.php';

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get main entry info
    $staff_name = trim($_POST['staff_name']);
    $staff_email = trim($_POST['staff_email']);
    $staff_type = trim($_POST['staff_type']);
    $title = trim($_POST['title']);
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $hours = $_POST['hours'];
    $institution = trim($_POST['institution']);

    // Insert main entry first
    $stmt = $pdo->prepare("INSERT INTO training_entries 
        (staff_name, staff_email, staff_type, title, start_date, end_date, hours, institution) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->execute([$staff_name, $staff_email, $staff_type, $title, $start_date, $end_date, $hours, $institution]);
    $training_entry_id = $pdo->lastInsertId();

    // Handle file upload
    $fileName = $_FILES['file']['name'];
    $fileTmp = $_FILES['file']['tmp_name'];
    $destination = 'uploads/' . uniqid() . '_' . basename($fileName);

    if (move_uploaded_file($fileTmp, $destination)) {
        // Save supporting doc linked to entry
        $stmt = $pdo->prepare("INSERT INTO supporting_docs 
            (training_entry_id, file_name, file_path) VALUES (?, ?, ?)");
        $stmt->execute([$training_entry_id, $fileName, $destination]);

        $message = "Upload successful!";
    } else {
        $message = "File upload failed.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Upload Training (Normalized)</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
    <div class="card mx-auto" style="max-width: 600px;">
        <div class="card-body">
            <h3 class="card-title mb-4">Staff Training Upload</h3>
            <?php if ($message) echo "<div class='alert alert-info'>$message</div>"; ?>
            <form method="POST" enctype="multipart/form-data">
                <div class="mb-3">
                    <label class="form-label">Name</label>
                    <input type="text" name="staff_name" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="staff_email" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Type (Faculty/Staff)</label>
                    <input type="text" name="staff_type" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Training Title</label>
                    <input type="text" name="title" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Start Date</label>
                    <input type="date" name="start_date" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">End Date</label>
                    <input type="date" name="end_date" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Hours</label>
                    <input type="number" name="hours" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Institution</label>
                    <input type="text" name="institution" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Upload Proof</label>
                    <input type="file" name="file" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary w-100">Submit</button>
            </form>
        </div>
    </div>
</div>
</body>
</html>
