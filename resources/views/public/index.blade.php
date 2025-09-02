<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Premium Bus Route Finder</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Select2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Google Fonts -->
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
            color: var(--light);
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

        .form-control, .select2-container--default .select2-selection--single {
            border: 2px solid #e9ecef;
            border-radius: 8px;
            padding: 12px 15px;
            height: auto;
            transition: all 0.3s;
        }

        .form-control:focus, .select2-container--default.select2-container--focus .select2-selection--single {
            border-color: var(--primary);
            box-shadow: 0 0 0 0.25rem rgba(58, 134, 255, 0.25);
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

        .search-icon {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--primary);
        }

        .form-label {
            font-weight: 500;
            margin-bottom: 8px;
            color: #495057;
        }

        .hero-text {
            text-align: center;
            margin-bottom: 30px;
        }

        .hero-text h1 {
            font-weight: 700;
            margin-bottom: 10px;
            background: linear-gradient(to right, #fff, #e0e0e0);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .hero-text p {
            font-size: 1.1rem;
            opacity: 0.9;
        }

        .feature-icon {
            font-size: 2rem;
            margin-bottom: 15px;
            color: var(--primary);
        }

        .features {
            margin-top: 40px;
        }

        .feature-box {
            text-align: center;
            padding: 20px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 10px;
            backdrop-filter: blur(10px);
            margin-bottom: 20px;
            transition: all 0.3s;
        }

        .feature-box:hover {
            transform: translateY(-5px);
            background: rgba(255, 255, 255, 0.2);
        }

        .select2-container--default .select2-selection--single {
            height: 46px;
            display: flex;
            align-items: center;
        }

        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 46px;
        }

        .date-input-container {
            position: relative;
        }

        .date-input-container i {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--primary);
        }

        footer {
            text-align: center;
            padding: 20px 0;
            color: rgba(255, 255, 255, 0.7);
            font-size: 0.9rem;
            margin-top: 40px;
        }

        /* Fix for Select2 dropdown options visibility */
        .select2-container--default .select2-results__option {
            color: #212529;
            padding: 10px 15px;
        }

        .select2-container--default .select2-results__option--highlighted[aria-selected] {
            background-color: var(--primary);
            color: white;
        }

        .select2-container--default .select2-selection--single .select2-selection__rendered {
            color: #212529;
        }

        .select2-dropdown {
            border: 2px solid #e9ecef;
            border-radius: 8px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>
<div class="container">
    <div class="hero-text">
        <h1>Find Your Perfect Bus Route</h1>
        <p>Search, compare, and book bus tickets with ease</p>
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card">
                <div class="card-header">
                    <h3 class="mb-0"><i class="fas fa-bus me-2"></i>Bus Route Finder</h3>
                </div>
                <div class="card-body p-4">
                    <form method="post" action="{{route('basic.search')}}" autocomplete="off">
                        @csrf
                        <div class="row">
                            <div class="col-md-5 mb-3">
                                <label for="startLocation" class="form-label">From</label>
                                <div class="position-relative">
                                    <select class="form-select form-control" id="startLocation" name="start">
                                        <option></option>
                                        @foreach($data as $d)
                                        <option value="{{$d->id}}">{{$d->busRoute->start_location}}</option>
                                        @endforeach
                                    </select>
                                    <div class="search-icon">
                                        <i class="fas fa-map-marker-alt"></i>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-5 mb-3">
                                <label for="destination" class="form-label">To</label>
                                <div class="position-relative">
                                    <select class="form-select form-control" id="destination" name="end_slot">
                                        <option></option>
                                        @foreach($data as $d)
                                            <option value="{{$d->id}}">{{$d->busRoute->end_location}}</option>
                                        @endforeach

                                    </select>
                                    <div class="search-icon">
                                        <i class="fas fa-map-marker-alt"></i>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-2 mb-3">
                                <label for="departureDate" class="form-label">Date</label>
                                <div class="date-input-container">
                                    <input type="date" name="date" class="form-control" id="departureDate">
                                </div>
                            </div>
                        </div>

                        <div class="text-center mt-4">
                            <button type="submit" class="btn btn-primary btn-lg">
                                <i class="fas fa-search me-2"></i>Search Routes
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="features">
        <div class="row">
            <div class="col-md-4">
                <div class="feature-box">
                    <div class="feature-icon">
                        <i class="fas fa-route"></i>
                    </div>
                    <h4>500+ Routes</h4>
                    <p>Extensive network covering all major cities and towns</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feature-box">
                    <div class="feature-icon">
                        <i class="fas fa-tags"></i>
                    </div>
                    <h4>Best Prices</h4>
                    <p>Guaranteed lowest prices on bus tickets</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feature-box">
                    <div class="feature-icon">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    <h4>Safe Travel</h4>
                    <p>Safety verified buses with trained drivers</p>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<!-- Select2 JS -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
    $(document).ready(function() {
        // Initialize Select2 for location dropdowns
        $('#startLocation').select2({
            placeholder: "Select start location",
            allowClear: true
        });

        $('#destination').select2({
            placeholder: "Select destination",
            allowClear: true
        });

        // Set minimum date as today for the date picker
        const today = new Date().toISOString().split('T')[0];
        document.getElementById('departureDate').setAttribute('min', today);


    });
</script>
</body>
</html>
