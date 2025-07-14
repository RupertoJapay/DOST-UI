<?php
require_once '../config/config.php';

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    $stmt = $pdo->prepare("SELECT * FROM hr_users WHERE email = ?");
    $stmt->execute([$email]);

    if ($stmt->fetch()) {
        $message = "An account with that email already exists.";
    } else {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $pdo->prepare("INSERT INTO hr_users (name, email, password) VALUES (?, ?, ?)");
        $stmt->execute([$name, $email, $hashedPassword]);
        header("Location: hr_login.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>DOST X HR Register</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <style>
    :root {
      --primary: #13296b;
      --accent: #4b95eb;
      --glass: rgba(255, 255, 255, 0.95);
    }

    * {
      box-sizing: border-box;
    }

    html, body {
      margin: 0;
      padding: 0;
      height: 100%;
      font-family: 'Segoe UI', sans-serif;
      background: linear-gradient(145deg, #e6ecf7, #ffffff);
      color: #1a1a1a;
    }

    .hero {
      background-color: var(--primary);
      min-height: 80px;
      display: flex;
      align-items: center;
      padding: 1.5rem 1rem;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
    }

    .hero img {
      max-height: 65px;
    }

    .page-content {
      margin-top: 3rem;
      display: flex;
      justify-content: center;
      align-items: center;
    }

    .main-wrapper {
      background: var(--glass);
      backdrop-filter: blur(10px);
      border-radius: 12px;
      box-shadow: 0 12px 40px rgba(0, 0, 0, 0.1);
      padding: 2rem;
      max-width: 420px;
      width: 100%;
    }

    .main-wrapper h3 {
      font-weight: 600;
      color: var(--primary);
      text-align: center;
      margin-bottom: 1.5rem;
    }

    .btn-custom {
      background-color: var(--primary);
      color: white;
      border: none;
      transition: all 0.3s ease;
    }

    .btn-custom:hover {
      background-color: var(--accent);
      color: white;
    }

    .form-control:focus {
      border-color: var(--accent);
      box-shadow: 0 0 0 0.2rem rgba(75, 149, 235, 0.25);
    }

    .text-muted {
      color: #6c757d;
      font-size: 0.9rem;
      text-align: center;
      margin-top: 10px;
    }

    a {
      color: #003366;
      text-decoration: none;
    }

    a:hover {
      text-decoration: underline;
    }

    @media (max-width: 576px) {
      .main-wrapper {
        padding: 1.5rem 1rem;
      }

      .hero img {
        max-height: 50px;
      }

      .main-wrapper h3 {
        font-size: 1.3rem;
      }
    }
  </style>
</head>
<body>

<!-- Header -->
<header class="hero">
  <img src="image/masthead.png" alt="DOST Logo" />
</header>

<!-- Register Form Section -->
<div class="page-content">
  <div class="main-wrapper">
    <h3>HR Account Registration</h3>
    <?php if (!empty($message)) echo "<div class='alert alert-danger text-center'>$message</div>"; ?>
    <form method="POST">
      <div class="mb-3">
        <label for="name" class="form-label">Full Name:</label>
        <input type="text" name="name" id="name" class="form-control" required placeholder="Juan Dela Cruz">
      </div>
      <div class="mb-3">
        <label for="email" class="form-label">Email Address:</label>
        <input type="email" name="email" id="email" class="form-control" required placeholder="hr@example.com">
      </div>
      <div class="mb-3">
        <label for="password" class="form-label">Password:</label>
        <input type="password" name="password" id="password" class="form-control" required placeholder="••••••••">
      </div>
      <button type="submit" class="btn btn-custom w-100">Register</button>
    </form>
    <p class="text-center mt-3">
      <a href="hr_login.php">Back to Login</a>
    </p>
  </div>
</div>

</body>
</html>
