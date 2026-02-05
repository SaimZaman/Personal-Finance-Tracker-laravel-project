<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-primary">

<h2 class="text-white text-center mt-3">FinSage</h2>

<div class="container vh-100 d-flex justify-content-center align-items-center">
    <div class="col-10 col-sm-8 col-md-6 col-lg-4 bg-white p-4 mb-4 rounded shadow">

        <form action="{{ route('login') }}" method="POST">
            @csrf

            <h3 class="text-center mb-3">Login</h3>

            {{-- Email --}}
            <label class="form-label">email:</label>
            <input type="email" 
                   name="email" 
                   class="form-control @error('email') is-invalid @enderror" 
                   placeholder="Email" required>
            @error('email')
                <span class="text-danger small">{{ $message }}</span>
            @enderror

            <br>

            {{-- Password --}}
            <label class="form-label">Password:</label>
            <input type="password" 
                   name="password" 
                   class="form-control @error('password') is-invalid @enderror" 
                   placeholder="Password" required>
            @error('password')
                <span class="text-danger small">{{ $message }}</span>
            @enderror

            <br>

            <a href="{{ url('forgot-password') }}">Forgot Password?</a>

            <button type="submit" class="btn btn-primary mb-3 mt-3 px-5 w-100">
                Login
            </button>

            <div class="text-center">
                <p>Or</p>
                <p>Not a member? <a href="{{ route('register') }}">Register</a></p>

                <p>or sign up with:</p>
            </div>

            <div class="text-center">
                <button type="button" class="btn">
                    <img src="{{ asset('google.svg') }}" width="70">
                </button>

                <button type="button" class="btn m-3">
                    <img src="{{ asset('facebook.svg') }}" width="45">
                </button>

                <button type="button" class="btn m-3">
                    <img src="{{ asset('linkedin.svg') }}" width="24">
                </button>
            </div>
        </form>

    </div>
</div>

</body>
</html>
