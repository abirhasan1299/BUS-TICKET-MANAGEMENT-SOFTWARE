@extends('layout.master')
@section('title', 'Bus Management')
@section('page-title', 'Bus Management')
@section('breadcrumb', 'Bus Fleet')

@section('action-buttons')
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#filterModal">
        <i class="bi bi-funnel me-1"></i> Filter
    </button>
    <a href="{{route('bus.create')}}" class="btn btn-success ms-2">
        <i class="bi bi-bus-front me-1"></i> Add New Bus
    </a>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="dashboard-card">
                <div class="card-header border-0 bg-transparent p-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="mb-0 fw-bold">Bus Fleet Management</h5>
                            <p class="text-muted mb-0">Manage all buses in the fleet</p>
                        </div>
                        <div>
                            <a class="btn btn-sm btn-primary" href="{{route('bus.create')}}" role="button">
                                <i class="bi bi-plus-lg"> Add Bus</i>
                            </a>
                        </div>
                        <div class="d-flex gap-2">
                            <div class="input-group" style="width: 250px;">
                            <span class="input-group-text bg-light border-end-0">
                                <i class="bi bi-search"></i>
                            </span>
                                <input type="text" class="form-control border-start-0" placeholder="Search buses..." id="searchInput">
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
                                    <h6 class="text-muted mb-1">Total Buses</h6>
                                    <h4 class="mb-0 fw-bold">{{ $buses->total() }}</h4>
                                </div>
                                <div class="bg-primary rounded-circle p-2">
                                    <i class="bi bi-bus-front text-white"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="stat-card bg-success bg-opacity-10 rounded-3 p-3">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="text-muted mb-1">Active Buses</h6>
                                    <h4 class="mb-0 fw-bold">{{ $buses->where('status', 'active')->count() }}</h4>
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
                                    <h6 class="text-muted mb-1">Maintenance</h6>
                                    <h4 class="mb-0 fw-bold">{{ $buses->where('status', 'maintenance')->count() }}</h4>
                                </div>
                                <div class="bg-warning rounded-circle p-2">
                                    <i class="bi bi-tools text-white"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="stat-card bg-info bg-opacity-10 rounded-3 p-3">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="text-muted mb-1">Total Seats</h6>
                                    <h4 class="mb-0 fw-bold">{{ $buses->sum('seat_capacity') }}</h4>
                                </div>
                                <div class="bg-info rounded-circle p-2">
                                    <i class="bi bi-people text-white"></i>
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
                                <th class="ps-4">#</th>
                                <th>Bus Details</th>
                                <th>Type</th>
                                <th>Capacity</th>
                                <th>Status</th>
                                <th>Added</th>
                                <th class="text-center pe-4">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($buses as $bus)
                                <tr>
                                    <td class="ps-4 fw-semibold">{{ $loop->iteration }}</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="bg-primary bg-opacity-10 rounded-circle p-2 me-3">
                                                <i class="bi bi-bus-front text-primary"></i>
                                            </div>
                                            <div>
                                                <div class="fw-semibold">{{$bus->bus_code}}</div>
                                                <div class="text-muted small">{{$bus->bus_name}}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        @php
                                            $typeColors = [
                                                'AC' => 'primary',
                                                'Non-AC' => 'secondary',
                                                'Sleeper' => 'warning'
                                            ];
                                            $typeColor = $typeColors[$bus->type] ?? 'info';
                                        @endphp
                                        <span class="badge bg-{{$typeColor}} bg-opacity-10 text-{{$typeColor}} px-3 py-1">
                                        <i class="bi bi-{{ $bus->type == 'AC' ? 'snow' : ($bus->type == 'Sleeper' ? 'moon' : 'fan') }} me-1"></i>
                                        {{$bus->type}}
                                    </span>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <i class="bi bi-person text-muted me-2"></i>
                                            <span class="fw-semibold">{{$bus->seat_capacity}}</span>
                                            <span class="text-muted small ms-1">seats</span>
                                        </div>
                                    </td>
                                    <td>
                                        @php
                                            $statusColors = [
                                                'active' => 'success',
                                                'inactive' => 'danger',
                                                'maintenance' => 'warning'
                                            ];
                                            $statusColor = $statusColors[$bus->status] ?? 'secondary';
                                        @endphp
                                        <span class="badge bg-{{$statusColor}} bg-opacity-10 text-{{$statusColor}} px-3 py-1">
                                        @if($bus->status == 'active')
                                                <i class="bi bi-check-circle me-1"></i>
                                            @elseif($bus->status == 'maintenance')
                                                <i class="bi bi-tools me-1"></i>
                                            @else
                                                <i class="bi bi-x-circle me-1"></i>
                                            @endif
                                            {{ ucfirst($bus->status) }}
                                    </span>
                                    </td>
                                    <td>
                                        <div class="text-nowrap">
                                            <div class="small">{{ \Carbon\Carbon::parse($bus->created_at)->format('d M Y') }}</div>
                                            <div class="text-muted small">{{ \Carbon\Carbon::parse($bus->created_at)->diffForHumans() }}</div>
                                        </div>
                                    </td>
                                    <td class="pe-4">
                                        <div class="d-flex justify-content-center gap-2">
                                            <a href="{{ route('bus.show', $bus->id) }}"
                                               class="btn btn-sm btn-outline-info d-flex align-items-center"
                                               title="View Details">
                                                <i class="bi bi-eye me-1"></i> View
                                            </a>
                                            <a href="{{ route('bus.edit', $bus->id) }}"
                                               class="btn btn-sm btn-outline-primary d-flex align-items-center"
                                               title="Edit Bus">
                                                <i class="bi bi-pencil-square me-1"></i> Edit
                                            </a>
                                            <form action="{{ route('bus.destroy', $bus->id) }}" method="POST"
                                                  onsubmit="return confirmDelete()" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                        class="btn btn-sm btn-outline-danger d-flex align-items-center"
                                                        title="Delete Bus">
                                                    <i class="bi bi-trash me-1"></i> Delete
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach

                            @if($buses->isEmpty())
                                <tr>
                                    <td colspan="7" class="text-center py-5">
                                        <div class="text-muted">
                                            <i class="bi bi-bus-front display-5 mb-3"></i>
                                            <h5 class="mb-2">No Buses Found</h5>
                                            <p class="mb-0">Get started by adding your first bus to the fleet</p>
                                            <a href="{{route('bus.create')}}" class="btn btn-primary mt-3">
                                                <i class="bi bi-bus-front me-1"></i> Add First Bus
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>

                @if($buses->isNotEmpty())
                    <div class="card-footer border-0 bg-transparent p-4">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="text-muted">
                                Showing {{$buses->firstItem()}} to {{$buses->lastItem()}} of {{$buses->total()}} buses
                            </div>
                            <div>
                                {{ $buses->links('pagination::bootstrap-5') }}
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
                    <h5 class="modal-title fw-bold" id="filterModalLabel">Filter Buses</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{route('driver.filter')}}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Bus Code</label>
                                <input type="text" name="bus_code" class="form-control" placeholder="Enter bus code">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Available Seats</label>
                                <input type="number" name="available_seats" class="form-control" placeholder="Enter available seats">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Bus Type</label>
                                <select name="type" class="form-select">
                                    <option value="">All Types</option>
                                    <option value="AC">AC</option>
                                    <option value="Non-AC">Non-AC</option>
                                    <option value="Sleeper">Sleeper</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Status</label>
                                <select name="status" class="form-select">
                                    <option value="">All Status</option>
                                    <option value="active">Active</option>
                                    <option value="inactive">Inactive</option>
                                    <option value="maintenance">Maintenance</option>
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
        }
    </style>

    <script>
        // Confirm delete
        function confirmDelete() {
            return confirm('Are you sure you want to delete this bus? This action cannot be undone.');
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

        // Stats animation
        document.addEventListener('DOMContentLoaded', function() {
            const statCards = document.querySelectorAll('.stat-card');
            statCards.forEach((card, index) => {
                card.style.animationDelay = `${index * 0.1}s`;
                card.classList.add('animate__animated', 'animate__fadeInUp');
            });
        });
    </script>
@endsection
