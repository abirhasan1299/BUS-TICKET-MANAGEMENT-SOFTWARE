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

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #4361ee;
            --secondary: #3f37c9;
            --accent: #4cc9f0;
            --light: #f8f9fa;
            --dark: #212529;
            --success: #4bb543;
            --sidebar-width: 260px;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f5f7fa;
            overflow-x: hidden;
        }

        /* Sidebar Styles */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            width: var(--sidebar-width);
            background: linear-gradient(to bottom, var(--primary), var(--secondary));
            color: white;
            transition: all 0.3s;
            z-index: 1000;
            box-shadow: 3px 0 10px rgba(0, 0, 0, 0.1);
        }

        .sidebar-header {
            padding: 20px;
            text-align: center;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .sidebar-header h3 {
            font-weight: 600;
            margin-bottom: 0;
        }

        .sidebar-menu {
            padding: 20px 0;
        }

        .sidebar-menu ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .sidebar-menu li {
            margin-bottom: 5px;
        }

        .sidebar-menu a {
            display: flex;
            align-items: center;
            padding: 12px 20px;
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            transition: all 0.3s;
            border-left: 3px solid transparent;
        }

        .sidebar-menu a:hover, .sidebar-menu a.active {
            background-color: rgba(255, 255, 255, 0.1);
            color: white;
            border-left: 3px solid var(--accent);
        }

        .sidebar-menu i {
            margin-right: 10px;
            font-size: 1.1rem;
            width: 20px;
            text-align: center;
        }

        /* Main Content Styles */
        .main-content {
            margin-left: var(--sidebar-width);
            padding: 20px;
            transition: all 0.3s;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 0;
            margin-bottom: 20px;
            border-bottom: 1px solid #e1e5ee;
        }

        .header h1 {
            font-weight: 600;
            color: var(--dark);
            margin-bottom: 0;
        }

        .user-info {
            display: flex;
            align-items: center;
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: var(--primary);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            margin-right: 10px;
        }

        /* Dashboard Cards */
        .dashboard-cards {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            transition: all 0.3s;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        .card-body {
            padding: 20px;
        }

        .card-icon {
            width: 50px;
            height: 50px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 15px;
            font-size: 1.5rem;
        }

        .card-1 .card-icon {
            background-color: rgba(67, 97, 238, 0.1);
            color: var(--primary);
        }

        .card-2 .card-icon {
            background-color: rgba(76, 201, 240, 0.1);
            color: var(--accent);
        }

        .card-3 .card-icon {
            background-color: rgba(75, 181, 67, 0.1);
            color: var(--success);
        }

        .card-4 .card-icon {
            background-color: rgba(255, 193, 7, 0.1);
            color: #ffc107;
        }

        .card-title {
            font-size: 0.9rem;
            color: #6c757d;
            margin-bottom: 5px;
        }

        .card-value {
            font-size: 1.8rem;
            font-weight: 600;
            color: var(--dark);
            margin-bottom: 0;
        }

        /* Recent Bookings */
        .section-title {
            font-weight: 600;
            margin-bottom: 20px;
            color: var(--dark);
            padding-bottom: 10px;
            border-bottom: 1px solid #e1e5ee;
        }

        .booking-card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.05);
            margin-bottom: 15px;
            transition: all 0.3s;
        }

        .booking-card:hover {
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .booking-header {
            background-color: rgba(67, 97, 238, 0.05);
            padding: 15px 20px;
            border-radius: 10px 10px 0 0;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .booking-route {
            font-weight: 600;
            color: var(--dark);
        }

        .booking-status {
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 500;
        }

        .status-confirmed {
            background-color: rgba(75, 181, 67, 0.1);
            color: var(--success);
        }

        .status-pending {
            background-color: rgba(255, 193, 7, 0.1);
            color: #ffc107;
        }

        .booking-details {
            padding: 15px 20px;
        }

        .booking-info {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
        }

        .booking-info:last-child {
            margin-bottom: 0;
        }

        .info-label {
            color: #6c757d;
            font-size: 0.9rem;
        }

        .info-value {
            font-weight: 500;
            color: var(--dark);
        }

        /* Mobile Toggle Button */
        .sidebar-toggle {
            display: none;
            background: none;
            border: none;
            font-size: 1.5rem;
            color: var(--dark);
        }
        #logout {
            background: transparent;
            border: none;
            color: #ffffff;
            font-size: 16px;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 10px; /* space between icon & text */
            padding: 10px 0;
            cursor: pointer;
            width: 100%;
            margin-left: 20px;
        }

        #logout i {
            font-size: 20px;
        }

        #logout:hover {
            opacity: 0.7;
        }


        /* Responsive Styles */
        @media (max-width: 768px) {
            .sidebar {
                width: 0;
                transform: translateX(-100%);
            }

            .sidebar.active {
                width: var(--sidebar-width);
                transform: translateX(0);
            }

            .main-content {
                margin-left: 0;
            }

            .sidebar-toggle {
                display: block;
            }

            .dashboard-cards {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
<!-- Sidebar -->
<div class="sidebar">
    <div class="sidebar-header">
        <h3><i class="fas fa-bus me-2"></i> HotBytes</h3>
    </div>
    <div class="sidebar-menu">
        <ul>
            <li>
                <a href="{{route('basic.home')}}">
                    <i class="bi bi-search"></i>
                    <span>Search Ticket</span>
                </a>
            </li>
            <li>
                <a href="{{route('users.payment')}}">
                    <i class="fas fa-credit-card"></i>
                    <span>Payment Info</span>
                </a>
            </li>
            <li>
                <a href="{{route('users.cart')}}">
                    <i class="bi bi-ticket-perforated"></i>

                    <span>Tickets</span>
                    @if(isset($cart_count) && $cart_count>0)
                    <span class="badge bg-danger ms-auto">{{$cart_count}}</span>
                    @endif
                </a>
            </li>
            <li>
                <form action="{{route('users.logout')}}" method="post">
                    @method('POST')
                    @csrf
                    <button type="submit"  id="logout"><i class="fas fa-sign-out-alt"></i> Logout</button>
                </form>
            </li>
        </ul>
    </div>
</div>

<!-- Main Content -->
<div class="main-content">

    @yield('content')


</div>

<!-- Bootstrap JS with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Sidebar toggle functionality
    document.querySelector('.sidebar-toggle').addEventListener('click', function() {
        document.querySelector('.sidebar').classList.toggle('active');
    });



    // Active menu item highlighting
    const menuItems = document.querySelectorAll('.sidebar-menu a');
    menuItems.forEach(item => {
        item.addEventListener('click', function() {
            menuItems.forEach(i => i.classList.remove('active'));
            this.classList.add('active');
        });
    });
</script>
</body>
</html>
