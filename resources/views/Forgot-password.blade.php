<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Forgot Password - FinSage</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-primary text-dark d-flex flex-column min-vh-100">

  <nav class="navbar navbar-dark bg-primary shadow">
    <div class="container">
      <a class="navbar-brand fw-bold text-white" href="{{ url('login') }}">FinSage</a>
      <span class="text-white">Forgot Password</span>
    </div>
  </nav>

  <div class="container d-flex justify-content-center align-items-center flex-grow-1">
    <div class="card shadow p-4 rounded-4" style="max-width: 400px; width: 100%;">
      <h4 class="text-center mb-3">Forgot Password</h4>
      <p class="text-center text-muted small mb-4">
        Enter your registered email to receive a password reset link.
      </p>

      <form id="forgotForm" novalidate>
        <div class="mb-3">
          <label for="email" class="form-label">Email Address</label>
          <input type="email" id="email" class="form-control" placeholder="you@example.com" required>
        </div>
        <button type="submit" class="btn btn-primary w-100">Send Reset Link</button>
      </form>

      <div id="message" class="mt-3 text-center small"></div>

      <a href="{{ url('login') }}" class="d-block text-center mt-3 small text-decoration-none text-primary">← Back to Login</a>
    </div>
  </div>

  <script>
    const form = document.getElementById("forgotForm");
    const emailInput = document.getElementById("email");
    const messageBox = document.getElementById("message");

    function isValidEmail(email) {
      return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
    }

    function showMessage(text, type = "success") {
      const colorClass = type === "success" ? "text-success" : "text-danger";
      messageBox.innerHTML = `<span class="${colorClass}">${text}</span>`;
    }

    form.addEventListener("submit", function (e) {
      e.preventDefault();
      const email = emailInput.value.trim();

      if (!email) {
        showMessage(" Please enter your email address.", "error");
        emailInput.focus();
        return;
      }

      if (!isValidEmail(email)) {
        showMessage(" Please enter a valid email address.", "error");
        emailInput.focus();
        return;
      }

      showMessage(" If this email exists, a reset link has been sent!", "success");
      form.reset();
    });
  </script>
</body>
</html>
