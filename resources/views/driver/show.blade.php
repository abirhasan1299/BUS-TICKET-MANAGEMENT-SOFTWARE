@extends('layout.master')

@section('title','View | Driver')

@section('content')
    <div class="container my-5">
        <h2 class="fw-bold text-center mb-4">Driver Details</h2>

        <div class="table-responsive">
            <table class="table table-bordered border-0 align-middle shadow-sm rounded-4 overflow-hidden">
                <tbody>
                <tr class="bg-light">
                    <th class="w-25 text-uppercase text-muted small">Driver Code</th>
                    <td class="fw-semibold">{{ $driver->driver_code }}</td>
                </tr>
                <tr>
                    <th class="text-uppercase text-muted small">Govt. ID</th>
                    <td>{{ $driver->gov_id }}</td>
                </tr>
                <tr class="bg-light">
                    <th class="text-uppercase text-muted small">Full Name</th>
                    <td>{{ $driver->name }}</td>
                </tr>
                <tr>
                    <th class="text-uppercase text-muted small">Phone</th>
                    <td>{{ $driver->phone }}</td>
                </tr>
                <tr class="bg-light">
                    <th class="text-uppercase text-muted small">Email</th>
                    <td>{{ $driver->email ?? '—' }}</td>
                </tr>
                <tr>
                    <th class="text-uppercase text-muted small">City</th>
                    <td>{{ $driver->city ?? '—' }}</td>
                </tr>
                <tr class="bg-light">
                    <th class="text-uppercase text-muted small">Postal Code</th>
                    <td>{{ $driver->postal_code }}</td>
                </tr>
                <tr>
                    <th class="text-uppercase text-muted small">License Number</th>
                    <td>{{ $driver->license_number }}</td>
                </tr>
                <tr class="bg-light">
                    <th class="text-uppercase text-muted small">License Expiry Date</th>
                    <td>
                        @php
                            $days = \Carbon\Carbon::today()->diffInDays(\Carbon\Carbon::parse($driver->license_expiry_date), false);
                        @endphp
                        {{ $driver->license_expiry_date ? \Carbon\Carbon::parse($driver->license_expiry_date)->format('d M, Y') : '—' }}

                        @if($days > 0)
                            <span class="badge bg-success ms-2">{{ $days }} days left</span>
                        @elseif($days === 0)
                            <span class="badge bg-warning text-dark ms-2">Expires Today</span>
                        @else
                            <span class="badge bg-danger ms-2">Expired {{ abs($days) }} days ago</span>
                        @endif
                    </td>
                </tr>
                <tr>
                    <th class="text-uppercase text-muted small">Address</th>
                    <td>{{ $driver->address ?? '—' }}</td>
                </tr>
                <tr class="bg-light">
                    <th class="text-uppercase text-muted small">Date of Birth</th>
                    <td>
                        {{ \Carbon\Carbon::parse($driver->dob)->format('d M, Y') }}
                        <span class="badge bg-primary">{{ \Carbon\Carbon::parse($driver->dob)->age }} yrs</span>
                    </td>
                </tr>
                <tr>
                    <th class="text-uppercase text-muted small">Status</th>
                    <td>
                        @if($driver->status)
                            <span class="badge bg-primary">Active</span>
                        @else
                            <span class="badge bg-secondary">Inactive</span>
                        @endif
                    </td>
                </tr>
                <tr class="bg-light">
                    <th class="text-uppercase text-muted small">Created At</th>
                    <td>{{ $driver->created_at->format('d M, Y h:i A') }}</td>
                </tr>
                <tr>
                    <th class="text-uppercase text-muted small">Last Updated</th>
                    <td>{{ $driver->updated_at->format('d M, Y h:i A') }}</td>
                </tr>
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-between mt-4">
            <a href="{{ route('driver.index') }}" class="btn btn-outline-secondary px-4">
                <i class="bi bi-arrow-left-circle me-1"></i> Back
            </a>
            <div>
                <a href="{{ route('driver.edit', $driver->id) }}" class="btn btn-outline-primary px-4 me-2">
                    <i class="bi bi-pencil-square me-1"></i> Edit
                </a>
                <form action="{{ route('driver.destroy', $driver->id) }}" method="POST" class="d-inline"
                      onsubmit="return confirm('Are you sure to delete this driver?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-outline-danger px-4">
                        <i class="bi bi-trash me-1"></i> Delete
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
