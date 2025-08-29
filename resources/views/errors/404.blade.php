<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 Not Found</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            background: #f5f7fa;
            font-family: 'Segoe UI', sans-serif;
            margin: 0;
        }

        .error-container {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .error-code {
            font-size: 12rem;
            font-weight: 900;
            background: linear-gradient(90deg,#6c5ce7,#a29bfe);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            animation: bounce 1.5s infinite;
            z-index: 1;
        }

        @keyframes bounce {
            0%,100% { transform: translateY(0); }
            50% { transform: translateY(-20px); }
        }

        .error-message {
            font-size: 2rem;
            font-weight: 500;
            color: #636e72;
            margin-bottom: 20px;
            z-index: 1;
        }

        .error-desc {
            font-size: 1.2rem;
            color: #b2bec3;
            margin-bottom: 30px;
            z-index: 1;
        }

        .btn-home {
            padding: 0.75rem 2rem;
            font-size: 1.1rem;
            border-radius: 50px;
            transition: all 0.3s ease;
            z-index: 1;
        }

        .btn-home:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
        }

        /* Floating circles */
        .circle {
            position: absolute;
            border-radius: 50%;
            background: rgba(108, 92, 231, 0.2);
            animation: float 6s infinite;
            z-index: 0;
        }

        .circle:nth-child(1){ width: 100px; height: 100px; top: 20%; left: 10%; animation-delay: 0s; }
        .circle:nth-child(2){ width: 150px; height: 150px; top: 60%; left: 20%; animation-delay: 2s; }
        .circle:nth-child(3){ width: 80px; height: 80px; top: 40%; left: 80%; animation-delay: 4s; }

        @keyframes float {
            0% { transform: translateY(0) rotate(0deg);}
            50% { transform: translateY(-30px) rotate(45deg);}
            100% { transform: translateY(0) rotate(0deg);}
        }
    </style>
</head>
<body>

<div class="error-container">
    <!-- Animated circles -->
    <div class="circle"></div>
    <div class="circle"></div>
    <div class="circle"></div>

    <h1 class="error-code">404</h1>
    <h2 class="error-message">Oops! Page Not Found</h2>
    <p class="error-desc">The page you are looking for might have been removed,<br> had its name changed, or is temporarily unavailable.</p>
    <a href="/" class="btn btn-primary btn-home">
        <i class="bi bi-house-door-fill me-1"></i> Go Back Home
    </a>
</div>

<script>
    // Floating bubbles random positions
    const circles = document.querySelectorAll('.circle');
    circles.forEach(circle => {
        let randomX = Math.random() * window.innerWidth;
        let randomY = Math.random() * window.innerHeight;
        circle.style.left = `${randomX}px`;
        circle.style.top = `${randomY}px`;
    });
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
