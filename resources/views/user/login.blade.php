<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | HotBytes</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #4361ee;
            --secondary: #3f37c9;
            --accent: #4cc9f0;
            --light: #f8f9fa;
            --dark: #212529;
            --success: #4bb543;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            padding: 20px 0;
        }

        .login-container {
            background-color: white;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            margin: 0 auto;
        }

        .login-header {
            background: linear-gradient(to right, var(--primary), var(--secondary));
            color: white;
            padding: 30px;
            text-align: center;
        }

        .login-header h2 {
            font-weight: 600;
            margin-bottom: 5px;
        }

        .login-header p {
            opacity: 0.9;
            margin-bottom: 0;
        }

        .login-form {
            padding: 30px;
        }

        .form-control {
            padding: 12px 15px;
            border-radius: 8px;
            border: 1px solid #e1e5ee;
            transition: all 0.3s;
        }

        .form-control:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 0.25rem rgba(67, 97, 238, 0.25);
        }

        .form-label {
            font-weight: 500;
            margin-bottom: 8px;
            color: #495057;
        }

        .input-group-text {
            background-color: #f8f9fa;
            border: 1px solid #e1e5ee;
            border-right: none;
        }

        .btn-primary {
            background: linear-gradient(to right, var(--primary), var(--secondary));
            border: none;
            padding: 12px 30px;
            border-radius: 8px;
            font-weight: 500;
            transition: all 0.3s;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(67, 97, 238, 0.4);
        }

        .form-check-input:checked {
            background-color: var(--primary);
            border-color: var(--primary);
        }

        .forgot-link {
            color: var(--primary);
            text-decoration: none;
            font-weight: 500;
        }

        .forgot-link:hover {
            text-decoration: underline;
        }

        .register-link {
            color: var(--primary);
            font-weight: 500;
            text-decoration: none;
        }

        .register-link:hover {
            text-decoration: underline;
        }

        .feature-icon {
            background-color: rgba(255, 255, 255, 0.2);
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 15px;
            color: white;
        }

        .feature-item {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }

        .feature-text h5 {
            margin-bottom: 5px;
            font-weight: 600;
        }

        .feature-text p {
            margin-bottom: 0;
            font-size: 0.9rem;
            opacity: 0.9;
        }

        .divider {
            display: flex;
            align-items: center;
            margin: 25px 0;
        }

        .divider::before, .divider::after {
            content: "";
            flex: 1;
            border-bottom: 1px solid #dee2e6;
        }

        .divider-text {
            padding: 0 15px;
            color: #6c757d;
            font-size: 0.9rem;
        }

        .social-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 10px;
            border: 1px solid #e1e5ee;
            border-radius: 8px;
            background-color: white;
            transition: all 0.3s;
            width: 100%;
            font-weight: 500;
        }

        .social-btn:hover {
            background-color: #f8f9fa;
            border-color: #c3cfe2;
        }

        .social-btn i {
            margin-right: 10px;
            font-size: 1.2rem;
        }

        .google-btn {
            color: #db4437;
        }

        .facebook-btn {
            color: #4267B2;
        }

        .remember-forgot {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        @media (max-width: 768px) {
            .login-container {
                margin: 0 15px;
            }

            .login-form {
                padding: 20px;
            }

            .remember-forgot {
                flex-direction: column;
                align-items: center;
            }

            .remember-forgot .form-check {
                margin-bottom: 10px;
            }
        }
    </style>
</head>
<body>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="login-container">

                <div class="row g-0">
                    <!-- Left Column - Features -->
                    <div class="col-lg-5 d-none d-lg-block" style="background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%); color: white;">
                        <div class="p-5 h-100 d-flex flex-column justify-content-center">
                            <h3 class="fw-bold mb-4">Welcome Back!</h3>

                            <div class="feature-item">
                                <div class="feature-icon">
                                    <i class="fas fa-route"></i>
                                </div>
                                <div class="feature-text">
                                    <h5>Track Your Bookings</h5>
                                    <p>Access your upcoming and past bus journeys in one place.</p>
                                </div>
                            </div>

                            <div class="feature-item">
                                <div class="feature-icon">
                                    <i class="fas fa-bolt"></i>
                                </div>
                                <div class="feature-text">
                                    <h5>Quick Rebooking</h5>
                                    <p>Save your favorite routes for faster booking next time.</p>
                                </div>
                            </div>

                            <div class="feature-item">
                                <div class="feature-icon">
                                    <i class="fas fa-gift"></i>
                                </div>
                                <div class="feature-text">
                                    <h5>Exclusive Rewards</h5>
                                    <p>Earn points with every trip and redeem for discounts.</p>
                                </div>
                            </div>

                        </div>
                    </div>

                    <!-- Right Column - Login Form -->
                    <div class="col-lg-7">
                        <div class="login-form">
                            <div class="text-center mb-4">
                                <h2 class="fw-bold text-dark">Sign In to Your Account</h2>
                                <p class="text-muted">Access your personalized bus booking dashboard</p>
                            </div>
                            @if(session('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{session('error')}}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                            @endif
                            @if(session('success'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{session('success')}}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                </div>
                            @endif
                            <form id="loginForm" action="{{route('users.login')}}" method="post">
                                @csrf
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email Address</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                        <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" required>

                                    </div>
                                    @error('email')
                                    <div class="text-danger small">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="password" class="form-label">Password</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                        <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password" required>
                                        <span class="input-group-text toggle-password" style="cursor: pointer;">
                                                <i class="fas fa-eye"></i>
                                            </span>
                                    </div>
                                </div>
                                <div class="mb-4 remember-forgot">

                                        <a href="{{route('forget.password')}}" class="forgot-link">Forgot password?</a>

                                </div>

                                <div class="d-grid mb-4">
                                    <button type="submit" class="btn btn-primary btn-lg">Sign In</button>
                                </div>


                                <div class="text-center">
                                    <p class="mb-0">Don't have an account? <a href="{{route('users.create')}}" class="register-link">Create Account</a></p>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Toggle password visibility
    document.querySelector('.toggle-password').addEventListener('click', function() {
        const passwordInput = document.getElementById('password');
        const icon = this.querySelector('i');

        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
        } else {
            passwordInput.type = 'password';
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
        }
    });
</script>
</body>
</html>
