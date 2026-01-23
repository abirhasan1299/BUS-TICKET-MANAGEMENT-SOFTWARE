@extends('layout.master')
@section('title', 'Ticket Slot Management')
@section('page-title', 'Ticket Slot Management')
@section('breadcrumb', 'Schedules & Slots')

@section('action-buttons')
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#filterModal">
        <i class="bi bi-funnel me-1"></i> Filter
    </button>
    <a href="{{route('slot.create')}}" class="btn btn-success ms-2">
        <i class="bi bi-calendar-plus me-1"></i> Create Slot
    </a>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="dashboard-card">
                <div class="card-header border-0 bg-transparent p-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="mb-0 fw-bold">Ticket Slots Management</h5>
                            <p class="text-muted mb-0">Manage all ticket slots and schedules</p>
                        </div>
                        <div>
                            <a class="btn btn-sm btn-primary" href="{{route('slot.create')}}" role="button">
                                <i class="bi bi-plus-lg"> Add Slot</i>
                            </a>
                        </div>
                        <div class="d-flex gap-2">
                            <div class="input-group" style="width: 250px;">
                            <span class="input-group-text bg-light border-end-0">
                                <i class="bi bi-search"></i>
                            </span>
                                <input type="text" class="form-control border-start-0" placeholder="Search slots..." id="searchInput">
                            </div>
                            <button class="btn btn-outline-primary" id="toggleFilters">
                                <i class="bi bi-filter-circle"></i>
                            </button>
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
                                    <h6 class="text-muted mb-1">Total Slots</h6>
                                    <h4 class="mb-0 fw-bold">{{ $data->total() }}</h4>
                                </div>
                                <div class="bg-primary rounded-circle p-2">
                                    <i class="bi bi-ticket-perforated text-white"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="stat-card bg-success bg-opacity-10 rounded-3 p-3">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="text-muted mb-1">Active Slots</h6>
                                    <h4 class="mb-0 fw-bold">{{ $data->where('status', 1)->count() }}</h4>
                                </div>
                                <div class="bg-success rounded-circle p-2">
                                    <i class="bi bi-check-circle text-white"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="stat-card bg-info bg-opacity-10 rounded-3 p-3">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="text-muted mb-1">Today's Slots</h6>
                                    <h4 class="mb-0 fw-bold">
                                        @php
                                            $todaySlots = 0;
                                            foreach($data as $slot) {
                                                if(\Carbon\Carbon::parse($slot->schedule)->isToday()) {
                                                    $todaySlots++;
                                                }
                                            }
                                        @endphp
                                        {{ $todaySlots }}
                                    </h4>
                                </div>
                                <div class="bg-info rounded-circle p-2">
                                    <i class="bi bi-calendar-day text-white"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="stat-card bg-warning bg-opacity-10 rounded-3 p-3">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="text-muted mb-1">Discounted Slots</h6>
                                    <h4 class="mb-0 fw-bold">{{ $data->where('discount', '>', 0)->count() }}</h4>
                                </div>
                                <div class="bg-warning rounded-circle p-2">
                                    <i class="bi bi-percent text-white"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Quick Filters -->
                <div id="quickFilters" class="mx-4 mt-3" style="display: none;">
                    <div class="bg-light rounded-3 p-3">
                        <div class="row g-2">
                            <div class="col-md-3">
                                <select class="form-select form-select-sm" id="statusFilter">
                                    <option value="">All Status</option>
                                    <option value="active">Active</option>
                                    <option value="inactive">Inactive</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <select class="form-select form-select-sm" id="timeFilter">
                                    <option value="">All Time</option>
                                    <option value="today">Today</option>
                                    <option value="tomorrow">Tomorrow</option>
                                    <option value="week">This Week</option>
                                    <option value="month">This Month</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <select class="form-select form-select-sm" id="discountFilter">
                                    <option value="">All Discounts</option>
                                    <option value="discounted">Discounted Only</option>
                                    <option value="no-discount">No Discount</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <button class="btn btn-sm btn-outline-secondary w-100" id="clearFilters">
                                    Clear Filters
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light">
                            <tr>
                                <th class="ps-4">#</th>
                                <th>Route Details</th>
                                <th>Schedule</th>
                                <th>Price</th>
                                <th>Discount</th>
                                <th>Status</th>
                                <th class="text-center pe-4">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($data as $d)
                                @php
                                    $isToday = \Carbon\Carbon::parse($d->schedule)->isToday();
                                    $isPast = \Carbon\Carbon::parse($d->schedule)->isPast();
                                    $scheduleDate = \Carbon\Carbon::parse($d->schedule);
                                    $timeUntil = $scheduleDate->diffForHumans();
                                @endphp
                                <tr class="{{ $isPast ? 'opacity-75' : '' }}">
                                    <td class="ps-4 fw-semibold">{{$loop->iteration}}</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="bg-primary bg-opacity-10 rounded-circle p-2 me-3">
                                                <i class="bi bi-sign-turn-right text-primary"></i>
                                            </div>
                                            <div>
                                                <div class="fw-semibold">
                                                    {{$d->busRoute->start_location}} → {{$d->busRoute->end_location}}
                                                </div>
                                                <div class="text-muted small">
                                                    <i class="bi bi-bus-front me-1"></i>
                                                    @if($d->bus)
                                                        {{ $d->bus->bus_name ?? 'N/A' }}
                                                    @endif
                                                </div>
                                                <div class="text-muted small">
                                                    <i class="bi bi-tag me-1"></i> SLOT#{{ $d->slot_code }}
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="text-nowrap">
                                            <div class="fw-semibold">
                                                {{ $scheduleDate->format('d M Y, h:i A') }}
                                            </div>
                                            <div class="small text-muted">
                                                @if($isToday)
                                                    <span class="badge bg-info bg-opacity-10 text-info px-2 py-1">
                                                    <i class="bi bi-clock me-1"></i> Today
                                                </span>
                                                @elseif($isPast)
                                                    <span class="text-danger">
                                                    <i class="bi bi-clock-history me-1"></i> Past
                                                </span>
                                                @else
                                                    <span class="text-success">
                                                    <i class="bi bi-clock me-1"></i> {{ $timeUntil }}
                                                </span>
                                                @endif
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <span class="fw-bold text-primary">৳{{$d->price}}</span>
                                            @if($d->discount > 0)
                                                <del class="text-muted small ms-2">৳{{ round($d->price / (1 - $d->discount/100)) }}</del>
                                            @endif
                                        </div>
                                    </td>
                                    <td>
                                        @if($d->discount > 0)
                                            <span class="badge bg-warning bg-opacity-10 text-warning px-3 py-1">
                                        <i class="bi bi-percent me-1"></i>
                                        {{$d->discount}}% Off
                                    </span>
                                            <div class="text-success small mt-1">
                                                Save ৳{{ round($d->price * $d->discount/100) }}
                                            </div>
                                        @else
                                            <span class="badge bg-secondary bg-opacity-10 text-secondary px-3 py-1">
                                        No Discount
                                    </span>
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
                                    <td class="pe-4">
                                        <div class="d-flex justify-content-center gap-2">
                                            <a href="{{route('slot.show',$d->id)}}"
                                               class="btn btn-sm btn-outline-info d-flex align-items-center"
                                               title="View Details">
                                                <i class="bi bi-eye me-1"></i> View
                                            </a>
                                            <a href="{{route('slot.edit',$d->id)}}"
                                               class="btn btn-sm btn-outline-primary d-flex align-items-center"
                                               title="Edit Slot">
                                                <i class="bi bi-pencil-square me-1"></i> Edit
                                            </a>
                                            <form action="{{route('slot.destroy',$d->id)}}" method="POST"
                                                  onsubmit="return confirmDelete()" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                        class="btn btn-sm btn-outline-danger d-flex align-items-center"
                                                        title="Delete Slot">
                                                    <i class="bi bi-trash me-1"></i> Delete
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center py-5">
                                        <div class="text-muted">
                                            <i class="bi bi-calendar-x display-5 mb-3"></i>
                                            <h5 class="mb-2">No Ticket Slots Found</h5>
                                            <p class="mb-0">Get started by creating your first ticket slot</p>
                                            <a href="{{route('slot.create')}}" class="btn btn-primary mt-3">
                                                <i class="bi bi-calendar-plus me-1"></i> Create First Slot
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                @if($data->isNotEmpty())
                    <div class="card-footer border-0 bg-transparent p-4">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="text-muted">
                                Showing {{$data->firstItem()}} to {{$data->lastItem()}} of {{$data->total()}} slots
                            </div>
                            <div>
                                {{ $data->links('pagination::bootstrap-5') }}
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
                    <h5 class="modal-title fw-bold" id="filterModalLabel">Filter Ticket Slots</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{route('slot.filter')}}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Slot Code</label>
                                <input type="text" name="slot_code" class="form-control" placeholder="Enter slot code">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Price Range</label>
                                <div class="input-group">
                                    <input type="number" name="min_price" class="form-control" placeholder="Min">
                                    <span class="input-group-text">to</span>
                                    <input type="number" name="max_price" class="form-control" placeholder="Max">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Start Location</label>
                                <input type="text" name="route_start" class="form-control" placeholder="Enter start location">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">End Location</label>
                                <input type="text" name="route_end" class="form-control" placeholder="Enter end location">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Date Range</label>
                                <input type="date" name="start_date" class="form-control mb-2" placeholder="From Date">
                                <input type="date" name="end_date" class="form-control" placeholder="To Date">
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

        .opacity-75 {
            opacity: 0.75;
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

        /* Price Strikethrough */
        del {
            text-decoration-color: #94a3b8;
        }

        /* Modal Styles */
        .modal-content {
            border-radius: 16px;
            border: none;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
        }

        /* Schedule Status Colors */
        .text-success { color: #2EC4B6 !important; }
        .text-danger { color: #E71D36 !important; }
        .text-info { color: #4CC9F0 !important; }

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
        // Toggle quick filters
        document.getElementById('toggleFilters').addEventListener('click', function() {
            const filters = document.getElementById('quickFilters');
            filters.style.display = filters.style.display === 'none' ? 'block' : 'none';
            this.innerHTML = filters.style.display === 'none' ?
                '<i class="bi bi-filter-circle"></i>' :
                '<i class="bi bi-filter-circle-fill"></i>';
        });

        // Quick filter functionality
        document.getElementById('statusFilter')?.addEventListener('change', filterTable);
        document.getElementById('timeFilter')?.addEventListener('change', filterTable);
        document.getElementById('discountFilter')?.addEventListener('change', filterTable);

        function filterTable() {
            const status = document.getElementById('statusFilter').value;
            const time = document.getElementById('timeFilter').value;
            const discount = document.getElementById('discountFilter').value;

            const rows = document.querySelectorAll('tbody tr');

            rows.forEach(row => {
                let show = true;

                // Status filter
                if (status) {
                    const statusText = row.querySelector('td:nth-child(6)').textContent.toLowerCase();
                    if (status === 'active' && !statusText.includes('active')) show = false;
                    if (status === 'inactive' && !statusText.includes('inactive')) show = false;
                }

                // Time filter
                if (time && row.cells[2]) {
                    const dateText = row.cells[2].textContent;
                    const today = new Date().toDateString();

                    if (time === 'today' && !dateText.toLowerCase().includes('today')) show = false;
                    // Add more time filter logic as needed
                }

                // Discount filter
                if (discount && row.cells[4]) {
                    const discountText = row.cells[4].textContent;
                    if (discount === 'discounted' && discountText.includes('No Discount')) show = false;
                    if (discount === 'no-discount' && !discountText.includes('No Discount')) show = false;
                }

                row.style.display = show ? '' : 'none';
            });
        }

        // Clear filters
        document.getElementById('clearFilters')?.addEventListener('click', function() {
            document.getElementById('statusFilter').value = '';
            document.getElementById('timeFilter').value = '';
            document.getElementById('discountFilter').value = '';

            const rows = document.querySelectorAll('tbody tr');
            rows.forEach(row => row.style.display = '');
        });

        // Confirm delete
        function confirmDelete() {
            return confirm('Are you sure you want to delete this ticket slot? This action cannot be undone.');
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

            // Highlight today's slots
            const todayRows = document.querySelectorAll('tbody tr');
            todayRows.forEach(row => {
                if (row.textContent.toLowerCase().includes('today')) {
                    row.style.backgroundColor = 'rgba(32, 201, 151, 0.05)';
                }
            });
        });
    </script>
@endsection
