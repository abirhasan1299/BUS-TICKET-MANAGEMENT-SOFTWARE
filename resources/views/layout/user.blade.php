<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') | HotBytes</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- Google Fonts -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #4361ee;
            --primary-light: #eef2ff;
            --secondary: #3f37c9;
            --accent: #4cc9f0;
            --light: #ffffff;
            --dark: #1e293b;
            --dark-light: #64748b;
            --success: #10b981;
            --warning: #f59e0b;
            --danger: #ef4444;
            --sidebar-width: 280px;
            --border-radius: 12px;
            --shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            --shadow-lg: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
            --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8fafc;
            color: var(--dark);
            overflow-x: hidden;
            line-height: 1.5;
        }

        /* Sidebar Styles - Modern Redesign */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            width: var(--sidebar-width);
            background: var(--light);
            border-right: 1px solid #e2e8f0;
            z-index: 1000;
            transition: var(--transition);
            display: flex;
            flex-direction: column;
            box-shadow: var(--shadow);
        }

        .sidebar-header {
            padding: 24px;
            border-bottom: 1px solid #e2e8f0;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .sidebar-header h3 {
            font-weight: 700;
            color: var(--primary);
            margin: 0;
            font-size: 1.5rem;
        }

        .sidebar-header .logo-icon {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            width: 40px;
            height: 40px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
        }

        .sidebar-menu {
            flex: 1;
            padding: 20px 16px;
            overflow-y: auto;
        }

        .sidebar-menu ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .sidebar-menu li {
            margin-bottom: 4px;
        }

        .sidebar-menu a {
            display: flex;
            align-items: center;
            padding: 14px 16px;
            color: var(--dark-light);
            text-decoration: none;
            border-radius: var(--border-radius);
            transition: var(--transition);
            font-weight: 500;
            position: relative;
            overflow: hidden;
        }

        .sidebar-menu a:hover {
            background-color: var(--primary-light);
            color: var(--primary);
            transform: translateX(4px);
        }

        .sidebar-menu a.active {
            background-color: var(--primary-light);
            color: var(--primary);
            font-weight: 600;
        }

        .sidebar-menu a.active::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            bottom: 0;
            width: 4px;
            background: var(--primary);
            border-radius: 0 2px 2px 0;
        }

        .sidebar-menu i {
            margin-right: 12px;
            font-size: 1.2rem;
            width: 24px;
            text-align: center;
        }

        .sidebar-menu .badge {
            margin-left: auto;
            font-size: 0.75rem;
            padding: 4px 8px;
        }

        .logout-btn {
            margin: 20px 16px;
            width: calc(100% - 32px);
        }

        .logout-btn button {
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 12px;
            background: #fef2f2;
            color: var(--danger);
            border: 1px solid #fee2e2;
            border-radius: var(--border-radius);
            font-weight: 500;
            transition: var(--transition);
        }

        .logout-btn button:hover {
            background: var(--danger);
            color: white;
            transform: translateY(-1px);
        }

        /* Premium Badge */
        .premium-badge {
            background: linear-gradient(135deg, #fbbf24, #f59e0b);
            color: white;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 4px;
            margin: 20px auto;
            width: fit-content;
        }

        /* Main Content */
        .main-content {
            margin-left: var(--sidebar-width);
            padding: 24px;
            min-height: 100vh;
            transition: var(--transition);
        }

        /* Header */
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            padding-bottom: 16px;
        }

        .header-left h1 {
            font-weight: 700;
            font-size: 1.875rem;
            margin-bottom: 4px;
            color: var(--dark);
        }

        .header-left p {
            color: var(--dark-light);
            font-size: 0.875rem;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 12px;
            background: var(--light);
            padding: 8px 16px;
            border-radius: var(--border-radius);
            border: 1px solid #e2e8f0;
            transition: var(--transition);
        }

        .user-info:hover {
            box-shadow: var(--shadow);
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--primary), var(--accent));
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            font-size: 1rem;
        }

        .user-details {
            display: flex;
            flex-direction: column;
        }

        .user-name {
            font-weight: 600;
            font-size: 0.875rem;
        }

        .user-role {
            font-size: 0.75rem;
            color: var(--dark-light);
        }

        /* Mobile Toggle */
        .sidebar-toggle {
            display: none;
            background: var(--primary);
            color: white;
            border: none;
            width: 44px;
            height: 44px;
            border-radius: 10px;
            align-items: center;
            justify-content: center;
            font-size: 1.25rem;
            transition: var(--transition);
            cursor: pointer;
        }

        .sidebar-toggle:hover {
            background: var(--secondary);
            transform: scale(1.05);
        }

        /* Dashboard Cards */
        .dashboard-cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 24px;
            margin-bottom: 40px;
        }

        .card {
            border: none;
            border-radius: var(--border-radius);
            background: var(--light);
            box-shadow: var(--shadow);
            transition: var(--transition);
            overflow: hidden;
            position: relative;
        }

        .card:hover {
            transform: translateY(-4px);
            box-shadow: var(--shadow-lg);
        }

        .card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 4px;
            height: 100%;
            background: var(--primary);
        }

        .card-body {
            padding: 24px;
        }

        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 16px;
        }

        .card-icon {
            width: 56px;
            height: 56px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            color: white;
        }

        .card-icon.search { background: linear-gradient(135deg, #4361ee, #3a56d4); }
        .card-icon.payment { background: linear-gradient(135deg, #10b981, #0da271); }
        .card-icon.tickets { background: linear-gradient(135deg, #f59e0b, #e6900a); }
        .card-icon.premium { background: linear-gradient(135deg, #8b5cf6, #7c3aed); }

        .card-value {
            font-size: 2rem;
            font-weight: 700;
            color: var(--dark);
            margin: 8px 0;
        }

        .card-title {
            font-size: 0.875rem;
            color: var(--dark-light);
            text-transform: uppercase;
            letter-spacing: 0.5px;
            font-weight: 600;
        }

        .card-trend {
            display: flex;
            align-items: center;
            gap: 4px;
            font-size: 0.875rem;
            margin-top: 8px;
        }

        .trend-up { color: var(--success); }
        .trend-down { color: var(--danger); }

        /* Recent Bookings */
        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 24px;
        }

        .section-title {
            font-weight: 700;
            font-size: 1.5rem;
            color: var(--dark);
        }

        .booking-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
            gap: 20px;
        }

        .booking-card {
            background: var(--light);
            border-radius: var(--border-radius);
            padding: 24px;
            border: 1px solid #e2e8f0;
            transition: var(--transition);
            position: relative;
        }

        .booking-card:hover {
            border-color: var(--primary);
            box-shadow: var(--shadow-lg);
            transform: translateY(-2px);
        }

        .booking-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .booking-route {
            font-weight: 600;
            font-size: 1.125rem;
            color: var(--dark);
        }

        .booking-badge {
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
        }

        .badge-confirmed {
            background: #d1fae5;
            color: var(--success);
        }

        .badge-pending {
            background: #fef3c7;
            color: var(--warning);
        }

        .badge-cancelled {
            background: #fee2e2;
            color: var(--danger);
        }

        .booking-details {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
        }

        .detail-item {
            display: flex;
            flex-direction: column;
            gap: 4px;
        }

        .detail-label {
            font-size: 0.75rem;
            color: var(--dark-light);
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .detail-value {
            font-weight: 600;
            color: var(--dark);
        }

        /* Responsive Design */
        @media (max-width: 1024px) {
            :root {
                --sidebar-width: 240px;
            }

            .dashboard-cards {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
                width: 280px;
            }

            .sidebar.active {
                transform: translateX(0);
                box-shadow: 0 0 40px rgba(0, 0, 0, 0.1);
            }

            .main-content {
                margin-left: 0;
                padding: 20px;
            }

            .sidebar-toggle {
                display: flex;
                position: fixed;
                top: 20px;
                left: 20px;
                z-index: 999;
            }

            .header {
                padding-top: 60px;
                flex-direction: column;
                gap: 16px;
                align-items: stretch;
            }

            .header-left h1 {
                font-size: 1.5rem;
            }

            .dashboard-cards {
                grid-template-columns: 1fr;
            }

            .booking-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 480px) {
            .main-content {
                padding: 16px;
            }

            .card-body {
                padding: 20px;
            }

            .booking-card {
                padding: 20px;
            }

            .booking-details {
                grid-template-columns: 1fr;
            }

            .user-info {
                padding: 8px 12px;
            }
        }

        /* Animation */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .fade-in {
            animation: fadeIn 0.3s ease-out forwards;
        }

        /* Loading State */
        .loading {
            opacity: 0.6;
            pointer-events: none;
        }

        /* Toast Notification */
        .toast {
            position: fixed;
            bottom: 24px;
            right: 24px;
            background: var(--dark);
            color: white;
            padding: 16px 24px;
            border-radius: var(--border-radius);
            box-shadow: var(--shadow-lg);
            z-index: 9999;
            animation: slideIn 0.3s ease-out;
            display: none;
        }

        @keyframes slideIn {
            from { transform: translateX(100%); opacity: 0; }
            to { transform: translateX(0); opacity: 1; }
        }
    </style>
</head>
<body>
<!-- Sidebar -->
<div class="sidebar">
    <div class="sidebar-header">
        <div class="logo-icon">
            <i class="fas fa-bus"></i>
        </div>
        <h3>HotBytes</h3>
    </div>

    <div class="sidebar-menu">
        <ul>
            <li>
                <a href="{{route('basic.home')}}" class="{{ Request::routeIs('basic.home') ? 'active' : '' }}">
                    <i class="bi bi-search"></i>
                    <span>Search Ticket</span>
                </a>
            </li>
            <li>
                <a href="{{route('users.payment')}}" class="{{ Request::routeIs('users.payment') ? 'active' : '' }}">
                    <i class="fas fa-credit-card"></i>
                    <span>Payment Info</span>
                </a>
            </li>
            <li>
                <a href="{{route('users.cart')}}" class="{{ Request::routeIs('users.cart') ? 'active' : '' }}">
                    <i class="bi bi-ticket-perforated"></i>
                    <span>Tickets</span>
                    @if(isset($cart_count) && $cart_count>0)
                        <span class="badge bg-danger">{{$cart_count}}</span>
                    @endif
                </a>
            </li>
        </ul>

        @if(session('is_premium'))
            <div class="text-center">
                <div class="premium-badge">
                    <i class="fas fa-crown"></i>
                    PREMIUM USER
                </div>
            </div>
        @endif
    </div>

    <div class="logout-btn">
        <form action="{{route('users.logout')}}" method="post">
            @method('POST')
            @csrf
            <button type="submit">
                <i class="fas fa-sign-out-alt"></i> Logout
            </button>
        </form>
    </div>
</div>

<!-- Main Content -->
<div class="main-content">
    <!-- Mobile Toggle -->
    <button class="sidebar-toggle" id="sidebarToggle">
        <i class="fas fa-bars"></i>
    </button>

    @yield('content')

</div>

<!-- Toast Notification -->
<div class="toast" id="toast"></div>

<!-- Bootstrap JS with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Sidebar toggle functionality
    const sidebar = document.querySelector('.sidebar');
    const sidebarToggle = document.getElementById('sidebarToggle');
    const mainContent = document.querySelector('.main-content');

    sidebarToggle.addEventListener('click', () => {
        sidebar.classList.toggle('active');
        sidebarToggle.innerHTML = sidebar.classList.contains('active')
            ? '<i class="fas fa-times"></i>'
            : '<i class="fas fa-bars"></i>';
    });

    // Close sidebar when clicking outside on mobile
    document.addEventListener('click', (e) => {
        if (window.innerWidth <= 768) {
            if (!sidebar.contains(e.target) && !sidebarToggle.contains(e.target)) {
                sidebar.classList.remove('active');
                sidebarToggle.innerHTML = '<i class="fas fa-bars"></i>';
            }
        }
    });

    // Active menu highlighting
    const currentPath = window.location.pathname;
    const menuLinks = document.querySelectorAll('.sidebar-menu a');

    menuLinks.forEach(link => {
        if (link.getAttribute('href') === currentPath) {
            link.classList.add('active');
        }

        link.addEventListener('click', function() {
            menuLinks.forEach(l => l.classList.remove('active'));
            this.classList.add('active');

            // Close sidebar on mobile after selection
            if (window.innerWidth <= 768) {
                sidebar.classList.remove('active');
                sidebarToggle.innerHTML = '<i class="fas fa-bars"></i>';
            }
        });
    });

    // Toast notification function
    function showToast(message, type = 'info') {
        const toast = document.getElementById('toast');
        toast.textContent = message;
        toast.style.display = 'block';
        toast.style.background = type === 'success' ? '#10b981' :
            type === 'error' ? '#ef4444' :
                type === 'warning' ? '#f59e0b' : '#1e293b';

        setTimeout(() => {
            toast.style.display = 'none';
        }, 3000);
    }

    // Add fade-in animation to cards
    document.addEventListener('DOMContentLoaded', () => {
        const cards = document.querySelectorAll('.card, .booking-card');
        cards.forEach((card, index) => {
            card.style.animationDelay = `${index * 0.1}s`;
            card.classList.add('fade-in');
        });
    });

    // Handle form submissions with loading states
    document.querySelectorAll('form').forEach(form => {
        form.addEventListener('submit', function(e) {
            const submitBtn = this.querySelector('button[type="submit"]');
            if (submitBtn) {
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Processing...';
                submitBtn.disabled = true;
            }
        });
    });

    // Update user status badge based on premium status
    const premiumStatus = {{ session('is_premium') ? 'true' : 'false' }};
    if (premiumStatus) {
        document.querySelector('.user-role').innerHTML =
            '<i class="fas fa-crown" style="color: #f59e0b;"></i> Premium Account';
    }

    // Handle window resize
    window.addEventListener('resize', () => {
        if (window.innerWidth > 768) {
            sidebar.classList.remove('active');
            sidebarToggle.innerHTML = '<i class="fas fa-bars"></i>';
        }
    });
</script>
</body>
</html>
