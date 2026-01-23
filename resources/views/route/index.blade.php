@extends('layout.master')
@section('title', 'Route Management')
@section('page-title', 'Route Management')
@section('breadcrumb', 'Bus Routes')

@section('action-buttons')
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#filterModal">
        <i class="bi bi-funnel me-1"></i> Filter
    </button>
    <a href="{{route('route.create')}}" class="btn btn-success ms-2">
        <i class="bi bi-plus-lg me-1"></i> Add New Route
    </a>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">

            <div class="dashboard-card">
                <div class="card-header border-0 bg-transparent p-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="mb-0 fw-bold">Route List</h5>
                            <p class="text-muted mb-0">Manage all bus routes and their details</p>
                        </div>
                        <div>
                            <a class="btn btn-primary btn-sm" href="{{route('route.create')}}" role="button">
                                <i class="bi bi-plus-lg"></i>
                                </i> Add Route
                            </a>
                        </div>
                        <div class="d-flex gap-2">
                            <div class="input-group" style="width: 250px;">
                            <span class="input-group-text bg-light border-end-0">
                                <i class="bi bi-search"></i>
                            </span>
                                <input type="text" class="form-control border-start-0" placeholder="Search routes..." id="searchInput">
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

                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show mx-4 mt-2" role="alert">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0">
                                <i class="bi bi-exclamation-circle-fill me-2"></i>
                            </div>
                            <div class="flex-grow-1">
                                <strong>Error!</strong> {{session('error')}}
                            </div>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    </div>
                @endif

                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light">
                            <tr>
                                <th class="ps-4">SL</th>
                                <th>Route Code</th>
                                <th>Start Location</th>
                                <th>End Location</th>
                                <th>Distance</th>
                                <th>Duration</th>
                                <th>Status</th>
                                <th class="text-center pe-4">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php $count = 1; @endphp
                            @foreach($data as $d)
                                <tr>
                                    <td class="ps-4 fw-semibold">{{$count++}}</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="bg-primary bg-opacity-10 rounded-circle p-2 me-3">
                                                <i class="bi bi-signpost text-primary"></i>
                                            </div>
                                            <div>
                                                <span class="fw-semibold">{{$d->route_code}}</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="text-nowrap">
                                            <i class="bi bi-geo-alt text-muted me-1"></i>
                                            {{$d->start_location}}
                                        </div>
                                    </td>
                                    <td>
                                        <div class="text-nowrap">
                                            <i class="bi bi-geo-alt-fill text-muted me-1"></i>
                                            {{$d->end_location}}
                                        </div>
                                    </td>
                                    <td>
                                    <span class="badge bg-info bg-opacity-10 text-info px-3 py-1">
                                        {{$d->distance}} km
                                    </span>
                                    </td>
                                    <td>
                                    <span class="text-muted">
                                        {{$d->estemated_time}} hours
                                    </span>
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
                                            <a href="{{route('route.edit',$d->id)}}"
                                               class="btn btn-sm btn-outline-primary d-flex align-items-center"
                                               title="Edit Route">
                                                <i class="bi bi-pencil-square me-1"></i> Edit
                                            </a>
                                            <form action="{{route('route.destroy',$d->id)}}" method="post"
                                                  onsubmit="return confirmDelete()">
                                                @method('DELETE')
                                                @csrf
                                                <button type="submit"
                                                        class="btn btn-sm btn-outline-danger d-flex align-items-center"
                                                        title="Delete Route">
                                                    <i class="bi bi-trash me-1"></i> Delete
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach

                            @if($data->isEmpty())
                                <tr>
                                    <td colspan="8" class="text-center py-5">
                                        <div class="text-muted">
                                            <i class="bi bi-signpost-split display-5 mb-3"></i>
                                            <h5 class="mb-2">No Routes Found</h5>
                                            <p class="mb-0">Get started by adding your first bus route</p>
                                            <a href="{{route('route.create')}}" class="btn btn-primary mt-3">
                                                <i class="bi bi-plus-lg me-1"></i> Add First Route
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
                                Showing {{$data->firstItem()}} to {{$data->lastItem()}} of {{$data->total()}} routes
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
                    <h5 class="modal-title fw-bold" id="filterModalLabel">Filter Routes</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{route('route.filter')}}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Route Code</label>
                                <input type="text" name="route_code" class="form-control" placeholder="Enter route code">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Start Location</label>
                                <input type="text" name="start_location" class="form-control" placeholder="Enter start location">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">End Location</label>
                                <input type="text" name="end_location" class="form-control" placeholder="Enter end location">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Distance (km)</label>
                                <input type="number" name="distance" class="form-control" placeholder="Enter distance">
                            </div>
                            <div class="col-md-12">
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
        /* Custom Table Styles */
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
        .btn-outline-primary, .btn-outline-danger {
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

        /* Modal Styles */
        .modal-content {
            border-radius: 16px;
            border: none;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
        }

        /* Search Input */
        .input-group-text {
            background-color: #F8FAFC;
            border-color: #E2E8F0;
            color: #64748B;
        }

        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.25rem rgba(255, 107, 53, 0.1);
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
        }
    </style>

    <script>
        // Confirm delete
        function confirmDelete() {
            return confirm('Are you sure you want to delete this route? This action cannot be undone.');
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
    </script>
@endsection
