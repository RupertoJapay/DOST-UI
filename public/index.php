<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>DOST X Training Impact Assessment Portal</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet" />

  <style>
    :root {
      --primary: #13296b;
      --accent: #4b95eb;
      --bg-light: #f4f6f9;
      --text-dark: #1a1a1a;
      --glass: rgba(255, 255, 255, 0.9);
    }

    * {
      box-sizing: border-box;
    }

    html, body {
      margin: 0;
      padding: 0;
      height: 100%;
      font-family: 'Inter', sans-serif;
      background: linear-gradient(145deg, #e6ecf7, #ffffff);
      color: var(--text-dark);
    }

    body {
      display: flex;
      flex-direction: column;
    }

    /* Header */
    .hero {
      background-color: var(--primary);
      color: white;
      padding: 2.5rem 2rem 5rem;
      position: relative;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
      z-index: 1;
    }

    .hero-left {
      display: flex;
      align-items: center;
      gap: 1rem;
    }

    .hero-left img {
      max-height: 60px;
    }

    .hero-text {
     display: flex;
     flex-direction: column;
     justify-content: center;
     height: 100%;
    }


    .hero-text h1 {
      font-size: 1.5rem;
      font-weight: 700;
      margin: 0 0 0.25rem;
      color: white;
    }

    .hero-text p {
      margin: 0;
      font-size: 1rem;
      color: #cbd6f4;
    }

    .hr-login-link {
      position: absolute;
      top: 0.75rem;
      right: 1rem;
    }

    .hr-login-link a {
      color: #fff;
      font-size: 0.9rem;
      text-decoration: underline;
    }

    /* Card */
    .main-wrapper {
      flex: 1;
      display: flex;
      justify-content: center;
      align-items: flex-start;
      padding: 1rem;
      position: relative;
    }

    .glass-card {
      background: var(--glass);
      backdrop-filter: blur(10px);
      border-radius: 0px;
      padding: 2rem;
      box-shadow: 0 12px 40px rgba(0, 0, 0, 0.1);
      width: 100%;
      max-width: 520px;
      animation: fadeInUp 0.6s ease;
      margin-top: -70px;
      z-index: 5;
      position: relative;
    }

    .glass-card h3 {
      font-weight: 600;
      color: var(--primary);
      text-align: center;
      margin-bottom: 1.5rem;
    }

    .form-floating label {
      color: #666;
    }

    .btn-custom {
      background-color: var(--primary);
      color: white;
      transition: all 0.3s ease;
      font-weight: 500;
    }

    .btn-custom:hover {
      background-color: var(--accent);
    }

    .spinner-border.spinner-border-sm {
      margin-left: 0.5rem;
      display: none;
    }

    .action-links a {
      font-size: 1rem;
      padding: 0.6rem 1rem;
    }

    .action-links a:hover {
      transform: translateY(-2px);
    }

    footer {
      text-align: center;
      font-size: .8rem;
      color: #777;
      padding: 0.75rem 1rem;
    }

    @keyframes fadeInUp {
      from { opacity: 0; transform: translateY(20px); }
      to { opacity: 1; transform: translateY(0); }
    }

    @media (max-height: 720px) {
      .hero {
        padding: 1.5rem 1rem 4rem;
      }

      .glass-card {
        padding: 1.5rem;
        margin-top: -50px;
      }
    }

    @media (max-width: 576px) {
      .hero-left {
        flex-direction: column;
        align-items: flex-start;
      }

      .hero-text h1 {
        font-size: 1.5rem;
      }
    }
    .btn-custom {
      background-color: var(--primary); /* #13296b */
      color: white;
      transition: all 0.3s ease;
      font-weight: 500;
    }

    .btn-custom:hover {
      background-color: var(--accent); /* #4b95eb */
    }

  </style>
</head>
<body>

  <!-- Hero Header -->
  <header class="hero">
    <div class="hr-login-link">
      <a href="hr_login.php">HR Login</a>
    </div>
    <div class="hero-left">
      <img src="image/header_logo.png" alt="DOST Logo" />
      <div class="hero-text">
        <h1>DOST X Training Impact Assessment</h1>
        <p>Portal Access</p>
      </div>
    </div>
  </header>

  <!-- Main Wrapper -->
  <div class="main-wrapper">
    <main class="glass-card">
      <h3>Access Your Training Entry</h3>
      <form method="POST" action="view_profile.php" id="lookupForm">
          <div class="form-group mb-3">
            <label for="email">Email address</label>
            <input type="email" class="form-control" id="email" name="email" required>
            <div class="invalid-feedback">Please enter a valid email.</div>
          </div>

          <div class="form-group mb-3">
            <label for="code">Training Entry Code</label>
            <input type="text" class="form-control" id="code" name="code" required>
            <div class="valid-feedback">✔️ Code found</div>
            <div class="invalid-feedback">❌ Code not found for this email</div>
          </div>

          <button id="submitBtn" class="btn btn-custom w-100" type="submit">
            <span class="spinner-border spinner-border-sm" role="status" style="display:none;"></span>
            Find Entry
          </button>

        </form>

      <hr class="my-4" />

      <div class="d-grid gap-3 action-links">
        <a href="upload.php" class="btn btn-outline-primary btn-lg">New Training Form</a>
        <a href="impact.php" class="btn btn-outline-primary btn-lg">Submit Impact Assessment</a>
      </div>
    </main>
  </div>

  <footer>
    &copy; 2025 DOST X. All rights reserved.
  </footer>

  <!-- Script: Spinner + Validation + Persistence -->
 <script>
  const form = document.getElementById('lookupForm');
  const submitBtn = document.getElementById('submitBtn');
  const spinner = submitBtn.querySelector('.spinner-border');
  const email = document.getElementById('email');
  const code = document.getElementById('code');

  let isCodeValid = false;

  document.addEventListener('DOMContentLoaded', () => {
    // Load from sessionStorage
    email.value = sessionStorage.getItem('email') || '';
    code.value = sessionStorage.getItem('code') || '';

    email.addEventListener('input', () => sessionStorage.setItem('email', email.value));
    code.addEventListener('input', () => {
      sessionStorage.setItem('code', code.value);
      validateCode(); // Validate in real time
    });

    code.addEventListener('blur', validateCode); // Also validate on blur
  });

  function validateCode() {
    const emailVal = email.value.trim();
    const codeVal = code.value.trim();

    // Clear validation if code is empty
    if (!codeVal) {
      code.classList.remove('is-valid', 'is-invalid');
      isCodeValid = false;
      return;
    }

    if (!emailVal) return;

    fetch('validate_entry.php', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/x-www-form-urlencoded'
      },
      body: `email=${encodeURIComponent(emailVal)}&code=${encodeURIComponent(codeVal)}`
    })
    .then(res => res.json())
    .then(data => {
      isCodeValid = data.valid;

      if (data.valid) {
        code.classList.add('is-valid');
        code.classList.remove('is-invalid');
      } else {
        code.classList.add('is-invalid');
        code.classList.remove('is-valid');
      }
    })
    .catch(err => {
      console.error('Validation failed', err);
      code.classList.add('is-invalid');
      code.classList.remove('is-valid');
      isCodeValid = false;
    });
  }

  form.addEventListener('submit', function (e) {
    e.preventDefault();
    e.stopPropagation();

    if (!form.checkValidity()) {
      form.classList.add('was-validated');
      Swal.fire({
        icon: 'error',
        title: 'Form Error',
        text: 'Please fill out all fields correctly.',
        confirmButtonColor: '#13296b'
      });
      return;
    }

    if (!isCodeValid) {
      Swal.fire({
        icon: 'error',
        title: 'Invalid Code',
        text: 'The code does not match any entry for the provided email.',
        confirmButtonColor: '#13296b'
      });
      return;
    }

    spinner.style.display = 'inline-block';
    submitBtn.disabled = true;

    setTimeout(() => {
      spinner.style.display = 'none';
      submitBtn.disabled = false;
      form.submit(); // Final submit
    }, 1000);
  });
</script>

</main>
</div>
</body>
</html>