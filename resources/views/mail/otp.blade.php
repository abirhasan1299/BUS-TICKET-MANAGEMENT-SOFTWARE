<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <style>
        body { font-family: Arial, sans-serif; background: #f5f7fa; margin: 0; padding: 20px; }
        .container { max-width: 400px; margin: 0 auto; background: white; border-radius: 12px; padding: 30px; box-shadow: 0 5px 15px rgba(0,0,0,0.05); }
        .header { text-align: center; margin-bottom: 30px; }
        .header h2 { color: #4f46e5; margin: 0 0 10px 0; }
        .otp { font-size: 48px; font-weight: bold; color: #4f46e5; text-align: center; letter-spacing: 8px; margin: 30px 0; font-family: monospace; }
        .info { color: #666; font-size: 14px; text-align: center; line-height: 1.6; margin-bottom: 20px; }
        .warning { background: #fff5f5; border: 1px solid #fed7d7; border-radius: 8px; padding: 15px; margin-top: 30px; font-size: 13px; color: #c53030; }
    </style>
</head>
<body>
<div class="container">
    <div class="header">
        <h2>OTP Code</h2>
        <p>Your verification code:</p>
    </div>

    <div class="otp">{{ $user }}</div>

    <div class="info">
        Enter this code to complete your payment.<br>
        Code expires in 10 minutes.
    </div>

    <div class="warning">
        ⚠️ Do not share this code with anyone.
    </div>
</div>
</body>
</html>
