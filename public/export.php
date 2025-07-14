<?php
// Prevent any output before headers
ob_clean();
ini_set('display_errors', 0);
error_reporting(0);

require_once '../config/config.php';

// Only start session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['hr_id'])) die("Access denied.");

// Fetch all entries with supporting docs and feedback
$sql = "
    SELECT te.staff_name, te.unique_code, te.staff_email, te.title, te.role, te.staff_type,
           te.start_date, te.end_date, te.hours, te.learning_and_development, te.institution,
           te.created_at, te.status, te.reminder_sent,
           sd.certificates, sd.certificate_path, sd.entry_plan, sd.plan_path,
           ia.rating, ia.feedback, ia.submitted_at
    FROM training_entries te
    LEFT JOIN supporting_docs sd ON te.id = sd.training_entry_id
    LEFT JOIN impact_assessments ia ON te.id = ia.training_entry_id
    ORDER BY te.id DESC
";
$stmt = $pdo->query($sql);
$entries = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Set CSV headers
header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=training_entries.csv');

// Output CSV column headers
$output = fopen('php://output', 'w');
fputcsv($output, [
    'Name of Trainee', 'Unique Code', 'Email', 'Training Title', 'Role', 'Employment Type',
    'Start Date', 'End Date', 'Hours', 'Training Type', 'Institution', 'Date Created', 'Status',
    'Reminder Sent', 'Certificate', 'Certificate Path', 'Entry Plan', 'Entry Plan Path',
    'Rating', 'Feedback', 'Date Of Submission'
]);

// Helper to wrap as Excel-safe text
function excel_text($value) {
    if ($value === null) return '';
    // Insert line breaks every 40 characters for long text fields
    if (mb_strlen($value) > 40) {
        $value = wordwrap($value, 40, "\n", true);
    }
    // Add a single quote to force Excel to treat as text (for dates, codes, etc.)
    return "'" . str_replace(["\r"], [''], $value);
}

// Output data rows
foreach ($entries as $e) {
    fputcsv($output, [
        excel_text($e['staff_name']),
        excel_text($e['unique_code']),
        excel_text($e['staff_email']),
        excel_text($e['title']),
        excel_text($e['role']),
        excel_text($e['staff_type']),
        excel_text($e['start_date']),
        excel_text($e['end_date']),
        excel_text($e['hours']),
        excel_text($e['learning_and_development']),
        excel_text($e['institution']),
        excel_text($e['created_at']),
        excel_text($e['status']),
        $e['reminder_sent'] ? 'Sent' : 'Not Sent',
        excel_text($e['certificates']),
        excel_text($e['certificate_path']),
        excel_text($e['entry_plan']),
        excel_text($e['plan_path']),
        excel_text($e['rating']),
        excel_text($e['feedback']),
        excel_text($e['submitted_at'])
    ]);
}
fclose($output);
exit;
?>
