@extends('layout.master')
@section('title', 'Ticket Slot Details')
@section('page-title', 'Ticket Slot Details')
@section('breadcrumb', 'Slot Information')

@section('action-buttons')
    <div>
        <a href="{{ route('slot.edit', $data->id) }}" class="btn btn-primary me-2">
            <i class="bi bi-pencil-square me-1"></i> Edit Slot
        </a>
        <a href="{{ route('slot.index') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left me-1"></i> Back to Slots
        </a>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="dashboard-card">
                <!-- Slot Header -->
                <div class="card-header border-0 bg-transparent p-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="mb-0 fw-bold">Ticket Slot Details</h5>
                            <p class="text-muted mb-0">Complete information about this ticket slot</p>
                        </div>
                        <div class="d-flex align-items-center gap-3">
                            <div class="badge bg-primary bg-opacity-10 text-primary px-3 py-2">
                                <i class="bi bi-ticket-perforated me-1"></i> SLOT#{{ $data->slot_code }}
                            </div>
                            @if($data->status == '1')
                                <span class="badge bg-success bg-opacity-10 text-success px-3 py-2">
                            <i class="bi bi-check-circle me-1"></i> Active
                        </span>
                            @else
                                <span class="badge bg-danger bg-opacity-10 text-danger px-3 py-2">
                            <i class="bi bi-x-circle me-1"></i> Inactive
                        </span>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <div class="row g-4">
                        <!-- Left Column - Journey Details -->
                        <div class="col-lg-8">
                            <div class="row g-4">
                                <!-- Route Information Card -->
                                <div class="col-12">
                                    <div class="card border-0 bg-light rounded-3">
                                        <div class="card-body">
                                            <h6 class="fw-bold mb-3 d-flex align-items-center">
                                                <i class="bi bi-sign-turn-right me-2 text-primary"></i>
                                                Route Information
                                            </h6>
                                            <div class="row align-items-center">
                                                <div class="col-md-4 text-center mb-3">
                                                    <div class="bg-primary bg-opacity-10 rounded-3 p-3">
                                                        <i class="bi bi-geo-alt text-primary fs-1"></i>
                                                        <div class="mt-2 fw-semibold">Start</div>
                                                        <div class="text-primary">{{ $data->busRoute->start_location }}</div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4 text-center mb-3">
                                                    <div class="bg-info bg-opacity-10 rounded-3 p-3">
                                                        <i class="bi bi-arrow-right text-info fs-1"></i>
                                                        <div class="mt-2 fw-semibold">Route Code</div>
                                                        <div class="text-info">{{ $data->busRoute->route_code }}</div>
                                                        <div class="text-muted small mt-1">
                                                            {{ $data->busRoute->distance }} km • {{ $data->busRoute->estemated_time }}
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4 text-center mb-3">
                                                    <div class="bg-primary bg-opacity-10 rounded-3 p-3">
                                                        <i class="bi bi-geo-alt-fill text-primary fs-1"></i>
                                                        <div class="mt-2 fw-semibold">Destination</div>
                                                        <div class="text-primary">{{ $data->busRoute->end_location }}</div>
                                                    </div>
                                                </div>
                                                <div class="col-12 text-end">
                                                    <a href="{{ route('route.index') }}" class="btn btn-sm btn-outline-primary">
                                                        <i class="bi bi-eye me-1"></i> View Route Details
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Schedule & Timing Card -->
                                <div class="col-12">
                                    <div class="card border-0 bg-light rounded-3">
                                        <div class="card-body">
                                            <h6 class="fw-bold mb-3 d-flex align-items-center">
                                                <i class="bi bi-clock me-2 text-warning"></i>
                                                Schedule & Timing
                                            </h6>
                                            <div class="row">
                                                <div class="col-md-8 mb-3">
                                                    <label class="form-label text-muted small">Departure Time</label>
                                                    <div class="d-flex align-items-center">
                                                        <div class="bg-warning bg-opacity-10 rounded-circle p-2 me-3">
                                                            <i class="bi bi-calendar-event text-warning"></i>
                                                        </div>
                                                        <div>
                                                            <div class="fw-bold h5">
                                                                {{ \Carbon\Carbon::parse($data->schedule)->format('l, d M Y') }}
                                                            </div>
                                                            <div class="text-muted">
                                                                <i class="bi bi-clock me-1"></i>
                                                                {{ \Carbon\Carbon::parse($data->schedule)->format('h:i A') }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4 mb-3">
                                                    <label class="form-label text-muted small">Time Until Departure</label>
                                                    <div class="text-center">
                                                        @php
                                                            $timeUntil = \Carbon\Carbon::parse($data->schedule)->diffForHumans();
                                                            $isPast = \Carbon\Carbon::parse($data->schedule)->isPast();
                                                        @endphp
                                                        <div class="{{ $isPast ? 'text-danger' : 'text-success' }} fw-bold">
                                                            {{ $timeUntil }}
                                                        </div>
                                                        <div class="text-muted small">
                                                            @if($isPast)
                                                                <i class="bi bi-clock-history me-1"></i> Past Departure
                                                            @else
                                                                <i class="bi bi-clock me-1"></i> Upcoming
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Vehicle & Driver Card -->
                                <div class="col-12">
                                    <div class="card border-0 bg-light rounded-3">
                                        <div class="card-body">
                                            <h6 class="fw-bold mb-3 d-flex align-items-center">
                                                <i class="bi bi-bus-front me-2 text-success"></i>
                                                Vehicle & Driver Details
                                            </h6>
                                            <div class="row">
                                                <!-- Bus Details -->
                                                <div class="col-md-6 mb-4">
                                                    <div class="card border-0 bg-white rounded-3">
                                                        <div class="card-body">
                                                            <div class="d-flex align-items-center mb-3">
                                                                <div class="bg-success bg-opacity-10 rounded-circle p-2 me-3">
                                                                    <i class="bi bi-bus-front text-success"></i>
                                                                </div>
                                                                <div>
                                                                    <div class="fw-semibold">{{ $data->busInfo->bus_name }}</div>
                                                                    <div class="text-muted small">Code: {{ $data->busInfo->bus_code }}</div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-6">
                                                                    <div class="text-center">
                                                                        <div class="fw-bold text-primary">{{ $data->busInfo->seat_capacity }}</div>
                                                                        <div class="text-muted small">Seats</div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-6">
                                                                    <div class="text-center">
                                                                        <div class="fw-bold text-info">{{ $data->busInfo->type }}</div>
                                                                        <div class="text-muted small">Type</div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="text-end mt-3">
                                                                <a href="{{ route('bus.show', $data->busInfo->id) }}" class="btn btn-sm btn-outline-success">
                                                                    <i class="bi bi-eye me-1"></i> View Bus
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Driver Details -->
                                                <div class="col-md-6 mb-4">
                                                    <div class="card border-0 bg-white rounded-3">
                                                        <div class="card-body">
                                                            <div class="d-flex align-items-center mb-3">
                                                                <div class="bg-primary bg-opacity-10 rounded-circle p-2 me-3">
                                                                    <i class="bi bi-person-badge text-primary"></i>
                                                                </div>
                                                                <div>
                                                                    <div class="fw-semibold">{{ $data->driverInfo->name }}</div>
                                                                    <div class="text-muted small">ID: {{ $data->driverInfo->driver_code }}</div>
                                                                </div>
                                                            </div>
                                                            <div class="mb-2">
                                                                <i class="bi bi-telephone text-muted me-2"></i>
                                                                <span>{{ $data->driverInfo->phone }}</span>
                                                            </div>
                                                            @if($data->driverInfo->license_number)
                                                                <div class="mb-2">
                                                                    <i class="bi bi-card-checklist text-muted me-2"></i>
                                                                    <span class="small">{{ $data->driverInfo->license_number }}</span>
                                                                </div>
                                                            @endif
                                                            <div class="text-end mt-3">
                                                                <a href="{{ route('driver.show', $data->driverInfo->id) }}" class="btn btn-sm btn-outline-primary">
                                                                    <i class="bi bi-eye me-1"></i> View Driver
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Right Column - Pricing & Stats -->
                        <div class="col-lg-4">
                            <!-- Pricing Information Card -->
                            <div class="card border-0 bg-primary bg-opacity-5 rounded-3 mb-4">
                                <div class="card-body">
                                    <h6 class="fw-bold mb-3 text-primary">Pricing Information</h6>

                                    <!-- Original Price -->
                                    <div class="mb-3">
                                        <label class="form-label text-muted small">Base Fare</label>
                                        <div class="d-flex align-items-center justify-content-between">
                                            <div>
                                                <div class="fw-bold h4">${{ $data->price }}</div>
                                                <div class="text-muted small">Original price per ticket</div>
                                            </div>
                                            <div class="bg-light rounded-circle p-2">
                                                <i class="bi bi-tag text-primary"></i>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Discount -->
                                    @if($data->discount > 0)
                                        <div class="mb-3">
                                            <label class="form-label text-muted small">Discount Applied</label>
                                            <div class="d-flex align-items-center justify-content-between">
                                                <div>
                                                    <div class="fw-bold h4 text-danger">{{ $data->discount }}%</div>
                                                    <div class="text-muted small">Discount percentage</div>
                                                </div>
                                                <div class="bg-danger bg-opacity-10 rounded-circle p-2">
                                                    <i class="bi bi-percent text-danger"></i>
                                                </div>
                                            </div>
                                        </div>
                                    @endif

                                    <!-- Final Price -->
                                    <div class="border-top pt-3">
                                        <label class="form-label text-muted small">Final Price Per Ticket</label>
                                        <div class="d-flex align-items-center justify-content-between">
                                            <div>
                                                <div class="fw-bold h2 text-success">
                                                    ${{ $data->price - round($data->price * ($data->discount / 100)) }}
                                                </div>
                                                <div class="text-muted small">After discount</div>
                                            </div>
                                            @if($data->discount > 0)
                                                <div class="bg-success bg-opacity-10 rounded-circle p-2">
                                                    <i class="bi bi-currency-dollar text-success fs-4"></i>
                                                </div>
                                            @endif
                                        </div>
                                        @if($data->discount > 0)
                                            <div class="text-center mt-2">
                                        <span class="text-muted small">
                                            <del>${{ $data->price }}</del>
                                            <span class="text-success ms-2">Save ${{ round($data->price * ($data->discount / 100)) }}</span>
                                        </span>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <!-- Sales Statistics Card -->
                            <div class="card border-0 bg-light rounded-3 mb-4">
                                <div class="card-body">
                                    <h6 class="fw-bold mb-3">Sales Statistics</h6>

                                    <!-- Total Sales -->
                                    <div class="mb-4">
                                        <label class="form-label text-muted small">Total Tickets Sold</label>
                                        <div class="d-flex align-items-center justify-content-between">
                                            <div>
                                                <div class="fw-bold h3">1,025</div>
                                                <div class="text-muted small">Tickets booked</div>
                                            </div>
                                            <div class="bg-success bg-opacity-10 rounded-circle p-2">
                                                <i class="bi bi-cart-check text-success"></i>
                                            </div>
                                        </div>
                                        <div class="progress mt-2" style="height: 6px;">
                                            <div class="progress-bar bg-success" style="width: 75%"></div>
                                        </div>
                                    </div>

                                    <!-- Total Revenue -->
                                    <div class="mb-4">
                                        <label class="form-label text-muted small">Total Revenue</label>
                                        <div class="d-flex align-items-center justify-content-between">
                                            <div>
                                                <div class="fw-bold h3">$12,450</div>
                                                <div class="text-muted small">From this slot</div>
                                            </div>
                                            <div class="bg-info bg-opacity-10 rounded-circle p-2">
                                                <i class="bi bi-cash-stack text-info"></i>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Occupancy Rate -->
                                    <div>
                                        <label class="form-label text-muted small">Occupancy Rate</label>
                                        <div class="d-flex align-items-center justify-content-between">
                                            <div>
                                                <div class="fw-bold h3">82%</div>
                                                <div class="text-muted small">Seats occupied</div>
                                            </div>
                                            <div class="bg-warning bg-opacity-10 rounded-circle p-2">
                                                <i class="bi bi-graph-up text-warning"></i>
                                            </div>
                                        </div>
                                        <div class="progress mt-2" style="height: 6px;">
                                            <div class="progress-bar bg-warning" style="width: 82%"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Action Buttons Card -->
                            <div class="card border-0 bg-light rounded-3">
                                <div class="card-body">
                                    <h6 class="fw-bold mb-3">Quick Actions</h6>
                                    <div class="d-grid gap-2">
                                        <a href="{{ route('slot.edit', $data->id) }}"
                                           class="btn btn-primary d-flex align-items-center justify-content-center">
                                            <i class="bi bi-pencil-square me-2"></i> Edit Slot
                                        </a>

                                        <button type="button" class="btn btn-outline-success d-flex align-items-center justify-content-center">
                                            <i class="bi bi-ticket-perforated me-2"></i> Manage Tickets
                                        </button>

                                        <button type="button" class="btn btn-outline-warning d-flex align-items-center justify-content-center">
                                            <i class="bi bi-bar-chart me-2"></i> View Analytics
                                        </button>

                                        <button type="button" class="btn btn-outline-info d-flex align-items-center justify-content-center">
                                            <i class="bi bi-printer me-2"></i> Generate Report
                                        </button>
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
                                Slot ID: SLOT-{{ $data->id }} | Created: {{ $data->created_at->format('d M, Y h:i A') }}
                            </div>
                        </div>
                        <div class="col-md-6 text-end">
                            <div class="text-muted small">
                                <i class="bi bi-clock-history me-1"></i>
                                Last updated: {{ $data->updated_at->format('d M, Y h:i A') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        /* Custom Styles for Slot Details */
        .dashboard-card {
            background: white;
            border-radius: 16px;
            border: 1px solid rgba(0, 0, 0, 0.05);
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.03);
            transition: all 0.3s ease;
            overflow: hidden;
        }

        .dashboard-card:hover {
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.08);
            transform: translateY(-2px);
        }

        .card.bg-light {
            background-color: #f8f9fa !important;
        }

        /* Progress Bar */
        .progress {
            background-color: rgba(0, 0, 0, 0.05);
        }

        /* Button Styles */
        .btn {
            transition: all 0.2s ease;
        }

        .btn:hover {
            transform: translateY(-2px);
        }

        /* Badge Styles */
        .badge {
            font-weight: 500;
            padding: 0.35em 0.65em;
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

        /* Price Strikethrough */
        del {
            text-decoration-color: #94a3b8;
            color: #94a3b8;
        }

        /* Responsive Adjustments */
        @media (max-width: 768px) {
            .card-body .row {
                margin-bottom: -1rem;
            }

            .col-lg-4 {
                margin-top: 1.5rem;
            }

            .btn {
                width: 100%;
            }

            .text-end {
                text-align: left !important;
                margin-top: 1rem;
            }

            .col-md-4.text-center {
                margin-bottom: 1rem;
            }
        }

        /* Ensure proper content wrapping */
        .card-body {
            word-wrap: break-word;
            overflow-wrap: break-word;
        }

        /* Journey Visualization */
        .col-md-4.text-center .bg-primary {
            transition: all 0.3s ease;
        }

        .col-md-4.text-center .bg-primary:hover {
            transform: scale(1.05);
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize tooltips
            const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });

            // Add copy to clipboard for slot code
            const slotCode = document.querySelector('.badge.bg-primary.bg-opacity-10');
            if (slotCode) {
                slotCode.style.cursor = 'pointer';
                slotCode.title = 'Click to copy Slot Code';
                slotCode.addEventListener('click', function() {
                    const text = this.textContent.replace('SLOT#', '').trim();
                    navigator.clipboard.writeText(text).then(() => {
                        const originalHTML = this.innerHTML;
                        this.innerHTML = '<i class="bi bi-check me-1"></i> Copied!';
                        this.classList.add('text-success');

                        setTimeout(() => {
                            this.innerHTML = originalHTML;
                            this.classList.remove('text-success');
                        }, 2000);
                    });
                });
            }

            // Add countdown timer for upcoming slots
            const scheduleTime = "{{ \Carbon\Carbon::parse($data->schedule) }}";
            const isPast = {{ \Carbon\Carbon::parse($data->schedule)->isPast() ? 'true' : 'false' }};

            if (!isPast) {
                function updateCountdown() {
                    const now = new Date();
                    const schedule = new Date(scheduleTime);
                    const diff = schedule - now;

                    if (diff > 0) {
                        const days = Math.floor(diff / (1000 * 60 * 60 * 24));
                        const hours = Math.floor((diff % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                        const minutes = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));

                        const countdownElement = document.querySelector('.text-success.fw-bold');
                        if (countdownElement) {
                            if (days > 0) {
                                countdownElement.textContent = `${days}d ${hours}h ${minutes}m`;
                            } else {
                                countdownElement.textContent = `${hours}h ${minutes}m`;
                            }
                        }
                    }
                }

                // Update countdown every minute
                updateCountdown();
                setInterval(updateCountdown, 60000);
            }

            // Highlight past slots
            if (isPast) {
                const scheduleCard = document.querySelector('.card.border-0.bg-light.rounded-3');
                if (scheduleCard) {
                    scheduleCard.style.backgroundColor = 'rgba(231, 29, 54, 0.05)';
                    scheduleCard.style.borderLeft = '4px solid #E71D36';
                }
            }

            // Add confirmation for actions
            const actionButtons = document.querySelectorAll('.btn-outline-danger');
            actionButtons.forEach(button => {
                button.addEventListener('click', function(e) {
                    if (!confirm('Are you sure you want to perform this action?')) {
                        e.preventDefault();
                    }
                });
            });
        });
    </script>
@endsection
