@extends('layout.master')
@section('title', 'Driver Details')
@section('page-title', 'Driver Details')
@section('breadcrumb', 'Driver Profile')

@section('action-buttons')
    <div>
        <a href="{{ route('driver.edit', $driver->id) }}" class="btn btn-primary me-2">
            <i class="bi bi-pencil-square me-1"></i> Edit Driver
        </a>
        <a href="{{ route('driver.index') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left me-1"></i> Back to List
        </a>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="dashboard-card">
                <!-- Driver Profile Header -->
                <div class="card-header border-0 bg-transparent p-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="mb-0 fw-bold">Driver Profile</h5>
                            <p class="text-muted mb-0">Complete driver information and details</p>
                        </div>
                        <div class="badge bg-{{ $driver->status ? 'success' : 'danger' }} bg-opacity-10 text-{{ $driver->status ? 'success' : 'danger' }} px-3 py-2">
                            <i class="bi bi-{{ $driver->status ? 'check-circle' : 'x-circle' }} me-1"></i>
                            {{ $driver->status ? 'Active' : 'Inactive' }}
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <div class="row">
                        <!-- Left Column - Basic Information -->
                        <div class="col-lg-8">
                            <div class="row g-4">
                                <!-- Personal Information Card -->
                                <div class="col-12">
                                    <div class="card border-0 bg-light rounded-3">
                                        <div class="card-body">
                                            <h6 class="fw-bold mb-3 d-flex align-items-center">
                                                <i class="bi bi-person-badge me-2 text-primary"></i>
                                                Personal Information
                                            </h6>
                                            <div class="row">
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label text-muted small">Driver Code</label>
                                                    <div class="fw-semibold">{{ $driver->driver_code }}</div>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label text-muted small">Govt. ID</label>
                                                    <div>{{ $driver->gov_id ?? '—' }}</div>
                                                </div>
                                                <div class="col-md-12 mb-3">
                                                    <label class="form-label text-muted small">Full Name</label>
                                                    <div class="fw-bold h5">{{ $driver->name }}</div>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label text-muted small">Date of Birth</label>
                                                    <div class="d-flex align-items-center">
                                                        <span>{{\Carbon\Carbon::parse($driver->dob)->format('d M, Y')}}</span>
                                                        <span class="badge bg-primary bg-opacity-10 text-primary ms-2">
                                                        {{\Carbon\Carbon::parse($driver->dob)->age}} years
                                                    </span>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label text-muted small">Contact</label>
                                                    <div class="d-flex align-items-center">
                                                        <i class="bi bi-telephone text-muted me-2"></i>
                                                        {{ $driver->phone }}
                                                    </div>
                                                    @if($driver->email)
                                                        <div class="d-flex align-items-center mt-1">
                                                            <i class="bi bi-envelope text-muted me-2"></i>
                                                            {{ $driver->email }}
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- License Information Card -->
                                <div class="col-12">
                                    <div class="card border-0 bg-light rounded-3">
                                        <div class="card-body">
                                            <h6 class="fw-bold mb-3 d-flex align-items-center">
                                                <i class="bi bi-card-checklist me-2 text-warning"></i>
                                                License Information
                                            </h6>
                                            <div class="row">
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label text-muted small">License Number</label>
                                                    <div class="fw-semibold">{{ $driver->license_number }}</div>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label text-muted small">License Expiry</label>
                                                    <div class="d-flex align-items-center">
                                                        <div>
                                                            <div>{{\Carbon\Carbon::parse($driver->license_expiry_date)->format('d M, Y')}}</div>
                                                            <div class="small text-muted">
                                                                @php
                                                                    $days = \Carbon\Carbon::today()->diffInDays(\Carbon\Carbon::parse($driver->license_expiry_date), false);
                                                                @endphp
                                                                @if($days > 0)
                                                                    <span class="text-success">
                                                                    <i class="bi bi-check-circle me-1"></i> Valid for {{ $days }} days
                                                                </span>
                                                                @elseif($days === 0)
                                                                    <span class="text-warning">
                                                                    <i class="bi bi-exclamation-circle me-1"></i> Expires today
                                                                </span>
                                                                @else
                                                                    <span class="text-danger">
                                                                    <i class="bi bi-x-circle me-1"></i> Expired {{ abs($days) }} days ago
                                                                </span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        @if($days > 0)
                                                            <div class="ms-3">
                                                                <div class="progress" style="width: 100px; height: 6px;">
                                                                    @php
                                                                        $totalDays = \Carbon\Carbon::parse($driver->license_expiry_date)->diffInDays(\Carbon\Carbon::parse($driver->created_at));
                                                                        $progressPercent = min(100, ($days / max(1, $totalDays)) * 100);
                                                                    @endphp
                                                                    <div class="progress-bar bg-success" style="width: {{ $progressPercent }}%"></div>
                                                                </div>
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                                @if($driver->experience_years)
                                                    <div class="col-md-12">
                                                        <label class="form-label text-muted small">Driving Experience</label>
                                                        <div class="d-flex align-items-center">
                                                    <span class="badge bg-info bg-opacity-10 text-info px-3 py-2">
                                                        <i class="bi bi-award me-1"></i>
                                                        {{ $driver->experience_years }} years experience
                                                    </span>
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Address Information Card -->
                                <div class="col-12">
                                    <div class="card border-0 bg-light rounded-3">
                                        <div class="card-body">
                                            <h6 class="fw-bold mb-3 d-flex align-items-center">
                                                <i class="bi bi-geo-alt me-2 text-success"></i>
                                                Address Information
                                            </h6>
                                            <div class="row">
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label text-muted small">City</label>
                                                    <div class="d-flex align-items-center">
                                                        <i class="bi bi-buildings text-muted me-2"></i>
                                                        {{ $driver->city ?? '—' }}
                                                    </div>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label text-muted small">Postal Code</label>
                                                    <div>{{ $driver->postal_code ?? '—' }}</div>
                                                </div>
                                                @if($driver->address)
                                                    <div class="col-12">
                                                        <label class="form-label text-muted small">Full Address</label>
                                                        <div class="bg-white p-3 rounded-2 border">
                                                            <i class="bi bi-house text-muted me-2"></i>
                                                            {{ $driver->address }}
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Right Column - Driver Summary & Actions -->
                        <div class="col-lg-4">
                            <!-- Driver Summary Card -->
                            <div class="card border-0 bg-primary bg-opacity-5 rounded-3 mb-4">
                                <div class="card-body">
                                    <h6 class="fw-bold mb-3 text-primary">Driver Summary</h6>

                                    <div class="d-flex align-items-center mb-3">
                                        <div class="avatar-lg bg-primary bg-opacity-10 rounded-circle p-3 me-3">
                                            <i class="bi bi-person-badge text-primary fs-4"></i>
                                        </div>
                                        <div>
                                            <div class="fw-bold">{{ $driver->name }}</div>
                                            <div class="text-muted small">Driver ID: {{ $driver->driver_code }}</div>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label text-muted small mb-1">Account Created</label>
                                        <div class="d-flex align-items-center">
                                            <i class="bi bi-calendar-plus text-muted me-2"></i>
                                            {{ $driver->created_at->format('d M, Y') }}
                                            <span class="badge bg-secondary bg-opacity-10 text-secondary ms-2">
                                            {{ $driver->created_at->diffForHumans() }}
                                        </span>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label text-muted small mb-1">Last Updated</label>
                                        <div class="d-flex align-items-center">
                                            <i class="bi bi-calendar-check text-muted me-2"></i>
                                            {{ $driver->updated_at->format('d M, Y') }}
                                        </div>
                                    </div>

                                    <!-- Status Indicator -->
                                    <div class="mb-4">
                                        <label class="form-label text-muted small mb-1">Account Status</label>
                                        <div class="d-flex align-items-center">
                                            @if($driver->status)
                                                <div class="d-flex align-items-center text-success">
                                                    <div class="status-indicator bg-success me-2"></div>
                                                    <span>Active</span>
                                                </div>
                                            @else
                                                <div class="d-flex align-items-center text-danger">
                                                    <div class="status-indicator bg-danger me-2"></div>
                                                    <span>Inactive</span>
                                                </div>
                                            @endif
                                        </div>
                                    </div>

                                    <!-- Quick Stats -->
                                    <div class="border-top pt-3">
                                        <h6 class="fw-bold mb-3 text-primary">Quick Stats</h6>
                                        <div class="row g-2">
                                            <div class="col-6">
                                                <div class="text-center p-2 bg-white rounded-2">
                                                    <div class="fw-bold text-primary">—</div>
                                                    <div class="text-muted small">Trips</div>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="text-center p-2 bg-white rounded-2">
                                                    <div class="fw-bold text-primary">—</div>
                                                    <div class="text-muted small">Rating</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Action Buttons Card -->
                            <div class="card border-0 bg-light rounded-3">
                                <div class="card-body">
                                    <h6 class="fw-bold mb-3">Actions</h6>
                                    <div class="d-grid gap-2">
                                        <a href="{{ route('driver.edit', $driver->id) }}"
                                           class="btn btn-primary d-flex align-items-center justify-content-center">
                                            <i class="bi bi-pencil-square me-2"></i> Edit Profile
                                        </a>

                                        <button type="button" class="btn btn-outline-success d-flex align-items-center justify-content-center">
                                            <i class="bi bi-calendar-plus me-2"></i> Assign Bus
                                        </button>

                                        <button type="button" class="btn btn-outline-warning d-flex align-items-center justify-content-center">
                                            <i class="bi bi-clock-history me-2"></i> View Schedule
                                        </button>

                                        <form action="{{ route('driver.destroy', $driver->id) }}" method="POST"
                                              class="d-inline w-100">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="btn btn-outline-danger d-flex align-items-center justify-content-center w-100"
                                                    onclick="return confirm('Are you sure you want to delete this driver? This action cannot be undone.')">
                                                <i class="bi bi-trash me-2"></i> Delete Driver
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <!-- Contact Card -->
                            <div class="card border-0 bg-light rounded-3 mt-4">
                                <div class="card-body">
                                    <h6 class="fw-bold mb-3 d-flex align-items-center">
                                        <i class="bi bi-telephone-outbound me-2 text-info"></i>
                                        Contact Driver
                                    </h6>
                                    <div class="d-grid gap-2">
                                        <a href="tel:{{ $driver->phone }}"
                                           class="btn btn-outline-primary d-flex align-items-center justify-content-center">
                                            <i class="bi bi-telephone me-2"></i> Call Now
                                        </a>
                                        @if($driver->email)
                                            <a href="mailto:{{ $driver->email }}"
                                               class="btn btn-outline-info d-flex align-items-center justify-content-center">
                                                <i class="bi bi-envelope me-2"></i> Send Email
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Footer with Timestamps -->
                <div class="card-footer border-0 bg-transparent p-4">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="text-muted small">
                                <i class="bi bi-info-circle me-1"></i>
                                Record ID: DRV-{{ $driver->id }} | Created: {{ $driver->created_at->format('d M, Y h:i A') }}
                            </div>
                        </div>
                        <div class="col-md-6 text-end">
                            <div class="text-muted small">
                                <i class="bi bi-clock-history me-1"></i>
                                Last updated: {{ $driver->updated_at->format('d M, Y h:i A') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        /* Custom Styles for Driver Details */
        .avatar-lg {
            width: 60px;
            height: 60px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .status-indicator {
            width: 8px;
            height: 8px;
            border-radius: 50%;
        }

        .card.bg-light {
            background-color: #f8f9fa !important;
        }

        .progress {
            background-color: rgba(0, 0, 0, 0.05);
        }

        /* Action Button Styles */
        .btn {
            transition: all 0.2s ease;
        }

        .btn:hover {
            transform: translateY(-2px);
        }

        /* Responsive Adjustments */
        @media (max-width: 768px) {
            .card-body .row {
                margin-bottom: -1rem;
            }

            .col-lg-4 {
                margin-top: 1.5rem;
            }

            .avatar-lg {
                width: 50px;
                height: 50px;
            }
        }

        /* Border Radius */
        .rounded-3 {
            border-radius: 12px !important;
        }

        /* Text Colors */
        .text-success { color: #2EC4B6 !important; }
        .text-warning { color: #FFBF69 !important; }
        .text-danger { color: #E71D36 !important; }
        .text-primary { color: #FF6B35 !important; }

        /* Badge Colors */
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

        .badge.bg-primary {
            background-color: rgba(255, 107, 53, 0.1) !important;
            color: #FF6B35 !important;
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize tooltips
            const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });

            // Add confirmation for delete button
            const deleteForm = document.querySelector('form[action*="destroy"]');
            if (deleteForm) {
                deleteForm.addEventListener('submit', function(e) {
                    if (!confirm('Are you sure you want to delete this driver? This action cannot be undone.')) {
                        e.preventDefault();
                    }
                });
            }

            // Add copy to clipboard for driver code
            const driverCode = document.querySelector('.fw-semibold');
            if (driverCode && driverCode.textContent.includes('DRV-')) {
                driverCode.style.cursor = 'pointer';
                driverCode.title = 'Click to copy Driver ID';
                driverCode.addEventListener('click', function() {
                    const text = this.textContent.trim();
                    navigator.clipboard.writeText(text).then(() => {
                        const originalText = this.textContent;
                        this.textContent = 'Copied!';
                        this.classList.add('text-success');

                        setTimeout(() => {
                            this.textContent = originalText;
                            this.classList.remove('text-success');
                        }, 2000);
                    });
                });
            }
        });
    </script>
@endsection
