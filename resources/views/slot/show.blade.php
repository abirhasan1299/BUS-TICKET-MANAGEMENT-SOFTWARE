@extends('layout.master')
@section('title','Details | Slot')
@section('content')
        <!-- Slot Header -->
        <div class="bg-gradient   p-4 mb-4">
            <div class="d-flex justify-content-between align-items-center flex-wrap">
                <h2 class="mb-0 text-primary"><i class="bi bi-calendar-event me-2"></i>Ticket Slot Information</h2>
                <a href="{{ route('slot.index') }}" class="btn btn-light btn-sm rounded-pill">
                    <i class="bi bi-arrow-left-circle me-1"></i> Back
                </a>
            </div>
        </div>

        <!-- Slot Details Content -->
        <div class="row g-4">

            <!-- Route -->
            <div class="col-md-6">
                <div class="p-4 bg-white rounded-4 shadow-sm h-100">
                    <h6 class="text-muted"><i class="bi bi-geo-alt-fill me-2 text-primary"></i>Route</h6>
                    <p class="fw-bold fs-5">
                        {{$data->busRoute->start_location}} → {{$data->busRoute->end_location}}  ({{$data->busRoute->route_code}})
                    </p>
                    <div class="d-flex justify-content-end">
                        <a href="{{route('route.index')}}" class="btn btn-sm btn-primary">See More</a>
                    </div>
                </div>
            </div>

            <!-- Bus -->
            <div class="col-md-6">
                <div class="p-4 bg-white rounded-4 shadow-sm h-100">
                    <h6 class="text-muted"><i class="bi bi-bus-front-fill me-2 text-success"></i>Bus</h6>
                    <p class="fw-bold fs-5">{{$data->busInfo->bus_name}} ({{$data->busInfo->bus_code}})</p>
                    <div class="d-flex justify-content-end">
                        <a href="{{route('bus.show',$data->busInfo->id)}}" class="btn btn-sm btn-primary">See More</a>
                    </div>
                </div>
            </div>

            <!-- Driver -->
            <div class="col-md-6">
                <div class="p-4 bg-white rounded-4 shadow-sm h-100">
                    <h6 class="text-muted"><i class="bi bi-person-badge-fill me-2 text-warning"></i>Driver</h6>
                    <p class="fw-bold fs-5">{{$data->driverInfo->name}}  ({{$data->driverInfo->driver_code}})</p>
                    <div class="d-flex justify-content-between">
                        <small class="text-muted"><i class="bi bi-telephone me-1"></i>{{$data->driverInfo->phone}}</small>
                        <a href="{{route('driver.show',$data->driverInfo->id)}}" class="btn btn-sm btn-primary">See More</a>
                    </div>
                </div>
            </div>

            <!-- Schedule -->
            <div class="col-md-6">
                <div class="p-4 bg-white rounded-4 shadow-sm h-100">
                    <h6 class="text-muted"><i class="bi bi-clock-fill me-2 text-info"></i>Schedule</h6>
                    <p class="fw-bold fs-5">{{\Carbon\Carbon::parse($data->schedule)->format('l, d M Y - h:i A')}}</p>
                </div>
            </div>

            <!-- Price -->
            <div class="col-md-6">
                <div class="p-4 bg-white rounded-4 shadow-sm h-100">
                    <h6 class="text-muted"><i class="bi bi-cash-coin me-2 text-success"></i>Price</h6>
                    <p class="fw-bold fs-4 text-dark">
                        ${{$data->price-round($data->price*($data->discount/100))}}
                        @if($data->discount)
                            <span class="text-danger ms-2 text-decoration-line-through">
                            ${{$data->price}}
                        </span>
                        @endif
                    </p>
                    <small class="text-muted">{{$data->discount}} <i class="bi bi-percent"></i></small>
                </div>
            </div>

            <!-- Status -->
            <div class="col-md-6">
                <div class="p-4 bg-white rounded-4 shadow-sm h-100">
                    <h6 class="text-muted"><i class="bi bi-check-circle-fill me-2 text-primary"></i>Status</h6>
                    @if($data->status ==='1')
                        <span class="badge bg-success px-3 py-2 ">Active</span>
                    @else
                        <span class="badge bg-danger px-3 py-2 ">Inactive</span>
                    @endif
                </div>
            </div>

            <!-- Total Sell -->
            <div class="col-md-6">
                <div class="p-4 bg-white rounded-4 shadow-sm h-100">
                    <h6 class="text-muted"><i class="bi bi-cart4 text-success"></i>  Total Sell</h6>
                    <p class="fw-bold fs-4 text-dark">
                         1025
                    </p>
                </div>
            </div>

            <!-- Total Income -->
            <div class="col-md-6">
                <div class="p-4 bg-white rounded-4 shadow-sm h-100">
                    <h6 class="text-muted"><i class="bi bi-wallet2 text-danger"></i>  Earn</h6>
                    <p class="fw-bold fs-4 text-dark">
                        $1025
                    </p>
                </div>
            </div>
        </div>
@endsection
