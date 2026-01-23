<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password | HotBytes</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            --secondary-gradient: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            --success-gradient: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
        }

        body {
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            min-height: 100vh;
            font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
        }

        .password-reset-container {
            max-width: 480px;
            margin: 0 auto;
        }

        .auth-card {
            background: white;
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(50, 50, 93, 0.1), 0 5px 15px rgba(0, 0, 0, 0.07);
            overflow: hidden;
            border: none;
            margin-top: 5vh;
        }

        .auth-header {
            background: var(--primary-gradient);
            padding: 40px 30px;
            text-align: center;
            color: white;
            position: relative;
        }

        .auth-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 5px;
            background: var(--secondary-gradient);
        }

        .logo-container {
            width: 70px;
            height: 70px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            backdrop-filter: blur(10px);
            border: 2px solid rgba(255, 255, 255, 0.3);
        }

        .logo-icon {
            font-size: 32px;
            color: white;
        }

        .auth-header h1 {
            font-weight: 600;
            font-size: 24px;
            margin-bottom: 8px;
        }

        .auth-header p {
            opacity: 0.9;
            font-size: 14px;
            margin-bottom: 0;
        }

        .auth-body {
            padding: 40px;
        }

        .form-label {
            font-weight: 600;
            color: #2d3748;
            margin-bottom: 8px;
            font-size: 14px;
            display: flex;
            align-items: center;
        }

        .form-label i {
            margin-right: 8px;
            color: #667eea;
        }

        .form-control {
            padding: 12px 16px;
            border-radius: 10px;
            border: 2px solid #e2e8f0;
            font-size: 15px;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }

        .input-group-text {
            background-color: #f8fafc;
            border: 2px solid #e2e8f0;
            border-right: none;
            border-radius: 10px 0 0 10px;
        }

        .form-control.password-input {
            border-left: none;
            border-radius: 0 10px 10px 0;
        }

        .password-toggle {
            background: transparent;
            border: 2px solid #e2e8f0;
            border-left: none;
            color: #718096;
            cursor: pointer;
            border-radius: 0 10px 10px 0;
        }

        .password-toggle:hover {
            background-color: #f8fafc;
            color: #4a5568;
        }

        .password-strength {
            height: 6px;
            border-radius: 3px;
            margin-top: 8px;
            background: #e2e8f0;
            overflow: hidden;
        }

        .strength-meter {
            height: 100%;
            width: 0%;
            border-radius: 3px;
            transition: width 0.3s ease, background-color 0.3s ease;
        }

        .strength-text {
            font-size: 12px;
            color: #718096;
            margin-top: 4px;
        }

        .requirements {
            margin-top: 20px;
            padding: 15px;
            background: #f8fafc;
            border-radius: 10px;
            border-left: 4px solid #667eea;
        }

        .requirements h6 {
            color: #4a5568;
            font-weight: 600;
            margin-bottom: 10px;
            font-size: 14px;
        }

        .requirements ul {
            margin-bottom: 0;
            padding-left: 20px;
        }

        .requirements li {
            color: #718096;
            font-size: 13px;
            margin-bottom: 5px;
        }

        .requirements li.valid {
            color: #38a169;
        }

        .requirements li.valid::before {
            content: "✓ ";
            font-weight: bold;
        }

        .btn-submit {
            background: var(--success-gradient);
            color: white;
            padding: 14px 30px;
            border-radius: 10px;
            font-weight: 600;
            font-size: 16px;
            border: none;
            width: 100%;
            transition: all 0.3s ease;
            margin-top: 10px;
        }

        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 7px 14px rgba(50, 50, 93, 0.1), 0 3px 6px rgba(0, 0, 0, 0.08);
            color: white;
        }

        .btn-submit:active {
            transform: translateY(0);
        }

        .back-to-login {
            text-align: center;
            margin-top: 25px;
            padding-top: 20px;
            border-top: 1px solid #e2e8f0;
        }

        .back-to-login a {
            color: #667eea;
            text-decoration: none;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            font-size: 14px;
        }

        .back-to-login a:hover {
            color: #5a67d8;
            text-decoration: underline;
        }

        .back-to-login a i {
            margin-right: 6px;
        }

        .status-message {
            padding: 12px 16px;
            border-radius: 10px;
            margin-bottom: 20px;
            display: none;
            font-size: 14px;
        }

        .status-message.success {
            background-color: #c6f6d5;
            color: #22543d;
            border-left: 4px solid #38a169;
            display: block;
        }

        .status-message.error {
            background-color: #fed7d7;
            color: #742a2a;
            border-left: 4px solid #e53e3e;
            display: block;
        }

        .status-message.info {
            background-color: #bee3f8;
            color: #1a365d;
            border-left: 4px solid #3182ce;
            display: block;
        }

        .password-visibility {
            cursor: pointer;
            user-select: none;
        }

        /* Progress bar colors */
        .strength-0 { width: 20%; background: #e53e3e; }
        .strength-1 { width: 40%; background: #dd6b20; }
        .strength-2 { width: 60%; background: #d69e2e; }
        .strength-3 { width: 80%; background: #38a169; }
        .strength-4 { width: 100%; background: #38a169; }

        /* Responsive adjustments */
        @media (max-width: 576px) {
            .auth-body {
                padding: 30px 20px;
            }

            .auth-header {
                padding: 30px 20px;
            }

            .auth-card {
                margin-top: 3vh;
            }
        }

        @media (max-height: 700px) {
            .auth-card {
                margin-top: 2vh;
            }
        }
    </style>
</head>
<body>
<div class="container password-reset-container">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="auth-card">
                <!-- Header -->
                <div class="auth-header">
                    <div class="logo-container">
                        <i class="fas fa-bus logo-icon"></i>
                    </div>
                    <h1>Reset Your Password</h1>
                    <p>Create a new secure password for your BusTicket Pro account</p>
                </div>

                <!-- Body -->
                <div class="auth-body">


                    <form id="passwordResetForm" action="{{route('forget.password.reset')}}" method="post" novalidate>
                        @csrf
                        <!-- OTP Field -->
                        <div class="mb-4">
                            <label for="OTP" class="form-label">
                                <i class="fas fa-envelope"></i> OTP CODE
                            </label>
                            <input
                                type="number"
                                class="form-control"
                                id="email"
                                name="otp"
                                placeholder="XXXXXXXXX"
                            >
                            <div class="form-text">
                                Check your EMAIL for OTP Code
                            </div>
                        </div>

                        <!-- New Password Field -->
                        <div class="mb-4">
                            <label for="newPassword" class="form-label">
                                <i class="fas fa-lock"></i> New Password
                            </label>
                            <div class="input-group">
                                <input
                                    type="password"
                                    class="form-control password-input"
                                    id="newPassword"
                                    name="password"
                                    placeholder="Create a strong password"
                                    required
                                >
                                <button class="btn password-toggle" type="button" id="toggleNewPassword">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>

                            <!-- Password Strength Meter -->
                            <div class="password-strength">
                                <div class="strength-meter" id="passwordStrength"></div>
                            </div>
                            <div class="strength-text" id="strengthText">Password strength: Very weak</div>
                        </div>

                        <!-- Confirm Password Field -->
                        <div class="mb-4">
                            <label for="confirmPassword" class="form-label">
                                <i class="fas fa-lock"></i> Confirm New Password
                            </label>
                            <div class="input-group">
                                <input
                                    type="password"
                                    class="form-control password-input"
                                    id="confirmPassword"
                                    placeholder="Re-enter your new password"
                                    required
                                >
                                <button class="btn password-toggle" type="button" id="toggleConfirmPassword">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                            <div class="invalid-feedback" id="confirmPasswordFeedback">
                                Passwords do not match
                            </div>
                        </div>
                        <!-- Submit Button -->
                        <button type="submit" class="btn btn-submit mt-4">
                            <i class="fas fa-key me-2"></i> Reset Password
                        </button>
                    </form>

                    </div>
            </div>

            <!-- Footer Note -->
            <div class="text-center mt-4 mb-5">
                <p class="text-muted small">
                    <i class="fas fa-shield-alt me-1"></i> Your password is encrypted and securely stored.
                    <br>If you didn't request this reset, please contact our support team immediately.
                </p>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap 5 JS Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

<script>
    // Password visibility toggle
    document.getElementById('toggleNewPassword').addEventListener('click', function() {
        const passwordInput = document.getElementById('newPassword');
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

    document.getElementById('toggleConfirmPassword').addEventListener('click', function() {
        const passwordInput = document.getElementById('confirmPassword');
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

    // Password strength checker
    const newPasswordInput = document.getElementById('newPassword');
    const confirmPasswordInput = document.getElementById('confirmPassword');
    const strengthMeter = document.getElementById('passwordStrength');
    const strengthText = document.getElementById('strengthText');
    const form = document.getElementById('passwordResetForm');

    // Requirement elements
    const reqLength = document.getElementById('req-length');
    const reqUppercase = document.getElementById('req-uppercase');
    const reqLowercase = document.getElementById('req-lowercase');
    const reqNumber = document.getElementById('req-number');
    const reqSpecial = document.getElementById('req-special');

    function checkPasswordStrength(password) {
        let strength = 0;
        let messages = [];

        // Check length
        if (password.length >= 8) {
            strength += 1;
            reqLength.classList.add('valid');
        } else {
            reqLength.classList.remove('valid');
        }

        // Check uppercase letters
        if (/[A-Z]/.test(password)) {
            strength += 1;
            reqUppercase.classList.add('valid');
        } else {
            reqUppercase.classList.remove('valid');
        }

        // Check lowercase letters
        if (/[a-z]/.test(password)) {
            strength += 1;
            reqLowercase.classList.add('valid');
        } else {
            reqLowercase.classList.remove('valid');
        }

        // Check numbers
        if (/[0-9]/.test(password)) {
            strength += 1;
            reqNumber.classList.add('valid');
        } else {
            reqNumber.classList.remove('valid');
        }

        // Check special characters
        if (/[^A-Za-z0-9]/.test(password)) {
            strength += 1;
            reqSpecial.classList.add('valid');
        } else {
            reqSpecial.classList.remove('valid');
        }

        // Update strength meter
        strengthMeter.className = 'strength-meter strength-' + strength;

        // Update strength text
        const strengthLabels = ['Very weak', 'Weak', 'Fair', 'Good', 'Strong'];
        strengthText.textContent = 'Password strength: ' + strengthLabels[strength];

        return strength;
    }

    function validatePasswords() {
        const password = newPasswordInput.value;
        const confirmPassword = confirmPasswordInput.value;
        const strength = checkPasswordStrength(password);

        // Check if passwords match
        if (password !== confirmPassword && confirmPassword !== '') {
            confirmPasswordInput.classList.add('is-invalid');
            return false;
        } else {
            confirmPasswordInput.classList.remove('is-invalid');
        }

        // Check if password is strong enough
        return strength >= 3; // Require at least "Good" strength
    }

    // Real-time validation
    newPasswordInput.addEventListener('input', function() {
        checkPasswordStrength(this.value);

        // Also check if confirm password matches
        if (confirmPasswordInput.value !== '') {
            if (this.value !== confirmPasswordInput.value) {
                confirmPasswordInput.classList.add('is-invalid');
            } else {
                confirmPasswordInput.classList.remove('is-invalid');
            }
        }
    });

    confirmPasswordInput.addEventListener('input', function() {
        if (newPasswordInput.value !== this.value) {
            this.classList.add('is-invalid');
        } else {
            this.classList.remove('is-invalid');
        }
    });


    // Initialize
    checkPasswordStrength('');
</script>
</body>
</html>
