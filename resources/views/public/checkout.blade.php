<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout - Confirm Your Booking</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #3a86ff;
            --secondary: #ff006e;
            --accent: #8338ec;
            --light: #f8f9fa;
            --dark: #212529;
            --gradient-start: #3a86ff;
            --gradient-end: #8338ec;
            --success: #28a745;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, var(--gradient-start), var(--gradient-end));
            min-height: 100vh;
            margin: 0;
            padding: 0;
            color: var(--dark);
        }

        .container {
            padding-top: 30px;
            padding-bottom: 50px;
        }

        .card {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
            overflow: hidden;
            color: var(--dark);
        }

        .card-header {
            background: linear-gradient(to right, var(--primary), var(--accent));
            color: white;
            padding: 20px 30px;
            border-bottom: none;
        }

        .btn-primary {
            background: linear-gradient(to right, var(--primary), var(--accent));
            border: none;
            padding: 12px 30px;
            font-weight: 600;
            border-radius: 8px;
            transition: all 0.3s;
        }

        .btn-primary:hover {
            background: linear-gradient(to right, var(--accent), var(--primary));
            transform: translateY(-2px);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
        }

        .btn-success {
            background: linear-gradient(to right, var(--success), #20c997);
            border: none;
            padding: 10px 20px;
            font-weight: 600;
            border-radius: 8px;
            transition: all 0.3s;
        }

        .btn-success:hover {
            background: linear-gradient(to right, #20c997, var(--success));
            transform: translateY(-2px);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
        }

        .form-control, .form-select {
            border: 2px solid #e9ecef;
            border-radius: 8px;
            padding: 12px 15px;
            transition: all 0.3s;
        }

        .form-control:focus, .form-select:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 0.25rem rgba(58, 134, 255, 0.25);
        }

        .form-label {
            font-weight: 500;
            margin-bottom: 8px;
            color: #495057;
        }

        .booking-details {
            background: #f8f9fa;
            border-radius: 10px;
            padding: 20px;
        }

        .detail-item {
            display: flex;
            justify-content: space-between;
            margin-bottom: 15px;
            padding-bottom: 15px;
            border-bottom: 1px solid #e9ecef;
        }

        .detail-item:last-child {
            border-bottom: none;
            margin-bottom: 0;
            padding-bottom: 0;
        }

        .detail-label {
            font-weight: 500;
            color: #6c757d;
        }

        .detail-value {
            font-weight: 600;
        }

        .price-summary {
            background: #f8f9fa;
            border-radius: 10px;
            padding: 20px;
            margin-top: 20px;
        }

        .summary-item {
            display: flex;
            justify-content: space-between;
            margin-bottom: 12px;
        }

        .discount-item {
            display: flex;
            justify-content: space-between;
            margin-bottom: 12px;
            color: var(--success);
        }

        .total-price {
            font-weight: 700;
            font-size: 1.4rem;
            color: var(--primary);
            border-top: 2px solid #dee2e6;
            padding-top: 15px;
            margin-top: 15px;
        }

        .coupon-section {
            background: #f8f9fa;
            border-radius: 10px;
            padding: 20px;
            margin-top: 20px;
        }

        .coupon-input-group {
            display: flex;
            gap: 10px;
        }

        .payment-methods {
            margin-top: 25px;
        }

        .payment-card {
            border: 2px solid #e9ecef;
            border-radius: 10px;
            padding: 15px;
            margin-bottom: 15px;
            cursor: pointer;
            transition: all 0.3s;
        }

        .payment-card:hover, .payment-card.selected {
            border-color: var(--primary);
            background-color: rgba(58, 134, 255, 0.05);
        }

        .payment-card.selected {
            background-color: rgba(58, 134, 255, 0.1);
        }

        .icon-circle {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: linear-gradient(to right, var(--primary), var(--accent));
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.5rem;
            margin-bottom: 15px;
        }

        .section-title {
            position: relative;
            padding-bottom: 15px;
            margin-bottom: 20px;
            font-weight: 600;
        }

        .section-title::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 50px;
            height: 3px;
            background: linear-gradient(to right, var(--primary), var(--accent));
            border-radius: 3px;
        }

        .highlight-box {
            background: linear-gradient(to right, rgba(58, 134, 255, 0.1), rgba(131, 56, 236, 0.1));
            border-left: 4px solid var(--primary);
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="text-center mb-4">
        <h1 class="text-white">Confirm Your Booking</h1>
        <p class="text-light">Review your details and complete the payment</p>
    </div>

    <div class="card">
        <div class="card-header">
            <h3 class="mb-0"><i class="fas fa-check-circle me-2"></i>Checkout</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <!-- Left Column - Booking Details -->
                <div class="col-md-6">
                    <div class="icon-circle mx-auto mb-4">
                        <i class="fas fa-user"></i>
                    </div>
                    <h4 class="text-center section-title">Passenger Details</h4>

                    <div class="booking-details">
                        <div class="detail-item">
                            <span class="detail-label">Full Name:</span>
                            <span class="detail-value" id="summary-name">John Doe</span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label">Email:</span>
                            <span class="detail-value" id="summary-email">johndoe@example.com</span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label">Phone:</span>
                            <span class="detail-value" id="summary-phone">+1 (555) 123-4567</span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label">Gender:</span>
                            <span class="detail-value" id="summary-gender">Male</span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label">Age:</span>
                            <span class="detail-value" id="summary-age">32</span>
                        </div>
                    </div>

                    <h4 class="mt-5 section-title">Journey Details</h4>

                    <div class="booking-details">
                        <div class="detail-item">
                            <span class="detail-label">Route:</span>
                            <span class="detail-value">New York to Chicago</span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label">Departure:</span>
                            <span class="detail-value">Aug 15, 2023 • 10:30 PM</span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label">Bus:</span>
                            <span class="detail-value">Luxury Coach (AC Sleeper)</span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label">Selected Seats:</span>
                            <span class="detail-value" id="summary-seats">A1, B3, C2</span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label">Duration:</span>
                            <span class="detail-value">12h 30m</span>
                        </div>
                    </div>

                    <div class="highlight-box mt-4">
                        <h5><i class="fas fa-info-circle me-2"></i>Important Information</h5>
                        <p class="mb-0">Please arrive at the boarding point at least 30 minutes before departure. Bring a valid ID proof for verification.</p>
                    </div>
                </div>

                <!-- Right Column - Payment & Summary -->
                <div class="col-md-6">
                    <div class="icon-circle mx-auto mb-4">
                        <i class="fas fa-credit-card"></i>
                    </div>
                    <h4 class="text-center section-title">Payment Summary</h4>

                    <div class="price-summary">
                        <div class="summary-item">
                            <span>Seats (3)</span>
                            <span>$135.00</span>
                        </div>
                        <div class="summary-item">
                            <span>Taxes & Fees</span>
                            <span>$13.50</span>
                        </div>
                        <div class="discount-item">
                            <span>Discount (EARLYBIRD15)</span>
                            <span>-$20.25</span>
                        </div>
                        <div class="summary-item total-price">
                            <span>Total Amount</span>
                            <span>$128.25</span>
                        </div>
                    </div>

                    <div class="coupon-section">
                        <h5 class="mb-3">Apply Coupon</h5>
                        <div class="coupon-input-group">
                            <input type="text" class="form-control" placeholder="Enter coupon code">
                            <button class="btn btn-success">Apply</button>
                        </div>
                        <div class="mt-3">
                            <span class="badge bg-success me-2">EARLYBIRD15</span>
                            <span class="badge bg-secondary">SUMMER10</span>
                            <span class="badge bg-secondary">WELCOME5</span>
                        </div>
                    </div>

                    <div class="payment-methods">
                        <h5 class="mb-3 section-title">Select Payment Method</h5>

                        <div class="payment-card selected">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="paymentMethod" id="creditCard" checked>
                                <label class="form-check-label fw-bold" for="creditCard">
                                    Credit/Debit Card
                                </label>
                            </div>
                            <div class="mt-2">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="mb-3">
                                            <label for="cardNumber" class="form-label">Card Number</label>
                                            <input type="text" class="form-control" id="cardNumber" placeholder="1234 5678 9012 3456">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="expiryDate" class="form-label">Expiry Date</label>
                                            <input type="text" class="form-control" id="expiryDate" placeholder="MM/YY">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="cvv" class="form-label">CVV</label>
                                            <input type="text" class="form-control" id="cvv" placeholder="123">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="mb-3">
                                            <label for="cardName" class="form-label">Name on Card</label>
                                            <input type="text" class="form-control" id="cardName" placeholder="John Doe">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="payment-card">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="paymentMethod" id="paypal">
                                <label class="form-check-label fw-bold" for="paypal">
                                    PayPal
                                </label>
                            </div>
                        </div>

                        <div class="payment-card">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="paymentMethod" id="googlePay">
                                <label class="form-check-label fw-bold" for="googlePay">
                                    Google Pay
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="form-check mt-4">
                        <input class="form-check-input" type="checkbox" id="termsCheck" checked>
                        <label class="form-check-label" for="termsCheck">
                            I agree to the <a href="#">terms and conditions</a> and <a href="#">privacy policy</a>
                        </label>
                    </div>

                    <button class="btn btn-primary w-100 mt-4 btn-lg">
                        <i class="fas fa-check-circle me-2"></i>Confirm Booking & Pay Now
                    </button>

                    <p class="text-center text-muted mt-3">Your booking will be confirmed immediately after successful payment</p>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Payment method selection
        const paymentCards = document.querySelectorAll('.payment-card');

        paymentCards.forEach(card => {
            card.addEventListener('click', function() {
                // Remove selected class from all cards
                paymentCards.forEach(c => c.classList.remove('selected'));

                // Add selected class to clicked card
                this.classList.add('selected');

                // Check the radio button inside this card
                const radioBtn = this.querySelector('input[type="radio"]');
                if (radioBtn) {
                    radioBtn.checked = true;
                }
            });
        });

        // Simulate loading user data from previous page
        // In a real application, this would come from your form or session storage
        const userData = {
            name: "John Doe",
            email: "johndoe@example.com",
            phone: "+1 (555) 123-4567",
            gender: "Male",
            age: "32",
            seats: "A1, B3, C2"
        };

        // Populate user data
        document.getElementById('summary-name').textContent = userData.name;
        document.getElementById('summary-email').textContent = userData.email;
        document.getElementById('summary-phone').textContent = userData.phone;
        document.getElementById('summary-gender').textContent = userData.gender;
        document.getElementById('summary-age').textContent = userData.age;
        document.getElementById('summary-seats').textContent = userData.seats;
    });
</script>
</body>
</html>
