<?php
require_once '../config/config.php';
$message = '';
$entry = null;
if (isset($_POST['code'])) {
    $code = trim($_POST['code']);
    $stmt = $pdo->prepare("SELECT * FROM training_entries WHERE unique_code = ?");
    $stmt->execute([$code]);
    $entry = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$entry) $message = "Invalid code.";
}

if (isset($_POST['feedback_submit'])) {
    $entry_id = $_POST['entry_id'];
    $feedback = $_POST['feedback'];
    $pdo->prepare("INSERT INTO impact_assessments (entry_id, feedback) VALUES (?, ?)")->execute([$entry_id, $feedback]);
    $pdo->prepare("UPDATE training_entries SET status = 'completed' WHERE id = ?")->execute([$entry_id]);
    $message = "Thank you for your feedback!";
    $entry = null;
}
?>
<h2>Impact Assessment</h2>
<?php if ($message) echo "<p>$message</p>"; ?>
<?php if (!$entry): ?>
<form method="POST">
    <input type="text" name="code" placeholder="Enter Unique Code" required>
    <button type="submit">Find</button>
</form>
<?php else: ?>
<form method="POST">
    <input type="hidden" name="entry_id" value="<?= $entry['id'] ?>">
    <textarea name="feedback" placeholder="Your Feedback" required></textarea>
    <button type="submit" name="feedback_submit">Submit</button>
</form>
<?php endif; ?>
