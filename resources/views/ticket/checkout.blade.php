<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Confirmation | Secure Checkout</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, sans-serif;
        }

        body {
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
            color: #1e293b;
        }

        .container {
            max-width: 900px;
            width: 100%;
            background-color: white;
            border-radius: 24px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.08);
            overflow: hidden;
            position: relative;
        }

        .header {
            background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
            color: white;
            padding: 40px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .header::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 200px;
            height: 200px;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 50%;
        }

        .header::after {
            content: '';
            position: absolute;
            bottom: -30px;
            left: -30px;
            width: 150px;
            height: 150px;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 50%;
        }

        .header h1 {
            font-size: 32px;
            margin-bottom: 12px;
            font-weight: 700;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 15px;
            position: relative;
            z-index: 1;
        }

        .header p {
            opacity: 0.9;
            font-size: 16px;
            max-width: 500px;
            margin: 0 auto;
            line-height: 1.6;
            position: relative;
            z-index: 1;
        }

        .content {
            padding: 50px;
        }

        @media (max-width: 768px) {
            .content {
                padding: 30px;
            }
        }

        .transaction-details {
            background-color: #f8fafc;
            border-radius: 18px;
            padding: 30px;
            margin-bottom: 40px;
            border: 1px solid #e2e8f0;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.03);
        }

        .transaction-details h2 {
            color: #1e293b;
            margin-bottom: 25px;
            font-size: 24px;
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .details-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
        }

        @media (max-width: 640px) {
            .details-grid {
                grid-template-columns: 1fr;
            }
        }

        .detail-item {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .detail-label {
            font-size: 14px;
            font-weight: 600;
            color: #64748b;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .detail-value {
            font-size: 18px;
            font-weight: 600;
            color: #1e293b;
        }

        .transaction-id {
            background-color: #f1f5f9;
            padding: 10px 16px;
            border-radius: 10px;
            font-family: 'SF Mono', 'Roboto Mono', monospace;
            font-size: 16px;
            letter-spacing: 0.5px;
            border-left: 4px solid #4f46e5;
            display: inline-block;
            max-width: 100%;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .amount {
            font-size: 36px;
            font-weight: 800;
            color: #10b981;
            display: flex;
            align-items: center;
            gap: 10px;
        }



        .otp-section {
            margin-bottom: 40px;
        }

        .otp-section h2 {
            color: #1e293b;
            margin-bottom: 20px;
            font-size: 24px;
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .otp-input-container {
            display: flex;
            flex-direction: column;
            gap: 20px;
            max-width: 500px;
        }

        .otp-field {
            position: relative;
        }

        .otp-field input {
            width: 100%;
            padding: 18px 20px;
            font-size: 18px;
            font-weight: 600;
            border: 2px solid #e2e8f0;
            border-radius: 14px;
            transition: all 0.3s ease;
            background-color: white;
            letter-spacing: 4px;
            text-align: center;
        }

        .otp-field input:focus {
            outline: none;
            border-color: #4f46e5;
            box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
        }

        .otp-hint {
            background-color: #f0f9ff;
            border-radius: 12px;
            padding: 18px;
            border-left: 4px solid #0ea5e9;
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .otp-hint i {
            color: #0ea5e9;
            font-size: 20px;
        }

        .otp-hint span {
            font-size: 16px;
            color: #0369a1;
        }

        .otp-hint b {
            background-color: #0ea5e9;
            color: white;
            padding: 4px 12px;
            border-radius: 6px;
            margin-left: 8px;
        }

        .payment-actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 40px;
            padding-top: 30px;
            border-top: 1px solid #e2e8f0;
        }

        @media (max-width: 640px) {
            .payment-actions {
                flex-direction: column;
                gap: 20px;
            }
        }

        .secure-info {
            display: flex;
            align-items: center;
            gap: 12px;
            color: #64748b;
            font-size: 14px;
        }

        .secure-info i {
            color: #10b981;
            font-size: 18px;
        }

        .submit-btn {
            background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
            color: white;
            border: none;
            padding: 18px 60px;
            font-size: 18px;
            font-weight: 600;
            border-radius: 14px;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 15px;
            box-shadow: 0 8px 20px rgba(79, 70, 229, 0.3);
            position: relative;
            overflow: hidden;
        }

        .submit-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.7s ease;
        }

        .submit-btn:hover::before {
            left: 100%;
        }

        .submit-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 25px rgba(79, 70, 229, 0.4);
        }

        .submit-btn:active {
            transform: translateY(0);
        }

        .submit-btn:disabled {
            background: #cbd5e1;
            cursor: not-allowed;
            transform: none;
            box-shadow: none;
        }

        .submit-btn i {
            font-size: 20px;
        }

        .footer {
            text-align: center;
            padding: 25px;
            color: #64748b;
            font-size: 14px;
            border-top: 1px solid #f1f5f9;
            background-color: #f8fafc;
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .payment-methods {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 20px;
            font-size: 24px;
            color: #94a3b8;
        }

        .footer-links {
            display: flex;
            justify-content: center;
            gap: 25px;
            flex-wrap: wrap;
        }

        .footer-links a {
            color: #4f46e5;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.2s;
        }

        .footer-links a:hover {
            color: #7c3aed;
            text-decoration: underline;
        }

        .copyright {
            font-size: 13px;
            opacity: 0.8;
        }

        .status-indicator {
            position: absolute;
            top: 30px;
            right: 30px;
            background-color: rgba(255, 255, 255, 0.2);
            padding: 8px 16px;
            border-radius: 20px;
            font-size: 14px;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 8px;
            backdrop-filter: blur(10px);
            z-index: 1;
        }

        .status-indicator i {
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% { opacity: 0.6; }
            50% { opacity: 1; }
            100% { opacity: 0.6; }
        }
    </style>
</head>
<body>
<div class="container">
    <div class="header">
        <div class="status-indicator">
            <i class="fas fa-circle"></i> Payment Pending
        </div>
        <h1><i class="fas fa-lock"></i> Secure Payment Confirmation</h1>
        <p>Verify your transaction with the OTP sent to your registered contact to complete the payment</p>
    </div>

    <div class="content">
        <div class="transaction-details">
            <h2><i class="fas fa-receipt"></i> Transaction Summary</h2>

            <div class="details-grid">
                <div class="detail-item">
                    <div class="detail-label">Transaction ID</div>
                    <div class="detail-value">
                        <span class="transaction-id" id="transactionId">TXN{{session('trans_id')}}</span>
                    </div>
                </div>

                <div class="detail-item">
                    <div class="detail-label">Date & Time</div>
                    <div class="detail-value" id="transactionDate">
                        {{now()}}
                    </div>
                </div>

                <div class="detail-item">
                    <div class="detail-label">Total Amount</div>
                    <div class="detail-value">
                       <span class="amount" id="totalAmount">BDT {{session('amount')}}</span>
                    </div>
                </div>

                <div class="detail-item">
                    <div class="detail-label">Payment Method</div>
                    <div class="detail-value" id="paymentMethod">
                        <i class="fas fa-credit-card"></i> Credit Card (**** 4567)
                    </div>
                </div>
            </div>
        </div>

        <form method="post" action="{{route('payment.success')}}">
            @csrf
            <div class="otp-section">
                <h2><i class="fas fa-shield-alt"></i> Authentication Required</h2>

                <div class="otp-input-container">
                    <div class="otp-field">
                        <input type="number" name="otp" placeholder="Enter 6-digit OTP" required pattern="\d{6}">
                    </div>


                </div>
            </div>

            <div class="payment-actions">
                <div class="secure-info">
                    <i class="fas fa-lock"></i>
                    <span>Secure SSL encrypted connection</span>
                </div>

                <button type="submit" class="submit-btn" id="submitBtn">
                    <i class="fas fa-paper-plane"></i> Confirm Payment
                </button>
            </div>
        </form>
    </div>


</div>

<script>

    document.addEventListener('DOMContentLoaded', function() {
        const submitBtn = document.getElementById('submitBtn');
        setTimeout(() => {
            submitBtn.style.transform = 'translateY(0)';
        }, 300);
    });
</script>
</body>
</html>
