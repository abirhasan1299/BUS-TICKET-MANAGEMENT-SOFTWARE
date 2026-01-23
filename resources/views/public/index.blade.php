<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HotBytes | Professional Bus Route Finder</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Select2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

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
            --gradient-start: #2563eb;
            --gradient-end: #7c3aed;
            --card-bg: rgba(255, 255, 255, 0.98);
            --shadow: 0 20px 40px rgba(0, 0, 0, 0.08);
            --shadow-hover: 0 25px 50px rgba(0, 0, 0, 0.12);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
            min-height: 100vh;
            color: var(--dark);
            line-height: 1.6;
        }

        /* Header & Navigation */
        .header {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
            padding: 1rem 0;
            position: sticky;
            top: 0;
            z-index: 1000;
            box-shadow: 0 2px 20px rgba(0, 0, 0, 0.05);
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 12px;
            font-weight: 800;
            font-size: 1.8rem;
            color: var(--dark);
            text-decoration: none;
        }

        .brand-logo {
            color: var(--primary);
            font-size: 2.2rem;
        }

        .auth-buttons {
            display: flex;
            gap: 12px;
            align-items: center;
        }

        .btn-login {
            background: transparent;
            color: var(--primary);
            border: 2px solid var(--primary);
            padding: 10px 24px;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-login:hover {
            background: var(--primary);
            color: white;
            transform: translateY(-2px);
        }

        .btn-register {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            border: none;
            padding: 10px 24px;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(37, 99, 235, 0.2);
        }

        .btn-register:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(37, 99, 235, 0.3);
            color: white;
        }

        /* Hero Section */
        .hero-section {
            padding: 80px 0 40px;
            text-align: center;
        }

        .hero-title {
            font-size: 3.5rem;
            font-weight: 800;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-bottom: 20px;
            line-height: 1.2;
        }

        .hero-subtitle {
            font-size: 1.2rem;
            color: var(--gray);
            max-width: 600px;
            margin: 0 auto 50px;
        }

        /* Main Card */
        .main-card {
            background: var(--card-bg);
            border-radius: 20px;
            box-shadow: var(--shadow);
            border: 1px solid rgba(255, 255, 255, 0.9);
            overflow: hidden;
            margin-bottom: 50px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .main-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-hover);
        }

        .card-header {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            padding: 30px;
            border-bottom: none;
        }

        .card-header h2 {
            font-weight: 700;
            margin: 0;
            font-size: 1.8rem;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .card-body {
            padding: 40px;
        }

        /* Form Elements */
        .form-label {
            font-weight: 600;
            color: var(--dark);
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .form-label i {
            color: var(--primary);
            font-size: 1.1rem;
        }

        .input-group-custom {
            position: relative;
            margin-bottom: 25px;
        }

        .input-group-custom i {
            position: absolute;
            left: 18px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--gray);
            z-index: 10;
        }

        .form-control, .select2-container--default .select2-selection--single {
            border: 2px solid #e2e8f0;
            border-radius: 12px;
            padding: 14px 20px 14px 50px;
            font-size: 1rem;
            height: auto;
            transition: all 0.3s ease;
            background: white;
            color: var(--dark);
        }

        .form-control:focus, .select2-container--default.select2-container--focus .select2-selection--single {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.15);
            outline: none;
        }

        .btn-search {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            border: none;
            padding: 18px 40px;
            font-size: 1.1rem;
            font-weight: 600;
            border-radius: 12px;
            transition: all 0.3s ease;
            margin-top: 20px;
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
        }

        .btn-search:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(37, 99, 235, 0.25);
            color: white;
        }

        /* Features Section */
        .features-section {
            padding: 60px 0;
        }

        .section-title {
            text-align: center;
            font-size: 2.5rem;
            font-weight: 800;
            margin-bottom: 50px;
            color: var(--dark);
        }

        .feature-card {
            background: white;
            border-radius: 16px;
            padding: 40px 30px;
            text-align: center;
            height: 100%;
            transition: all 0.3s ease;
            border: 1px solid rgba(0, 0, 0, 0.05);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.04);
        }

        .feature-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        }

        .feature-icon {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 25px;
            color: white;
            font-size: 2rem;
        }

        .feature-card h4 {
            font-weight: 700;
            margin-bottom: 15px;
            color: var(--dark);
        }

        .feature-card p {
            color: var(--gray);
            margin-bottom: 0;
        }

        /* Footer */
        .footer {
            background: var(--dark);
            color: white;
            padding: 50px 0 20px;
            margin-top: 80px;
        }

        .footer-logo {
            font-size: 1.8rem;
            font-weight: 800;
            margin-bottom: 20px;
            color: white;
        }

        .footer-links {
            list-style: none;
            padding: 0;
        }

        .footer-links li {
            margin-bottom: 12px;
        }

        .footer-links a {
            color: #cbd5e1;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .footer-links a:hover {
            color: white;
        }

        .copyright {
            text-align: center;
            padding-top: 30px;
            margin-top: 30px;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            color: #94a3b8;
            font-size: 0.9rem;
        }

        /* Select2 Customization */
        .select2-container--default .select2-selection--single {
            height: 54px;
            display: flex;
            align-items: center;
        }

        .select2-container--default .select2-selection--single .select2-selection__rendered {
            color: var(--dark);
            font-weight: 500;
            padding-left: 0;
        }

        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 54px;
            right: 15px;
        }

        .select2-dropdown {
            border: 2px solid #e2e8f0;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            margin-top: 5px;
        }

        .select2-container--default .select2-results__option--highlighted[aria-selected] {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
        }

        .select2-container--default .select2-results__option[aria-selected=true] {
            background-color: #f1f5f9;
            color: var(--dark);
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .hero-title {
                font-size: 2.5rem;
            }

            .card-body {
                padding: 30px 20px;
            }

            .card-header {
                padding: 25px 20px;
            }

            .btn-search {
                padding: 16px 30px;
            }
        }

        @media (max-width: 576px) {
            .hero-title {
                font-size: 2rem;
            }

            .hero-subtitle {
                font-size: 1rem;
            }

            .auth-buttons {
                flex-direction: column;
                width: 100%;
            }

            .auth-buttons .btn {
                width: 100%;
            }
        }
    </style>
