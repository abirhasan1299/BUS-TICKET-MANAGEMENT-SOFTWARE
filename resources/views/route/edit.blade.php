@extends('layout.master')
@section('title', 'Edit Route')
@section('page-title', 'Edit Route')
@section('breadcrumb', 'Update Route Details')

@section('action-buttons')
    <a href="{{ route('route.index') }}" class="btn btn-outline-secondary">
        <i class="bi bi-arrow-left me-1"></i> Back to Routes
    </a>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="dashboard-card">
                <!-- Form Header -->
                <div class="card-header border-0 bg-transparent p-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="mb-0 fw-bold">Update Route Information</h5>
                            <p class="text-muted mb-0">Modify the route details as needed</p>
                        </div>
                        <div class="badge bg-primary bg-opacity-10 text-primary px-3 py-2">
                            <i class="bi bi-sign-turn-right me-1"></i> Route ID: {{ $data->route_code }}
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <form method="post" action="{{ route('route.update', $data->id) }}" autocomplete="off">
                        @csrf
                        @method('PUT')

                        <div class="row g-4">
                            <!-- Route Code (Read-only) -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label fw-semibold">Route Code</label>
                                    <div class="input-group">
                                    <span class="input-group-text bg-light">
                                        <i class="bi bi-tag text-primary"></i>
                                    </span>
                                        <input type="text" class="form-control bg-light" name="route_code" readonly value="{{ $data->route_code }}">
                                    </div>
                                    <div class="form-text text-muted small">
                                        <i class="bi bi-info-circle me-1"></i> Route code cannot be modified
                                    </div>
                                </div>
                            </div>

                            <!-- Start Location -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label fw-semibold">Start Location</label>
                                    <div class="input-group">
                                    <span class="input-group-text bg-light">
                                        <i class="bi bi-geo-alt text-primary"></i>
                                    </span>
                                        <input type="text" class="form-control @error('start_location') is-invalid @enderror"
                                               name="start_location"
                                               placeholder="e.g., Dhaka Terminal"
                                               value="{{ old('start_location', $data->start_location) }}">
                                    </div>
                                    @error('start_location')
                                    <div class="invalid-feedback d-block">
                                        <i class="bi bi-exclamation-circle me-1"></i> {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>

                            <!-- End Location -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label fw-semibold">End Location</label>
                                    <div class="input-group">
                                    <span class="input-group-text bg-light">
                                        <i class="bi bi-geo-alt-fill text-primary"></i>
                                    </span>
                                        <input type="text" class="form-control @error('end_location') is-invalid @enderror"
                                               name="end_location"
                                               placeholder="e.g., Chittagong Terminal"
                                               value="{{ old('end_location', $data->end_location) }}">
                                    </div>
                                    @error('end_location')
                                    <div class="invalid-feedback d-block">
                                        <i class="bi bi-exclamation-circle me-1"></i> {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Distance -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label fw-semibold">Distance (in kilometers)</label>
                                    <div class="input-group">
                                    <span class="input-group-text bg-light">
                                        <i class="bi bi-arrow-left-right text-primary"></i>
                                    </span>
                                        <input type="number" class="form-control @error('distance') is-invalid @enderror"
                                               name="distance"
                                               placeholder="e.g., 250"
                                               min="0"
                                               step="0.1"
                                               value="{{ old('distance', $data->distance) }}">
                                        <span class="input-group-text bg-light">km</span>
                                    </div>
                                    @error('distance')
                                    <div class="invalid-feedback d-block">
                                        <i class="bi bi-exclamation-circle me-1"></i> {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Estimated Time -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label fw-semibold">Estimated Travel Time</label>
                                    <div class="input-group">
                                    <span class="input-group-text bg-light">
                                        <i class="bi bi-clock text-primary"></i>
                                    </span>
                                        <input type="text" class="form-control @error('estemated_time') is-invalid @enderror"
                                               name="estemated_time"
                                               placeholder="e.g., 06:30 hrs"
                                               value="{{ old('estemated_time', $data->estemated_time) }}">
                                    </div>
                                    @error('estemated_time')
                                    <div class="invalid-feedback d-block">
                                        <i class="bi bi-exclamation-circle me-1"></i> {{ $message }}
                                    </div>
                                    @enderror
                                    <div class="form-text text-muted small">
                                        <i class="bi bi-info-circle me-1"></i> Format: HH:MM hrs (e.g., 05:30 hrs)
                                    </div>
                                </div>
                            </div>

                            <!-- Status -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label fw-semibold">Route Status</label>
                                    <div class="row g-3">
                                        <div class="col-6">
                                            <div class="form-check-card">
                                                <input class="form-check-input" type="radio" name="status" id="activeStatus" value="1" {{ $data->status == 1 ? 'checked' : '' }}>
                                                <label class="form-check-label w-100" for="activeStatus">
                                                    <div class="card border-0 bg-success bg-opacity-10 p-3 text-center">
                                                        <i class="bi bi-check-circle-fill text-success fs-4 mb-2"></i>
                                                        <div class="fw-semibold">Active</div>
                                                        <small class="text-muted">Route is operational</small>
                                                    </div>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-check-card">
                                                <input class="form-check-input" type="radio" name="status" id="inactiveStatus" value="0" {{ $data->status == 0 ? 'checked' : '' }}>
                                                <label class="form-check-label w-100" for="inactiveStatus">
                                                    <div class="card border-0 bg-danger bg-opacity-10 p-3 text-center">
                                                        <i class="bi bi-x-circle-fill text-danger fs-4 mb-2"></i>
                                                        <div class="fw-semibold">Inactive</div>
                                                        <small class="text-muted">Route is suspended</small>
                                                    </div>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    @error('status')
                                    <div class="invalid-feedback d-block mt-2">
                                        <i class="bi bi-exclamation-circle me-1"></i> {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Form Actions -->
                        <div class="row mt-5">
                            <div class="col-12">
                                <div class="d-flex justify-content-between align-items-center pt-4 border-top">
                                    <div>
                                        <a href="{{ route('route.index') }}" class="btn btn-outline-secondary px-4">
                                            <i class="bi bi-x-circle me-1"></i> Cancel
                                        </a>
                                    </div>
                                    <div class="d-flex gap-3">
                                        <button type="reset" class="btn btn-outline-warning px-4">
                                            <i class="bi bi-arrow-clockwise me-1"></i> Reset
                                        </button>
                                        <button type="submit" class="btn btn-primary px-4">
                                            <i class="bi bi-check-circle me-1"></i> Update Route
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

                <!-- Form Footer -->
                <div class="card-footer border-0 bg-transparent p-4">
                    <div class="alert alert-info border-0 mb-0">
                        <div class="d-flex align-items-center">
                            <i class="bi bi-info-circle-fill me-3 fs-5 text-info"></i>
                            <div>
                                <h6 class="mb-1">Update Information</h6>
                                <p class="mb-0 small">Make changes to the route details as needed. All fields except Route Code can be modified. Changes will be reflected immediately in the system.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        /* Custom Styles */
        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-label {
            font-weight: 600;
            margin-bottom: 0.5rem;
            color: #1e293b;
        }

        .form-check-input {
            position: absolute;
            opacity: 0;
        }

        .form-check-card {
            position: relative;
        }

        .form-check-card .form-check-input:checked + label .card {
            border: 2px solid var(--primary-color) !important;
            background-color: rgba(255, 107, 53, 0.15) !important;
        }

        .form-check-card label {
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .form-check-card label:hover .card {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .form-check-card .card {
            transition: all 0.2s ease;
            border: 2px solid transparent;
        }

        .input-group-text {
            background-color: #f8fafc;
            border-color: #e2e8f0;
            color: #64748b;
        }

        .form-control:focus, .form-select:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.25rem rgba(255, 107, 53, 0.1);
        }

        .form-control.bg-light {
            background-color: #f8fafc !important;
            color: #64748b;
            cursor: not-allowed;
        }

        .invalid-feedback {
            font-size: 0.875rem;
            margin-top: 0.25rem;
        }

        .form-text {
            font-size: 0.875rem;
            margin-top: 0.25rem;
        }

        /* Button Styles */
        .btn-primary {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            border: none;
            padding: 0.625rem 1.75rem;
            border-radius: 10px;
            font-weight: 600;
            transition: all 0.2s ease;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(255, 107, 53, 0.3);
        }

        .btn-outline-secondary, .btn-outline-warning {
            border-width: 1px;
            transition: all 0.2s ease;
        }

        .btn-outline-secondary:hover {
            background-color: rgba(100, 116, 139, 0.1);
            transform: translateY(-2px);
        }

        .btn-outline-warning:hover {
            background-color: rgba(255, 191, 105, 0.1);
            transform: translateY(-2px);
        }

        /* Alert Styles */
        .alert-info {
            background-color: rgba(76, 201, 240, 0.1);
            border-color: rgba(76, 201, 240, 0.2);
            color: #0c5460;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .card-body {
                padding: 1.5rem !important;
            }

            .d-flex.justify-content-between {
                flex-direction: column;
                gap: 1rem;
            }

            .d-flex.gap-3 {
                width: 100%;
                justify-content: space-between;
            }

            .btn {
                width: 100%;
                margin-bottom: 0.5rem;
            }

            .col-6 {
                margin-bottom: 1rem;
            }
        }
        .dashboard-card{
            padding: 30px;
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize tooltips
            const tooltips = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            tooltips.map(function(tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });

            // Add validation styling
            const inputs = document.querySelectorAll('.form-control');
            inputs.forEach(input => {
                input.addEventListener('blur', function() {
                    if (this.value.trim() === '') {
                        this.classList.add('is-invalid');
                    } else {
                        this.classList.remove('is-invalid');
                    }
                });
            });

            // Form reset handler
            const resetButton = document.querySelector('button[type="reset"]');
            if (resetButton) {
                resetButton.addEventListener('click', function() {
                    // Remove all validation classes
                    inputs.forEach(input => {
                        input.classList.remove('is-invalid');
                    });

                    // Reset radio buttons to original state
                    const originalStatus = "{{ $data->status }}";
                    document.querySelectorAll('input[name="status"]').forEach(radio => {
                        radio.checked = radio.value === originalStatus;
                    });
                });
            }

            // Form submission feedback
            const form = document.querySelector('form');
            if (form) {
                form.addEventListener('submit', function(e) {
                    const submitButton = this.querySelector('button[type="submit"]');
                    if (submitButton) {
                        submitButton.innerHTML = '<i class="bi bi-hourglass-split me-1"></i> Updating...';
                        submitButton.disabled = true;
                    }
                });
            }
        });
    </script>
@endsection
