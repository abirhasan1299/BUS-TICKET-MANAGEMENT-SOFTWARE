<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register | BusTicket Pro</title>
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

        .registration-container {
            background-color: white;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            margin: 0 auto;
        }

        .registration-header {
            background: linear-gradient(to right, var(--primary), var(--secondary));
            color: white;
            padding: 30px;
            text-align: center;
        }

        .registration-header h2 {
            font-weight: 600;
            margin-bottom: 5px;
        }

        .registration-header p {
            opacity: 0.9;
            margin-bottom: 0;
        }

        .registration-form {
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

        .terms-link {
            color: var(--primary);
            text-decoration: none;
        }

        .terms-link:hover {
            text-decoration: underline;
        }

        .login-link {
            color: var(--primary);
            font-weight: 500;
            text-decoration: none;
        }

        .login-link:hover {
            text-decoration: underline;
        }

        .feature-icon {
            background-color: rgba(67, 97, 238, 0.1);
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 15px;
            color: var(--primary);
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
            color: #6c757d;
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

        @media (max-width: 768px) {
            .registration-container {
                margin: 0 15px;
            }

            .registration-form {
                padding: 20px;
            }
        }
    </style>
</head>
<body>
<div class="container">
    <div class="row justify-content-center">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if(session('danger'))
            <div class="alert alert-danger alert-dismissible fade show">
                {{ session('danger') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
        <div class="col-lg-10">
            <div class="registration-container">
                <div class="row g-0">
                    <!-- Left Column - Registration Form -->
                    <div class="col-lg-7">
                        <div class="registration-form">
                            <div class="text-center mb-4">
                                <h2 class="fw-bold text-dark">Create Your Account</h2>
                                <p class="text-muted">Join thousands of travelers using our bus ticket system</p>
                            </div>

                            <form id="registrationForm" action="{{route('users.store')}}" method="post">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12 mb-3">
                                        <label for="firstName" class="form-label">Full  Name</label>
                                        <input type="text" class="form-control" id="firstName" name="name" placeholder="Enter your  name" required>
                                        @error('name')
                                        <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="email" class="form-label">Email Address</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                        <input type="email" name="email" class="form-control" id="email" placeholder="Enter your email" required>
                                        @error('email')
                                        <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="phone" class="form-label">Phone Number</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                        <input type="tel" name="phone" class="form-control" id="phone" placeholder="Enter your phone number" required>
                                        @error('phone')
                                        <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="password" class="form-label">Password</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                        <input type="password" class="form-control" id="password" name="password" placeholder="Create a password" required>
                                        <span class="input-group-text toggle-password" style="cursor: pointer;">
                                                <i class="fas fa-eye"></i>
                                            </span>
                                    </div>
                                    <div class="form-text">Password must be at least 8 characters with uppercase, lowercase, and numbers.</div>
                                    @error('password')
                                    <div class="text-danger small">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="confirmPassword" class="form-label">Confirm Password</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                        <input type="password" class="form-control" id="confirmPassword" name="password_confirmation" placeholder="Confirm your password" required>
                                    </div>
                                </div>

                                <div class="d-grid mb-4">
                                    <button type="submit" class="btn btn-primary btn-lg">Create Account</button>
                                </div>



                                <div class="text-center">
                                    <p class="mb-0">Already have an account? <a href="{{route('users.index')}}" class="login-link">Sign In</a></p>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Right Column - Features -->
                    <div class="col-lg-5 d-none d-lg-block" style="background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%); color: white;">
                        <div class="p-5 h-100 d-flex flex-column justify-content-center">
                            <h3 class="fw-bold mb-4">Why Register With Us?</h3>

                            <div class="feature-item">
                                <div class="feature-icon">
                                    <i class="fas fa-bus"></i>
                                </div>
                                <div class="feature-text">
                                    <h5>Easy Booking</h5>
                                    <p>Book bus tickets in just a few clicks with our intuitive platform.</p>
                                </div>
                            </div>

                            <div class="feature-item">
                                <div class="feature-icon">
                                    <i class="fas fa-tags"></i>
                                </div>
                                <div class="feature-text">
                                    <h5>Exclusive Deals</h5>
                                    <p>Get access to special discounts and promotional offers.</p>
                                </div>
                            </div>

                            <div class="feature-item">
                                <div class="feature-icon">
                                    <i class="fas fa-shield-alt"></i>
                                </div>
                                <div class="feature-text">
                                    <h5>Secure Payments</h5>
                                    <p>Your transactions are protected with bank-level security.</p>
                                </div>
                            </div>

                            <div class="feature-item">
                                <div class="feature-icon">
                                    <i class="fas fa-history"></i>
                                </div>
                                <div class="feature-text">
                                    <h5>Booking History</h5>
                                    <p>Keep track of all your past and upcoming journeys.</p>
                                </div>
                            </div>

                            <div class="feature-item">
                                <div class="feature-icon">
                                    <i class="fas fa-headset"></i>
                                </div>
                                <div class="feature-text">
                                    <h5>24/7 Support</h5>
                                    <p>Our customer service team is always ready to assist you.</p>
                                </div>
                            </div>
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

    // Form validation
    document.getElementById('registrationForm').addEventListener('submit', function(e) {


        const password = document.getElementById('password').value;
        const confirmPassword = document.getElementById('confirmPassword').value;

        if (password !== confirmPassword) {
            alert('Passwords do not match. Please try again.');
            return;
        }


    });
</script>
</body>
</html>
