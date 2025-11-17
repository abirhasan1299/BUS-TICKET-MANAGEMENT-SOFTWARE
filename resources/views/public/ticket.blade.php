<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Bus Ticket</title>
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
            padding: 20px;
            color: var(--dark);
        }

        .ticket-container {
            max-width: 800px;
            margin: 0 auto;
        }

        .ticket {
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
            overflow: hidden;
            position: relative;
        }

        .ticket-header {
            background: linear-gradient(to right, var(--primary), var(--accent));
            color: white;
            padding: 20px 30px;
            position: relative;
        }

        .ticket-body {
            padding: 30px;
        }

        .ticket-ribbon {
            position: absolute;
            top: 20px;
            right: -30px;
            background: var(--success);
            color: white;
            padding: 8px 40px;
            transform: rotate(45deg);
            font-weight: 600;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
        }

        .ticket-details {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-bottom: 20px;
        }

        .detail-card {
            background: #f8f9fa;
            border-radius: 10px;
            padding: 15px;
            border-left: 4px solid var(--primary);
        }

        .detail-item {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
            padding-bottom: 10px;
            border-bottom: 1px dashed #dee2e6;
            font-size: 0.9rem;
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

        .route-display {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin: 20px 0;
            position: relative;
        }

        .route-point {
            text-align: center;
            flex: 1;
        }

        .route-point h4 {
            font-weight: 700;
            margin-bottom: 5px;
            font-size: 1.2rem;
        }

        .route-point p {
            color: #6c757d;
            margin: 0;
            font-size: 0.9rem;
        }

        .route-point .detail-value {
            font-size: 1.1rem;
        }

        .route-line {
            flex-grow: 1;
            height: 3px;
            background: linear-gradient(to right, var(--primary), var(--accent));
            margin: 0 15px;
            position: relative;
        }

        .route-line::before {
            content: '';
            position: absolute;
            top: -5px;
            left: 0;
            width: 100%;
            height: 13px;
            border-top: 1px dashed #dee2e6;
            border-bottom: 1px dashed #dee2e6;
        }

        .ticket-footer {
            background: #f8f9fa;
            padding: 15px 30px;
            border-top: 1px solid #e9ecef;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .barcode {
            text-align: center;
            padding: 10px;
            background: white;
            border-radius: 8px;
            border: 1px solid #dee2e6;
            margin: 15px auto;
            max-width: 180px;
        }

        .barcode img {
            max-width: 100%;
            height: auto;
        }

        .terms {
            font-size: 0.75rem;
            color: #6c757d;
            margin-top: 15px;
            text-align: center;
        }

        .btn-print {
            background: linear-gradient(to right, var(--primary), var(--accent));
            border: none;
            padding: 10px 25px;
            font-weight: 600;
            border-radius: 8px;
            color: white;
            transition: all 0.3s;
        }

        .btn-print:hover {
            background: linear-gradient(to right, var(--accent), var(--primary));
            transform: translateY(-2px);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
        }

        .ticket-number {
            font-size: 1.1rem;
            font-weight: 700;
            color: var(--primary);
        }

        .company-logo {
            font-size: 1.6rem;
            font-weight: 700;
        }

        .ticket-type {
            background: rgba(255, 255, 255, 0.2);
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 0.8rem;
            display: inline-block;
            margin-top: 8px;
        }

        /* Print-specific styles */
        @media print {
            body {
                background: white !important;
                padding: 0;
                margin: 0;
                height: 100%;
            }

            .ticket-container {
                max-width: 100%;
                margin: 0;
                padding: 0;
            }

            .ticket {
                box-shadow: none;
                border: 1px solid #dee2e6;
                border-radius: 0;
                margin: 0;
                padding: 0;
                width: 100%;
                height: auto;
                page-break-inside: avoid;
            }

            .no-print {
                display: none !important;
            }

            .ticket-header {
                padding: 15px 20px;
            }

            .ticket-body {
                padding: 20px;
            }

            .ticket-details {
                gap: 15px;
                margin-bottom: 15px;
            }

            .detail-card {
                padding: 12px;
            }

            .route-display {
                margin: 15px 0;
            }

            .ticket-footer {
                padding: 12px 20px;
            }

            /* Ensure everything fits on one page */
            html, body {
                height: 100%;
                overflow: hidden;
            }

            .ticket {
                height: auto;
                min-height: 100%;
            }
        }

        /* Ensure content fits on one page */
        @page {
            size: portrait;
            margin: 0;
        }
    </style>
</head>
<body>
<div class="ticket-container">
    <div class="d-flex justify-content-between align-items-center mb-4 no-print">
        <h1 class="text-white">Your Bus Ticket</h1>
        <button class="btn-print" onclick="window.print()">
            <i class="fas fa-print me-2"></i>Print Ticket
        </button>
    </div>

    <div class="ticket">
        <div class="ticket-header">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <div class="company-logo">PremiumBus</div>
                    <div class="ticket-type">E-TICKET • AC SLEEPER</div>
                </div>
                <div class="text-end">
                    <div class="ticket-number">TN: PB28361945</div>
                    <div>Booking Date: Aug 10, 2023</div>
                </div>
            </div>
            <div class="ticket-ribbon">CONFIRMED</div>
        </div>

        <div class="ticket-body">
            <div class="route-display">
                <div class="route-point">
                    <h4>New York</h4>
                    <p>Port Authority</p>
                    <div class="detail-value">10:30 PM</div>
                    <div class="detail-label">Aug 15, 2023</div>
                </div>

                <div class="route-line"></div>

                <div class="route-point">
                    <h4>Chicago</h4>
                    <p>Union Station</p>
                    <div class="detail-value">11:00 AM</div>
                    <div class="detail-label">Aug 16, 2023</div>
                </div>
            </div>

            <div class="ticket-details">
                <div class="detail-card">
                    <h5 class="mb-3"><i class="fas fa-user me-2"></i>Passenger Details</h5>
                    <div class="detail-item">
                        <span class="detail-label">Name:</span>
                        <span class="detail-value">John Doe</span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Gender:</span>
                        <span class="detail-value">Male</span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Age:</span>
                        <span class="detail-value">32 years</span>
                    </div>
                </div>

                <div class="detail-card">
                    <h5 class="mb-3"><i class="fas fa-chair me-2"></i>Seat Details</h5>
                    <div class="detail-item">
                        <span class="detail-label">Seats:</span>
                        <span class="detail-value">A1, B3, C2</span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Bus:</span>
                        <span class="detail-value">Luxury Coach</span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Coach No:</span>
                        <span class="detail-value">PB-2284</span>
                    </div>
                </div>
            </div>

            <div class="ticket-details">
                <div class="detail-card">
                    <h5 class="mb-3"><i class="fas fa-route me-2"></i>Journey Details</h5>
                    <div class="detail-item">
                        <span class="detail-label">Duration:</span>
                        <span class="detail-value">12h 30m</span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Distance:</span>
                        <span class="detail-value">790 miles</span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Bus Type:</span>
                        <span class="detail-value">AC Sleeper</span>
                    </div>
                </div>

                <div class="detail-card">
                    <h5 class="mb-3"><i class="fas fa-receipt me-2"></i>Fare Details</h5>
                    <div class="detail-item">
                        <span class="detail-label">Base Fare:</span>
                        <span class="detail-value">$135.00</span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Taxes & Fees:</span>
                        <span class="detail-value">$13.50</span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Discount:</span>
                        <span class="detail-value" style="color: var(--success);">-$20.25</span>
                    </div>
                    <div class="detail-item" style="border-top: 2px solid #dee2e6;">
                        <span class="detail-label" style="font-weight: 700;">Total Amount:</span>
                        <span class="detail-value" style="font-weight: 700;">$128.25</span>
                    </div>
                </div>
            </div>

            <div class="barcode">
                <img src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=PB28361945" alt="Ticket Barcode">
                <div class="mt-2">PB28361945</div>
            </div>

            <div class="terms">
                <p>• Please arrive at the boarding point at least 30 minutes before departure<br>
                    • Bring a valid photo ID for verification<br>
                    • Ticket is non-transferable and non-refundable<br>
                    • Boarding gates close 5 minutes before scheduled departure</p>
            </div>
        </div>

        <div class="ticket-footer">
            <div>
                <div>For support contact: support@premiumbus.com</div>
                <div>Call: +1 (555) 123-4567</div>
            </div>
            <div class="text-end">
                <div>Thank you for choosing PremiumBus!</div>
                <div>Have a safe journey!</div>
            </div>
        </div>
    </div>

    <div class="text-center mt-4 no-print">
        <button class="btn btn-light me-2" onclick="window.print()">
            <i class="fas fa-print me-2"></i>Print Ticket
        </button>
        <button class="btn btn-light" onclick="downloadPDF()">
            <i class="fas fa-download me-2"></i>Download PDF
        </button>
        <button class="btn btn-light ms-2">
            <i class="fas fa-envelope me-2"></i>Email Ticket
        </button>
    </div>
</div>

<script>
    // Function to handle PDF download (would need a proper PDF library in a real application)
    function downloadPDF() {
        alert("In a real application, this would generate and download a PDF version of your ticket.");
        // Actual implementation would use a library like jsPDF or html2pdf.js
    }

    // In a real application, this would be populated from your backend or form data
    document.addEventListener('DOMContentLoaded', function() {
        // Sample data - in a real app, this would come from your database or form submission
        const ticketData = {
            passengerName: "John Doe",
            passengerGender: "Male",
            passengerAge: "32",
            seats: "A1, B3, C2",
            from: "New York",
            fromStation: "Port Authority",
            to: "Chicago",
            toStation: "Union Station",
            departureTime: "10:30 PM",
            departureDate: "Aug 15, 2023",
            arrivalTime: "11:00 AM",
            arrivalDate: "Aug 16, 2023",
            busType: "Luxury Coach",
            coachNumber: "PB-2284",
            duration: "12h 30m",
            distance: "790 miles",
            baseFare: "$135.00",
            taxes: "$13.50",
            discount: "$20.25",
            totalAmount: "$128.25",
            ticketNumber: "PB28361945",
            bookingDate: "Aug 10, 2023"
        };

        // Populate ticket with data
        // You would set these values in a real application
    });

    // Add event listener for before print to optimize layout
    window.addEventListener('beforeprint', function() {
        // Add any pre-print adjustments here if needed
    });
</script>
</body>
</html>
