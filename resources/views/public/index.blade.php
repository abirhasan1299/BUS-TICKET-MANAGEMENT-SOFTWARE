<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LuxuryBus | Premium Bus Travel</title>
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
            transition: all 0.3s ease;
        }

        header.scrolled {
            padding: 15px 0;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
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

        /* Hero Section */
        .hero {
            min-height: 100vh;
            display: flex;
            align-items: center;
            padding-top: 80px;
            position: relative;
            overflow: hidden;
        }

        .hero-content {
            display: flex;
            align-items: center;
            justify-content: space-between;
            width: 100%;
        }

        .hero-text {
            width: 45%;
            color: white;
        }

        .hero-text h1 {
            font-size: 3.5rem;
            font-weight: 700;
            margin-bottom: 20px;
            line-height: 1.2;
        }

        .hero-text p {
            font-size: 1.2rem;
            margin-bottom: 30px;
            opacity: 0.9;
            font-weight: 300;
        }

        .hero-buttons {
            display: flex;
            gap: 20px;
        }

        .secondary-button {
            background: transparent;
            color: white;
            border: 2px solid white;
            padding: 12px 25px;
            border-radius: 50px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .secondary-button:hover {
            background: white;
            color: #4776E6;
        }

        .search-card {
            background: var(--card-bg);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 30px;
            width: 50%;
            box-shadow: 0 8px 32px rgba(31, 38, 135, 0.2);
            border: 1px solid var(--card-border);
        }

        .search-card h2 {
            color: white;
            margin-bottom: 25px;
            font-size: 1.8rem;
            text-align: center;
        }

        .search-form {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        .form-group {
            margin-bottom: 15px;
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

        .full-width {
            grid-column: span 2;
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

        /* Features Section */
        .features {
            padding: 100px 0;
            position: relative;
        }

        .section-title {
            text-align: center;
            margin-bottom: 60px;
            color: white;
            font-size: 2.5rem;
            font-weight: 700;
        }

        .section-subtitle {
            text-align: center;
            color: rgba(255, 255, 255, 0.8);
            margin-bottom: 60px;
            font-size: 1.2rem;
            max-width: 700px;
            margin-left: auto;
            margin-right: auto;
        }

        .features-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 30px;
        }

        .feature-card {
            background: var(--card-bg);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 40px 30px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
            text-align: center;
            border: 1px solid var(--card-border);
            color: white;
        }

        .feature-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.15);
        }

        .feature-icon {
            width: 80px;
            height: 80px;
            background: var(--primary-gradient);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 25px;
            color: white;
            font-size: 32px;
        }

        .feature-card h3 {
            font-size: 1.5rem;
            margin-bottom: 15px;
            color: white;
        }

        .feature-card p {
            color: rgba(255, 255, 255, 0.9);
            line-height: 1.6;
        }

        /* Popular Routes Section */
        .popular-routes {
            padding: 100px 0;
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(10px);
        }

        .routes-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
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

        .route-image {
            height: 180px;
            background: var(--secondary-gradient);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            color: white;
        }

        .route-content {
            padding: 20px;
        }

        .route-content h3 {
            font-size: 1.3rem;
            margin-bottom: 10px;
            color: white;
        }

        .route-info {
            display: flex;
            justify-content: space-between;
            margin-bottom: 15px;
            font-size: 0.9rem;
            color: rgba(255, 255, 255, 0.8);
        }

        .route-price {
            font-size: 1.4rem;
            font-weight: 700;
            color: white;
            margin-bottom: 15px;
        }

        .route-button {
            background: var(--primary-gradient);
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 8px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
            width: 100%;
            box-shadow: 0 4px 10px rgba(142, 84, 233, 0.3);
        }

        .route-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(142, 84, 233, 0.4);
        }

        .section-button {
            text-align: center;
            margin-top: 50px;
        }

        /* Testimonials Section */
        .testimonials {
            padding: 100px 0;
            position: relative;
        }

        .testimonials-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 30px;
        }

        .testimonial-card {
            background: var(--card-bg);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 30px;
            border: 1px solid var(--card-border);
            color: white;
            transition: all 0.3s ease;
        }

        .testimonial-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.2);
        }

        .testimonial-header {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }

        .testimonial-avatar {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background: var(--secondary-gradient);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 24px;
            margin-right: 15px;
        }

        .testimonial-info h4 {
            font-size: 1.2rem;
            margin-bottom: 5px;
        }

        .testimonial-info span {
            color: rgba(255, 255, 255, 0.7);
            font-size: 0.9rem;
        }

        .testimonial-rating {
            color: #FFD700;
            margin-bottom: 15px;
        }

        .testimonial-content {
            line-height: 1.6;
            color: rgba(255, 255, 255, 0.9);
        }

        /* App Download Section */
        .app-download {
            padding: 100px 0;
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(10px);
        }

        .app-container {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 50px;
            align-items: center;
        }

        .app-content {
            color: white;
        }

        .app-content h2 {
            font-size: 2.5rem;
            margin-bottom: 20px;
        }

        .app-content p {
            font-size: 1.1rem;
            margin-bottom: 30px;
            opacity: 0.9;
            line-height: 1.7;
        }

        .app-features {
            list-style: none;
            margin-bottom: 40px;
        }

        .app-features li {
            margin-bottom: 15px;
            display: flex;
            align-items: center;
        }

        .app-features li i {
            color: #8E54E9;
            margin-right: 15px;
            font-size: 1.2rem;
        }

        .app-buttons {
            display: flex;
            gap: 15px;
        }

        .app-button {
            display: flex;
            align-items: center;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 12px;
            padding: 12px 20px;
            color: white;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .app-button:hover {
            background: rgba(255, 255, 255, 0.2);
            transform: translateY(-3px);
        }

        .app-button i {
            font-size: 2rem;
            margin-right: 10px;
        }

        .app-button span {
            font-size: 0.8rem;
            display: block;
        }

        .app-button strong {
            display: block;
            font-size: 1.1rem;
        }

        .app-image {
            text-align: center;
        }

        .app-image-placeholder {
            width: 300px;
            height: 400px;
            background: var(--secondary-gradient);
            border-radius: 30px;
            margin: 0 auto;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 5rem;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
        }

        /* Footer */
        footer {
            background: rgba(26, 41, 128, 0.9);
            padding: 60px 0 30px;
            color: white;
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
            .hero-content {
                flex-direction: column;
            }

            .hero-text, .search-card {
                width: 100%;
                margin-bottom: 40px;
            }

            .features-grid, .routes-grid, .testimonials-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .app-container {
                grid-template-columns: 1fr;
            }

            .footer-container {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 768px) {
            .search-form {
                grid-template-columns: 1fr;
            }

            .full-width {
                grid-column: span 1;
            }

            nav ul {
                display: none;
            }

            .hero-text h1 {
                font-size: 2.5rem;
            }

            .features-grid, .routes-grid, .testimonials-grid {
                grid-template-columns: 1fr;
            }

            .footer-container {
                grid-template-columns: 1fr;
            }

            .hero-buttons {
                flex-direction: column;
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
            <button class="mobile-nav-btn" id="mobileNavBtn">
                <i class="fas fa-bars"></i>
            </button>
            <ul id="navMenu">
                <li><a href="{{route('basic.index')}}">Home</a></li>
                <li><a href="{{route('basic.route')}}" class="active">Routes</a></li>
                <li><a href="{{route('basic.contact')}}">Contact</a></li>
            </ul>
        </nav>
        <button class="cta-button">Login</button>
    </div>
</header>

<!-- Hero Section -->
<section class="hero" id="home">
    <div class="container hero-content">
        <div class="hero-text">
            <h1>Travel in Luxury, Arrive in Style</h1>
            <p>Experience premium comfort with our luxury bus service. Book your tickets now and enjoy a journey like never before.</p>
            <div class="hero-buttons">
                <button class="cta-button">Book Now</button>
                <button class="secondary-button">Learn More</button>
            </div>
        </div>

        <div class="search-card">
            <h2>Book Your Journey</h2>
            <form class="search-form">
                <div class="form-group">
                    <label for="from">From</label>
                    <input type="text" id="from" placeholder="Departure city">
                </div>
                <div class="form-group">
                    <label for="to">To</label>
                    <input type="text" id="to" placeholder="Destination city">
                </div>
                <div class="form-group">
                    <label for="date">Date</label>
                    <input type="date" id="date">
                </div>
                <div class="form-group">
                    <label for="passengers">Passengers</label>
                    <select id="passengers">
                        <option value="1">1 Passenger</option>
                        <option value="2">2 Passengers</option>
                        <option value="3">3 Passengers</option>
                        <option value="4">4 Passengers</option>
                    </select>
                </div>
                <div class="form-group full-width">
                    <button type="submit" class="search-button">Search Buses</button>
                </div>
            </form>
        </div>
    </div>
</section>

<!-- Features Section -->
<section class="features" id="features">
    <div class="container">
        <h2 class="section-title">Why Choose LuxuryBus?</h2>
        <p class="section-subtitle">Experience the difference of premium travel with our exceptional services and amenities</p>
        <div class="features-grid">
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-couch"></i>
                </div>
                <h3>Premium Comfort</h3>
                <p>Enjoy spacious, reclining seats with extra legroom, perfect for relaxing during your journey.</p>
            </div>

            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-wifi"></i>
                </div>
                <h3>Free Wi-Fi</h3>
                <p>Stay connected with our high-speed internet access available on all luxury buses.</p>
            </div>

            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-plug"></i>
                </div>
                <h3>Power Outlets</h3>
                <p>Charge your devices with individual power outlets available at every seat.</p>
            </div>

            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-tv"></i>
                </div>
                <h3>Entertainment</h3>
                <p>Enjoy onboard entertainment with personal screens and a selection of movies and music.</p>
            </div>

            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-concierge-bell"></i>
                </div>
                <h3>Onboard Service</h3>
                <p>Experience premium service with complimentary snacks and beverages on select routes.</p>
            </div>

            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-shield-alt"></i>
                </div>
                <h3>Safe Travel</h3>
                <p>Travel with peace of mind thanks to our professional drivers and rigorous safety standards.</p>
            </div>
        </div>
    </div>
</section>

<!-- Popular Routes Section -->
<section class="popular-routes" id="routes">
    <div class="container">
        <h2 class="section-title">Popular Routes</h2>
        <p class="section-subtitle">Discover our most traveled routes with multiple daily departures</p>
        <div class="routes-grid">
            <div class="route-card">
                <div class="route-image">
                    <i class="fas fa-route"></i>
                </div>
                <div class="route-content">
                    <h3>New York to Boston</h3>
                    <div class="route-info">
                        <span><i class="far fa-clock"></i> 4h 15m</span>
                        <span><i class="fas fa-bus"></i> Every 2 hours</span>
                    </div>
                    <div class="route-price">From $29.99</div>
                    <button class="route-button">View Schedule</button>
                </div>
            </div>

            <div class="route-card">
                <div class="route-image">
                    <i class="fas fa-route"></i>
                </div>
                <div class="route-content">
                    <h3>Los Angeles to Las Vegas</h3>
                    <div class="route-info">
                        <span><i class="far fa-clock"></i> 5h 30m</span>
                        <span><i class="fas fa-bus"></i> Every 3 hours</span>
                    </div>
                    <div class="route-price">From $39.99</div>
                    <button class="route-button">View Schedule</button>
                </div>
            </div>

            <div class="route-card">
                <div class="route-image">
                    <i class="fas fa-route"></i>
                </div>
                <div class="route-content">
                    <h3>Chicago to Detroit</h3>
                    <div class="route-info">
                        <span><i class="far fa-clock"></i> 4h 45m</span>
                        <span><i class="fas fa-bus"></i> Every 2 hours</span>
                    </div>
                    <div class="route-price">From $34.99</div>
                    <button class="route-button">View Schedule</button>
                </div>
            </div>
        </div>
        <div class="section-button">
            <button class="cta-button">View All Routes</button>
        </div>
    </div>
</section>

<!-- Testimonials Section -->
<section class="testimonials" id="testimonials">
    <div class="container">
        <h2 class="section-title">What Our Customers Say</h2>
        <p class="section-subtitle">Hear from travelers who have experienced the LuxuryBus difference</p>
        <div class="testimonials-grid">
            <div class="testimonial-card">
                <div class="testimonial-header">
                    <div class="testimonial-avatar">
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="testimonial-info">
                        <h4>Sarah Johnson</h4>
                        <span>Business Traveler</span>
                    </div>
                </div>
                <div class="testimonial-rating">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                </div>
                <div class="testimonial-content">
                    <p>"I travel weekly for work and LuxuryBus has transformed my commute. The Wi-Fi is reliable, the seats are incredibly comfortable, and I always arrive feeling refreshed."</p>
                </div>
            </div>

            <div class="testimonial-card">
                <div class="testimonial-header">
                    <div class="testimonial-avatar">
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="testimonial-info">
                        <h4>Michael Chen</h4>
                        <span>Frequent Traveler</span>
                    </div>
                </div>
                <div class="testimonial-rating">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                </div>
                <div class="testimonial-content">
                    <p>"The premium amenities make all the difference. Power outlets at every seat, comfortable legroom, and professional staff. This is how travel should be!"</p>
                </div>
            </div>

            <div class="testimonial-card">
                <div class="testimonial-header">
                    <div class="testimonial-avatar">
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="testimonial-info">
                        <h4>Emily Rodriguez</h4>
                        <span>Student</span>
                    </div>
                </div>
                <div class="testimonial-rating">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star-half-alt"></i>
                </div>
                <div class="testimonial-content">
                    <p>"As a student, I appreciate the affordable luxury. The buses are always clean, on time, and the free Wi-Fi helps me study during long trips."</p>
                </div>
            </div>

            <div class="testimonial-card">
                <div class="testimonial-header">
                    <div class="testimonial-avatar">
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="testimonial-info">
                        <h4>James Wilson</h4>
                        <span>Tourist</span>
                    </div>
                </div>
                <div class="testimonial-rating">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                </div>
                <div class="testimonial-content">
                    <p>"I took the LuxuryBus from New York to Boston and was blown away by the experience. The scenic route views, comfortable seats, and onboard amenities made the journey enjoyable."</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- App Download Section -->
<section class="app-download" id="app">
    <div class="container">
        <div class="app-container">
            <div class="app-content">
                <h2>Download Our Mobile App</h2>
                <p>Book tickets, track your bus in real-time, manage your bookings, and get exclusive offers—all from the palm of your hand.</p>

                <ul class="app-features">
                    <li><i class="fas fa-check-circle"></i> Easy booking and mobile tickets</li>
                    <li><i class="fas fa-check-circle"></i> Real-time bus tracking</li>
                    <li><i class="fas fa-check-circle"></i> Exclusive mobile-only deals</li>
                    <li><i class="fas fa-check-circle"></i> Secure payment options</li>
                    <li><i class="fas fa-check-circle"></i> Travel alerts and notifications</li>
                </ul>

                <div class="app-buttons">
                    <a href="#" class="app-button">
                        <i class="fab fa-apple"></i>
                        <div>
                            <span>Download on the</span>
                            <strong>App Store</strong>
                        </div>
                    </a>
                    <a href="#" class="app-button">
                        <i class="fab fa-google-play"></i>
                        <div>
                            <span>Get it on</span>
                            <strong>Google Play</strong>
                        </div>
                    </a>
                </div>
            </div>

            <div class="app-image">
                <div class="app-image-placeholder">
                    <i class="fas fa-mobile-alt"></i>
                </div>
            </div>
        </div>
    </div>
</section>

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
                    <li><a href="#home">Home</a></li>
                    <li><a href="#features">Features</a></li>
                    <li><a href="#routes">Routes</a></li>
                    <li><a href="#testimonials">Testimonials</a></li>
                    <li><a href="#app">Mobile App</a></li>
                </ul>
            </div>
            <div class="footer-col">
                <h4>Popular Routes</h4>
                <ul>
                    <li><a href="#">New York to Boston</a></li>
                    <li><a href="#">Los Angeles to Las Vegas</a></li>
                    <li><a href="#">Chicago to Detroit</a></li>
                    <li><a href="#">Miami to Orlando</a></li>
                    <li><a href="#">Seattle to Portland</a></li>
                </ul>
            </div>
            <div class="footer-col">
                <h4>Support</h4>
                <ul>
                    <li><a href="#">FAQ</a></li>
                    <li><a href="#">Terms of Service</a></li>
                    <li><a href="#">Privacy Policy</a></li>
                    <li><a href="#">Refund Policy</a></li>
                    <li><a href="#">Booking Guide</a></li>
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

    // Add hover effects to cards
    const cards = document.querySelectorAll('.feature-card, .route-card, .testimonial-card');
    cards.forEach(card => {
        card.addEventListener('mouseenter', () => {
            card.style.transform = 'translateY(-10px)';
            card.style.boxShadow = '0 15px 35px rgba(0, 0, 0, 0.15)';
        });

        card.addEventListener('mouseleave', () => {
            card.style.transform = 'translateY(0)';
            card.style.boxShadow = '0 10px 30px rgba(0, 0, 0, 0.08)';
        });
    });

    // Header scroll effect
    window.addEventListener('scroll', function() {
        const header = document.getElementById('header');
        if (window.scrollY > 50) {
            header.classList.add('scrolled');
        } else {
            header.classList.remove('scrolled');
        }
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

    // Smooth scrolling for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();

            const targetId = this.getAttribute('href');
            if (targetId === '#') return;

            const targetElement = document.querySelector(targetId);
            if (targetElement) {
                window.scrollTo({
                    top: targetElement.offsetTop - 80,
                    behavior: 'smooth'
                });
            }
        });
    });
</script>
</body>
</html>
