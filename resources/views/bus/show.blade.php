@extends('layout.master')
@section('title', 'Bus Details')
@section('page-title', 'Bus Details')
@section('breadcrumb', 'Bus Information')

@section('action-buttons')
    <div>
        <a href="{{ route('bus.edit', $bus->id) }}" class="btn btn-primary me-2">
            <i class="bi bi-pencil-square me-1"></i> Edit Bus
        </a>
        <a href="{{ route('bus.index') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left me-1"></i> Back to List
        </a>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="dashboard-card">
                <!-- Bus Profile Header -->
                <div class="card-header border-0 bg-transparent p-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="mb-0 fw-bold">{{ $bus->bus_name }}</h5>
                            <p class="text-muted mb-0">Complete bus information and specifications</p>
                        </div>
                        <div class="d-flex align-items-center gap-3">
                            @if($bus->status == 'active')
                                <span class="badge bg-success bg-opacity-10 text-success px-3 py-2">
                            <i class="bi bi-check-circle me-1"></i> Active
                        </span>
                            @elseif($bus->status == 'inactive')
                                <span class="badge bg-danger bg-opacity-10 text-danger px-3 py-2">
                            <i class="bi bi-x-circle me-1"></i> Inactive
                        </span>
                            @else
                                <span class="badge bg-warning bg-opacity-10 text-warning px-3 py-2">
                            <i class="bi bi-exclamation-circle me-1"></i> {{ ucfirst($bus->status) }}
                        </span>
                            @endif
                            <div class="text-muted">
                                <i class="bi bi-bus-front me-1"></i> ID: {{ $bus->bus_code }}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <div class="row g-4">
                        <!-- Left Column - Basic Information -->
                        <div class="col-lg-8">
                            <div class="row g-4">
                                <!-- Basic Information Card -->
                                <div class="col-12">
                                    <div class="card border-0 bg-light rounded-3">
                                        <div class="card-body">
                                            <h6 class="fw-bold mb-3 d-flex align-items-center">
                                                <i class="bi bi-info-circle me-2 text-primary"></i>
                                                Basic Information
                                            </h6>
                                            <div class="row">
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label text-muted small">Bus Code</label>
                                                    <div class="fw-semibold">{{ $bus->bus_code }}</div>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label text-muted small">Registration Number</label>
                                                    <div class="fw-semibold text-primary">{{ $bus->registration_number }}</div>
                                                </div>
                                                <div class="col-md-12 mb-3">
                                                    <label class="form-label text-muted small">Bus Name</label>
                                                    <div class="fw-bold h5">{{ $bus->bus_name }}</div>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label text-muted small">Bus Type</label>
                                                    <div class="d-flex align-items-center">
                                                        @php
                                                            $typeColors = [
                                                                'AC' => 'primary',
                                                                'Non-AC' => 'secondary',
                                                                'Sleeper' => 'warning',
                                                                'Semi-Sleeper' => 'info'
                                                            ];
                                                            $typeColor = $typeColors[$bus->type] ?? 'success';
                                                        @endphp
                                                        <span class="badge bg-{{$typeColor}} bg-opacity-10 text-{{$typeColor}} px-3 py-1">
                                                        <i class="bi bi-{{ $bus->type == 'AC' ? 'snow' : ($bus->type == 'Sleeper' ? 'moon' : 'fan') }} me-1"></i>
                                                        {{ $bus->type }}
                                                    </span>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label text-muted small">Owner Information</label>
                                                    <div class="text-truncate" style="max-width: 200px;">{{ $bus->bus_owner_info ?? 'N/A' }}</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Capacity & Seating Card -->
                                <div class="col-12">
                                    <div class="card border-0 bg-light rounded-3">
                                        <div class="card-body">
                                            <h6 class="fw-bold mb-3 d-flex align-items-center">
                                                <i class="bi bi-people me-2 text-success"></i>
                                                Capacity & Seating
                                            </h6>
                                            <div class="row">
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label text-muted small">Total Seat Capacity</label>
                                                    <div class="d-flex align-items-center">
                                                        <div class="bg-success bg-opacity-10 rounded-circle p-2 me-3">
                                                            <i class="bi bi-people-fill text-success"></i>
                                                        </div>
                                                        <div>
                                                            <div class="fw-bold h4">{{ $bus->seat_capacity }}</div>
                                                            <div class="text-muted small">Total Seats</div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label text-muted small">Currently Available</label>
                                                    <div class="d-flex align-items-center">
                                                        <div class="bg-info bg-opacity-10 rounded-circle p-2 me-3">
                                                            <i class="bi bi-ticket-perforated text-info"></i>
                                                        </div>
                                                        <div>
                                                            <div class="fw-bold h4">{{ $bus->available_seats ?? 'N/A' }}</div>
                                                            <div class="text-muted small">Available Seats</div>
                                                        </div>
                                                    </div>
                                                </div>
                                                @if($bus->available_seats && $bus->seat_capacity)
                                                    <div class="col-12">
                                                        <label class="form-label text-muted small mb-2">Seat Occupancy</label>
                                                        <div class="progress" style="height: 10px; border-radius: 5px;">
                                                            @php
                                                                $occupiedSeats = $bus->seat_capacity - $bus->available_seats;
                                                                $occupancyPercent = $bus->seat_capacity > 0 ? ($occupiedSeats / $bus->seat_capacity) * 100 : 0;
                                                                $progressColor = $occupancyPercent >= 80 ? 'danger' : ($occupancyPercent >= 50 ? 'warning' : 'success');
                                                            @endphp
                                                            <div class="progress-bar bg-{{ $progressColor }}"
                                                                 style="width: {{ $occupancyPercent }}%"
                                                                 role="progressbar">
                                                            </div>
                                                        </div>
                                                        <div class="d-flex justify-content-between mt-2">
                                                            <span class="text-muted small">Occupied: {{ $occupiedSeats }}</span>
                                                            <span class="text-muted small">{{ round($occupancyPercent, 1) }}% full</span>
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Facilities Card -->
                                <div class="col-12">
                                    <div class="card border-0 bg-light rounded-3">
                                        <div class="card-body">
                                            <h6 class="fw-bold mb-3 d-flex align-items-center">
                                                <i class="bi bi-stars me-2 text-warning"></i>
                                                Facilities & Amenities
                                            </h6>
                                            <div class="row">
                                                @php
                                                    $facilities = [
                                                        'wifi' => ['icon' => 'bi-wifi', 'label' => 'WiFi', 'color' => 'primary'],
                                                        'tv' => ['icon' => 'bi-tv', 'label' => 'TV', 'color' => 'info'],
                                                        'ac' => ['icon' => 'bi-snow', 'label' => 'Air Conditioner', 'color' => 'success'],
                                                        'charging_port' => ['icon' => 'bi-plug', 'label' => 'Charging Ports', 'color' => 'warning'],
                                                        'washroom' => ['icon' => 'bi-droplet', 'label' => 'Washroom', 'color' => 'danger']
                                                    ];
                                                @endphp
                                                @foreach($facilities as $key => $facility)
                                                    <div class="col-md-6 mb-3">
                                                        <div class="d-flex align-items-center">
                                                            <div class="me-3">
                                                                @if($bus->$key)
                                                                    <div class="bg-{{$facility['color']}} bg-opacity-10 rounded-circle p-2">
                                                                        <i class="bi {{$facility['icon']}} text-{{$facility['color']}}"></i>
                                                                    </div>
                                                                @else
                                                                    <div class="bg-secondary bg-opacity-10 rounded-circle p-2">
                                                                        <i class="bi bi-x-circle text-secondary"></i>
                                                                    </div>
                                                                @endif
                                                            </div>
                                                            <div>
                                                                <div class="fw-semibold">{{ $facility['label'] }}</div>
                                                                <div class="text-muted small">
                                                                    @if($bus->$key)
                                                                        <span class="text-success">Available</span>
                                                                    @else
                                                                        <span class="text-muted">Not Available</span>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Right Column - Status & Actions -->
                        <div class="col-lg-4">
                            <!-- Status & Fitness Card -->
                            <div class="card border-0 bg-primary bg-opacity-5 rounded-3 mb-4">
                                <div class="card-body">
                                    <h6 class="fw-bold mb-3 text-primary">Status & Compliance</h6>

                                    <!-- Current Status -->
                                    <div class="mb-4">
                                        <label class="form-label text-muted small mb-2">Current Status</label>
                                        @if($bus->status == 'active')
                                            <div class="d-flex align-items-center text-success">
                                                <div class="status-indicator bg-success me-2"></div>
                                                <span class="fw-semibold">Active & Operational</span>
                                            </div>
                                            <div class="text-muted small mt-1">Bus is currently in service</div>
                                        @elseif($bus->status == 'inactive')
                                            <div class="d-flex align-items-center text-danger">
                                                <div class="status-indicator bg-danger me-2"></div>
                                                <span class="fw-semibold">Inactive & Parked</span>
                                            </div>
                                            <div class="text-muted small mt-1">Bus is not currently in service</div>
                                        @else
                                            <div class="d-flex align-items-center text-warning">
                                                <div class="status-indicator bg-warning me-2"></div>
                                                <span class="fw-semibold">Under Maintenance</span>
                                            </div>
                                            <div class="text-muted small mt-1">Bus is undergoing repairs/maintenance</div>
                                        @endif
                                    </div>

                                    <!-- Fitness Expiry -->
                                    @if($bus->fitness_expiry)
                                        <div class="mb-4">
                                            <label class="form-label text-muted small mb-2">Fitness Certificate Expiry</label>
                                            <div class="d-flex align-items-center">
                                                <i class="bi bi-calendar-event text-muted me-2"></i>
                                                <div>
                                                    <div>{{\Carbon\Carbon::parse($bus->fitness_expiry)->format('d M, Y')}}</div>
                                                    <div class="text-muted small">
                                                        @php
                                                            $daysToExpire = \Carbon\Carbon::today()->diffInDays(\Carbon\Carbon::parse($bus->fitness_expiry), false);
                                                        @endphp
                                                        @if($daysToExpire > 0)
                                                            <span class="text-success">
                                                        <i class="bi bi-check-circle me-1"></i> Valid for {{ $daysToExpire }} days
                                                    </span>
                                                        @elseif($daysToExpire === 0)
                                                            <span class="text-warning">
                                                        <i class="bi bi-exclamation-circle me-1"></i> Expires today
                                                    </span>
                                                        @else
                                                            <span class="text-danger">
                                                        <i class="bi bi-x-circle me-1"></i> Expired {{ abs($daysToExpire) }} days ago
                                                    </span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif

                                    <!-- Additional Information -->
                                    @if($bus->additional_info)
                                        <div>
                                            <label class="form-label text-muted small mb-2">Additional Notes</label>
                                            <div class="bg-white p-3 rounded-2 border">
                                                <i class="bi bi-chat-left-text text-muted me-2"></i>
                                                {{ $bus->additional_info }}
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <!-- Action Buttons Card -->
                            <div class="card border-0 bg-light rounded-3 mb-4">
                                <div class="card-body">
                                    <h6 class="fw-bold mb-3">Actions</h6>
                                    <div class="d-grid gap-2">
                                        <a href="{{ route('bus.edit', $bus->id) }}"
                                           class="btn btn-primary d-flex align-items-center justify-content-center">
                                            <i class="bi bi-pencil-square me-2"></i> Edit Bus Details
                                        </a>

                                        <button type="button" class="btn btn-outline-success d-flex align-items-center justify-content-center">
                                            <i class="bi bi-calendar-plus me-2"></i> Assign Schedule
                                        </button>

                                        <button type="button" class="btn btn-outline-warning d-flex align-items-center justify-content-center">
                                            <i class="bi bi-tools me-2"></i> Maintenance Log
                                        </button>

                                        <button type="button" class="btn btn-outline-info d-flex align-items-center justify-content-center">
                                            <i class="bi bi-graph-up me-2"></i> View Performance
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <!-- Quick Stats Card -->
                            <div class="card border-0 bg-light rounded-3">
                                <div class="card-body">
                                    <h6 class="fw-bold mb-3">Quick Stats</h6>
                                    <div class="row g-2">
                                        <div class="col-6">
                                            <div class="text-center p-2 bg-white rounded-2">
                                                <div class="fw-bold text-primary">—</div>
                                                <div class="text-muted small">Trips This Month</div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="text-center p-2 bg-white rounded-2">
                                                <div class="fw-bold text-success">—</div>
                                                <div class="text-muted small">Occupancy Rate</div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="text-center p-2 bg-white rounded-2">
                                                <div class="fw-bold text-warning">—</div>
                                                <div class="text-muted small">Avg. Rating</div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="text-center p-2 bg-white rounded-2">
                                                <div class="fw-bold text-info">—</div>
                                                <div class="text-muted small">Revenue</div>
                                            </div>
                                        </div>
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
                                Record ID: BUS-{{ $bus->id }} | Created: {{ $bus->created_at->format('d M, Y h:i A') }}
                            </div>
                        </div>
                        <div class="col-md-6 text-end">
                            <div class="text-muted small">
                                <i class="bi bi-clock-history me-1"></i>
                                Last updated: {{ $bus->updated_at->format('d M, Y h:i A') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        /* Custom Styles for Bus Details */
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

        .status-indicator {
            width: 8px;
            height: 8px;
            border-radius: 50%;
        }

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
        }

        /* Fix content overflow */
        .text-truncate {
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        /* Ensure proper content wrapping */
        .card-body {
            word-wrap: break-word;
            overflow-wrap: break-word;
        }

        /* Prevent long words from breaking layout */
        .fw-semibold, .fw-bold {
            word-break: break-word;
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize tooltips
            const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });

            // Add copy to clipboard for bus code
            const busCode = document.querySelector('.text-primary.fw-semibold');
            if (busCode) {
                busCode.style.cursor = 'pointer';
                busCode.title = 'Click to copy Bus Code';
                busCode.addEventListener('click', function() {
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

            // Add confirmation for actions
            const actionButtons = document.querySelectorAll('.btn-outline-danger');
            actionButtons.forEach(button => {
                button.addEventListener('click', function(e) {
                    if (!confirm('Are you sure you want to perform this action?')) {
                        e.preventDefault();
                    }
                });
            });

            // Highlight fitness expiry if near or passed
            const fitnessElement = document.querySelector('.text-success, .text-warning, .text-danger');
            if (fitnessElement) {
                const parentCard = fitnessElement.closest('.card');
                if (fitnessElement.classList.contains('text-danger')) {
                    parentCard.style.backgroundColor = 'rgba(231, 29, 54, 0.05)';
                } else if (fitnessElement.classList.contains('text-warning')) {
                    parentCard.style.backgroundColor = 'rgba(255, 191, 105, 0.05)';
                }
            }
        });
    </script>
@endsection
