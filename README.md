📚 Training Impact Assessment System

A streamlined web-based platform developed for DOST X to manage and assess the effectiveness of staff training programs. This system allows staff to submit training details and HR officers to track progress, view supporting documents, and analyze impact feedback.

✨ Core Features

1.🧑‍💼 Staff Submission Portal (Phase 1)
- Submit training information such as title, duration, hours, institution, type, etc.
- Upload required documents:
  - ✅ Certificate of Completion
  - ✅ Re-Entry Plan or AR/3R
- Auto-generates a unique Training Entry Code.
- Confirms submission with a "Find Entry" button for immediate review.
  
2.📝 Impact Assessment Portal (Phase 2)
- Staff can search for their submission using email + unique code.
- Displays full profile with locked form fields and document links.
- Staff can submit a rating (1-5) and optional feedback after 6 months.
- Entries marked as Completed after feedback is submitted.

3.🧑‍💻 HR Dashboard
- Login-protected interface for HR officers.
- View all submitted training entries and uploaded documents.
- Filter by:
  - Employment Type (`COS` or `Permanent`)
  - Status (`Pending`, `Completed`)
  - Search by `Training Code`
- View feedback, rating, and submission timestamps.
- Export to CSV supported.
- Clean and modern UI using Bootstrap 5.

4.📧 Email Reminder System (Automated)
- Located in `/cron/send_reminder.php`
- Sends automatic reminders via PHPMailer to staff whose entries are:
  - 6 months old
  - Still marked as `Pending`
- Uses SMTP for reliable email delivery.
- Runs daily via Windows Task Scheduler.
- Marks reminders as sent to avoid duplicates.

🔧 Tech Stack
| Category       | Stack                      |
|----------------|----------------------------|
| Backend        | PHP 8.2                    |
| Frontend       | HTML5 + Bootstrap 5        |
| Database       | MySQL (via PDO)            |
| Email          | PHPMailer + SMTP           |
| Scheduler      | Windows Task Scheduler     |
| File Uploads   | PHP `$_FILES`              |
| Deployment     | XAMPP, Laragon, Apache     |

📁 Folder Structure
training-impact-assessment-system/
├── config/
│ └── config.php # DB connection
├── public/
│ ├── index.php # Homepage
│ ├── upload.php # Staff Phase 1 submission
│ ├── impact.php # Phase 2 assessment
│ ├── hr_dashboard.php # HR management dashboard
│ ├── validate_entry.php # Real-time code checker
│ ├── style.css # Unified custom styles
│ ├── function.js # Form validation and UI scripts
│ └── image/ # Logo/banner
├── uploads/ # Certificate and Plan uploads
├── cron/
│ └── send_reminder.php # Auto-email reminder via PHPMailer
├── README.md # You are here!

🚀 Getting Started
1. Clone the Repository
git clone https://github.com/stayfocuz/training-impact-assessment-system.git
cd training-impact-assessment-system

2. Set Up the Database
Create a MySQL database.
Import the provided SQL schema (if available).

Tables include:
training_entries
supporting_docs
impact_assessments
hr_users

3. Configure Database Connection
In config/config.php:
$host = 'localhost';
$db   = 'your_database';
$user = 'your_username';
$pass = 'your_password';
$pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);

4. Setup PHPMailer
Edit cron/send_reminder.php:
$mail->isSMTP();
$mail->Host = 'smtp.yourhost.com';
$mail->SMTPAuth = true;
$mail->Username = 'your@email.com';
$mail->Password = 'your_email_password';
$mail->SMTPSecure = 'tls';
$mail->Port = 587;

5. Configure Task Scheduler (Windows)
Open Task Scheduler
Create Basic Task → Daily at 8AM (or as needed)
Set Action: Start a program
Program: Path to php.exe
Argument: Full path to send_reminder.php

✅ Ensure your server has email port access and cron works in background
✅ Features in Action

Real-time validation for training code
File upload paths protected with unique IDs
Form confirmation popup with training code + link
Locked fields on profile viewing
Auto-status update after feedback submission
AJAX feedback and validation

👨‍💻 Authors
Made by:
John Kyle Cuarteros
Ruperto Japay III
Jireh Xaris Dumindin

From: University of Science and Technology of Southern Mindanao (USTSMDX)
OJT Project — June - July 2025

📜 License
For demonstration and educational purposes.
Contact the authors if you wish to deploy this system institutionally.
