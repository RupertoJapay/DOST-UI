<?php
require_once '../config/config.php';

$message = '';
$uniqueCode = '';

// Function to generate unique code
function generateUniqueCode($length = 8) {
    return strtoupper(bin2hex(random_bytes($length / 2))); // e.g., 'A3F9C8D1'
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get main entry info
    $staff_name = trim($_POST['staff_name']);
    $staff_email = trim($_POST['staff_email']);
    $staff_type = trim($_POST['staff_type']);
    $staff_role = trim($_POST['staff_role']);
    $title = trim($_POST['title']);
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $hours = $_POST['hours'];
    $learning_and_development = trim($_POST['learning_and_development']);
    $institution = trim($_POST['institution']);

    // Generate unique code
    $uniqueCode = generateUniqueCode();

    // Insert main entry
    $stmt = $pdo->prepare("INSERT INTO training_entries 
        (staff_name, staff_email, staff_type, role, title, start_date, end_date, hours, learning_and_development, institution, unique_code, created_at, reminder_sent) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW(), 0)");
    $stmt->execute([$staff_name, $staff_email, $staff_type, $staff_role, $title, $start_date, $end_date, $hours, $learning_and_development, $institution, $uniqueCode]);

    $training_entry_id = $pdo->lastInsertId();

    // Handle file upload
    $certFileName = $_FILES['certificates']['name'];
    $certTmp = $_FILES['certificates']['tmp_name'];
    $certPath = 'uploads/' . uniqid() . '_' . basename($certFileName);

    $planFileName = $_FILES['entry_plan']['name'];
    $planTmp = $_FILES['entry_plan']['tmp_name'];
    $planPath = 'uploads/' . uniqid() . '_' . basename($planFileName);

    if (move_uploaded_file($certTmp, $certPath) && move_uploaded_file($planTmp, $planPath)) {
        $stmt = $pdo->prepare("INSERT INTO supporting_docs 
            (training_entry_id, certificates, certificate_path, entry_plan, plan_path) 
            VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([ 
            $training_entry_id,
            $certFileName,
            $certPath,
            $planFileName,
            $planPath
        ]);

        $message = "Your response has been recorded.<br>Your unique code is: <strong>$uniqueCode</strong>";
    } else {
        $message = "File upload failed.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <title>Training Upload - Phase 1</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="style.css"/>
    <style>
        /* Overlay behind popup */
        .popup-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0,0,0,0.45);
            z-index: 9998;
        }

        /* Custom popup */
        .custom-popup {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: #ffffffff;
            border: 2px solid #ffffffff;
            border-radius: 16px;
            box-shadow: 0 8px 32px rgba(0,0,0,0.25);
            padding: 2rem 2.5rem;
            text-align: center;
            z-index: 9999;
            max-width: 400px;
            width: 90%;
            font-family: 'Segoe UI', sans-serif;
        }

        .custom-popup p {
            font-size: 1.1rem;
            color: #1b1a3dff;
            margin-bottom: 1.5rem;
        }

        .popup-btn {
            background-color: #13296b;
            color: white;
            border: none;
            padding: 0.6rem 1.2rem;
            font-size: 1rem;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        footer {
           text-align: center;
           font-size: .8rem;
           color: #777;
           padding: 0.75rem 1rem;
        }

        .popup-btn:hover {
            background-color: #13296b;
        }

        <?php if ($message): ?>
        body {
            overflow: hidden;
        }
        <?php endif; ?>
    </style>
</head>
<body class="upload-page">
<div class="container mt-5">

<header class="hero">
    <img src="image/masthead.png" alt="DOST Logo" />
</header>

<main class="upload-main container">
    <?php if ($message): ?>
        <div class="popup-overlay"></div>
        <div id="popup-message" class="custom-popup">
            <p><?= $message ?></p>
            <button onclick="window.location.href='index.php'" class="popup-btn">Done</button>
        </div>
    <?php else: ?>
        <div class="card phase1-card">
            <h2 class="form-title">Training Input Form</h2>

            <form method="POST" enctype="multipart/form-data" id="uploadForm" novalidate>
                <label>Name:</label>
                <input type="text" name="staff_name" class="form-control" required>
                <div class="invalid-feedback">Please enter your name.</div>

                <label>Email:</label>
                <input type="email" name="staff_email" class="form-control" required>
                <div class="invalid-feedback">Please enter a valid email address.</div>

                <label>Training Title:</label>
                <input type="text" name="title" class="form-control" required>
                <div class="invalid-feedback">Please enter the training title.</div>

                <label>Employment Type (COS or Permanent):</label>
                <select name="staff_type" class="form-control" required>
                    <option value="">Select type</option>
                    <option value="COS">COS</option>
                    <option value="Permanent">Permanent</option>
                </select>
                <div class="invalid-feedback">Please select your employment type.</div>

                <label class="form-label">Role (Participant, Facilitator, Resource Speaker etc.):</label>
                <input type="text" name="staff_role" class="form-control" required>
                <div class="invalid-feedback">Please specify your role.</div>

                <label>Start Date:</label>
                <input type="date" name="start_date" class="form-control" required>
                <div class="invalid-feedback">Please select a start date.</div>

                <label>End Date:</label>
                <input type="date" name="end_date" class="form-control" required>
                <div class="invalid-feedback">Please select an end date.</div>

                <label>Number of Hours:</label>
                <input type="number" name="hours" class="form-control" min="1" required>
                <div class="invalid-feedback">Please enter the number of hours.</div>

                <label class="form-label">Type of Learning and Development (e.g., Managerial, Supervisory, Technical, etc.):</label>
                <input type="text" name="learning_and_development" class="form-control" required>
                <div class="invalid-feedback">Please enter the type of L&D.</div>

                <label>Sponsored by (Name of Institution):</label>
                <input type="text" name="institution" class="form-control" required>
                <div class="invalid-feedback">Please specify the institution.</div>

                <br><h2 class="form-title">Upload Supporting Documents</h2>

                <label>Certificate of Completion:</label>
                <div class="file-input-group">
                    <input type="file" name="certificates" class="form-control" id="certificateInput" required>
                    <button type="button" class="remove-btn btn-sm" onclick="clearFileInput('certificateInput')">Remove</button>
                </div>
                <div class="invalid-feedback">Please upload any valid proof of Participation.</div>

                <br><label>AR/3R or Re-Entry Plan</label>
                <div class="file-input-group">
                    <input type="file" name="entry_plan" class="form-control" id="entryPlanInput" required>
                    <button type="button" class="remove-btn btn-sm" onclick="clearFileInput('entryPlanInput')">Remove</button>
                </div>
                <div class="invalid-feedback">Please upload a valid file.</div>

                <button type="submit" class="custom-submit">Submit</button>
                <a href="index.php" class="back-button"> Back to Home</a>
            </form>
        </div>
    <?php endif; ?>
</main>

</div>

<?php if ($message): ?>
<script>
    // Clear form fields and file inputs when message is shown
    window.addEventListener('DOMContentLoaded', function () {
        const form = document.getElementById('uploadForm');
        if (form) {
            form.reset();
            document.getElementById('certificateInput').value = "";
            document.getElementById('entryPlanInput').value = "";
        }
    });
</script>
<?php endif; ?>

<script src="function.js"></script>
  <footer>
    &copy; 2025 DOST X. All rights reserved.
  </footer>
</body>
</html>
