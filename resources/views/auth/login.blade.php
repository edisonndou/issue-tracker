<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Issue Tracker</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #0d6efd 0%, #0b5ed7 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .login-container {
            width: 100%;
            max-width: 400px;
        }

        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 1rem 3rem rgba(0, 0, 0, 0.175);
        }

        .card-body {
            padding: 2rem;
        }

        .btn-primary {
            background: linear-gradient(135deg, #0d6efd 0%, #0b5ed7 100%);
            border: none;
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, #0b5ed7 0%, #0a58ca 100%);
            transform: translateY(-2px);
            box-shadow: 0 0.5rem 1rem rgba(13, 110, 253, 0.3);
        }

        .form-control:focus {
            border-color: #0d6efd;
            box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.25);
        }

        .brand {
            text-align: center;
            margin-bottom: 2rem;
        }

        .brand h1 {
            color: white;
            font-weight: 700;
            font-size: 2rem;
            margin-bottom: 0.5rem;
        }

        .brand p {
            color: rgba(255, 255, 255, 0.8);
        }

        .auth-link {
            text-align: center;
            margin-top: 1rem;
        }

        .auth-link a {
            color: #0d6efd;
            text-decoration: none;
        }

        .auth-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="brand">
            <h1><i class="bi bi-checklist-task"></i> IssueTracker</h1>
            <p>Manage your projects and issues efficiently</p>
        </div>

        <div class="card">
            <div class="card-body">
                <h2 class="card-title mb-4">Login</h2>

                @if($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <form action="{{ route('login') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror"
                               value="{{ old('email') }}" required autofocus>
                        @error('email')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" required>
                        @error('password')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                    </div>

                    <div class="mb-3 form-check">
                        <input type="checkbox" name="remember" id="remember" class="form-check-input">
                        <label class="form-check-label" for="remember">Remember me</label>
                    </div>

                    <button type="submit" class="btn btn-primary w-100">
                        <i class="bi bi-box-arrow-in-right"></i> Login
                    </button>
                </form>

                <div class="auth-link">
                    Don't have an account? <a href="{{ route('register') }}">Register here</a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
