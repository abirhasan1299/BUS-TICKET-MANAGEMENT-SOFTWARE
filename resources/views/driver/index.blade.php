@extends('layout.master')
@section('title', 'Driver Management')
@section('page-title', 'Driver Management')
@section('breadcrumb', 'Drivers & Crew')

@section('action-buttons')
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#filterModal">
        <i class="bi bi-funnel me-1"></i> Filter
    </button>
    <a href="{{route('driver.create')}}" class="btn btn-success ms-2">
        <i class="bi bi-person-plus me-1"></i> Add New Driver
    </a>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="dashboard-card">
                <div class="card-header border-0 bg-transparent p-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="mb-0 fw-bold">Driver Management</h5>
                            <p class="text-muted mb-0">Manage all drivers and their details</p>
                        </div>
                        <div>
                            <a class="btn btn-sm btn-primary" role="button" href="{{route('driver.create')}}">
                                <i class="bi bi-plus-lg"></i> Add Driver
                            </a>
                        </div>
                        <div class="d-flex gap-2">
                            <div class="input-group" style="width: 250px;">
                            <span class="input-group-text bg-light border-end-0">
                                <i class="bi bi-search"></i>
                            </span>
                                <input type="text" class="form-control border-start-0" placeholder="Search drivers..." id="searchInput">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Alerts -->
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show mx-4 mt-2" role="alert">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0">
                                <i class="bi bi-check-circle-fill me-2"></i>
                            </div>
                            <div class="flex-grow-1">
                                <strong>Success!</strong> {{session('success')}}
                            </div>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    </div>
                @endif

                @if(session('danger'))
                    <div class="alert alert-danger alert-dismissible fade show mx-4 mt-2" role="alert">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0">
                                <i class="bi bi-exclamation-circle-fill me-2"></i>
                            </div>
                            <div class="flex-grow-1">
                                <strong>Error!</strong> {{session('danger')}}
                            </div>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    </div>
                @endif

                <!-- Stats Cards -->
                <div class="row mx-4 mt-3">
                    <div class="col-md-3">
                        <div class="stat-card bg-primary bg-opacity-10 rounded-3 p-3">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="text-muted mb-1">Total Drivers</h6>
                                    <h4 class="mb-0 fw-bold">{{ $data->total() }}</h4>
                                </div>
                                <div class="bg-primary rounded-circle p-2">
                                    <i class="bi bi-people text-white"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="stat-card bg-success bg-opacity-10 rounded-3 p-3">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="text-muted mb-1">Active Drivers</h6>
                                    <h4 class="mb-0 fw-bold">{{ $data->where('status', 1)->count() }}</h4>
                                </div>
                                <div class="bg-success rounded-circle p-2">
                                    <i class="bi bi-check-circle text-white"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="stat-card bg-warning bg-opacity-10 rounded-3 p-3">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="text-muted mb-1">License Expiring</h6>
                                    <h4 class="mb-0 fw-bold">
                                        @php
                                            $expiringCount = 0;
                                            foreach($data as $driver) {
                                                $daysToExpire = \Carbon\Carbon::today()->diffInDays(\Carbon\Carbon::parse($driver->license_expiry_date), false);
                                                if($daysToExpire > 0 && $daysToExpire <= 30) {
                                                    $expiringCount++;
                                                }
                                            }
                                        @endphp
                                        {{ $expiringCount }}
                                    </h4>
                                </div>
                                <div class="bg-warning rounded-circle p-2">
                                    <i class="bi bi-clock text-white"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="stat-card bg-info bg-opacity-10 rounded-3 p-3">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="text-muted mb-1">Avg Experience</h6>
                                    <h4 class="mb-0 fw-bold">
                                        @php
                                            $totalExp = 0;
                                            $count = 0;
                                            foreach($data as $driver) {
                                                if($driver->experience_years) {
                                                    $totalExp += $driver->experience_years;
                                                    $count++;
                                                }
                                            }
                                            $avgExp = $count > 0 ? round($totalExp / $count, 1) : 0;
                                        @endphp
                                        {{ $avgExp }} yrs
                                    </h4>
                                </div>
                                <div class="bg-info rounded-circle p-2">
                                    <i class="bi bi-award text-white"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light">
                            <tr>
                                <th class="ps-4">SL</th>
                                <th>Driver Details</th>
                                <th>Contact</th>
                                <th>Location</th>
                                <th>Status</th>
                                <th>License Status</th>
                                <th class="text-center pe-4">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php $count = 1; @endphp
                            @foreach($data as $d)
                                @php
                                    $daysToExpire = \Carbon\Carbon::today()->diffInDays(\Carbon\Carbon::parse($d->license_expiry_date), false);
                                    $licenseStatus = 'valid';
                                    $licenseColor = 'success';
                                    $licenseIcon = 'check-circle';

                                    if($daysToExpire < 0) {
                                        $licenseStatus = 'expired';
                                        $licenseColor = 'danger';
                                        $licenseIcon = 'x-circle';
                                    } elseif($daysToExpire <= 30) {
                                        $licenseStatus = 'expiring soon';
                                        $licenseColor = 'warning';
                                        $licenseIcon = 'clock';
                                    }
                                @endphp
                                <tr>
                                    <td class="ps-4 fw-semibold">{{$count++}}</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="avatar-sm me-3">
                                                <div class="bg-primary bg-opacity-10 rounded-circle p-2">
                                                    <i class="bi bi-person-badge text-primary"></i>
                                                </div>
                                            </div>
                                            <div>
                                                <div class="fw-semibold">{{$d->name}}</div>
                                                <div class="text-muted small">ID: {{$d->driver_code}}</div>
                                                @if($d->experience_years)
                                                    <div class="badge bg-info bg-opacity-10 text-info px-2 py-1 mt-1">
                                                        {{$d->experience_years}} yrs exp
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div>
                                            <div class="d-flex align-items-center mb-1">
                                                <i class="bi bi-telephone text-muted me-2"></i>
                                                <span>{{$d->phone}}</span>
                                            </div>
                                            @if($d->email)
                                                <div class="d-flex align-items-center">
                                                    <i class="bi bi-envelope text-muted me-2"></i>
                                                    <span class="small text-truncate" style="max-width: 150px;">{{$d->email}}</span>
                                                </div>
                                            @endif
                                        </div>
                                    </td>
                                    <td>
                                        <div class="text-nowrap">
                                            <i class="bi bi-geo-alt text-muted me-1"></i>
                                            {{$d->city}}
                                        </div>
                                        @if($d->address)
                                            <div class="text-muted small mt-1" style="max-width: 150px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                                                {{$d->address}}
                                            </div>
                                        @endif
                                    </td>
                                    <td>
                                        @if($d->status == 1)
                                            <span class="badge bg-success bg-opacity-10 text-success px-3 py-1">
                                        <i class="bi bi-check-circle me-1"></i> Active
                                    </span>
                                        @else
                                            <span class="badge bg-danger bg-opacity-10 text-danger px-3 py-1">
                                        <i class="bi bi-x-circle me-1"></i> Inactive
                                    </span>
                                        @endif
                                    </td>
                                    <td>
                                    <span class="badge bg-{{$licenseColor}} bg-opacity-10 text-{{$licenseColor}} px-3 py-1">
                                        <i class="bi bi-{{$licenseIcon}} me-1"></i>
                                        @if($licenseStatus == 'valid')
                                            Valid ({{$daysToExpire}} days)
                                        @elseif($licenseStatus == 'expiring soon')
                                            Expires in {{$daysToExpire}} days
                                        @else
                                            Expired {{abs($daysToExpire)}} days ago
                                        @endif
                                    </span>
                                        <div class="text-muted small mt-1">
                                            License: {{$d->license_number}}
                                        </div>
                                    </td>
                                    <td class="pe-4">
                                        <div class="d-flex justify-content-center gap-2">
                                            <a href="{{route('driver.show',$d->id)}}"
                                               class="btn btn-sm btn-outline-info d-flex align-items-center"
                                               title="View Details">
                                                <i class="bi bi-eye me-1"></i> View
                                            </a>
                                            <a href="{{route('driver.edit',$d->id)}}"
                                               class="btn btn-sm btn-outline-primary d-flex align-items-center"
                                               title="Edit Driver">
                                                <i class="bi bi-pencil-square me-1"></i> Edit
                                            </a>
                                            <form action="{{route('driver.destroy',$d->id)}}" method="post"
                                                  onsubmit="return confirmDelete()" class="d-inline">
                                                @method('DELETE')
                                                @csrf
                                                <button type="submit"
                                                        class="btn btn-sm btn-outline-danger d-flex align-items-center"
                                                        title="Delete Driver">
                                                    <i class="bi bi-trash me-1"></i> Delete
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach

                            @if($data->isEmpty())
                                <tr>
                                    <td colspan="7" class="text-center py-5">
                                        <div class="text-muted">
                                            <i class="bi bi-person-badge display-5 mb-3"></i>
                                            <h5 class="mb-2">No Drivers Found</h5>
                                            <p class="mb-0">Get started by adding your first driver</p>
                                            <a href="{{route('driver.create')}}" class="btn btn-primary mt-3">
                                                <i class="bi bi-person-plus me-1"></i> Add First Driver
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>

                @if($data->isNotEmpty())
                    <div class="card-footer border-0 bg-transparent p-4">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="text-muted">
                                Showing {{$data->firstItem()}} to {{$data->lastItem()}} of {{$data->total()}} drivers
                            </div>
                            <div>
                                {{$data->links('pagination::bootstrap-5')}}
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Filter Modal -->
    <div class="modal fade" id="filterModal" tabindex="-1" aria-labelledby="filterModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <h5 class="modal-title fw-bold" id="filterModalLabel">Filter Drivers</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{route('driver.filter')}}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Driver Code</label>
                                <input type="text" name="driver_code" class="form-control" placeholder="Enter driver code">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Date of Birth</label>
                                <input type="text" id="date" name="dob" class="form-control" placeholder="YYYY-MM-DD">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Phone Number</label>
                                <input type="text" name="phone" class="form-control" placeholder="Enter phone number">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">License Number</label>
                                <input type="text" name="license_number" class="form-control" placeholder="Enter license number">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">City</label>
                                <input type="text" name="city" class="form-control" placeholder="Enter city">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Status</label>
                                <select name="status" class="form-select">
                                    <option value="">All Status</option>
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer border-0">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-funnel me-1"></i> Apply Filters
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <style>
        /* Custom Styles */
        .stat-card {
            transition: all 0.3s ease;
            border: 1px solid transparent;
        }

        .stat-card:hover {
            transform: translateY(-3px);
            border-color: rgba(0, 0, 0, 0.1);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        }

        .avatar-sm {
            width: 40px;
            height: 40px;
        }

        .table > :not(caption) > * > * {
            padding: 1rem 0.75rem;
            vertical-align: middle;
        }

        .table-hover tbody tr:hover {
            background-color: rgba(var(--primary-color-rgb), 0.05);
            transition: all 0.2s ease;
        }

        .table thead th {
            font-weight: 600;
            font-size: 0.875rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: #64748B;
            border-bottom: 2px solid #E2E8F0;
        }

        .table tbody td {
            border-bottom: 1px solid #F1F5F9;
        }

        /* Badge Styles */
        .badge {
            font-weight: 500;
            padding: 0.35em 0.65em;
        }

        /* Button Styles */
        .btn-outline-primary, .btn-outline-danger, .btn-outline-info {
            border-width: 1px;
            transition: all 0.2s ease;
        }

        .btn-outline-primary:hover {
            background-color: rgba(var(--primary-color-rgb), 0.1);
            transform: translateY(-1px);
        }

        .btn-outline-danger:hover {
            background-color: rgba(231, 29, 54, 0.1);
            transform: translateY(-1px);
        }

        .btn-outline-info:hover {
            background-color: rgba(32, 201, 151, 0.1);
            transform: translateY(-1px);
        }

        /* Modal Styles */
        .modal-content {
            border-radius: 16px;
            border: none;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
        }

        /* License Status Colors */
        .badge.bg-success {
            background-color: rgba(46, 196, 182, 0.1) !important;
            color: #2EC4B6 !important;
        }

        .badge.bg-warning {
            background-color: rgba(255, 191, 105, 0.1) !important;
            color: #FFBF69 !important;
        }

        .badge.bg-danger {
            background-color: rgba(231, 29, 54, 0.1) !important;
            color: #E71D36 !important;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .card-header .d-flex {
                flex-direction: column;
                gap: 1rem;
            }

            .card-header .input-group {
                width: 100% !important;
            }

            .btn {
                width: 100%;
                margin-bottom: 0.5rem;
            }

            .d-flex.gap-2 {
                flex-wrap: wrap;
            }

            .stat-card {
                margin-bottom: 1rem;
            }

            .table-responsive {
                font-size: 0.875rem;
            }
        }
    </style>

    <script>
        // Initialize Flatpickr for date input
        flatpickr("#date", {
            dateFormat: "Y-m-d",
        });

        // Confirm delete
        function confirmDelete() {
            return confirm('Are you sure you want to delete this driver? This action cannot be undone.');
        }

        // Search functionality
        document.getElementById('searchInput')?.addEventListener('input', function(e) {
            const searchTerm = e.target.value.toLowerCase();
            const rows = document.querySelectorAll('tbody tr');

            rows.forEach(row => {
                const text = row.textContent.toLowerCase();
                row.style.display = text.includes(searchTerm) ? '' : 'none';
            });
        });

        // Initialize tooltips
        document.addEventListener('DOMContentLoaded', function() {
            const tooltips = document.querySelectorAll('[title]');
            tooltips.forEach(el => {
                new bootstrap.Tooltip(el);
            });
        });

        // Highlight expired licenses
        document.addEventListener('DOMContentLoaded', function() {
            const licenseCells = document.querySelectorAll('td:nth-child(6)');
            licenseCells.forEach(cell => {
                const badge = cell.querySelector('.badge');
                if(badge.classList.contains('bg-danger')) {
                    cell.parentElement.style.backgroundColor = 'rgba(231, 29, 54, 0.05)';
                } else if(badge.classList.contains('bg-warning')) {
                    cell.parentElement.style.backgroundColor = 'rgba(255, 191, 105, 0.05)';
                }
            });
        });
    </script>
@endsection
