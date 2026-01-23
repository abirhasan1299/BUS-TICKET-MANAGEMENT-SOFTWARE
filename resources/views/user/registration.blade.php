<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register | HotBytes Bus</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #2563eb;
            --primary-dark: #1d4ed8;
            --secondary: #7c3aed;
            --accent: #06b6d4;
            --light: #f8fafc;
            --dark: #1e293b;
            --gray: #64748b;
            --success: #10b981;
            --warning: #f59e0b;
            --gradient: linear-gradient(135deg, #2563eb 0%, #7c3aed 100%);
            --gradient-light: linear-gradient(135deg, #3b82f6 0%, #8b5cf6 100%);
            --shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
            --shadow-hover: 0 15px 35px rgba(0, 0, 0, 0.12);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #f1f5f9 0%, #e2e8f0 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .container-compact {
            max-width: 1000px;
            width: 100%;
        }

        .registration-wrapper {
            background: white;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: var(--shadow);
            display: flex;
            min-height: 550px;
            max-height: 550px;
        }

        .left-section {
            flex: 1.2;
            padding: 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            position: relative;
        }

        .right-section {
            flex: 0.8;
            background: var(--gradient);
            color: white;
            padding: 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }

        .right-section::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255,255,255,0.1) 1px, transparent 1px);
            background-size: 30px 30px;
            opacity: 0.3;
            animation: float 20s linear infinite;
        }

        @keyframes float {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        .logo-header {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 30px;
        }

        .logo-icon {
            width: 40px;
            height: 40px;
            background: var(--gradient);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.3rem;
        }

        .logo-text {
            font-size: 1.5rem;
            font-weight: 800;
            background: var(--gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .form-title {
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--dark);
            margin-bottom: 8px;
        }

        .form-subtitle {
            color: var(--gray);
            margin-bottom: 30px;
            font-size: 0.95rem;
        }

        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            display: block;
            font-weight: 600;
            color: var(--dark);
            margin-bottom: 8px;
            font-size: 0.9rem;
        }

        .input-with-icon {
            position: relative;
        }

        .input-with-icon i {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--gray);
            font-size: 1rem;
            z-index: 2;
        }

        .form-control {
            width: 100%;
            padding: 12px 15px 12px 45px;
            border: 2px solid #e2e8f0;
            border-radius: 10px;
            font-size: 0.95rem;
            font-weight: 500;
            transition: all 0.3s ease;
            background: white;
        }

        .form-control:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.15);
            outline: none;
        }

        .password-toggle {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: var(--gray);
            cursor: pointer;
            z-index: 2;
        }

        .form-text {
            font-size: 0.8rem;
            color: var(--gray);
            margin-top: 6px;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .form-text i {
            font-size: 0.9rem;
        }

        .btn-register {
            background: var(--gradient);
            color: white;
            border: none;
            padding: 14px;
            border-radius: 10px;
            font-weight: 600;
            font-size: 1rem;
            cursor: pointer;
            transition: all 0.3s ease;
            width: 100%;
            margin-top: 10px;
        }

        .btn-register:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-hover);
        }

        .login-link {
            text-align: center;
            margin-top: 25px;
            font-size: 0.9rem;
            color: var(--gray);
        }

        .login-link a {
            color: var(--primary);
            font-weight: 600;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .login-link a:hover {
            color: var(--secondary);
        }

        /* Right Section Styles */
        .welcome-title {
            font-size: 1.8rem;
            font-weight: 700;
            margin-bottom: 25px;
            position: relative;
            z-index: 1;
        }

        .benefit-item {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 20px;
            position: relative;
            z-index: 1;
        }

        .benefit-icon {
            width: 40px;
            height: 40px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .benefit-content h5 {
            font-size: 1rem;
            font-weight: 600;
            margin-bottom: 4px;
        }

        .benefit-content p {
            font-size: 0.85rem;
            opacity: 0.9;
            margin-bottom: 0;
        }

        .floating-bus {
            position: absolute;
            bottom: -30px;
            right: -30px;
            font-size: 10rem;
            opacity: 0.1;
            transform: rotate(-20deg);
            z-index: 0;
        }

        /* Alert Styling */
        .alert-container {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 1000;
            max-width: 400px;
        }

        .alert-custom {
            border-radius: 10px;
            border: none;
            box-shadow: var(--shadow);
            animation: slideIn 0.3s ease;
        }

        @keyframes slideIn {
            from {
                transform: translateX(100%);
                opacity: 0;
            }
            to {
                transform: translateX(0);
                opacity: 1;
            }
        }

        /* Responsive */
        @media (max-width: 900px) {
            .registration-wrapper {
                flex-direction: column;
                max-height: none;
                min-height: auto;
            }

            .right-section {
                display: none;
            }

            .left-section {
                padding: 30px;
            }
        }

        @media (max-width: 576px) {
            .form-grid {
                grid-template-columns: 1fr;
                gap: 15px;
            }

            .left-section {
                padding: 25px;
            }

            .form-title {
                font-size: 1.5rem;
            }
        }
    </style>
</head>
<body>
<!-- Alerts Container -->
<div class="alert-container">
    @if(session('success'))
        <div class="alert alert-success alert-custom alert-dismissible fade show">
            <div class="d-flex align-items-center">
                <i class="fas fa-check-circle me-2"></i>
                <div>{{ session('success') }}</div>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(session('danger'))
        <div class="alert alert-danger alert-custom alert-dismissible fade show">
            <div class="d-flex align-items-center">
                <i class="fas fa-exclamation-circle me-2"></i>
                <div>{{ session('danger') }}</div>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif
</div>

<div class="container-compact">
    <div class="registration-wrapper">
        <!-- Left Section - Registration Form -->
        <div class="left-section">
            <div class="logo-header">
                <div class="logo-icon">
                    <i class="fas fa-bus"></i>
                </div>
                <div class="logo-text">HotBytes</div>
            </div>

            <h2 class="form-title">Create Account</h2>
            <p class="form-subtitle">Join our community of travelers and start your journey</p>

            <form id="registrationForm" action="{{route('users.store')}}" method="post">
                @csrf

                <div class="form-grid">
                    <div class="form-group">
                        <label for="name" class="form-label">
                            <i class="fas fa-user me-1"></i>Full Name
                        </label>
                        <div class="input-with-icon">
                            <i class="fas fa-user"></i>
                            <input type="text" class="form-control" id="name" name="name"
                                   placeholder="John Doe" value="{{ old('name') }}" required>
                        </div>
                        @error('name')
                        <div class="form-text text-danger">
                            <i class="fas fa-exclamation-circle"></i> {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="email" class="form-label">
                            <i class="fas fa-envelope me-1"></i>Email Address
                        </label>
                        <div class="input-with-icon">
                            <i class="fas fa-envelope"></i>
                            <input type="email" class="form-control" id="email" name="email"
                                   placeholder="john@example.com" value="{{ old('email') }}" required>
                        </div>
                        @error('email')
                        <div class="form-text text-danger">
                            <i class="fas fa-exclamation-circle"></i> {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>

                <div class="form-grid">
                    <div class="form-group">
                        <label for="phone" class="form-label">
                            <i class="fas fa-phone me-1"></i>Phone Number
                        </label>
                        <div class="input-with-icon">
                            <i class="fas fa-phone"></i>
                            <input type="tel" class="form-control" id="phone" name="phone"
                                   placeholder="+1 (555) 123-4567" value="{{ old('phone') }}" required>
                        </div>
                        @error('phone')
                        <div class="form-text text-danger">
                            <i class="fas fa-exclamation-circle"></i> {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password" class="form-label">
                            <i class="fas fa-lock me-1"></i>Password
                        </label>
                        <div class="input-with-icon">
                            <i class="fas fa-lock"></i>
                            <input type="password" class="form-control" id="password" name="password"
                                   placeholder="••••••••" required>
                            <button type="button" class="password-toggle" id="togglePassword">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                        <div class="form-text">
                            <i class="fas fa-info-circle"></i> Minimum 8 characters with letters & numbers
                        </div>
                        @error('password')
                        <div class="form-text text-danger">
                            <i class="fas fa-exclamation-circle"></i> {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label for="password_confirmation" class="form-label">
                        <i class="fas fa-lock me-1"></i>Confirm Password
                    </label>
                    <div class="input-with-icon">
                        <i class="fas fa-lock"></i>
                        <input type="password" class="form-control" id="password_confirmation"
                               name="password_confirmation" placeholder="••••••••" required>
                    </div>
                </div>

                <button type="submit" class="btn-register">
                    <i class="fas fa-user-plus me-2"></i>Create Account
                </button>

                <div class="login-link">
                    Already have an account?
                    <a href="{{route('users.index')}}">
                        <i class="fas fa-sign-in-alt me-1"></i>Sign In Now
                    </a>
                </div>
            </form>
        </div>

        <!-- Right Section - Benefits -->
        <div class="right-section">
            <h3 class="welcome-title">Why Join HotBytes?</h3>

            <div class="benefit-item">
                <div class="benefit-icon">
                    <i class="fas fa-bolt"></i>
                </div>
                <div class="benefit-content">
                    <h5>Instant Booking</h5>
                    <p>Book tickets in seconds with our streamlined process</p>
                </div>
            </div>

            <div class="benefit-item">
                <div class="benefit-icon">
                    <i class="fas fa-shield-alt"></i>
                </div>
                <div class="benefit-content">
                    <h5>Secure Payments</h5>
                    <p>Bank-level encryption for all transactions</p>
                </div>
            </div>

            <div class="benefit-item">
                <div class="benefit-icon">
                    <i class="fas fa-tags"></i>
                </div>
                <div class="benefit-content">
                    <h5>Exclusive Deals</h5>
                    <p>Member-only discounts and promotions</p>
                </div>
            </div>

            <div class="benefit-item">
                <div class="benefit-icon">
                    <i class="fas fa-headset"></i>
                </div>
                <div class="benefit-content">
                    <h5>24/7 Support</h5>
                    <p>Dedicated customer service anytime</p>
                </div>
            </div>

            <div class="floating-bus">
                <i class="fas fa-bus"></i>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Toggle password visibility
    const togglePassword = document.getElementById('togglePassword');
    const passwordInput = document.getElementById('password');
    const eyeIcon = togglePassword.querySelector('i');

    togglePassword.addEventListener('click', function() {
        const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInput.setAttribute('type', type);

        if (type === 'text') {
            eyeIcon.classList.remove('fa-eye');
            eyeIcon.classList.add('fa-eye-slash');
        } else {
            eyeIcon.classList.remove('fa-eye-slash');
            eyeIcon.classList.add('fa-eye');
        }
    });

    // Form validation
    document.getElementById('registrationForm').addEventListener('submit', function(e) {
        const password = document.getElementById('password').value;
        const confirmPassword = document.getElementById('password_confirmation').value;

        if (password !== confirmPassword) {
            e.preventDefault();
            showAlert('Passwords do not match. Please try again.', 'danger');
            return false;
        }

        // Password strength validation
        const passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}$/;
        if (!passwordRegex.test(password)) {
            e.preventDefault();
            showAlert('Password must be at least 8 characters with uppercase, lowercase, and numbers.', 'warning');
            return false;
        }
    });

    // Auto-remove alerts after 5 seconds
    setTimeout(() => {
        const alerts = document.querySelectorAll('.alert');
        alerts.forEach(alert => {
            const bsAlert = new bootstrap.Alert(alert);
            bsAlert.close();
        });
    }, 5000);

    function showAlert(message, type) {
        const alertHtml = `
                <div class="alert alert-${type} alert-custom alert-dismissible fade show">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-${type === 'danger' ? 'exclamation' : 'exclamation'}-circle me-2"></i>
                        <div>${message}</div>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            `;

        const alertContainer = document.querySelector('.alert-container');
        alertContainer.innerHTML = alertHtml;

        // Auto remove after 5 seconds
        setTimeout(() => {
            const alert = alertContainer.querySelector('.alert');
            if (alert) {
                const bsAlert = new bootstrap.Alert(alert);
                bsAlert.close();
            }
        }, 5000);
    }
</script>
</body>
</html>
