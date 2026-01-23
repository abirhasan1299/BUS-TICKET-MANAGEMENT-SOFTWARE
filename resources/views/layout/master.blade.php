<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('title') - HotBytes</title>

    <!-- Meta Tags -->
    <meta name="description" content="HotBytes  - Admin Panel">
    <meta name="author" content="HotBytes">

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{asset('assets/img/favicon.ico')}}" type="image/x-icon">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">

    <!-- Core CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Plugin CSS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.1.2/styles/overlayscrollbars.min.css" rel="stylesheet">

    <!-- Custom Admin CSS -->
    <style>
        :root {
            --primary-color: #FF6B35;
            --secondary-color: #FF9F1C;
            --success-color: #2EC4B6;
            --info-color: #4CC9F0;
            --warning-color: #FFBF69;
            --danger-color: #E71D36;
            --sidebar-width: 260px;
            --header-height: 70px;
            --box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        * {
            font-family: 'Inter', sans-serif;
        }

        body {
            background: #F8FAFC;
            color: #1E293B;
            overflow-x: hidden;
        }

        /* Header Styles */
        .main-header {
            background: #FFFFFF;
            height: var(--header-height);
            box-shadow: var(--box-shadow);
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
            position: fixed;
            top: 0;
            right: 0;
            left: 0;
            z-index: 1030;
        }

        .header-content {
            display: flex;
            align-items: center;
            justify-content: space-between;
            height: 100%;
            padding: 0 2rem;
        }

        .header-left, .header-right {
            display: flex;
            align-items: center;
            gap: 1.5rem;
        }

        /* Sidebar Styles - FIXED */
        .main-sidebar {
            background: linear-gradient(180deg, #1A1F2E 0%, #0F131F 100%);
            position: fixed;
            top: var(--header-height);
            left: 0;
            bottom: 0;
            width: var(--sidebar-width);
            z-index: 1029;
            transition: var(--transition);
            box-shadow: 4px 0 20px rgba(0, 0, 0, 0.15);
            display: flex;
            flex-direction: column;
            overflow: hidden;
        }

        .sidebar-brand {
            padding: 1.5rem;
            text-align: center;
            border-bottom: 1px solid rgba(255, 255, 255, 0.08);
            margin-bottom: 0;
            flex-shrink: 0;
        }

        .brand-logo {
            width: 48px;
            height: 48px;
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 12px;
        }

        .brand-logo i {
            font-size: 1.75rem;
            color: white;
        }

        .brand-text {
            color: white;
            font-size: 1.25rem;
            font-weight: 700;
            letter-spacing: 0.5px;
            background: linear-gradient(135deg, #FFFFFF 0%, #FFE4C4 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .sidebar-menu {
            padding: 0 1rem;
            flex: 1;
            overflow-y: auto;
            overflow-x: hidden;
            padding-bottom: 1rem;
        }

        /* Custom Scrollbar for Sidebar */
        .sidebar-menu::-webkit-scrollbar {
            width: 6px;
        }

        .sidebar-menu::-webkit-scrollbar-track {
            background: rgba(255, 255, 255, 0.05);
            border-radius: 3px;
        }

        .sidebar-menu::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.2);
            border-radius: 3px;
        }

        .sidebar-menu::-webkit-scrollbar-thumb:hover {
            background: rgba(255, 255, 255, 0.3);
        }

        .nav-item {
            margin-bottom: 0.5rem;
        }

        .nav-link {
            color: #CBD5E1;
            padding: 0.875rem 1rem;
            border-radius: 10px;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            transition: var(--transition);
            font-weight: 500;
        }

        .nav-link:hover {
            background: linear-gradient(90deg, rgba(255, 107, 53, 0.1), rgba(255, 159, 28, 0.05));
            color: white;
            transform: translateX(5px);
        }

        .nav-link.active {
            background: linear-gradient(90deg, var(--primary-color), var(--secondary-color));
            color: white;
            box-shadow: 0 4px 12px rgba(255, 107, 53, 0.25);
            transform: translateX(5px);
        }

        .nav-link i {
            font-size: 1.25rem;
            width: 24px;
            text-align: center;
        }

        .nav-link .badge {
            margin-left: auto;
            background: rgba(255, 255, 255, 0.2);
            font-size: 0.7rem;
            font-weight: 600;
            padding: 0.25rem 0.5rem;
        }

        /* Main Content */
        .main-content {
            margin-left: var(--sidebar-width);
            margin-top: var(--header-height);
            padding: 2.5rem;
            min-height: calc(100vh - var(--header-height));
            transition: var(--transition);
            background: #F8FAFC;
        }

        /* Header Action Buttons */
        .header-actions {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .header-btn {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #F1F5F9;
            color: #475569;
            text-decoration: none;
            transition: var(--transition);
            border: 1px solid #E2E8F0;
        }

        .header-btn:hover {
            background: var(--primary-color);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(255, 107, 53, 0.2);
            border-color: var(--primary-color);
        }

        /* User Profile Dropdown */
        .user-profile-dropdown {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            cursor: pointer;
            padding: 0.5rem;
            border-radius: 12px;
            transition: var(--transition);
        }

        .user-profile-dropdown:hover {
            background: #F1F5F9;
        }

        .user-avatar {
            width: 44px;
            height: 44px;
            border-radius: 12px;
            overflow: hidden;
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
            font-size: 1.1rem;
        }

        .user-info {
            line-height: 1.4;
        }

        .user-name {
            font-weight: 600;
            font-size: 0.95rem;
            color: #1E293B;
        }

        .user-role {
            font-size: 0.8rem;
            color: #64748B;
            font-weight: 500;
        }

        .dropdown-menu {
            border: none;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
            border-radius: 12px;
            padding: 0.5rem;
            margin-top: 0.75rem;
            min-width: 220px;
        }

        .dropdown-item {
            padding: 0.75rem 1rem;
            border-radius: 8px;
            font-weight: 500;
            transition: var(--transition);
            color: #475569;
        }

        .dropdown-item:hover {
            background: #F1F5F9;
            color: var(--primary-color);
        }

        .dropdown-item i {
            width: 20px;
            margin-right: 0.75rem;
        }

        /* Content Header */
        .content-header {
            background: white;
            border-radius: 16px;
            padding: 1.5rem 2rem;
            margin-bottom: 2rem;
            box-shadow: var(--box-shadow);
            border: 1px solid rgba(0, 0, 0, 0.05);
        }

        .content-header h1 {
            font-weight: 700;
            color: #1E293B;
            margin-bottom: 0.5rem;
        }

        .breadcrumb {
            background: none;
            padding: 0;
            margin: 0;
        }

        .breadcrumb-item a {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 500;
        }

        .breadcrumb-item.active {
            color: #64748B;
        }

        /* Cards */
        .dashboard-card {
            background: white;
            border-radius: 16px;
            border: 1px solid rgba(0, 0, 0, 0.05);
            box-shadow: var(--box-shadow);
            transition: var(--transition);
            overflow: hidden;
        }

        .dashboard-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
        }

        .card-icon {
            width: 64px;
            height: 64px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.75rem;
            color: white;
        }

        /* Buttons */
        .btn-primary {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            border: none;
            padding: 0.625rem 1.75rem;
            border-radius: 10px;
            font-weight: 600;
            transition: var(--transition);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(255, 107, 53, 0.3);
        }

        /* Responsive */
        @media (max-width: 992px) {
            .main-sidebar {
                transform: translateX(-100%);
            }

            .main-sidebar.show {
                transform: translateX(0);
            }

            .main-content {
                margin-left: 0;
                padding: 1.5rem;
            }

            .header-content {
                padding: 0 1.5rem;
            }

            .user-info {
                display: none;
            }
        }

        @media (max-width: 768px) {
            .main-content {
                padding: 1.25rem;
            }

            .header-content {
                padding: 0 1rem;
            }

            .header-actions .header-btn:nth-child(2),
            .header-actions .header-btn:nth-child(3) {
                display: none;
            }
        }

        /* Animation */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .fade-in {
            animation: fadeIn 0.5s ease-out;
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #F1F5F9;
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb {
            background: #CBD5E1;
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #94A3B8;
        }
    </style>
</head>

<body>
<!-- Header -->
<header class="main-header">
    <div class="header-content">
        <div class="header-left">
            <button class="header-btn" id="sidebarToggle">
                <i class="bi bi-list" style="font-size: 1.25rem;"></i>
            </button>
            <div class="search-box" style="position: relative;">
                <i class="bi bi-search" style="position: absolute; left: 1rem; top: 50%; transform: translateY(-50%); color: #94A3B8;"></i>
                <input type="text" class="search-input" placeholder="Search orders, customers..."
                       style="width: 300px; padding: 0.6rem 1rem 0.6rem 3rem; border: 1px solid #E2E8F0; border-radius: 10px; background: #F8FAFC; transition: var(--transition);">
            </div>
        </div>

        <div class="header-right">
            <div class="header-actions">
                <a href="#" class="header-btn" title="Calendar">
                    <i class="bi bi-calendar3"></i>
                </a>
                <a href="#" class="header-btn" title="Messages">
                    <i class="bi bi-chat"></i>
                </a>
                <a href="#" class="header-btn" title="Reports">
                    <i class="bi bi-graph-up"></i>
                </a>
            </div>

            <div class="dropdown">
                <div class="user-profile-dropdown dropdown-toggle" data-bs-toggle="dropdown">
                    <div class="user-avatar">
                        AU
                    </div>
                    <div class="user-info d-none d-lg-block">
                        <div class="user-name">Admin User</div>
                        <div class="user-role">Super Admin</div>
                    </div>
                    <i class="bi bi-chevron-down text-muted d-none d-lg-block"></i>
                </div>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                        <a class="dropdown-item" href="#">
                            <i class="bi bi-person"></i> My Profile
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="#">
                            <i class="bi bi-gear"></i> Settings
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="#">
                            <i class="bi bi-shield-check"></i> Security
                        </a>
                    </li>
                    <li><hr class="dropdown-divider"></li>
                    <li>
                        <a class="dropdown-item" href="#">
                            <i class="bi bi-question-circle"></i> Help Center
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="#">
                            <i class="bi bi-headset"></i> Support
                        </a>
                    </li>
                    <li><hr class="dropdown-divider"></li>
                    <li>
                        <a class="dropdown-item text-danger" href="{{route('admin.logout')}}">
                            <i class="bi bi-box-arrow-right"></i> Logout
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</header>

<!-- Sidebar - FIXED -->
<aside class="main-sidebar">
    <div class="sidebar-brand">
        <div class="brand-logo">
            <i class="bi bi-fire"></i>
        </div>
        <div class="brand-text">HotBytes</div>
    </div>

    <nav class="sidebar-menu">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a href="{{route('basic.dashboard')}}" class="nav-link {{request()->routeIs('basic.dashboard') ? 'active' : ''}}">
                    <i class="bi bi-speedometer2"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{route('route.index')}}" class="nav-link {{request()->routeIs('route.*') ? 'active' : ''}}">
                    <i class="bi bi-sign-turn-right"></i>
                    <span>Routes</span>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{route('bus.index')}}" class="nav-link {{request()->routeIs('bus.*') ? 'active' : ''}}">
                    <i class="bi bi-bus-front"></i>
                    <span>Buses</span>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{route('driver.index')}}" class="nav-link {{request()->routeIs('driver.*') ? 'active' : ''}}">
                    <i class="bi bi-person-badge"></i>
                    <span>Drivers</span>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{route('slot.index')}}" class="nav-link {{request()->routeIs('slot.*') ? 'active' : ''}}">
                    <i class="bi bi-ticket-perforated"></i>
                    <span>Ticket Slots</span>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{route('coupon.index')}}" class="nav-link {{request()->routeIs('coupon.*') ? 'active' : ''}}">
                    <i class="bi bi-percent"></i>
                    <span>Coupons</span>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{route('admin.payment')}}" class="nav-link {{request()->routeIs('admin.payment') ? 'active' : ''}}">
                    <i class="bi bi-credit-card"></i>
                    <span>Payments</span>
                </a>
            </li>

            <li class="nav-item mt-4">
                <a href="{{route('admin.logout')}}" class="nav-link text-danger">
                    <i class="bi bi-box-arrow-right"></i>
                    <span>Logout</span>
                </a>
            </li>
        </ul>
    </nav>
