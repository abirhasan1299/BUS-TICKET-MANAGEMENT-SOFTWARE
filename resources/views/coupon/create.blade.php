@extends('layout.master')
@section('title','Coupon')
@section('content')
    <div class="container">

        <div class="row justify-content-center">
            <div class="col-md-8">

                <!-- Coupon Form -->
                <div class="p-5 rounded-4 shadow-lg bg-white border-0"
                     style="background: linear-gradient(145deg, #ffffff, #f0f0f0);">

                    <h2 class="fw-bold text-center mb-4"
                        style="color:#5b86e5; text-shadow: 0px 1px 2px rgba(0,0,0,0.1);">
                        <i class="bi bi-ticket-detailed-fill me-2"></i> Create New Coupon
                    </h2>

                    <form action="{{ route('coupon.store') }}" method="POST">
                        @csrf

                        <!-- Coupon Name -->
                        <div class="mb-4">
                            <label class="form-label fw-semibold">Coupon Name</label>
                            <input type="text" name="name"
                                   class="form-control form-control-lg rounded-3 shadow-sm"
                                   placeholder="Enter coupon name" required>
                            @error('name')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        <!-- Coupon Code -->
                        <div class="mb-4">
                            <label class="form-label fw-semibold">Coupon Code</label>
                            <input type="text" name="coupon_code"
                                   class="form-control form-control-lg rounded-3 shadow-sm"
                                   placeholder="ABC123" required>
                            @error('coupon_code')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        <!-- Validity -->
                        <div class="mb-4">
                            <label class="form-label fw-semibold">Validity</label>
                            <input type="text" id="date" name="expire"
                                   class="form-control form-control-lg rounded-3 shadow-sm"
                                   required placeholder="Expire Date">
                            @error('expire')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        <!-- Discount -->
                        <div class="mb-4">
                            <label class="form-label fw-semibold">Discount (%)</label>
                            <input type="number"  name="discount"
                                   class="form-control form-control-lg rounded-3 shadow-sm"
                                   required placeholder="Percentage of Discount">
                            @error('discount')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                        <!-- Status -->
                        <div class="mb-4">
                            <label class="form-label fw-semibold d-block">Status</label>
                            <div class="d-flex gap-4">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="status" id="active" value="1" >
                                    <label class="form-check-label fw-semibold text-success" for="active">
                                        <i class="bi bi-check-circle-fill me-1"></i> Active
                                    </label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="status" id="inactive" value="0" checked>
                                    <label class="form-check-label fw-semibold text-danger" for="inactive">
                                        <i class="bi bi-x-circle-fill me-1"></i> Inactive
                                    </label>
                                </div>
                                @error('status')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>

                        <!-- Submit -->
                        <div class="text-center mt-5">
                            <button type="submit"
                                    class="btn btn-lg px-5 rounded-pill shadow fw-bold text-white"
                                    style="background: linear-gradient(135deg, #36d1dc 0%, #5b86e5 100%);">
                                <i class="bi bi-plus-circle me-2"></i> Create Coupon
                            </button>
                        </div>

                    </form>
                </div>
                <!-- End Coupon Form -->

            </div>
        </div>

    </div>
@endsection
