<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Available Bus Routes</title>

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

        /* Route List Styles */
        .route-card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
            transition: all 0.3s;
            margin-bottom: 20px;
        }

        .route-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
        }

        .route-header {
            background: linear-gradient(to right, #f8f9fa, #e9ecef);
            padding: 15px 20px;
            border-radius: 12px 12px 0 0;
            border-bottom: 1px solid #dee2e6;
        }

        .route-body {
            padding: 20px;
        }

        .route-time {
            font-size: 1.5rem;
            font-weight: 600;
            color: var(--primary);
        }

        .route-duration {
            background-color: #f8f9fa;
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 0.9rem;
            color: #6c757d;
        }

        .route-price {
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--secondary);
        }

        .route-seats {
            color: #28a745;
            font-weight: 500;
        }

        .route-divider {
            display: flex;
            align-items: center;
            margin: 15px 0;
        }

        .route-dot {
            width: 8px;
            height: 8px;
            background-color: #6c757d;
            border-radius: 50%;
            margin: 0 5px;
        }

        .route-line {
            flex-grow: 1;
            height: 2px;
            background-color: #dee2e6;
        }

        .route-company {
            font-weight: 500;
            color: #6c757d;
        }

        .route-type {
            background: linear-gradient(to right, var(--primary), var(--accent));
            color: white;
            padding: 5px 15px;
            border-radius: 20px;
            font-size: 0.8rem;
            display: inline-block;
        }

        .filter-card {
            margin-bottom: 30px;
        }

        .filter-title {
            font-weight: 600;
            margin-bottom: 15px;
            color: var(--dark);
        }

        .form-check-input:checked {
            background-color: var(--primary);
            border-color: var(--primary);
        }

        .results-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .sort-select {
            width: auto;
            display: inline-block;
        }

        .badge {
            font-weight: 500;
            padding: 6px 10px;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="hero-text">
        <h1>Available Bus Routes</h1>
    </div>

    <div class="row">

        <div class="col-lg-12">
            <div class="results-header">
                <div>
                    <h4 class="text-white">{{$data->count()}} buses available</h4>
                </div>

            </div>

            <!-- Route-->
            @forelse($data as $d)
            <div class="card route-card">
                <div class="route-header d-flex justify-content-between align-items-center">
                    <div class="route-company">{{strtoupper($d->busInfo->bus_name)}}</div>
                    <div class="route-type">{{strtoupper($d->busInfo->type)}}</div>
                </div>
                <div class="route-body">
                    <div class="row align-items-center">
                        <div class="col-md-4">
                            <div class="route-time">{{\Carbon\Carbon::parse($d->schedule)->format('h:i A')}}</div>
                            <div class="text-muted">{{strtoupper($d->busRoute->start_location)}}, {{strtoupper($d->busRoute->end_location)}}</div>
                        </div>
                        <div class="col-md-2 text-center">
                            <div class="route-duration">{{$d->busRoute->estemated_time}}  hrs</div>
                            <div class="route-divider">
                                <div class="route-line"></div>
                                <div class="route-dot"></div>
                                <div class="route-dot"></div>
                                <div class="route-dot"></div>
                                <div class="route-line"></div>
                            </div>
                            <div class="text-muted small">{{$d->busRoute->distance}} KM</div>
                        </div>
                        <div class="col-md-4">
                            <div class="route-time">{{\Carbon\Carbon::parse($d->schedule)->format('h:i A')}}</div>
                            <div class="text-muted">{{strtoupper($d->busRoute->start_location)}}, {{strtoupper($d->busRoute->end_location)}}</div>
                        </div>
                        <div class="col-md-2 text-center">
                            <div class="route-price">${{$d->price-round($d->discount/100*$d->price)}}</div>

                            <a class="btn btn-primary btn-sm mt-2" href="{{route('basic.seat',bin2hex($d->slot_code))}}" role="button">Select</a>
                        </div>
                    </div>
                </div>
            </div>
            @empty
                <p class="text-center text-danger fw-bold">No Available Bus Found</p>
            @endforelse
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
        // Initialize Select2 for sort dropdown
        $('.sort-select').select2({
            minimumResultsForSearch: Infinity
        });

        // Add hover effects to route cards
        $('.route-card').hover(
            function() {
                $(this).css('transform', 'translateY(-5px)');
                $(this).css('box-shadow', '0 10px 25px rgba(0, 0, 0, 0.15)');
            },
            function() {
                $(this).css('transform', 'translateY(0)');
                $(this).css('box-shadow', '0 5px 15px rgba(0, 0, 0, 0.08)');
            }
        );



    });
</script>
</body>
</html>
