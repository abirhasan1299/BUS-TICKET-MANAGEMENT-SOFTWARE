<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Find Routes | LuxuryBus</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --primary-gradient: linear-gradient(135deg, #4776E6, #8E54E9);
            --secondary-gradient: linear-gradient(135deg, #1a2980, #26d0ce);
            --text-dark: #1a2980;
            --text-light: #666;
            --card-bg: rgba(255, 255, 255, 0.15);
            --card-border: rgba(255, 255, 255, 0.18);
        }

        body {
            font-family: 'Inter', sans-serif;
            color: #333;
            background: linear-gradient(135deg, #1a2980, #26d0ce, #8A2BE2);
            background-size: 400% 400%;
            animation: gradientBG 15s ease infinite;
            line-height: 1.6;
            min-height: 100vh;
        }

        @keyframes gradientBG {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        .container {
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        /* Header Styles */
        header {
            padding: 20px 0;
            position: sticky;
            top: 0;
            width: 100%;
            z-index: 1000;
            background: rgba(26, 41, 128, 0.9);
            backdrop-filter: blur(10px);
        }

        .header-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            font-size: 28px;
            font-weight: 700;
            color: white;
            display: flex;
            align-items: center;
            text-decoration: none;
        }

        .logo i {
            margin-right: 10px;
            background: var(--primary-gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        nav ul {
            display: flex;
            list-style: none;
        }

        nav ul li {
            margin-left: 30px;
        }

        nav ul li a {
            color: white;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
            position: relative;
        }

        nav ul li a:after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: -5px;
            left: 0;
            background: var(--primary-gradient);
            transition: width 0.3s ease;
        }

        nav ul li a:hover {
            color: #8E54E9;
        }

        nav ul li a:hover:after {
            width: 100%;
        }

        .cta-button {
            background: var(--primary-gradient);
            color: white;
            border: none;
            padding: 12px 25px;
            border-radius: 50px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(142, 84, 233, 0.3);
        }

        .cta-button:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(142, 84, 233, 0.4);
        }

        /* Main Content */
        .main-content {
            padding: 80px 0;
        }

        .page-header {
            text-align: center;
            margin-bottom: 50px;
        }

        .page-title {
            font-size: 2.8rem;
            color: white;
            margin-bottom: 15px;
            font-weight: 700;
        }

        .page-subtitle {
            font-size: 1.2rem;
            color: rgba(255, 255, 255, 0.9);
            max-width: 600px;
            margin: 0 auto;
        }

        /* Search Section */
        .search-section {
            margin-bottom: 60px;
        }

        .search-card {
            background: var(--card-bg);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 8px 32px rgba(31, 38, 135, 0.2);
            border: 1px solid var(--card-border);
            margin-bottom: 30px;
        }

        .search-card h2 {
            color: white;
            margin-bottom: 25px;
            font-size: 1.8rem;
            text-align: center;
        }

        .search-form {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group.full-width {
            grid-column: span 4;
        }

        .form-group label {
            display: block;
            color: white;
            margin-bottom: 8px;
            font-weight: 500;
        }

        .form-group input, .form-group select {
            width: 100%;
            padding: 15px;
            border-radius: 12px;
            border: none;
            background: rgba(255, 255, 255, 0.9);
            font-size: 16px;
            transition: all 0.3s ease;
        }

        .form-group input:focus, .form-group select:focus {
            outline: none;
            box-shadow: 0 0 0 3px rgba(142, 84, 233, 0.3);
        }

        .search-button {
            background: var(--primary-gradient);
            color: white;
            border: none;
            padding: 16px;
            border-radius: 12px;
            font-weight: 600;
            font-size: 18px;
            cursor: pointer;
            transition: all 0.3s ease;
            width: 100%;
            box-shadow: 0 4px 15px rgba(142, 84, 233, 0.3);
        }

        .search-button:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(142, 84, 233, 0.4);
        }

        /* Results Section */
        .results-section h2 {
            color: white;
            text-align: center;
            margin-bottom: 30px;
            font-size: 2rem;
        }

        .routes-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 25px;
        }

        .route-card {
            background: var(--card-bg);
            backdrop-filter: blur(10px);
            border-radius: 15px;
            overflow: hidden;
            transition: all 0.3s ease;
            border: 1px solid var(--card-border);
            color: white;
        }

        .route-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.2);
        }

        .route-header {
            padding: 20px;
            background: rgba(0, 0, 0, 0.2);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .route-title {
            font-size: 1.4rem;
            font-weight: 600;
        }

        .route-price {
            font-size: 1.5rem;
            font-weight: 700;
            background: var(--primary-gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .route-content {
            padding: 20px;
        }

        .route-info {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .route-info-item {
            text-align: center;
        }

        .route-info-item i {
            font-size: 1.5rem;
            margin-bottom: 8px;
            color: #8E54E9;
        }

        .route-info-item span {
            display: block;
            font-size: 0.9rem;
            color: rgba(255, 255, 255, 0.8);
        }

        .route-info-item strong {
            font-size: 1.1rem;
            color: white;
        }

        .route-details {
            display: grid;
            grid-template-columns: 1fr auto 1fr;
            align-items: center;
            margin-bottom: 20px;
            padding: 15px;
            background: rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }

        .route-from, .route-to {
            text-align: center;
        }

        .route-from h3, .route-to h3 {
            font-size: 1.2rem;
            margin-bottom: 5px;
        }

        .route-from p, .route-to p {
            color: rgba(255, 255, 255, 0.8);
            font-size: 0.9rem;
        }

        .route-stops {
            text-align: center;
            padding: 0 15px;
        }

        .route-stops i {
            font-size: 1.8rem;
            color: #8E54E9;
        }

        .route-stops span {
            display: block;
            font-size: 0.8rem;
            margin-top: 5px;
            color: rgba(255, 255, 255, 0.7);
        }

        .route-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .route-button {
            background: var(--primary-gradient);
            color: white;
            border: none;
            padding: 12px 20px;
            border-radius: 8px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 10px rgba(142, 84, 233, 0.3);
        }

        .route-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(142, 84, 233, 0.4);
        }

        .bus-type {
            font-size: 0.9rem;
            color: rgba(255, 255, 255, 0.8);
            display: flex;
            align-items: center;
        }

        .bus-type i {
            margin-right: 5px;
            color: #8E54E9;
        }

        /* No Results */
        .no-results {
            text-align: center;
            padding: 40px;
            background: var(--card-bg);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            border: 1px solid var(--card-border);
            color: white;
        }

        .no-results i {
            font-size: 3rem;
            margin-bottom: 20px;
            color: #8E54E9;
        }

        .no-results h3 {
            font-size: 1.5rem;
            margin-bottom: 15px;
        }

        /* Footer */
        footer {
            background: rgba(26, 41, 128, 0.9);
            padding: 40px 0 20px;
            color: white;
            margin-top: 60px;
        }

        .footer-container {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 40px;
        }

        .footer-col h4 {
            font-size: 1.2rem;
            margin-bottom: 20px;
            color: white;
        }

        .footer-col ul {
            list-style: none;
        }

        .footer-col ul li {
            margin-bottom: 10px;
        }

        .footer-col ul li a {
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .footer-col ul li a:hover {
            color: #8E54E9;
        }

        .social-links {
            display: flex;
            gap: 15px;
            margin-top: 20px;
        }

        .social-links a {
            width: 40px;
            height: 40px;
            background: var(--primary-gradient);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .social-links a:hover {
            transform: translateY(-3px);
        }

        .copyright {
            text-align: center;
            margin-top: 40px;
            padding-top: 20px;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            color: rgba(255, 255, 255, 0.7);
        }

        /* Responsive Design */
        @media (max-width: 992px) {
            .search-form {
                grid-template-columns: repeat(2, 1fr);
            }

            .form-group.full-width {
                grid-column: span 2;
            }

            .routes-grid {
                grid-template-columns: 1fr;
            }

            .footer-container {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 768px) {
            nav ul {
                display: none;
            }

            .search-form {
                grid-template-columns: 1fr;
            }

            .form-group.full-width {
                grid-column: span 1;
            }

            .route-info {
                flex-direction: column;
                gap: 15px;
            }

            .footer-container {
                grid-template-columns: 1fr;
            }

            .page-title {
                font-size: 2.2rem;
            }
        }

        /* Mobile Nav Button */
        .mobile-nav-btn {
            display: none;
            background: none;
            border: none;
            color: white;
            font-size: 24px;
            cursor: pointer;
        }

        @media (max-width: 768px) {
            .mobile-nav-btn {
                display: block;
            }

            nav ul {
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100vh;
                background: rgba(26, 41, 128, 0.95);
                flex-direction: column;
                justify-content: center;
                align-items: center;
                z-index: 100;
                transition: all 0.3s ease;
                opacity: 0;
                visibility: hidden;
            }

            nav ul.active {
                opacity: 1;
                visibility: visible;
            }

            nav ul li {
                margin: 15px 0;
            }

            .close-btn {
                position: absolute;
                top: 20px;
                right: 20px;
                background: none;
                border: none;
                color: white;
                font-size: 24px;
                cursor: pointer;
            }
        }
    </style>
</head>
<body>
<!-- Header -->
<header id="header">
    <div class="container header-container">
        <a href="#" class="logo">
            <i class="fas fa-bus"></i>
            LuxuryBus
        </a>
        <nav>

            <ul id="navMenu">
                <li><a href="{{route('basic.index')}}">Home</a></li>
                <li><a href="{{route('basic.route')}}" class="active">Routes</a></li>
                <li><a href="{{route('basic.contact')}}">Contact</a></li>
            </ul>
        </nav>
        <button class="cta-button">Login</button>
    </div>
</header>

<!-- Main Content -->
<main class="main-content">
    <div class="container">
        <div class="page-header">
            <h1 class="page-title">Find Your Perfect Route</h1>
            <p class="page-subtitle">Search from hundreds of routes across the country with luxury buses and premium amenities</p>
        </div>

        <!-- Search Section -->
        <section class="search-section">
            <div class="search-card">
                <h2>Search for Routes</h2>
                <form class="search-form" id="routeSearchForm">
                    <div class="form-group">
                        <label for="from">From</label>
                        <input type="text" id="from" placeholder="Departure city" value="New York">
                    </div>
                    <div class="form-group">
                        <label for="to">To</label>
                        <input type="text" id="to" placeholder="Destination city" value="Boston">
                    </div>
                    <div class="form-group">
                        <label for="date">Departure Date</label>
                        <input type="date" id="date">
                    </div>
                    <div class="form-group">
                        <label for="passengers">Passengers</label>
                        <select id="passengers">
                            <option value="1">1 Passenger</option>
                            <option value="2" selected>2 Passengers</option>
                            <option value="3">3 Passengers</option>
                            <option value="4">4 Passengers</option>
                        </select>
                    </div>
                    <div class="form-group full-width">
                        <button type="submit" class="search-button">Search Routes</button>
                    </div>
                </form>
            </div>
        </section>

        <!-- Results Section -->
        <section class="results-section">
            <h2>Available Routes</h2>

            <div class="routes-grid" id="routesContainer">
                <!-- Route cards will be displayed here -->
            </div>
        </section>
    </div>
</main>

<!-- Footer -->
<footer>
    <div class="container">
        <div class="footer-container">
            <div class="footer-col">
                <h4>LuxuryBus</h4>
                <p>Premium bus travel with comfort, safety, and style. Experience the difference with our luxury services.</p>
                <div class="social-links">
                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-linkedin-in"></i></a>
                </div>
            </div>
            <div class="footer-col">
                <h4>Quick Links</h4>
                <ul>
                    <li><a href="#">Home</a></li>
                    <li><a href="#">Routes</a></li>
                    <li><a href="#">Deals</a></li>
                    <li><a href="#">Contact</a></li>
                </ul>
            </div>
            <div class="footer-col">
                <h4>Popular Routes</h4>
                <ul>
                    <li><a href="#">New York to Boston</a></li>
                    <li><a href="#">Los Angeles to Las Vegas</a></li>
                    <li><a href="#">Chicago to Detroit</a></li>
                    <li><a href="#">Miami to Orlando</a></li>
                </ul>
            </div>
            <div class="footer-col">
                <h4>Support</h4>
                <ul>
                    <li><a href="#">FAQ</a></li>
                    <li><a href="#">Terms of Service</a></li>
                    <li><a href="#">Privacy Policy</a></li>
                    <li><a href="#">Contact Support</a></li>
                </ul>
            </div>
        </div>
        <div class="copyright">
            <p>&copy; 2023 LuxuryBus. All rights reserved.</p>
        </div>
    </div>
</footer>

<script>
    // Set minimum date to today
    document.getElementById('date').min = new Date().toISOString().split("T")[0];
    // Set default date to tomorrow
    const tomorrow = new Date();
    tomorrow.setDate(tomorrow.getDate() + 1);
    document.getElementById('date').value = tomorrow.toISOString().split("T")[0];

    // Sample route data
    const sampleRoutes = [
        {
            from: "New York",
            to: "Boston",
            departure: "08:00 AM",
            arrival: "12:15 PM",
            duration: "4h 15m",
            price: "$29.99",
            busType: "Luxury Coach",
            stops: "Non-stop",
            seats: "32 available"
        },
        {
            from: "New York",
            to: "Boston",
            departure: "10:30 AM",
            arrival: "02:45 PM",
            duration: "4h 15m",
            price: "$32.99",
            busType: "First Class",
            stops: "1 stop",
            seats: "18 available"
        },
        {
            from: "New York",
            to: "Boston",
            departure: "02:00 PM",
            arrival: "06:30 PM",
            duration: "4h 30m",
            price: "$27.99",
            busType: "Standard",
            stops: "2 stops",
            seats: "45 available"
        },
        {
            from: "New York",
            to: "Boston",
            departure: "06:00 PM",
            arrival: "10:15 PM",
            duration: "4h 15m",
            price: "$34.99",
            busType: "Business Class",
            stops: "Non-stop",
            seats: "12 available"
        }
    ];

    // Function to display routes
    function displayRoutes(routes) {
        const routesContainer = document.getElementById('routesContainer');
        routesContainer.innerHTML = '';

        if (routes.length === 0) {
            routesContainer.innerHTML = `
                    <div class="no-results">
                        <i class="fas fa-route"></i>
                        <h3>No routes found</h3>
                        <p>Try adjusting your search criteria to find more options.</p>
                    </div>
                `;
            return;
        }

        routes.forEach(route => {
            const routeCard = document.createElement('div');
            routeCard.className = 'route-card';
            routeCard.innerHTML = `
                    <div class="route-header">
                        <div class="route-title">${route.from} to ${route.to}</div>
                        <div class="route-price">${route.price}</div>
                    </div>
                    <div class="route-content">
                        <div class="route-details">
                            <div class="route-from">
                                <h3>${route.departure}</h3>
                                <p>${route.from}</p>
                            </div>
                            <div class="route-stops">
                                <i class="fas fa-route"></i>
                                <span>${route.stops}</span>
                            </div>
                            <div class="route-to">
                                <h3>${route.arrival}</h3>
                                <p>${route.to}</p>
                            </div>
                        </div>
                        <div class="route-info">
                            <div class="route-info-item">
                                <i class="far fa-clock"></i>
                                <span>Duration</span>
                                <strong>${route.duration}</strong>
                            </div>
                            <div class="route-info-item">
                                <i class="fas fa-chair"></i>
                                <span>Seats</span>
                                <strong>${route.seats}</strong>
                            </div>
                        </div>
                        <div class="route-footer">
                            <div class="bus-type">
                                <i class="fas fa-bus"></i>
                                <span>${route.busType}</span>
                            </div>
                            <button class="route-button">Book Now</button>
                        </div>
                    </div>
                `;
            routesContainer.appendChild(routeCard);
        });
    }

    // Initial display of routes
    displayRoutes(sampleRoutes);

    // Form submission handler
    document.getElementById('routeSearchForm').addEventListener('submit', function(e) {
        e.preventDefault();

        const from = document.getElementById('from').value;
        const to = document.getElementById('to').value;
        const date = document.getElementById('date').value;
        const passengers = document.getElementById('passengers').value;

        // In a real application, you would fetch data from an API
        // For this demo, we'll just filter the sample data
        const filteredRoutes = sampleRoutes.filter(route =>
            route.from.toLowerCase().includes(from.toLowerCase()) &&
            route.to.toLowerCase().includes(to.toLowerCase())
        );

        displayRoutes(filteredRoutes);
    });

    // Mobile navigation
    const mobileNavBtn = document.getElementById('mobileNavBtn');
    const closeNavBtn = document.getElementById('closeNavBtn');
    const navMenu = document.getElementById('navMenu');

    mobileNavBtn.addEventListener('click', function() {
        navMenu.classList.add('active');
        document.body.style.overflow = 'hidden';
    });

    closeNavBtn.addEventListener('click', function() {
        navMenu.classList.remove('active');
        document.body.style.overflow = 'auto';
    });

    // Close mobile nav when clicking on links
    const navLinks = document.querySelectorAll('nav ul li a');
    navLinks.forEach(link => {
        link.addEventListener('click', function() {
            navMenu.classList.remove('active');
            document.body.style.overflow = 'auto';
        });
    });
</script>
</body>
</html>