</head>
<body>
<!-- Header -->
<header class="header">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center">
            <a href="#" class="brand">
                <i class="fas fa-bus brand-logo"></i>
                <span>HotBytes</span>
            </a>

            @guest
                <div class="auth-buttons">
                    <a href="{{route('users.index')}}" class="btn btn-login">
                        <i class="fas fa-sign-in-alt me-2"></i>Login
                    </a>
                    <a href="{{route('users.create')}}" class="btn btn-register">
                        <i class="fas fa-user-plus me-2"></i>Register
                    </a>
                </div>
            @endguest

            @auth
                <div class="auth-buttons">
                    <form action="{{route('users.logout')}}" method="post" class="m-0">
                        @method('POST')
                        @csrf
                        <button type="submit" class="btn btn-login">
                            <i class="fas fa-sign-out-alt me-2"></i>Logout
                        </button>
                    </form>
                </div>
            @endauth
        </div>
    </div>
</header>

<!-- Hero Section -->
<section class="hero-section">
    <div class="container">
        <h1 class="hero-title">Find Your Perfect Bus Route</h1>
        <p class="hero-subtitle">Search across thousands of routes with real-time availability, competitive pricing, and trusted operators for your safe journey.</p>
    </div>
</section>

<!-- Main Search Card -->
<div class="container">
    <div class="main-card">
        <div class="card-header">
            <h2><i class="fas fa-route"></i> Bus Route Finder</h2>
        </div>
        <div class="card-body">
            <form method="post" action="{{route('basic.search')}}" autocomplete="off">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <label for="startLocation" class="form-label">
                            <i class="fas fa-map-marker-alt"></i> From
                        </label>
                        <div class="input-group-custom">
                            <i class="fas fa-location-dot"></i>
                            <select class="form-select form-control" id="startLocation" name="start">
                                <option></option>
                                @foreach($data as $d)
                                    <option value="{{$d->id}}">{{$d->start_location}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label for="destination" class="form-label">
                            <i class="fas fa-map-marker-alt"></i> To
                        </label>
                        <div class="input-group-custom">
                            <i class="fas fa-location-dot"></i>
                            <select class="form-select form-control" id="destination" name="end_slot">
                                <option></option>
                                @foreach($data as $d)
                                    <option value="{{$d->id}}">{{$d->end_location}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-search">
                    <i class="fas fa-search"></i> Search Available Routes
                </button>
            </form>
        </div>
    </div>
</div>

<!-- Features Section -->
<section class="features-section">
    <div class="container">
        <h2 class="section-title">Why Choose HotBytes?</h2>
        <div class="row g-4">
            <div class="col-md-4">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-route"></i>
                    </div>
                    <h4>Extensive Network</h4>
                    <p>Access to 500+ routes covering major cities, towns, and remote destinations with comprehensive connectivity.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-tags"></i>
                    </div>
                    <h4>Best Price Guarantee</h4>
                    <p>We offer the most competitive prices with transparent pricing and no hidden charges on all bookings.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    <h4>Premium Safety</h4>
                    <p>All operators are safety-certified with verified vehicles, trained drivers, and 24/7 travel support.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Footer -->
<footer class="footer">
    <div class="container">
        <div class="row">
            <div class="col-md-4 mb-4">
                <div class="footer-logo">
                    <i class="fas fa-bus me-2"></i>HotBytes
                </div>
                <p>Your trusted partner for seamless bus travel experiences across the country.</p>
            </div>
            <div class="col-md-4 mb-4">
                <h5 class="mb-3">Quick Links</h5>
                <ul class="footer-links">
                    <li><a href="#">Bus Tickets</a></li>
                    <li><a href="#">Routes & Schedules</a></li>
                    <li><a href="#">Offers & Discounts</a></li>
                    <li><a href="#">Contact Support</a></li>
                </ul>
            </div>
            <div class="col-md-4 mb-4">
                <h5 class="mb-3">Contact Us</h5>
                <ul class="footer-links">
                    <li><i class="fas fa-phone me-2"></i> +1 (555) 123-4567</li>
                    <li><i class="fas fa-envelope me-2"></i> support@hotbytes.com</li>
                    <li><i class="fas fa-clock me-2"></i> 24/7 Customer Support</li>
                </ul>
            </div>
        </div>
        <div class="copyright">
            <p>&copy; 2024 HotBytes. All rights reserved. | Designed with <i class="fas fa-heart text-danger"></i> for travelers</p>
        </div>
    </div>
</footer>

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<!-- Select2 JS -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
    $(document).ready(function() {
        // Initialize Select2 with enhanced settings
        $('#startLocation').select2({
            placeholder: "",
            allowClear: true,
            width: '100%',
            theme: 'bootstrap'
        });

        $('#destination').select2({
            placeholder: "",
            allowClear: true,
            width: '100%',
            theme: 'bootstrap'
        });

    });
</script>
</body>
</html>