</aside>

<!-- Main Content -->
<main class="main-content fade-in">
    <!-- Page Content -->
    <div class="container-fluid">
        @yield('content')
    </div>
</main>

<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.1.2/browser/overlayscrollbars.browser.es6.min.js"></script>
<script src="{{asset('js/adminlte.js')}}"></script>

<script>
    // Toggle Sidebar
    document.getElementById('sidebarToggle').addEventListener('click', function() {
        document.querySelector('.main-sidebar').classList.toggle('show');
        document.querySelector('.main-content').classList.toggle('sidebar-collapsed');
    });

    // Initialize Select2
    $(document).ready(function() {
        $('.select2').select2({
            placeholder: 'Select an option',
            allowClear: true,
            width: '100%'
        });
    });

    // Initialize Flatpickr
    flatpickr("#date", {
        dateFormat: "Y-m-d",
    });

    flatpickr("#schedule", {
        enableTime: true,
        dateFormat: "Y-m-d H:i",
        time_24hr: true,
    });

    // Active menu highlighting
    document.addEventListener('DOMContentLoaded', function() {
        const currentPath = window.location.pathname;
        const navLinks = document.querySelectorAll('.nav-link');

        navLinks.forEach(link => {
            if (link.getAttribute('href') === currentPath) {
                link.classList.add('active');
            }
        });
    });

    // Search functionality
    document.querySelector('.search-input').addEventListener('focus', function() {
        this.parentElement.style.width = '350px';
    });

    document.querySelector('.search-input').addEventListener('blur', function() {
        this.parentElement.style.width = '300px';
    });

    // User dropdown hover effect
    const userDropdown = document.querySelector('.user-profile-dropdown');
    userDropdown.addEventListener('mouseenter', function() {
        this.style.transform = 'translateY(-2px)';
    });

    userDropdown.addEventListener('mouseleave', function() {
        this.style.transform = 'translateY(0)';
    });
</script>

@yield('scripts')
</body>
</html>
