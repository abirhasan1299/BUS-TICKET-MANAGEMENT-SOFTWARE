<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dynamic Bus Seat Selection</title>
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

        .bus-container {
            background: #f8f9fa;
            border-radius: 10px;
            padding: 20px;
            position: relative;
            min-height: 500px;
        }

        .bus-door {
            position: absolute;
            bottom: 20px;
            left: 20px;
            width: 40px;
            height: 80px;
            background: #6c757d;
            border-radius: 5px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
        }

        .driver-seat {
            background: #6c757d;
            color: white;
            width: 60px;
            height: 60px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 20px;
        }

        .seats-container {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .seat-row {
            display: flex;
            justify-content: center;
            margin-bottom: 15px;
            gap: 15px;
        }

        .seat {
            width: 50px;
            height: 50px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            font-weight: 500;
            transition: all 0.3s;
        }

        .seat-available {
            background: #e9ecef;
            border: 2px solid #dee2e6;
        }

        .seat-available:hover {
            background: #d8e2ff;
            border-color: var(--primary);
        }

        .seat-selected {
            background: var(--primary);
            color: white;
            border: 2px solid var(--primary);
        }

        .seat-booked {
            background: #ff006e;
            color: white;
            border: 2px solid #ff006e;
            cursor: not-allowed;
        }

        .seat-gap {
            width: 50px;
            visibility: hidden;
        }

        .seat-legend {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-top: 20px;
        }

        .legend-item {
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .legend-color {
            width: 20px;
            height: 20px;
            border-radius: 4px;
        }

        .selected-seats-container {
            background: #f8f9fa;
            border-radius: 10px;
            padding: 15px;
            margin-top: 20px;
        }

        .selected-seat {
            background: var(--primary);
            color: white;
            padding: 5px 10px;
            border-radius: 5px;
            margin-right: 8px;
            margin-bottom: 8px;
            display: inline-block;
        }

        .bus-steering {
            position: absolute;
            bottom: 30px;
            right: 20px;
            font-size: 24px;
            color: #6c757d;
        }

        .booking-summary {
            background: #f8f9fa;
            border-radius: 10px;
            padding: 20px;
            margin-top: 20px;
        }

        .summary-item {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
        }

        .total-price {
            font-weight: 600;
            font-size: 1.2rem;
            color: var(--primary);
        }

        .bus-config {
            background: #f8f9fa;
            border-radius: 10px;
            padding: 15px;
            margin-bottom: 20px;
        }

        .booked-seats-list {
            max-height: 150px;
            overflow-y: auto;
            background: white;
            border-radius: 8px;
            padding: 10px;
            margin-top: 10px;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="text-center mb-4">
        <h1 class="text-white">Select Your Seats</h1>
        <p class="text-light">{{$data->busRoute->start_location}} to {{$data->busRoute->end_location}} • {{\Carbon\Carbon::parse($data->schedule)->format('M d, Y')}} • {{\Carbon\Carbon::parse($data->schedule)->format('h:i A')}}</p>
    </div>
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>{{session('error')}}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div class="card">
        <div class="card-header">
            <h3 class="mb-0"><i class="fas fa-chair me-2"></i>Seat Selection</h3>
        </div>
        <div class="card-body">
            <!-- Bus Configuration Panel -->
            <div class="bus-config" style="display: none;">
                <h5>Bus Configuration</h5>
                <div class="row">
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="rows" class="form-label">Number of Rows</label>
                            <input type="number" class="form-control" id="rows" value="{{$data->busInfo->total_rows}}">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="cols" class="form-label">Seats per Row</label>
                            <input type="number" class="form-control" id="cols" min="2" max="5" value="{{$data->busInfo->seat_per_row}}">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="bookedSeats" class="form-label">Booked Seats (comma separated)</label>
                            <input type="text" class="form-control" id="bookedSeats" value="
                            @foreach($booked as $b)
                            {{$b->sit_list}},
                            @endforeach
                            ">
                        </div>
                    </div>
                </div>
                <button id="generateSeats" class="btn btn-primary">
                    <i class="fas fa-sync-alt me-2"></i>Generate Seats
                </button>

                <div class="mt-2">
                    <small class="text-muted">Example: A1,B3,C2 (comma separated seat numbers)</small>
                </div>

                <div class="mt-3">
                    <h6>Currently Booked Seats:</h6>
                    <div class="booked-seats-list" id="bookedSeatsList">
                        <!-- Booked seats will be listed here -->
                    </div>
                </div>
            </div>

            <div class="row">
                <!-- Seat Selection Column -->
                <div class="col-md-7">
                    <div class="bus-container">

                        <div class="bus-steering">
                            <i class="fas fa-car"></i>
                        </div>

                        <div class="d-flex justify-content-center mb-4">
                            <div class="driver-seat">
                                <i class="fas fa-user"></i>
                            </div>
                        </div>

                        <!-- Dynamic seats container -->
                        <div class="seats-container" id="seatsContainer">
                            <!-- Seats will be generated here by JavaScript -->
                        </div>

                        <div class="seat-legend">
                            <div class="legend-item">
                                <div class="legend-color" style="background-color: #e9ecef; border: 2px solid #dee2e6;"></div>
                                <span>Available</span>
                            </div>
                            <div class="legend-item">
                                <div class="legend-color" style="background-color: #3a86ff; border: 2px solid #3a86ff;"></div>
                                <span>Selected</span>
                            </div>
                            <div class="legend-item">
                                <div class="legend-color" style="background-color: #ff006e; border: 2px solid #ff006e;"></div>
                                <span>Booked</span>
                            </div>
                        </div>
                    </div>

                    <div class="selected-seats-container">
                        <h5>Selected Seats: <span id="selected-count">0</span></h5>
                        <div id="selected-seats-list"></div>
                    </div>
                </div>

                <!-- User Details Column -->
                <div class="col-md-5">
                    <h4 class="mb-4">Passenger Details</h4>

                    <form method="post" action="{{route('basic.cart')}}" autocomplete="off">
                        @csrf
                        <input type="hidden" name="sit_count" id="seat_count"  required>
                        <input type="hidden" name="sit_list" id="seat_list"  required>
                        <input type="hidden" name="slot_id" value="{{$data->id}}"  required>

                        <div class="mb-3">
                            <label for="gender" class="form-label">Gender</label>
                            <select class="form-select" name="gender" id="gender" required>
                                <option  selected disabled>Select gender</option>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                                <option value="other">Other</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="coupon" class="form-label">Apply Coupon (Optional)</label>
                            <input type="text" class="form-control" id="coupon" placeholder="Coupon Code" name="coupon" >
                        </div>

                        <div class="booking-summary" style="display: none;">
                            <h5>Booking Summary</h5>
                            <div class="summary-item">
                                <span>Seats (<span id="summary-seat-count">0</span>)</span>
                                <span>$<span id="seats-price">0</span></span>
                            </div>
                            <div class="summary-item">
                                <span>Taxes & Fees</span>
                                <span>$<span id="taxes">0</span></span>
                            </div>
                            <hr>
                            <div class="summary-item total-price">
                                <span>Total</span>
                                <span>$<span id="total-price">0</span></span>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary w-100 mt-4">
                            <i class="fas fa-ticket-alt me-2"></i>Confirm Booking
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const seatsContainer = document.getElementById('seatsContainer');
        const selectedSeatsList = document.getElementById('selected-seats-list');
        const selectedCount = document.getElementById('selected-count');
        const summarySeatCount = document.getElementById('summary-seat-count');
        const seatsPrice = document.getElementById('seats-price');
        const taxes = document.getElementById('taxes');
        const totalPrice = document.getElementById('total-price');
        const generateBtn = document.getElementById('generateSeats');
        const bookedSeatsList = document.getElementById('bookedSeatsList');

        const seatPrice = {{$data->price}}; // Price per seat
        const taxRate = 0; // 10% tax
        let selectedSeats = [];
        let bookedSeats = [];

        // Parse booked seats from input
        function parseBookedSeats() {
            const bookedSeatsInput = document.getElementById('bookedSeats').value;
            // Split by comma and remove any whitespace
            bookedSeats = bookedSeatsInput.split(',').map(seat => seat.trim().toUpperCase());

            // Update the booked seats list display
            updateBookedSeatsList();
        }

        // Update the booked seats list display
        function updateBookedSeatsList() {
            bookedSeatsList.innerHTML = '';
            if (bookedSeats.length === 0) {
                bookedSeatsList.innerHTML = '<p class="text-muted mb-0">No booked seats</p>';
                return;
            }

            bookedSeats.forEach(seat => {
                const seatElement = document.createElement('span');
                seatElement.classList.add('selected-seat');
                seatElement.style.backgroundColor = '#ff006e';
                seatElement.textContent = seat;
                bookedSeatsList.appendChild(seatElement);
            });
        }

        // Generate seats based on configuration
        function generateSeats() {
            const rows = parseInt(document.getElementById('rows').value);
            const cols = parseInt(document.getElementById('cols').value);

            // Parse the booked seats
            parseBookedSeats();

            // Clear previous seats
            seatsContainer.innerHTML = '';
            selectedSeats = [];
            updateSelection();

            // Create seat layout
            for (let row = 0; row < rows; row++) {
                const seatRow = document.createElement('div');
                seatRow.classList.add('seat-row');

                for (let col = 0; col < cols; col++) {
                    const seatNumber = `${String.fromCharCode(65 + row)}${col + 1}`;

                    const seat = document.createElement('div');
                    seat.classList.add('seat');
                    seat.setAttribute('data-seat', seatNumber);
                    seat.textContent = seatNumber;

                    // Check if seat is in the booked list
                    if (bookedSeats.includes(seatNumber)) {
                        seat.classList.add('seat-booked');
                    } else {
                        seat.classList.add('seat-available');
                    }

                    // Add gap in the middle for aisle
                    if (col === Math.floor(cols / 2)) {
                        const gap = document.createElement('div');
                        gap.classList.add('seat-gap');
                        seatRow.appendChild(gap);
                    }

                    seatRow.appendChild(seat);
                }

                seatsContainer.appendChild(seatRow);
            }

            // Add event listeners to the new seats
            addSeatEventListeners();
        }

        // Add event listeners to seats
        function addSeatEventListeners() {
            const seats = document.querySelectorAll('.seat-available');

            seats.forEach(seat => {
                seat.addEventListener('click', function() {
                    const seatNumber = this.getAttribute('data-seat');

                    // Check if seat is already selected
                    const index = selectedSeats.indexOf(seatNumber);

                    if (index === -1) {
                        // Select seat
                        this.classList.remove('seat-available');
                        this.classList.add('seat-selected');
                        selectedSeats.push(seatNumber);
                    } else {
                        // Deselect seat
                        this.classList.remove('seat-selected');
                        this.classList.add('seat-available');
                        selectedSeats.splice(index, 1);
                    }

                    updateSelection();
                });
            });
        }

        function updateSelection() {
            // Update selected seats list
            selectedSeatsList.innerHTML = '';
            selectedSeats.forEach(seat => {
                const seatElement = document.createElement('span');
                seatElement.classList.add('selected-seat');
                seatElement.textContent = seat;
                selectedSeatsList.appendChild(seatElement);
            });

            // Update counts
            const count = selectedSeats.length;
            selectedCount.textContent = count;
            summarySeatCount.textContent = count;

            // ✅ Show in input fields
            document.getElementById("seat_list").value = selectedSeats.join(", ");
            document.getElementById("seat_count").value = count;

            // Update pricing
            const subtotal = count * seatPrice;
            const taxAmount = subtotal * taxRate;
            const total = subtotal - taxAmount;

            seatsPrice.textContent = subtotal.toFixed(2);
            taxes.textContent = taxAmount.toFixed(2);
            totalPrice.textContent = total.toFixed(2);
        }

        // Initial seat generation
        generateSeats();

        // Regenerate seats when configuration changes
        generateBtn.addEventListener('click', generateSeats);

        // Update when booked seats input changes
        document.getElementById('bookedSeats').addEventListener('input', function() {
            parseBookedSeats();
        });

    });
</script>
</body>
</html>
