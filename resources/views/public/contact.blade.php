<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us | LuxuryBus</title>
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

        /* Contact Section */
        .contact-section {
            margin-bottom: 60px;
        }

        .contact-container {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 40px;
        }

        .contact-info {
            color: white;
        }

        .contact-info h2 {
            font-size: 2.2rem;
            margin-bottom: 20px;
            color: white;
        }

        .contact-info p {
            margin-bottom: 30px;
            opacity: 0.9;
            font-size: 1.1rem;
            line-height: 1.7;
        }

        .contact-details {
            list-style: none;
            margin-top: 30px;
        }

        .contact-details li {
            margin-bottom: 25px;
            display: flex;
            align-items: flex-start;
        }

        .contact-details li i {
            width: 50px;
            height: 50px;
            background: var(--primary-gradient);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 15px;
            color: white;
            font-size: 1.2rem;
            flex-shrink: 0;
        }

        .contact-details li div {
            flex: 1;
        }

        .contact-details li strong {
            display: block;
            margin-bottom: 5px;
            font-size: 1.1rem;
        }

        .contact-details li span {
            display: block;
            color: rgba(255, 255, 255, 0.9);
        }

        .contact-form-container {
            background: var(--card-bg);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 40px;
            border: 1px solid var(--card-border);
            box-shadow: 0 8px 32px rgba(31, 38, 135, 0.2);
        }

        .contact-form-container h2 {
            color: white;
            margin-bottom: 25px;
            font-size: 1.8rem;
            text-align: center;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            color: white;
            margin-bottom: 8px;
            font-weight: 500;
        }

        .form-group input,
        .form-group select,
        .form-group textarea {
            width: 100%;
            padding: 15px;
            border-radius: 12px;
            border: none;
            background: rgba(255, 255, 255, 0.9);
            font-size: 16px;
            transition: all 0.3s ease;
        }

        .form-group input:focus,
        .form-group select:focus,
        .form-group textarea:focus {
            outline: none;
            box-shadow: 0 0 0 3px rgba(142, 84, 233, 0.3);
        }

        .form-group textarea {
            min-height: 150px;
            resize: vertical;
        }

        .submit-button {
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

        .submit-button:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(142, 84, 233, 0.4);
        }

        /* FAQ Section */
        .faq-section {
            margin-top: 80px;
        }

        .faq-container {
            background: var(--card-bg);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 40px;
            border: 1px solid var(--card-border);
            box-shadow: 0 8px 32px rgba(31, 38, 135, 0.2);
        }

        .faq-container h2 {
            color: white;
            text-align: center;
            margin-bottom: 40px;
            font-size: 2rem;
        }

        .faq-item {
            margin-bottom: 20px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            padding-bottom: 20px;
        }

        .faq-question {
            color: white;
            font-size: 1.2rem;
            font-weight: 600;
            margin-bottom: 15px;
            cursor: pointer;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .faq-question i {
            transition: transform 0.3s ease;
        }

        .faq-answer {
            color: rgba(255, 255, 255, 0.9);
            line-height: 1.6;
            overflow: hidden;
            max-height: 0;
            transition: max-height 0.3s ease;
        }

        .faq-item.active .faq-answer {
            max-height: 500px;
        }

        .faq-item.active .faq-question i {
            transform: rotate(180deg);
        }

        /* Map Section */
        .map-section {
            margin-top: 80px;
        }

        .map-container {
            background: var(--card-bg);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 30px;
            border: 1px solid var(--card-border);
            box-shadow: 0 8px 32px rgba(31, 38, 135, 0.2);
            overflow: hidden;
        }

        .map-container h2 {
            color: white;
            text-align: center;
            margin-bottom: 30px;
            font-size: 2rem;
        }

        .map-placeholder {
            height: 400px;
            background: var(--secondary-gradient);
            border-radius: 15px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            color: white;
        }

        .map-placeholder i {
            font-size: 4rem;
            margin-bottom: 20px;
        }

        .map-placeholder h3 {
            font-size: 1.5rem;
            margin-bottom: 10px;
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
            .contact-container {
                grid-template-columns: 1fr;
                gap: 30px;
            }

            .footer-container {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 768px) {
            nav ul {
                display: none;
            }

            .footer-container {
                grid-template-columns: 1fr;
            }

            .page-title {
                font-size: 2.2rem;
            }

            .contact-form-container,
            .faq-container,
            .map-container {
                padding: 25px;
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
               
                <ul id="navMenu">
                    <li><a href="{{route('basic.index')}}">Home</a></li>
                    <li><a href="{{route('basic.route')}}" class="active">Routes</a></li>
                    <li><a href="{{route('basic.contact')}}">Contact</a></li>
                </ul>
            </ul>
        </nav>
        <button class="cta-button">Login</button>
    </div>
</header>

<!-- Main Content -->
<main class="main-content">
    <div class="container">
        <div class="page-header">
            <h1 class="page-title">Get In Touch With Us</h1>
            <p class="page-subtitle">We're here to help you with any questions or concerns about your travel plans</p>
        </div>

        <!-- Contact Section -->
        <section class="contact-section">
            <div class="contact-container">
                <div class="contact-info">
                    <h2>We'd Love to Hear From You</h2>
                    <p>Whether you have questions about our services, need assistance with your booking, or want to provide feedback, our team is ready to help you.</p>

                    <ul class="contact-details">
                        <li>
                            <i class="fas fa-map-marker-alt"></i>
                            <div>
                                <strong>Headquarters</strong>
                                <span>123 Luxury Avenue, New York, NY 10001</span>
                            </div>
                        </li>
                        <li>
                            <i class="fas fa-phone-alt"></i>
                            <div>
                                <strong>Phone Number</strong>
                                <span>+1 (800) 555-LUXURY (589787)</span>
                            </div>
                        </li>
                        <li>
                            <i class="fas fa-envelope"></i>
                            <div>
                                <strong>Email Address</strong>
                                <span>info@luxurybus.com</span>
                            </div>
                        </li>
                        <li>
                            <i class="fas fa-clock"></i>
                            <div>
                                <strong>Customer Service Hours</strong>
                                <span>24/7 Support</span>
                            </div>
                        </li>
                    </ul>
                </div>

                <div class="contact-form-container">
                    <h2>Send Us a Message</h2>
                    <form id="contactForm">
                        <div class="form-group">
                            <label for="name">Full Name</label>
                            <input type="text" id="name" placeholder="Your full name" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email Address</label>
                            <input type="email" id="email" placeholder="Your email address" required>
                        </div>
                        <div class="form-group">
                            <label for="subject">Subject</label>
                            <select id="subject" required>
                                <option value="">Select a subject</option>
                                <option value="booking">Booking Inquiry</option>
                                <option value="support">Customer Support</option>
                                <option value="feedback">Feedback</option>
                                <option value="complaint">Complaint</option>
                                <option value="other">Other</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="message">Message</label>
                            <textarea id="message" placeholder="How can we help you?" required></textarea>
                        </div>
                        <button type="submit" class="submit-button">Send Message</button>
                    </form>
                </div>
            </div>
        </section>

        <!-- FAQ Section -->
        <section class="faq-section">
            <div class="faq-container">
                <h2>Frequently Asked Questions</h2>

                <div class="faq-item active">
                    <div class="faq-question">
                        How do I change or cancel my booking?
                        <i class="fas fa-chevron-down"></i>
                    </div>
                    <div class="faq-answer">
                        You can change or cancel your booking through our website or mobile app. Simply log in to your account, go to "My Bookings", and select the booking you wish to modify. Please note that cancellation policies may vary depending on the fare type and timing.
                    </div>
                </div>

                <div class="faq-item">
                    <div class="faq-question">
                        What amenities are available on your buses?
                        <i class="fas fa-chevron-down"></i>
                    </div>
                    <div class="faq-answer">
                        Our luxury buses are equipped with comfortable reclining seats, free Wi-Fi, power outlets, air conditioning, onboard restrooms, and entertainment systems. Some routes also offer complimentary snacks and beverages.
                    </div>
                </div>

                <div class="faq-item">
                    <div class="faq-question">
                        How early should I arrive before departure?
                        <i class="fas fa-chevron-down"></i>
                    </div>
                    <div class="faq-answer">
                        We recommend arriving at least 30 minutes before scheduled departure for domestic routes and 45 minutes for international routes. This allows sufficient time for boarding and storing your luggage.
                    </div>
                </div>

                <div class="faq-item">
                    <div class="faq-question">
                        What is your luggage policy?
                        <i class="fas fa-chevron-down"></i>
                    </div>
                    <div class="faq-answer">
                        Each passenger may bring one carry-on bag (max 15 lbs) and two checked bags (max 50 lbs each). Additional baggage may be subject to fees. Some restrictions apply for oversized or special items.
                    </div>
                </div>
            </div>
        </section>

        <!-- Map Section -->
        <section class="map-section">
            <div class="map-container">
                <h2>Our Main Office</h2>
                <div class="map-placeholder">
                    <i class="fas fa-map-marked-alt"></i>
                    <h3>Interactive Map</h3>
                    <p>123 Luxury Avenue, New York, NY 10001</p>
                </div>
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
    // Form submission handler
    document.getElementById('contactForm').addEventListener('submit', function(e) {
        e.preventDefault();

        // In a real application, you would send the form data to a server
        // For this demo, we'll just show an alert
        alert('Thank you for your message! We will get back to you soon.');
        this.reset();
    });

    // FAQ accordion functionality
    const faqItems = document.querySelectorAll('.faq-item');

    faqItems.forEach(item => {
        const question = item.querySelector('.faq-question');

        question.addEventListener('click', () => {
            // Close all other items
            faqItems.forEach(otherItem => {
                if (otherItem !== item) {
                    otherItem.classList.remove('active');
                }
            });

            // Toggle current item
            item.classList.toggle('active');
        });
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
