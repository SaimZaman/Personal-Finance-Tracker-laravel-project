<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Register</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-primary">

  <h2 class="text-white text-center mt-4">FinSage</h2>

  <div class="container vh-100 d-flex justify-content-center align-items-center">
    <div class="col-10 col-sm-8 col-md-6 col-lg-4 bg-white p-4 rounded shadow">

      <h3 class="text-center mb-4">Create an Account</h3>

      {{-- Validation Errors --}}
      @if ($errors->any())
        <div class="alert alert-danger">
          <ul class="mb-0">
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      {{-- Success Message --}}
      @if (session('success'))
        <div class="alert alert-success">
          {{ session('success') }}
        </div>
      @endif

      {{-- Registration Form --}}
      <form action="{{ route('register') }}" method="POST">
        @csrf

        <label class="form-label">Full Name</label>
        <input type="text"
               name="name"
               class="form-control mb-3"
               value="{{ old('name') }}"
               placeholder="Your Name"
               required>

        <label class="form-label">Email</label>
        <input type="email"
               name="email"
               class="form-control mb-3"
               value="{{ old('email') }}"
               placeholder="Your Email"
               required>

        <label class="form-label">Password</label>
        <input type="password"
               name="password"
               class="form-control mb-3"
               placeholder="Password"
               required>

        <label class="form-label">Confirm Password</label>
        <input type="password"
               name="password_confirmation"
               class="form-control mb-3"
               placeholder="Repeat Password"
               required>

        <div class="form-check mb-3">
          <input type="checkbox" class="form-check-input" id="terms" required>
          <label class="form-check-label" for="terms">
            I agree to the <a href="#" class="text-primary">Terms of Service</a>
          </label>
        </div>

        <button type="submit" class="btn btn-primary w-100 mb-3">
          Register
        </button>

        <p class="text-center text-muted">
          Already have an account?
          <a href="{{ route('login') }}" class="text-primary">Login here</a>
        </p>

      </form>

    </div>
  </div>

</body>
</html>
