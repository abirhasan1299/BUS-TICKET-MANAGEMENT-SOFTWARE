@extends('layout.master')
@section('title', 'Dashboard')
@section('page-title', 'Dashboard Overview')
@section('breadcrumb', 'Statistics & Analytics')

@section('content')
    <!-- Dashboard Stats -->
    <div class="row g-4">
        <!-- Total Users Card -->
        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12">
            <div class="dashboard-card">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <div class="card-icon" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                            <i class="bi bi-people-fill text-white"></i>
                        </div>
                        <div class="text-end">
                        <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-1 rounded-pill">
                            <i class="bi bi-graph-up me-1"></i> 12%
                        </span>
                        </div>
                    </div>
                    <h6 class="text-muted fw-semibold mb-2">Total Users</h6>
                    <h2 class="mb-3 fw-bold">{{ number_format($user) }}</h2>
                    <div class="progress mb-3" style="height: 6px;">
                        <div class="progress-bar bg-primary" style="width: {{ min($user, 100) }}%"></div>
                    </div>
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="text-muted small">Active this month</span>
                        <a href="#" class="text-primary text-decoration-none small">
                            View all <i class="bi bi-arrow-right ms-1"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Net Amount Card -->
        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12">
            <div class="dashboard-card">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <div class="card-icon" style="background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);">
                            <i class="bi bi-cash-stack text-white"></i>
                        </div>
                        <div class="text-end">
                        <span class="badge bg-success bg-opacity-10 text-success px-3 py-1 rounded-pill">
                            <i class="bi bi-arrow-up me-1"></i> 24%
                        </span>
                        </div>
                    </div>
                    <h6 class="text-muted fw-semibold mb-2">Net Amount</h6>
                    <h2 class="mb-3 fw-bold">৳ {{ number_format($amount) }}</h2>
                    <div class="progress mb-3" style="height: 6px;">
                        <div class="progress-bar bg-success" style="width: {{ min($amount/1000, 100) }}%"></div>
                    </div>
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="text-muted small">Total revenue</span>
                        <a href="{{ route('admin.payment') }}" class="text-primary text-decoration-none small">
                            Details <i class="bi bi-arrow-right ms-1"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bus Routes Card -->
        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12">
            <div class="dashboard-card">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <div class="card-icon" style="background: linear-gradient(135deg, #f7971e 0%, #ffd200 100%);">
                            <i class="bi bi-sign-turn-right-fill text-white"></i>
                        </div>
                        <div class="text-end">
                        <span class="badge bg-warning bg-opacity-10 text-warning px-3 py-1 rounded-pill">
                            <i class="bi bi-diagram-3 me-1"></i> 8
                        </span>
                        </div>
                    </div>
                    <h6 class="text-muted fw-semibold mb-2">Bus Routes</h6>
                    <h2 class="mb-3 fw-bold">{{ number_format($busroute) }}</h2>
                    <div class="progress mb-3" style="height: 6px;">
                        <div class="progress-bar bg-warning" style="width: {{ min($busroute*10, 100) }}%"></div>
                    </div>
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="text-muted small">Active routes</span>
                        <a href="{{ route('route.index') }}" class="text-primary text-decoration-none small">
                            Manage <i class="bi bi-arrow-right ms-1"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Drivers Card -->
        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12">
            <div class="dashboard-card">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <div class="card-icon" style="background: linear-gradient(135deg, #ff416c 0%, #ff4b2b 100%);">
                            <i class="bi bi-person-badge-fill text-white"></i>
                        </div>
                        <div class="text-end">
                        <span class="badge bg-info bg-opacity-10 text-info px-3 py-1 rounded-pill">
                            <i class="bi bi-person-check me-1"></i> {{ rand(5, $drivers) }}
                        </span>
                        </div>
                    </div>
                    <h6 class="text-muted fw-semibold mb-2">Total Drivers</h6>
                    <h2 class="mb-3 fw-bold">{{ number_format($drivers) }}</h2>
                    <div class="progress mb-3" style="height: 6px;">
                        <div class="progress-bar bg-info" style="width: {{ min($drivers*10, 100) }}%"></div>
                    </div>
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="text-muted small">Available today</span>
                        <a href="{{ route('driver.index') }}" class="text-primary text-decoration-none small">
                            View all <i class="bi bi-arrow-right ms-1"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4 mt-2">
        <!-- Recent Activity & Chart -->
        <div class="col-xl-8">
            <div class="dashboard-card h-100">
                <div class="card-header border-0 bg-transparent p-4 pb-2">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="mb-1 fw-bold">Recent Activity</h5>
                            <p class="text-muted mb-0">Latest system activities and updates</p>
                        </div>
                        <div>
                            <select class="form-select form-select-sm border-0 bg-light" style="width: auto;">
                                <option>Today</option>
                                <option selected>This Week</option>
                                <option>This Month</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="card-body p-4 pt-2">
                    <div class="activity-timeline">
                        @foreach([
                            ['icon' => 'bi-ticket-perforated', 'color' => 'primary', 'title' => 'New Booking', 'desc' => 'Booking #BK-' . rand(1000, 9999) . ' created', 'time' => '10 min ago', 'badge' => 'New'],
                            ['icon' => 'bi-credit-card', 'color' => 'success', 'title' => 'Payment Received', 'desc' => 'Payment of ৳' . rand(500, 2000) . ' processed', 'time' => '45 min ago', 'badge' => 'Completed'],
                            ['icon' => 'bi-bus-front', 'color' => 'warning', 'title' => 'Bus Added', 'desc' => 'New bus added to fleet - ' . chr(rand(65, 90)) . '-' . rand(1000, 9999), 'time' => '2 hours ago', 'badge' => 'Fleet'],
                            ['icon' => 'bi-person-plus', 'color' => 'info', 'title' => 'New Driver', 'desc' => 'Driver ' . rand(1, 99) . ' joined the team', 'time' => '5 hours ago', 'badge' => 'HR'],
                            ['icon' => 'bi-geo-alt', 'color' => 'danger', 'title' => 'Route Updated', 'desc' => 'Route ' . chr(rand(65, 90)) . ' schedule updated', 'time' => '1 day ago', 'badge' => 'Update'],
                        ] as $activity)
                            <div class="activity-item d-flex align-items-start mb-3">
                                <div class="activity-icon flex-shrink-0">
                                    <div class="bg-{{ $activity['color'] }} bg-opacity-10 rounded-circle p-2">
                                        <i class="bi {{ $activity['icon'] }} text-{{ $activity['color'] }}"></i>
                                    </div>
                                </div>
                                <div class="activity-content flex-grow-1 ms-3">
                                    <div class="d-flex justify-content-between align-items-start">
                                        <div>
                                            <h6 class="mb-1 fw-semibold">{{ $activity['title'] }}</h6>
                                            <p class="text-muted mb-1 small">{{ $activity['desc'] }}</p>
                                            <span class="text-muted small">{{ $activity['time'] }}</span>
                                        </div>
                                        <span class="badge bg-{{ $activity['color'] }} bg-opacity-10 text-{{ $activity['color'] }}">{{ $activity['badge'] }}</span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Actions & System Status -->
        <div class="col-xl-4">
            <div class="dashboard-card h-100">
                <div class="card-header border-0 bg-transparent p-4 pb-2">
                    <h5 class="mb-1 fw-bold">Quick Actions</h5>
                    <p class="text-muted mb-0">Frequently used operations</p>
                </div>
                <div class="card-body p-4">
                    <div class="row g-3 mb-4">
                        @foreach([
                            ['route' => 'route.index', 'icon' => 'bi-plus-circle', 'text' => 'Add Route', 'color' => 'primary'],
                            ['route' => 'bus.index', 'icon' => 'bi-bus-front', 'text' => 'Manage Buses', 'color' => 'success'],
                            ['route' => 'slot.index', 'icon' => 'bi-calendar-plus', 'text' => 'Create Slot', 'color' => 'warning'],
                            ['route' => 'coupon.index', 'icon' => 'bi-percent', 'text' => 'Generate Coupon', 'color' => 'info'],
                        ] as $action)
                            <div class="col-6">
                                <a href="{{ route($action['route']) }}" class="quick-action-btn d-flex flex-column align-items-center justify-content-center p-3 text-decoration-none">
                                    <div class="mb-2">
                                        <div class="bg-{{ $action['color'] }} bg-opacity-10 rounded-circle p-3">
                                            <i class="bi {{ $action['icon'] }} text-{{ $action['color'] }} fs-4"></i>
                                        </div>
                                    </div>
                                    <span class="text-dark fw-semibold small">{{ $action['text'] }}</span>
                                </a>
                            </div>
                        @endforeach
                    </div>

                    <div class="system-status">
                        <h6 class="fw-semibold mb-3">System Status</h6>

                        <div class="status-item mb-3">
                            <div class="d-flex justify-content-between align-items-center mb-1">
                                <span class="small">Server Load</span>
                                <span class="small fw-semibold text-success">{{ rand(20, 60) }}%</span>
                            </div>
                            <div class="progress" style="height: 8px; border-radius: 4px;">
                                <div class="progress-bar bg-success" role="progressbar" style="width: {{ rand(20, 60) }}%"></div>
                            </div>
                        </div>

                        <div class="status-item mb-3">
                            <div class="d-flex justify-content-between align-items-center mb-1">
                                <span class="small">Database Connections</span>
                                <span class="small fw-semibold text-primary">{{ rand(5, 15) }}/50</span>
                            </div>
                            <div class="progress" style="height: 8px; border-radius: 4px;">
                                <div class="progress-bar bg-primary" role="progressbar" style="width: {{ rand(10, 30) }}%"></div>
                            </div>
                        </div>

                        <div class="status-item mb-3">
                            <div class="d-flex justify-content-between align-items-center mb-1">
                                <span class="small">Storage Usage</span>
                                <span class="small fw-semibold text-warning">{{ rand(40, 80) }}%</span>
                            </div>
                            <div class="progress" style="height: 8px; border-radius: 4px;">
                                <div class="progress-bar bg-warning" role="progressbar" style="width: {{ rand(40, 80) }}%"></div>
                            </div>
                        </div>

                        <div class="status-item">
                            <div class="d-flex justify-content-between align-items-center mb-1">
                                <span class="small">Uptime</span>
                                <span class="small fw-semibold text-info">{{ rand(99, 100) }}%</span>
                            </div>
                            <div class="progress" style="height: 8px; border-radius: 4px;">
                                <div class="progress-bar bg-info" role="progressbar" style="width: {{ rand(99, 100) }}%"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Bookings -->
    <div class="row g-4 mt-2">
        <div class="col-12">
            <div class="dashboard-card">
                <div class="card-header border-0 bg-transparent p-4 pb-2">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="mb-1 fw-bold">Recent Bookings</h5>
                            <p class="text-muted mb-0">Latest booking transactions</p>
                        </div>
                        <a href="#" class="btn btn-sm btn-primary px-3">
                            <i class="bi bi-download me-1"></i> Export
                        </a>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light">
                            <tr>
                                <th class="ps-4">Booking ID</th>
                                <th>Passenger</th>
                                <th>Route</th>
                                <th>Bus</th>
                                <th>Date & Time</th>
                                <th>Amount</th>
                                <th>Status</th>
                                <th class="pe-4">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @for($i = 1; $i <= 5; $i++)
                                @php
                                    $statuses = [
                                        ['text' => 'Confirmed', 'class' => 'success'],
                                        ['text' => 'Pending', 'class' => 'warning'],
                                        ['text' => 'Completed', 'class' => 'info'],
                                        ['text' => 'Cancelled', 'class' => 'danger']
                                    ];
                                    $status = $statuses[array_rand($statuses)];
                                @endphp
                                <tr>
                                    <td class="ps-4 fw-semibold">#BK-{{ rand(1000, 9999) }}</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="avatar-sm me-2">
                                                <div class="bg-primary bg-opacity-10 rounded-circle p-2">
                                                    <i class="bi bi-person text-primary"></i>
                                                </div>
                                            </div>
                                            <span>Passenger {{ $i }}</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="text-nowrap">
                                            <i class="bi bi-geo-alt text-muted me-1"></i>
                                            Route {{ chr(64 + $i) }}
                                        </div>
                                    </td>
                                    <td>
                                        <div class="text-nowrap">
                                            <i class="bi bi-bus-front text-muted me-1"></i>
                                            Bus {{ $i }}-{{ rand(100, 999) }}
                                        </div>
                                    </td>
                                    <td>
                                        <div class="text-nowrap">
                                            <small>{{ date('d M, Y') }}</small><br>
                                            <small class="text-muted">{{ rand(8, 22) }}:00</small>
                                        </div>
                                    </td>
                                    <td class="fw-semibold">৳ {{ number_format(rand(500, 2000)) }}</td>
                                    <td>
                                    <span class="badge bg-{{ $status['class'] }} bg-opacity-10 text-{{ $status['class'] }} px-3 py-1">
                                        {{ $status['text'] }}
                                    </span>
                                    </td>
                                    <td class="pe-4">
                                        <div class="btn-group btn-group-sm" role="group">
                                            <button type="button" class="btn btn-outline-primary">
                                                <i class="bi bi-eye"></i>
                                            </button>
                                            <button type="button" class="btn btn-outline-primary">
                                                <i class="bi bi-printer"></i>
                                            </button>
                                            <button type="button" class="btn btn-outline-primary">
                                                <i class="bi bi-download"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @endfor
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer border-0 bg-transparent p-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="text-muted small">
                            Showing 5 of {{ rand(50, 100) }} total bookings
                        </div>
                        <a href="#" class="btn btn-outline-primary px-4">
                            View All Bookings <i class="bi bi-arrow-right ms-1"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        /* Dashboard Card Styles */
        .dashboard-card {
            background: #ffffff;
            border-radius: 12px;
            border: 1px solid rgba(0, 0, 0, 0.05);
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.03);
            transition: all 0.3s ease;
            overflow: hidden;
            height: 100%;
        }

        .dashboard-card:hover {
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.08);
            transform: translateY(-2px);
        }

        /* Card Icon */
        .card-icon {
            width: 56px;
            height: 56px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
        }

        /* Progress Bars */
        .progress {
            background-color: rgba(0, 0, 0, 0.05);
        }

        /* Activity Timeline */
        .activity-item {
            position: relative;
            padding-left: 1rem;
        }

        .activity-item:before {
            content: '';
            position: absolute;
            left: 0.8rem;
            top: 2.5rem;
            bottom: -2rem;
            width: 2px;
            background: rgba(0, 0, 0, 0.1);
        }

        .activity-item:last-child:before {
            display: none;
        }

        .activity-icon {
            position: relative;
            z-index: 1;
        }

        /* Quick Action Buttons */
        .quick-action-btn {
            transition: all 0.3s ease;
            border-radius: 10px;
            background: rgba(0, 0, 0, 0.02);
        }

        .quick-action-btn:hover {
            background: rgba(var(--primary-color-rgb), 0.1);
            transform: translateY(-3px);
        }

        /* Table Styles */
        .table > :not(caption) > * > * {
            padding: 1rem 0.75rem;
        }

        .avatar-sm {
            width: 36px;
            height: 36px;
        }

        /* Badge Styles */
        .badge {
            font-weight: 500;
        }

        /* Responsive Adjustments */
        @media (max-width: 768px) {
            .card-body {
                padding: 1rem !important;
            }

            .table-responsive {
                font-size: 0.875rem;
            }

            .btn-group-sm .btn {
                padding: 0.25rem 0.5rem;
            }
        }
    </style>
@endsection
