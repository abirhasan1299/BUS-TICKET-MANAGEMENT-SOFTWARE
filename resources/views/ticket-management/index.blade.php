@extends('layout.master')
@section('title','Ticket Management')
@section('content')
    <div class="container py-5">

        <!-- Top Stats Row -->
        <div class="row g-4 mb-5">
            <!-- Ticket Sales Count -->
            <div class="col-md-3 col-6">
                <div class="p-4 rounded-4 shadow-sm text-center text-white"
                     style="background: linear-gradient(135deg, #36d1dc 0%, #5b86e5 100%);">
                    <i class="bi bi-ticket-perforated-fill fs-1 mb-2 d-block"></i>
                    <h5 class="fw-bold mb-1">Ticket Sales</h5>
                    <h3 class="fw-bold">{{ $ticketSalesCount ?? 0 }}</h3>
                </div>
            </div>

            <!-- Total Price -->
            <div class="col-md-3 col-6">
                <div class="p-4 rounded-4 shadow-sm text-center text-white"
                     style="background: linear-gradient(135deg, #ff512f 0%, #dd2476 100%);">
                    <i class="bi bi-cash-stack fs-1 mb-2 d-block"></i>
                    <h5 class="fw-bold mb-1">Total Price</h5>
                    <h3 class="fw-bold">${{ number_format($totalPrice ?? 0, 2) }}</h3>
                </div>
            </div>

            <!-- Coupon Uses Count -->
            <div class="col-md-3 col-6">
                <div class="p-4 rounded-4 shadow-sm text-center text-white"
                     style="background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);">
                    <i class="bi bi-ticket-detailed-fill fs-1 mb-2 d-block"></i>
                    <h5 class="fw-bold mb-1">Coupon Uses</h5>
                    <h3 class="fw-bold">{{ $couponUsesCount ?? 0 }}</h3>
                </div>
            </div>

            <!-- Total Buyers -->
            <div class="col-md-3 col-6">
                <div class="p-4 rounded-4 shadow-sm text-center text-white"
                     style="background: linear-gradient(135deg, #f7971e 0%, #ffd200 100%);">
                    <i class="bi bi-people-fill fs-1 mb-2 d-block"></i>
                    <h5 class="fw-bold mb-1">Total Buyers</h5>
                    <h3 class="fw-bold">{{ $totalBuyers ?? 0 }}</h3>
                </div>
            </div>
        </div>

        <!-- Search Row -->
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="p-4 rounded-4 shadow-sm bg-white">
                    <form method="GET" action="#" class="d-flex">
                        <input type="text" name="query"
                               class="form-control form-control-lg me-2 rounded-pill shadow-sm"
                               placeholder="Search tickets by buyer name, code, or route..."
                               value="{{ request('query') }}">
                        <button type="submit" class="btn btn-primary btn-lg rounded-pill px-4 shadow-sm">
                            <i class="bi bi-search me-1"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>

    </div>
@endsection
