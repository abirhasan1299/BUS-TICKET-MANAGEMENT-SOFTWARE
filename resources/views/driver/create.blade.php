@extends('layout.master')
@section('title', 'Create Driver')
@section('page-title', 'Create New Driver')
@section('breadcrumb', 'Add Driver')

@section('action-buttons')
    <a href="{{ route('driver.index') }}" class="btn btn-outline-secondary">
        <i class="bi bi-arrow-left me-1"></i> Back to Drivers
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
                            <h5 class="mb-0 fw-bold">Create New Driver</h5>
                            <p class="text-muted mb-0">Add a new driver to the system</p>
                        </div>
                        <div class="badge bg-primary bg-opacity-10 text-primary px-3 py-2">
                            <i class="bi bi-person-plus me-1"></i> New Driver
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <form action="{{ route('driver.store') }}" method="POST" id="driverForm">
                        @csrf

                        <div class="row g-4">
                            <!-- Personal Information Card -->
                            <div class="col-12">
                                <div class="card border-0 bg-light rounded-3 mb-4">
                                    <div class="card-body">
                                        <h6 class="fw-bold mb-3 d-flex align-items-center">
                                            <i class="bi bi-person-badge me-2 text-primary"></i>
                                            Personal Information
                                        </h6>
                                        <div class="row">
                                            <!-- Driver Code -->
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label fw-semibold">Driver Code <span class="text-danger">*</span></label>
                                                    <div class="input-group">
                                                    <span class="input-group-text bg-light">
                                                        <i class="bi bi-tag text-primary"></i>
                                                    </span>
                                                        <input type="text"
                                                               name="driver_code"
                                                               class="form-control bg-light @error('driver_code') is-invalid @enderror"
                                                               id="driver_code"
                                                               value="{{ old('driver_code') }}"
                                                               readonly>
                                                        <button type="button" class="btn btn-outline-secondary" onclick="generateDriverCode()" title="Generate New Code">
                                                            <i class="bi bi-arrow-clockwise"></i>
                                                        </button>
                                                    </div>
                                                    @error('driver_code')
                                                    <div class="invalid-feedback d-block">
                                                        <i class="bi bi-exclamation-circle me-1"></i> {{ $message }}
                                                    </div>
                                                    @enderror
                                                    <div class="form-text text-muted small">
                                                        <i class="bi bi-info-circle me-1"></i> Auto-generated unique driver identifier
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Government ID -->
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label fw-semibold">Government ID <span class="text-danger">*</span></label>
                                                    <div class="input-group">
                                                    <span class="input-group-text bg-light">
                                                        <i class="bi bi-card-checklist text-primary"></i>
                                                    </span>
                                                        <input type="text"
                                                               name="gov_id"
                                                               class="form-control @error('gov_id') is-invalid @enderror"
                                                               placeholder="Enter Government ID"
                                                               value="{{ old('gov_id') }}"
                                                               required>
                                                    </div>
                                                    @error('gov_id')
                                                    <div class="invalid-feedback d-block">
                                                        <i class="bi bi-exclamation-circle me-1"></i> {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <!-- Full Name -->
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label fw-semibold">Full Name <span class="text-danger">*</span></label>
                                                    <div class="input-group">
                                                    <span class="input-group-text bg-light">
                                                        <i class="bi bi-person text-primary"></i>
                                                    </span>
                                                        <input type="text"
                                                               name="name"
                                                               class="form-control @error('name') is-invalid @enderror"
                                                               placeholder="Enter driver's full name"
                                                               value="{{ old('name') }}"
                                                               required>
                                                    </div>
                                                    @error('name')
                                                    <div class="invalid-feedback d-block">
                                                        <i class="bi bi-exclamation-circle me-1"></i> {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <!-- Date of Birth -->
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label fw-semibold">Date of Birth <span class="text-danger">*</span></label>
                                                    <div class="input-group">
                                                    <span class="input-group-text bg-light">
                                                        <i class="bi bi-calendar text-primary"></i>
                                                    </span>
                                                        <input type="date"
                                                               name="dob"
                                                               class="form-control @error('dob') is-invalid @enderror"
                                                               id="dob"
                                                               value="{{ old('dob') }}"
                                                               required>
                                                    </div>
                                                    @error('dob')
                                                    <div class="invalid-feedback d-block">
                                                        <i class="bi bi-exclamation-circle me-1"></i> {{ $message }}
                                                    </div>
                                                    @enderror
                                                    <div class="form-text text-muted small">
                                                        <i class="bi bi-info-circle me-1"></i> Driver must be at least 21 years old
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Contact Information Card -->
                            <div class="col-12">
                                <div class="card border-0 bg-light rounded-3 mb-4">
                                    <div class="card-body">
                                        <h6 class="fw-bold mb-3 d-flex align-items-center">
                                            <i class="bi bi-telephone me-2 text-success"></i>
                                            Contact Information
                                        </h6>
                                        <div class="row">
                                            <!-- Phone Number -->
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label fw-semibold">Phone Number <span class="text-danger">*</span></label>
                                                    <div class="input-group">
                                                    <span class="input-group-text bg-light">
                                                        <i class="bi bi-telephone-fill text-primary"></i>
                                                    </span>
                                                        <input type="text"
                                                               name="phone"
                                                               class="form-control @error('phone') is-invalid @enderror"
                                                               placeholder="Enter phone number"
                                                               value="{{ old('phone') }}"
                                                               required>
                                                    </div>
                                                    @error('phone')
                                                    <div class="invalid-feedback d-block">
                                                        <i class="bi bi-exclamation-circle me-1"></i> {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <!-- Email Address -->
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label fw-semibold">Email Address</label>
                                                    <div class="input-group">
                                                    <span class="input-group-text bg-light">
                                                        <i class="bi bi-envelope text-primary"></i>
                                                    </span>
                                                        <input type="email"
                                                               name="email"
                                                               class="form-control @error('email') is-invalid @enderror"
                                                               placeholder="Enter email address (optional)"
                                                               value="{{ old('email') }}">
                                                    </div>
                                                    @error('email')
                                                    <div class="invalid-feedback d-block">
                                                        <i class="bi bi-exclamation-circle me-1"></i> {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <!-- City -->
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label fw-semibold">City</label>
                                                    <div class="input-group">
                                                    <span class="input-group-text bg-light">
                                                        <i class="bi bi-geo-alt text-primary"></i>
                                                    </span>
                                                        <input type="text"
                                                               name="city"
                                                               class="form-control @error('city') is-invalid @enderror"
                                                               placeholder="Enter city"
                                                               value="{{ old('city') }}">
                                                    </div>
                                                    @error('city')
                                                    <div class="invalid-feedback d-block">
                                                        <i class="bi bi-exclamation-circle me-1"></i> {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <!-- Postal Code -->
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label fw-semibold">Postal Code <span class="text-danger">*</span></label>
                                                    <div class="input-group">
                                                    <span class="input-group-text bg-light">
                                                        <i class="bi bi-mailbox text-primary"></i>
                                                    </span>
                                                        <input type="text"
                                                               name="postal_code"
                                                               class="form-control @error('postal_code') is-invalid @enderror"
                                                               placeholder="Enter postal code"
                                                               value="{{ old('postal_code') }}"
                                                               required>
                                                    </div>
                                                    @error('postal_code')
                                                    <div class="invalid-feedback d-block">
                                                        <i class="bi bi-exclamation-circle me-1"></i> {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <!-- Address -->
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label class="form-label fw-semibold">Full Address</label>
                                                    <div class="input-group">
                                                    <span class="input-group-text bg-light align-items-start">
                                                        <i class="bi bi-house text-primary mt-1"></i>
                                                    </span>
                                                        <textarea name="address"
                                                                  rows="3"
                                                                  class="form-control @error('address') is-invalid @enderror"
                                                                  placeholder="Enter full address">{{ old('address') }}</textarea>
                                                    </div>
                                                    @error('address')
                                                    <div class="invalid-feedback d-block">
                                                        <i class="bi bi-exclamation-circle me-1"></i> {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- License Information Card -->
                            <div class="col-12">
                                <div class="card border-0 bg-light rounded-3 mb-4">
                                    <div class="card-body">
                                        <h6 class="fw-bold mb-3 d-flex align-items-center">
                                            <i class="bi bi-card-checklist me-2 text-warning"></i>
                                            License Information
                                        </h6>
                                        <div class="row">
                                            <!-- License Number -->
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label fw-semibold">License Number <span class="text-danger">*</span></label>
                                                    <div class="input-group">
                                                    <span class="input-group-text bg-light">
                                                        <i class="bi bi-card-heading text-primary"></i>
                                                    </span>
                                                        <input type="text"
                                                               name="license_number"
                                                               class="form-control @error('license_number') is-invalid @enderror"
                                                               placeholder="Enter license number"
                                                               value="{{ old('license_number') }}"
                                                               required>
                                                    </div>
                                                    @error('license_number')
                                                    <div class="invalid-feedback d-block">
                                                        <i class="bi bi-exclamation-circle me-1"></i> {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <!-- License Expiry Date -->
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label fw-semibold">License Expiry Date <span class="text-danger">*</span></label>
                                                    <div class="input-group">
                                                    <span class="input-group-text bg-light">
                                                        <i class="bi bi-calendar-x text-primary"></i>
                                                    </span>
                                                        <input type="date"
                                                               name="license_expiry_date"
                                                               class="form-control @error('license_expiry_date') is-invalid @enderror"
                                                               id="license_expiry_date"
                                                               value="{{ old('license_expiry_date') }}"
                                                               required>
                                                    </div>
                                                    @error('license_expiry_date')
                                                    <div class="invalid-feedback d-block">
                                                        <i class="bi bi-exclamation-circle me-1"></i> {{ $message }}
                                                    </div>
                                                    @enderror
                                                    <div class="form-text text-muted small">
                                                        <i class="bi bi-info-circle me-1"></i> License must be valid for at least 3 months
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Experience Years -->
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label fw-semibold">Driving Experience (Years)</label>
                                                    <div class="input-group">
                                                    <span class="input-group-text bg-light">
                                                        <i class="bi bi-award text-primary"></i>
                                                    </span>
                                                        <input type="number"
                                                               name="experience_years"
                                                               class="form-control @error('experience_years') is-invalid @enderror"
                                                               placeholder="Years of experience"
                                                               value="{{ old('experience_years') }}"
                                                               min="0"
                                                               max="50">
                                                        <span class="input-group-text bg-light">years</span>
                                                    </div>
                                                    @error('experience_years')
                                                    <div class="invalid-feedback d-block">
                                                        <i class="bi bi-exclamation-circle me-1"></i> {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Status Selection Card -->
                            <div class="col-12">
                                <div class="card border-0 bg-light rounded-3">
                                    <div class="card-body">
                                        <h6 class="fw-bold mb-3 d-flex align-items-center">
                                            <i class="bi bi-toggle-on me-2 text-info"></i>
                                            Account Status
                                        </h6>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-check-card">
                                                    <input class="form-check-input" type="radio" name="status" id="activeStatus" value="1" {{ old('status', '1') == '1' ? 'checked' : '' }}>
                                                    <label class="form-check-label w-100" for="activeStatus">
                                                        <div class="card border-0 bg-success bg-opacity-10 p-3 text-center">
                                                            <i class="bi bi-check-circle-fill text-success fs-4 mb-2"></i>
                                                            <div class="fw-semibold">Active</div>
                                                            <small class="text-muted">Driver can be assigned to trips</small>
                                                        </div>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-check-card">
                                                    <input class="form-check-input" type="radio" name="status" id="inactiveStatus" value="0" {{ old('status') == '0' ? 'checked' : '' }}>
                                                    <label class="form-check-label w-100" for="inactiveStatus">
                                                        <div class="card border-0 bg-danger bg-opacity-10 p-3 text-center">
                                                            <i class="bi bi-x-circle-fill text-danger fs-4 mb-2"></i>
                                                            <div class="fw-semibold">Inactive</div>
                                                            <small class="text-muted">Driver cannot be assigned to trips</small>
                                                        </div>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        @error('status')
                                        <div class="invalid-feedback d-block mt-3">
                                            <i class="bi bi-exclamation-circle me-1"></i> {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Driver Summary -->
                            <div class="col-12">
                                <div class="card border-0 bg-primary bg-opacity-5 rounded-3 mt-4">
                                    <div class="card-body">
                                        <h6 class="fw-bold mb-3 text-primary">Driver Summary</h6>
                                        <div class="row">
                                            <div class="col-md-3 mb-3">
                                                <label class="form-label text-muted small">Driver Code</label>
                                                <div class="fw-semibold" id="driverCodePreview">—</div>
                                            </div>
                                            <div class="col-md-3 mb-3">
                                                <label class="form-label text-muted small">Full Name</label>
                                                <div class="fw-semibold" id="namePreview">—</div>
                                            </div>
                                            <div class="col-md-3 mb-3">
                                                <label class="form-label text-muted small">License Expires</label>
                                                <div class="fw-semibold" id="licenseExpiryPreview">—</div>
                                            </div>
                                            <div class="col-md-3 mb-3">
                                                <label class="form-label text-muted small">Account Status</label>
                                                <div class="fw-semibold">
                                                <span id="statusPreview" class="badge bg-success bg-opacity-10 text-success">
                                                    Active
                                                </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Form Actions -->
                        <div class="row mt-5">
                            <div class="col-12">
                                <div class="d-flex justify-content-between align-items-center pt-4 border-top">
                                    <div>
                                        <a href="{{ route('driver.index') }}" class="btn btn-outline-secondary px-4">
                                            <i class="bi bi-x-circle me-1"></i> Cancel
                                        </a>
                                    </div>
                                    <div class="d-flex gap-3">
                                        <button type="reset" class="btn btn-outline-warning px-4">
                                            <i class="bi bi-arrow-clockwise me-1"></i> Clear Form
                                        </button>
                                        <button type="submit" class="btn btn-primary px-4">
                                            <i class="bi bi-plus-circle me-1"></i> Create Driver
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
                                <h6 class="mb-1">Adding a New Driver</h6>
                                <p class="mb-0 small">Fill in all required fields to add a new driver to the system. The driver code is automatically generated. Ensure all license information is accurate and up-to-date.</p>
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

        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.25rem rgba(255, 107, 53, 0.1);
        }

        .form-control.bg-light {
            background-color: #f8fafc !important;
            color: #64748b;
            cursor: not-allowed;
        }

        textarea.form-control {
            resize: vertical;
            min-height: 100px;
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

        /* Badge Styles */
        .badge {
            font-weight: 500;
            padding: 0.35em 0.65em;
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

            .col-md-6, .col-md-3 {
                margin-bottom: 1rem;
            }

            .form-check-card {
                margin-bottom: 1rem;
            }
        }
        .dashboard-card{
            padding: 20px;
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize tooltips
            const tooltips = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            tooltips.map(function(tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });

            // Generate driver code function
            window.generateDriverCode = function() {
                // Generate a random number with 6 digits
                let number = Math.floor(100000 + Math.random() * 900000);
                document.getElementById('driver_code').value = "DRV" + number;
                updateDriverPreview();
            }

            // Update driver preview function
            function updateDriverPreview() {
                const driverCode = document.getElementById('driver_code').value;
                const name = document.querySelector('input[name="name"]').value;
                const licenseExpiry = document.querySelector('input[name="license_expiry_date"]').value;
                const activeStatus = document.getElementById('activeStatus');

                // Update preview elements
                document.getElementById('driverCodePreview').textContent = driverCode || '—';
                document.getElementById('namePreview').textContent = name || '—';

                // Format license expiry date
                if (licenseExpiry) {
                    const expiryDate = new Date(licenseExpiry);
                    const formattedDate = expiryDate.toLocaleDateString('en-US', {
                        year: 'numeric',
                        month: 'short',
                        day: 'numeric'
                    });
                    document.getElementById('licenseExpiryPreview').textContent = formattedDate;
                } else {
                    document.getElementById('licenseExpiryPreview').textContent = '—';
                }

                // Update status preview
                const statusPreview = document.getElementById('statusPreview');
                if (activeStatus.checked) {
                    statusPreview.textContent = 'Active';
                    statusPreview.className = 'badge bg-success bg-opacity-10 text-success';
                } else {
                    statusPreview.textContent = 'Inactive';
                    statusPreview.className = 'badge bg-danger bg-opacity-10 text-danger';
                }
            }

            // Event listeners for live updates
            document.getElementById('driver_code')?.addEventListener('input', updateDriverPreview);
            document.querySelector('input[name="name"]')?.addEventListener('input', updateDriverPreview);
            document.querySelector('input[name="license_expiry_date"]')?.addEventListener('change', updateDriverPreview);
            document.querySelectorAll('input[name="status"]').forEach(radio => {
                radio.addEventListener('change', updateDriverPreview);
            });

            // Form validation styling
            const inputs = document.querySelectorAll('.form-control[required]');
            inputs.forEach(input => {
                input.addEventListener('blur', function() {
                    if (this.value.trim() === '') {
                        this.classList.add('is-invalid');
                    } else {
                        this.classList.remove('is-invalid');
                    }
                });
            });

            // Age validation for date of birth
            const dobInput = document.getElementById('dob');
            if (dobInput) {
                dobInput.addEventListener('change', function() {
                    const birthDate = new Date(this.value);
                    const today = new Date();
                    const age = today.getFullYear() - birthDate.getFullYear();

                    if (age < 21) {
                        this.classList.add('is-invalid');
                        const errorElement = this.parentElement.querySelector('.invalid-feedback') || document.createElement('div');
                        errorElement.className = 'invalid-feedback d-block';
                        errorElement.innerHTML = '<i class="bi bi-exclamation-circle me-1"></i> Driver must be at least 21 years old';
                        if (!this.parentElement.querySelector('.invalid-feedback')) {
                            this.parentElement.appendChild(errorElement);
                        }
                    } else {
                        this.classList.remove('is-invalid');
                        const errorElement = this.parentElement.querySelector('.invalid-feedback');
                        if (errorElement && errorElement.textContent.includes('21 years')) {
                            errorElement.remove();
                        }
                    }
                });
            }

            // License expiry validation (must be future date)
            const licenseExpiryInput = document.getElementById('license_expiry_date');
            if (licenseExpiryInput) {
                licenseExpiryInput.addEventListener('change', function() {
                    const expiryDate = new Date(this.value);
                    const today = new Date();

                    if (expiryDate <= today) {
                        this.classList.add('is-invalid');
                        const errorElement = this.parentElement.querySelector('.invalid-feedback') || document.createElement('div');
                        errorElement.className = 'invalid-feedback d-block';
                        errorElement.innerHTML = '<i class="bi bi-exclamation-circle me-1"></i> License expiry must be a future date';
                        if (!this.parentElement.querySelector('.invalid-feedback')) {
                            this.parentElement.appendChild(errorElement);
                        }
                    } else {
                        this.classList.remove('is-invalid');
                        const errorElement = this.parentElement.querySelector('.invalid-feedback');
                        if (errorElement && errorElement.textContent.includes('future date')) {
                            errorElement.remove();
                        }
                    }
                });
            }

            // Form submission feedback
            const form = document.getElementById('driverForm');
            if (form) {
                form.addEventListener('submit', function(e) {
                    const submitButton = this.querySelector('button[type="submit"]');
                    if (submitButton) {
                        submitButton.innerHTML = '<i class="bi bi-hourglass-split me-1"></i> Creating...';
                        submitButton.disabled = true;
                    }
                });
            }

            // Form reset handler
            const resetButton = document.querySelector('button[type="reset"]');
            if (resetButton) {
                resetButton.addEventListener('click', function() {
                    // Remove all validation classes
                    inputs.forEach(input => {
                        input.classList.remove('is-invalid');
                    });

                    // Regenerate driver code
                    generateDriverCode();

                    // Reset preview
                    setTimeout(updateDriverPreview, 100);
                });
            }

            // Initialize on page load
            generateDriverCode();
            updateDriverPreview();
        });
    </script>
@endsection
