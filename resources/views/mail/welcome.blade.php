<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to HotBytes</title>
    <style>
        /* Base Styles */
        body {
            margin: 0;
            padding: 0;
            background-color: #f8fafc;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            line-height: 1.6;
            color: #334155;
        }

        /* Container */
        .email-wrapper {
            max-width: 640px;
            margin: 0 auto;
            padding: 20px;
        }

        .email-container {
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 24px rgba(0, 0, 0, 0.08), 0 1px 4px rgba(0, 0, 0, 0.05);
            margin: 40px 0;
        }

        /* Header */
        .header {
            background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%);
            padding: 40px 30px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .header::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.05'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        }

        .logo {
            width: 64px;
            height: 64px;
            background: white;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            position: relative;
        }

        .logo-badge {
            font-size: 24px;
            font-weight: 800;
            background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .header h1 {
            color: white;
            margin: 0;
            font-size: 28px;
            font-weight: 700;
            letter-spacing: -0.5px;
            position: relative;
        }

        /* Content */
        .content {
            padding: 40px 35px;
        }

        .greeting {
            font-size: 20px;
            font-weight: 600;
            color: #1e293b;
            margin-bottom: 25px;
        }

        .welcome-message {
            font-size: 16px;
            color: #475569;
            margin-bottom: 30px;
            line-height: 1.7;
        }

        .features-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
            margin: 30px 0;
        }

        .feature-item {
            background: #f8fafc;
            border-left: 4px solid #3b82f6;
            padding: 18px;
            border-radius: 8px;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .feature-item:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.1);
        }

        .feature-icon {
            display: inline-block;
            width: 24px;
            height: 24px;
            background: #dbeafe;
            border-radius: 6px;
            text-align: center;
            line-height: 24px;
            margin-right: 10px;
            font-weight: bold;
            color: #2563eb;
        }

        .feature-text {
            font-size: 14px;
            color: #334155;
            font-weight: 500;
        }

        /* CTA Button */
        .cta-container {
            text-align: center;
            margin: 40px 0 30px;
            padding-top: 30px;
            border-top: 1px solid #e2e8f0;
        }

        .cta-button {
            display: inline-block;
            padding: 16px 40px;
            background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%);
            color: white !important;
            text-decoration: none;
            border-radius: 10px;
            font-weight: 600;
            font-size: 16px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(37, 99, 235, 0.2);
        }

        .cta-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(37, 99, 235, 0.3);
        }

        /* Footer */
        .footer {
            background: #f1f5f9;
            padding: 30px;
            text-align: center;
        }

        .footer-links {
            display: flex;
            justify-content: center;
            gap: 25px;
            margin-bottom: 20px;
        }

        .footer-link {
            color: #64748b;
            text-decoration: none;
            font-size: 14px;
            transition: color 0.2s ease;
        }

        .footer-link:hover {
            color: #2563eb;
        }

        .copyright {
            color: #94a3b8;
            font-size: 13px;
            line-height: 1.5;
            margin-top: 20px;
        }

        /* Account Info */
        .account-info {
            background: #f0f9ff;
            border-radius: 10px;
            padding: 20px;
            margin: 25px 0;
            border: 1px solid #bae6fd;
        }

        .info-title {
            color: #0369a1;
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 10px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        /* Responsive */
        @media (max-width: 640px) {
            .content {
                padding: 30px 25px;
            }

            .features-grid {
                grid-template-columns: 1fr;
            }

            .footer-links {
                flex-direction: column;
                gap: 15px;
            }

            .header {
                padding: 30px 20px;
            }

            .header h1 {
                font-size: 24px;
            }
        }
    </style>
</head>
<body>
<div class="email-wrapper">
    <div class="email-container">

        <!-- Header -->
        <div class="header">
            <div class="logo">
                <span class="logo-badge">HotBytes</span>
            </div>
            <h1>Welcome to HotBytes</h1>
        </div>

        <!-- Content -->
        <div class="content">
            <h2 class="greeting">Hello {{ $username ?? 'Valued Customer' }},</h2>

            <p class="welcome-message">
                Thank you for joining <strong>HotBytes</strong> – your gateway to seamless bus travel.
                Your account has been successfully created and is ready to use.
            </p>

            <div class="account-info">
                <div class="info-title">Account Ready</div>
                <p>You can now access all features of our premium bus booking platform.</p>
            </div>

            <h3 style="color: #1e293b; font-size: 18px; margin: 30px 0 20px;">Everything You Can Do:</h3>

            <div class="features-grid">
                <div class="feature-item">
                    <span class="feature-icon">✓</span>
                    <span class="feature-text">Book Tickets  Clicks</span>
                </div>
                <div class="feature-item">
                    <span class="feature-icon">✓</span>
                    <span class="feature-text">Smart Seat Selection</span>
                </div>
                <div class="feature-item">
                    <span class="feature-icon">✓</span>
                    <span class="feature-text">Instant E-Tickets</span>
                </div>
                <div class="feature-item">
                    <span class="feature-icon">✓</span>
                    <span class="feature-text">Real-time Tracking</span>
                </div>
                <div class="feature-item">
                    <span class="feature-icon">✓</span>
                    <span class="feature-text">Secure Payments</span>
                </div>
                <div class="feature-item">
                    <span class="feature-icon">✓</span>
                    <span class="feature-text">24/7 Support</span>
                </div>
            </div>

            <div class="cta-container">
                <p style="color: #475569; margin-bottom: 25px; font-size: 15px;">
                    Start your journey with us – login to access your dashboard
                </p>

                <p style="font-size: 13px; color: #94a3b8; margin-top: 15px;">
                    Link valid for 30 days
                </p>
            </div>



            <p style="color: #475569; margin-top: 35px;">
                Best regards,<br>
                <strong style="color: #1e293b;">The HotBytes Team</strong>
            </p>
        </div>

        <!-- Footer -->
        <div class="footer">

            <div class="copyright">
                © {{ date('Y') }} HotBytes. All rights reserved.<br>
                This is an automated message. Please do not reply directly to this email.<br>
            </div>
        </div>
    </div>
</div>
</body>
</html>
