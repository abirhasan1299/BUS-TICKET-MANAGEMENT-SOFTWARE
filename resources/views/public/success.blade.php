<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Successful - Bus Ticket</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #10b981;
            --primary-dark: #059669;
            --gradient: linear-gradient(135deg, #10b981 0%, #3b82f6 100%);
            --premium-gold: #f59e0b;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #f0fdf4 0%, #f8fafc 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .success-card {
            background: white;
            border-radius: 20px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
            border: none;
            overflow: hidden;
            max-width: 500px;
            width: 100%;
            position: relative;
        }

        .success-header {
            background: var(--gradient);
            padding: 40px 30px;
            text-align: center;
            color: white;
            position: relative;
        }

        .success-badge {
            background: rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            width: 80px;
            height: 80px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            animation: bounce 2s infinite;
        }

        .success-body {
            padding: 40px 30px;
            text-align: center;
        }

        .ticket-preview {
            background: linear-gradient(135deg, #fffbeb 0%, #fef3c7 100%);
            border: 2px dashed var(--premium-gold);
            border-radius: 15px;
            padding: 25px;
            margin: 25px 0;
            position: relative;
        }

        .ticket-icon {
            font-size: 3rem;
            color: var(--premium-gold);
            margin-bottom: 15px;
        }

        .btn-premium {
            background: var(--gradient);
            border: none;
            color: white;
            padding: 12px 30px;
            border-radius: 50px;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(16, 185, 129, 0.4);
        }

        .btn-premium:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(16, 185, 129, 0.6);
            color: white;
        }

        .btn-outline-premium {
            border: 2px solid var(--primary);
            color: var(--primary);
            background: transparent;
            padding: 12px 30px;
            border-radius: 50px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-outline-premium:hover {
            background: var(--primary);
            color: white;
            transform: translateY(-2px);
        }

        .confetti {
            position: absolute;
            width: 10px;
            height: 10px;
            background: var(--premium-gold);
            border-radius: 50%;
            animation: confetti-fall 5s linear infinite;
        }

        @keyframes bounce {
            0%, 20%, 50%, 80%, 100% {transform: translateY(0);}
            40% {transform: translateY(-10px);}
            60% {transform: translateY(-5px);}
        }

        @keyframes confetti-fall {
            0% {transform: translateY(-100px) rotate(0deg); opacity: 1;}
            100% {transform: translateY(500px) rotate(360deg); opacity: 0;}
        }

        .feature-list {
            text-align: left;
            margin: 25px 0;
        }

        .feature-item {
            display: flex;
            align-items: center;
            margin-bottom: 12px;
            color: #64748b;
        }

        .feature-item i {
            color: var(--primary);
            margin-right: 10px;
            font-size: 1.1rem;
        }

        .success-message {
            font-size: 1.1rem;
            color: #64748b;
            line-height: 1.6;
            margin-bottom: 25px;
        }
    </style>
</head>
<body>
<div class="success-card">
    <!-- Confetti Animation -->
    <div id="confetti-container"></div>

    <!-- Header -->
    <div class="success-header">
        <div class="success-badge">
            <i class="bi bi-check-lg" style="font-size: 2.5rem;"></i>
        </div>
        <h2 class="mb-2">Payment Successful!</h2>
        <p class="mb-0">Your booking has been confirmed</p>
    </div>

    <!-- Body -->
    <div class="success-body">
        <div class="success-message">
            <strong>Congratulations!</strong> Your payment has been processed successfully.
            The ticket has been added to your account and is ready for download.
        </div>

        <!-- Ticket Preview -->
        <div class="ticket-preview">
            <i class="bi bi-ticket-perforated ticket-icon"></i>
            <h5 class="text-dark mb-2">E-Ticket Generated</h5>
            <p class="text-muted mb-3">Your digital ticket is ready for travel</p>
            <div class="feature-list">
                <div class="feature-item">
                    <i class="bi bi-check-circle-fill"></i>
                    <span>Instant confirmation</span>
                </div>
                <div class="feature-item">
                    <i class="bi bi-qr-code"></i>
                    <span>QR code included</span>
                </div>
                <div class="feature-item">
                    <i class="bi bi-phone"></i>
                    <span>Mobile friendly</span>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="d-grid gap-3">
            <button class="btn btn-premium" onclick="downloadTicket()">
                <i class="bi bi-download me-2"></i>Download Ticket
            </button>
            <button class="btn btn-outline-premium" onclick="goToHome()">
                <i class="bi bi-house me-2"></i>Home
            </button>
        </div>

        <!-- Additional Info -->
        <div class="mt-4">
            <small class="text-muted">
                <i class="bi bi-info-circle me-1"></i>
                Please show your ticket QR code to the bus operator before boarding
            </small>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Create confetti effect
    function createConfetti() {
        const container = document.getElementById('confetti-container');
        const colors = ['#10b981', '#3b82f6', '#f59e0b', '#ef4444', '#8b5cf6'];

        for (let i = 0; i < 50; i++) {
            const confetti = document.createElement('div');
            confetti.className = 'confetti';
            confetti.style.left = Math.random() * 100 + 'vw';
            confetti.style.background = colors[Math.floor(Math.random() * colors.length)];
            confetti.style.animationDelay = Math.random() * 5 + 's';
            confetti.style.width = Math.random() * 10 + 5 + 'px';
            confetti.style.height = confetti.style.width;
            container.appendChild(confetti);
        }
    }

    // Simulate ticket download
    function downloadTicket() {
        // Show loading state
        const btn = event.target;
        const originalText = btn.innerHTML;
        btn.innerHTML = '<i class="bi bi-hourglass-split me-2"></i>Preparing Ticket...';
        btn.disabled = true;

        // Simulate download process
        setTimeout(() => {
            // In real implementation, this would download the actual ticket PDF
            alert('Ticket download started! Check your downloads folder.');
            btn.innerHTML = originalText;
            btn.disabled = false;

            // You would typically call your backend download endpoint here
            // window.location.href = '#';
        }, 2000);
    }

    function goToHome() {
        window.location.href = '{{route('users.cart')}}';
    }

    // Initialize confetti when page loads
    document.addEventListener('DOMContentLoaded', function() {
        createConfetti();

        // Add celebration sound (optional)
        // const audio = new Audio('success-sound.mp3');
        // audio.volume = 0.3;
        // audio.play().catch(e => console.log('Audio play failed:', e));
    });
</script>
</body>
</html>
