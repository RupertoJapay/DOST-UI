<?php
require_once '../config/config.php';
$message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $type = $_POST['staff_type'];
    $title = $_POST['title'];
    $role = $_POST['role'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $hours = $_POST['hours'];
    $ttype = $_POST['type'];
    $institution = $_POST['institution'];
    $code = uniqid();

    $stmt = $pdo->prepare("INSERT INTO training_entries (staff_name, staff_email, staff_type, title, role, start_date, end_date, hours, type, institution, unique_code) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->execute([$name, $email, $type, $title, $role, $start_date, $end_date, $hours, $ttype, $institution, $code]);
    $entry_id = $pdo->lastInsertId();

    if (isset($_FILES['doc']) && $_FILES['doc']['error'] === UPLOAD_ERR_OK) {
        $ext = pathinfo($_FILES['doc']['name'], PATHINFO_EXTENSION);
        $newName = uniqid() . "." . $ext;
        move_uploaded_file($_FILES['doc']['tmp_name'], "uploads/" . $newName);
        $pdo->prepare("INSERT INTO supporting_docs (entry_id, file_name) VALUES (?, ?)")->execute([$entry_id, $newName]);
    }

    $message = "Submitted successfully! Your unique code is: " . $code;
}
?>
<h2>Training Submission</h2>
<?php if ($message) echo "<p>$message</p>"; ?>
<form method="POST" enctype="multipart/form-data">
    <input type="text" name="name" placeholder="Name" required>
    <input type="email" name="email" placeholder="Email" required>
    <select name="staff_type">
        <option value="COS">COS</option>
        <option value="Permanent">Permanent</option>
    </select>
    <input type="text" name="title" placeholder="Training Title" required>
    <input type="text" name="role" placeholder="Role" required>
    <input type="date" name="start_date" required>
    <input type="date" name="end_date" required>
    <input type="number" name="hours" placeholder="Hours" required>
    <input type="text" name="type" placeholder="Training Type">
    <input type="text" name="institution" placeholder="Institution">
    <input type="file" name="doc" accept=".pdf,.doc,.docx">
    <button type="submit">Submit</button>
</form>
