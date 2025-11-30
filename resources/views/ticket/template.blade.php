<!DOCTYPE html>
<html>
<head>
    <title>Bus Ticket</title>
    <style>
        /* Reset and base styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f8f9fa;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
        }

        .ticket-container {
            width: 100%;
            max-width: 700px;
        }

        .ticket {
            background: white;
            border-radius: 12px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            padding: 30px;
            position: relative;
            overflow: hidden;
        }

        /* Watermark */
        .watermark {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) rotate(-45deg);
            font-size: 70px;
            font-weight: 900;
            color: rgba(37, 117, 252, 0.08);
            z-index: 1;
            pointer-events: none;
            white-space: nowrap;
            letter-spacing: 5px;
        }

        /* Header */
        .ticket-header {
            text-align: center;
            margin-bottom: 25px;
            position: relative;
            z-index: 2;
        }

        .ticket-title {
            font-size: 28px;
            font-weight: 700;
            color: #2575fc;
            margin-bottom: 5px;
        }

        .ticket-subtitle {
            color: #666;
            font-size: 14px;
        }

        /* Main content layout */
        .ticket-content {
            display: flex;
            gap: 30px;
            position: relative;
            z-index: 2;
        }

        .ticket-details {
            flex: 1;
        }

        .qr-section {

            width: 150px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        /* QR Code Styling */
        .qr-code {
            width: 180px;
            height: 180px;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 15px;

        }

        .qr-placeholder {

            padding: 10px;
        }

        .ticket-number {
            text-align: center;
            font-weight: 600;
            color: #2575fc;
            font-size: 14px;
        }

        /* Details sections */
        .detail-section {
            margin-bottom: 20px;
        }

        .section-title {
            font-size: 16px;
            font-weight: 600;
            color: #333;
            margin-bottom: 10px;
            padding-bottom: 5px;
            border-bottom: 1px dashed #e0e0e0;
        }

        .detail-row {
            display: flex;
            margin-bottom: 12px;
        }

        .detail-label {
            width: 120px;
            font-size: 14px;
            color: #666;
        }

        .detail-value {
            flex: 1;
            font-size: 15px;
            font-weight: 600;
            color: #333;
        }

        /* Confirmation badge */
        .confirmation-badge {
            background: #28a745;
            color: white;
            padding: 8px 25px;
            border-radius: 20px;
            font-weight: 700;
            text-align: center;
            display: inline-block;
            margin-top: 10px;
            box-shadow: 0 3px 8px rgba(40, 167, 69, 0.3);
        }
        /* Expired badge */
        .expired-badge {
            background: #ff3333;
            color: white;
            padding: 8px 25px;
            border-radius: 20px;
            font-weight: 700;
            text-align: center;
            display: inline-block;
            margin-top: 10px;
            box-shadow: 0 3px 8px rgba(40, 167, 69, 0.3);
        }

        /* Price styling */
        .price-section {
            text-align: center;
            margin-top: 20px;
            padding-top: 15px;
            border-top: 1px dashed #e0e0e0;
        }

        .price-label {
            font-size: 14px;
            color: #666;
            margin-bottom: 5px;
        }

        .price-value {
            font-size: 24px;
            font-weight: 700;
            color: #2575fc;
        }

        /* Footer */
        .ticket-footer {
            margin-top: 25px;
            text-align: center;
            font-size: 12px;
            color: #999;
            position: relative;
            z-index: 2;
        }
    </style>
</head>
<body>
<div class="ticket-container">
    <div class="ticket">
        <!-- Watermark -->
        <div class="watermark">HotBytes</div>

        <!-- Header -->
        <div class="ticket-header">
            <div class="ticket-title">BUS TICKET</div>
            <div class="ticket-subtitle">Travel Confirmation</div>
        </div>

        <!-- Main Content -->
        <div class="ticket-content">
            <!-- Details Section -->
            <div class="ticket-details">
                <!-- Passenger Info -->
                <div class="detail-section">
                    <div class="section-title">Passenger Information</div>
                    <div class="detail-row">
                        <div class="detail-label">Passenger:</div>
                        <div class="detail-value">{{ Auth::getUser()->name ?? 'N/A' }}</div>
                    </div>
                    <div class="detail-row">
                        <div class="detail-label">Ticket No:</div>
                        <div class="detail-value">TXN{{ $payment->transaction_id ?? 'N/A' }}</div>
                    </div>
                </div>

                <!-- Journey Details -->
                <div class="detail-section">
                    <div class="section-title">Journey Details</div>
                    <div class="detail-row">
                        <div class="detail-label">From:</div>
                        <div class="detail-value">{{ $data->slots->busRoute->start_location }}</div>
                    </div>
                    <div class="detail-row">
                        <div class="detail-label">To:</div>
                        <div class="detail-value">{{ $data->slots->busRoute->end_location }}</div>
                    </div>
                    <div class="detail-row">
                        <div class="detail-label">Date:</div>
                        <div class="detail-value">{{ $data->slots->created_at->format('d-M-Y') }}</div>
                    </div>
                    <div class="detail-row">
                        <div class="detail-label">Time:</div>
                        <div class="detail-value">{{ $data->slots->created_at->format('h:i A') }}</div>
                    </div>
                </div>

                <!-- Seat Information -->
                <div class="detail-section">
                    <div class="section-title">Seat Information</div>
                    <div class="detail-row">
                        <div class="detail-label">Seat No:</div>
                        <div class="detail-value">{{ $data->sit_list }}</div>
                    </div>
                </div>

                <!-- Confirmation Badge -->
                <div style="text-align: center; margin-top: 20px;">
                    <div class="@php
if(\Carbon\Carbon::parse($data->slots->schedule)->isPast() ){
    echo "expired-badge";
}else{
    echo "confirmation-badge";
}
 @endphp">
                        @php
if(\Carbon\Carbon::parse($data->slots->schedule)->isPast() ){
    echo "EXPIRED";
}else{
    echo "CONFIRMED";
}
 @endphp</div>
                </div>
            </div>

            <div class="qr-section">
                <div class="qr-code" id="qrcode"></div>
            </div>

            <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>
            <script>
                new QRCode(document.getElementById("qrcode"), {
                    text: "{{ bin2hex($payment->transaction_id) ?? 'N/A' }}",
                    width: 150,
                    height: 150
                });
            </script>
        </div>

        <!-- Price Section -->
        <div class="price-section">
            <div class="price-label">Total Amount</div>
            <div class="price-value"> ৳ {{ $data->sit_count * ($data->slots->price - ($data->slots->price * ($data->slots->discount / 100))) }}
            </div>
        </div>

        <!-- Footer -->
        <div class="ticket-footer">
            <p>Thank you for choosing our service. Have a safe journey!</p>
            <p>For any queries, contact: support@hotbytes.com</p>
        </div>
    </div>
</div>
<script>
    window.onload = function() {
        window.print();
    };
</script>
</body>
</html>
