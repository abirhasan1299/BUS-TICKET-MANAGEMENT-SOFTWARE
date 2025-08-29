@extends('layout.master')
@section('title', 'Bus Details')

@section('content')
    <div class="container my-5">
        <h2 class="mb-4 text-primary fw-bold">Bus Details - {{ $bus->bus_name }}</h2>

        <div class="row g-4">
            <!-- Left Column -->
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="fw-semibold text-secondary">Bus Code:</label>
                    <p class="fs-5">{{ $bus->bus_code }}</p>
                </div>

                <div class="mb-3">
                    <label class="fw-semibold text-secondary">Registration Number:</label>
                    <p class="fs-5">{{ $bus->registration_number }}</p>
                </div>

                <div class="mb-3">
                    <label class="fw-semibold text-secondary">Bus Owner Info:</label>
                    <p class="fs-5">{{ $bus->bus_owner_info }}</p>
                </div>

                <div class="mb-3">
                    <label class="fw-semibold text-secondary">Type:</label>
                    <p class="fs-5">{{ $bus->type }}</p>
                </div>

                <div class="mb-3">
                    <label class="fw-semibold text-secondary">Seat Capacity:</label>
                    <p class="fs-5">{{ $bus->seat_capacity }}</p>
                </div>

                <div class="mb-3">
                    <label class="fw-semibold text-secondary">Available Seats:</label>
                    <p class="fs-5">{{ $bus->available_seats ?? 'N/A' }}</p>
                </div>
            </div>

            <!-- Right Column -->
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="fw-semibold text-secondary">Facilities:</label>
                    <ul class="list-unstyled fs-5">
                        <li><span class="badge bg-success me-1">{{ $bus->wifi ? 'WiFi' : '' }}</span></li>
                        <li><span class="badge bg-success me-1">{{ $bus->tv ? 'TV' : '' }}</span></li>
                        <li><span class="badge bg-success me-1">{{ $bus->ac ? 'AC' : '' }}</span></li>
                        <li><span class="badge bg-success me-1">{{ $bus->charging_port ? 'Charging Port' : '' }}</span></li>
                        <li><span class="badge bg-success me-1">{{ $bus->washroom ? 'Washroom' : '' }}</span></li>
                    </ul>
                </div>

                <div class="mb-3">
                    <label class="fw-semibold text-secondary">Status:</label>
                    @if($bus->status == 'active')
                        <span class="badge bg-success fs-6">{{ ucfirst($bus->status) }}</span>
                    @elseif($bus->status == 'inactive')
                        <span class="badge bg-danger fs-6">{{ ucfirst($bus->status) }}</span>
                    @else
                        <span class="badge bg-warning text-dark fs-6">{{ ucfirst($bus->status) }}</span>
                    @endif
                </div>

                <div class="mb-3">
                    <label class="fw-semibold text-secondary">Fitness Expiry:</label>
                    <p class="fs-5">{{ $bus->fitness_expiry ? \Carbon\Carbon::parse($bus->fitness_expiry)->format('d M, Y') : 'N/A' }}</p>
                </div>

                <div class="mb-3">
                    <label class="fw-semibold text-secondary">Additional Info:</label>
                    <p class="fs-5">{{ $bus->additional_info ?? 'N/A' }}</p>
                </div>
            </div>
        </div>

        <div class="mt-4">
            <a href="{{ route('bus.index') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left-circle me-1"></i> Back to Bus List
            </a>
            <a href="{{ route('bus.edit', $bus->id) }}" class="btn btn-primary">
                <i class="bi bi-pencil-square me-1"></i> Edit Bus
            </a>
        </div>
    </div>
@endsection
