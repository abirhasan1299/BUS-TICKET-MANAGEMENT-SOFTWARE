@extends('layout.master')
@section('title', 'Coupon Management')
@section('page-title', 'Coupon Management')
@section('breadcrumb', 'Promotions & Discounts')

@section('action-buttons')
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#filterModal">
        <i class="bi bi-funnel me-1"></i> Filter
    </button>
    <a href="{{route('coupon.create')}}" class="btn btn-success ms-2">
        <i class="bi bi-plus-lg me-1"></i> Create Coupon
    </a>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="dashboard-card">
                <div class="card-header border-0 bg-transparent p-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="mb-0 fw-bold">Coupon Management</h5>
                            <p class="text-muted mb-0">Manage all discount coupons and promotions</p>
                        </div>
                        <div>
                            <a class="btn btn-sm btn-primary" href="{{route('coupon.create')}}" role="button">
                                <i class="bi bi-plus-lg"> Add Coupon</i>
                            </a>
                        </div>
                        <div class="d-flex gap-2">
                            <div class="input-group" style="width: 250px;">
                            <span class="input-group-text bg-light border-end-0">
                                <i class="bi bi-search"></i>
                            </span>
                                <input type="text" class="form-control border-start-0" placeholder="Search coupons..." id="searchInput">
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
                                    <h6 class="text-muted mb-1">Total Coupons</h6>
                                    <h4 class="mb-0 fw-bold">{{ $data->total() }}</h4>
                                </div>
                                <div class="bg-primary rounded-circle p-2">
                                    <i class="bi bi-tags text-white"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="stat-card bg-success bg-opacity-10 rounded-3 p-3">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="text-muted mb-1">Active Coupons</h6>
                                    <h4 class="mb-0 fw-bold">{{ $data->where('status', '1')->count() }}</h4>
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
                                    <h6 class="text-muted mb-1">Expiring Soon</h6>
                                    <h4 class="mb-0 fw-bold">
                                        @php
                                            $expiringCount = 0;
                                            foreach($data as $coupon) {
                                                $daysToExpire = \Carbon\Carbon::today()->diffInDays(\Carbon\Carbon::parse($coupon->expire), false);
                                                if($daysToExpire > 0 && $daysToExpire <= 7) {
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
                                    <h6 class="text-muted mb-1">Total Usage</h6>
                                    <h4 class="mb-0 fw-bold">{{ $data->sum('count') }}</h4>
                                </div>
                                <div class="bg-info rounded-circle p-2">
                                    <i class="bi bi-arrow-repeat text-white"></i>
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
                                <th>Coupon Details</th>
                                <th>Code</th>
                                <th>Usage</th>
                                <th>Validity</th>
                                <th>Status</th>
                                <th class="text-center pe-4">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($data as $d)
                                @php
                                    $daysToExpire = \Carbon\Carbon::today()->diffInDays(\Carbon\Carbon::parse($d->expire), false);
                                    $isExpired = $daysToExpire < 0;
                                    $isExpiringSoon = $daysToExpire > 0 && $daysToExpire <= 7;
                                    $discountValue = $d->discount ?? 0;
                                    $maxDiscount = $d->max_discount ?? 0;
                                    $minOrderAmount = $d->min_order_amount ?? 0;
                                    $usageLimit = $d->usage_limit ?? 0;
                                @endphp
                                <tr class="{{ $isExpired ? 'opacity-75' : '' }}">
                                    <td class="ps-4 fw-semibold">{{$loop->iteration}}</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="bg-primary bg-opacity-10 rounded-circle p-2 me-3">
                                                <i class="bi bi-percent text-primary"></i>
                                            </div>
                                            <div>
                                                <div class="fw-semibold">{{$d->name}}</div>
                                                <div class="text-muted small">
                                                    <i class="bi bi-percent me-1"></i> {{$discountValue}}% Off
                                                </div>
                                                @if($maxDiscount > 0)
                                                    <div class="badge bg-info bg-opacity-10 text-info px-2 py-1 mt-1">
                                                        Max: ৳{{$maxDiscount}}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="position-relative">
                                            <code class="bg-light px-3 py-1 rounded-2 fw-bold text-primary">
                                                {{$d->coupon_code}}
                                            </code>
                                            <button class="btn btn-sm btn-link text-muted p-0 ms-1 copy-btn"
                                                    data-code="{{$d->coupon_code}}"
                                                    title="Copy Code">
                                                <i class="bi bi-clipboard"></i>
                                            </button>
                                        </div>
                                        @if($minOrderAmount > 0)
                                            <div class="text-muted small mt-1">
                                                Min order: ৳{{$minOrderAmount}}
                                            </div>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="me-3">
                                                <div class="fw-bold text-center">{{$d->count}}</div>
                                                <div class="text-muted small">Used</div>
                                            </div>
                                            @if($usageLimit > 0)
                                                <div class="border-start ps-3">
                                                    <div class="text-center">{{$usageLimit}}</div>
                                                    <div class="text-muted small">Limit</div>
                                                </div>
                                            @endif
                                        </div>
                                        @if($usageLimit > 0)
                                            <div class="progress mt-2" style="height: 4px;">
                                                @php
                                                    $usagePercent = min(100, ($d->count / $usageLimit) * 100);
                                                    $progressColor = $usagePercent >= 90 ? 'danger' : ($usagePercent >= 70 ? 'warning' : 'success');
                                                @endphp
                                                <div class="progress-bar bg-{{$progressColor}}" style="width: {{$usagePercent}}%"></div>
                                            </div>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="text-nowrap">
                                            <div class="{{ $isExpired ? 'text-danger' : ($isExpiringSoon ? 'text-warning' : 'text-success') }}">
                                                <i class="bi bi-calendar-event me-1"></i>
                                                {{\Carbon\Carbon::parse($d->expire)->format('d M, Y')}}
                                            </div>
                                            <div class="text-muted small">
                                                @if($isExpired)
                                                    <i class="bi bi-x-circle me-1"></i>
                                                    Expired {{abs($daysToExpire)}} days ago
                                                @elseif($isExpiringSoon)
                                                    <i class="bi bi-clock me-1"></i>
                                                    Expires in {{$daysToExpire}} days
                                                @else
                                                    <i class="bi bi-check-circle me-1"></i>
                                                    Valid for {{$daysToExpire}} days
                                                @endif
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        @if($d->status == '1')
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
                                            <form action="{{route('coupon.destroy',$d->id)}}" method="post"
                                                  class="d-inline">
                                                @method('DELETE')
                                                @csrf
                                                <button type="submit"
                                                        class="btn btn-sm btn-outline-danger d-flex align-items-center"
                                                        title="Delete Coupon"
                                                        onclick="return confirmDelete()">
                                                    <i class="bi bi-trash me-1"></i> Delete
                                                </button>
                                            </form>
                                        </div>

                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center py-5">
                                        <div class="text-muted">
                                            <i class="bi bi-percent-circle display-5 mb-3"></i>
                                            <h5 class="mb-2">No Coupons Found</h5>
                                            <p class="mb-0">Get started by creating your first discount coupon</p>
                                            <a href="{{route('coupon.create')}}" class="btn btn-primary mt-3">
                                                <i class="bi bi-plus-lg me-1"></i> Create First Coupon
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
                                Showing {{$data->firstItem()}} to {{$data->lastItem()}} of {{$data->total()}} coupons
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
                    <h5 class="modal-title fw-bold" id="filterModalLabel">Filter Coupons</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{route('coupon.filter')}}" method="post" autocomplete="off">
                    @csrf
                    <div class="modal-body">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Coupon Name</label>
                                <input type="text" name="name" class="form-control" placeholder="Enter coupon name">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Coupon Code</label>
                                <input type="text" name="coupon_code" class="form-control" placeholder="Enter coupon code">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Expiry Date</label>
                                <input type="date" name="expire_date" class="form-control" id="expireDate">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Status</label>
                                <select name="status" class="form-select">
                                    <option value="">All Status</option>
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Usage Range</label>
                                <div class="input-group">
                                    <input type="number" name="min_usage" class="form-control" placeholder="Min">
                                    <span class="input-group-text">to</span>
                                    <input type="number" name="max_usage" class="form-control" placeholder="Max">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Discount Type</label>
                                <select name="discount_type" class="form-select">
                                    <option value="">All Types</option>
                                    <option value="percentage">Percentage</option>
                                    <option value="fixed">Fixed Amount</option>
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

        code {
            font-family: 'SFMono-Regular', Consolas, 'Liberation Mono', Menlo, monospace;
            font-size: 0.875rem;
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

        /* Progress Bar */
        .progress {
            background-color: rgba(0, 0, 0, 0.05);
        }

        /* Badge Styles */
        .badge {
            font-weight: 500;
            padding: 0.35em 0.65em;
        }

        /* Button Styles */
        .btn-outline-primary, .btn-outline-danger, .btn-outline-success {
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

        .btn-outline-success:hover {
            background-color: rgba(46, 196, 182, 0.1);
            transform: translateY(-1px);
        }

        /* Copy Button */
        .btn-link {
            text-decoration: none;
        }

        /* Modal Styles */
        .modal-content {
            border-radius: 16px;
            border: none;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
        }

        /* Text Colors */
        .text-success { color: #2EC4B6 !important; }
        .text-warning { color: #FFBF69 !important; }
        .text-danger { color: #E71D36 !important; }

        /* Responsive */
        @media (max-width: 768px) {
            .card-header .d-flex {
                flex-direction: column;
                gap: 1rem;
            }

            .card-header .input-group {
                width: 100% !important;
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

            .d-flex.justify-content-center.gap-2 {
                flex-wrap: wrap;
                justify-content: center !important;
            }
        }
    </style>

    <script>
        // Initialize Flatpickr for date input
        document.addEventListener('DOMContentLoaded', function() {
            const expireDateInput = document.getElementById('expireDate');
            if (expireDateInput) {
                flatpickr(expireDateInput, {
                    dateFormat: "Y-m-d",
                });
            }

            // Initialize tooltips
            const tooltipTriggerList = [].slice.call(document.querySelectorAll('[title]'));
            tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });

            // Highlight expiring coupons
            const rows = document.querySelectorAll('tbody tr');
            rows.forEach(row => {
                if (row.classList.contains('opacity-75')) {
                    row.style.backgroundColor = 'rgba(231, 29, 54, 0.05)';
                } else if (row.querySelector('.text-warning')) {
                    row.style.backgroundColor = 'rgba(255, 191, 105, 0.05)';
                }
            });
        });

        // Copy coupon code to clipboard
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.copy-btn').forEach(btn => {
                btn.addEventListener('click', function(e) {
                    e.preventDefault();
                    const code = this.getAttribute('data-code');

                    navigator.clipboard.writeText(code).then(() => {
                        // Show success message
                        const originalHTML = this.innerHTML;
                        this.innerHTML = '<i class="bi bi-check"></i>';
                        this.classList.add('text-success');

                        setTimeout(() => {
                            this.innerHTML = originalHTML;
                            this.classList.remove('text-success');
                        }, 2000);
                    }).catch(err => {
                        console.error('Failed to copy: ', err);
                        alert('Failed to copy coupon code');
                    });
                });
            });
        });

        // Confirm delete
        function confirmDelete() {
            return confirm('Are you sure you want to delete this coupon? This action cannot be undone.');
        }

        // Search functionality
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('searchInput');
            if (searchInput) {
                searchInput.addEventListener('input', function(e) {
                    const searchTerm = e.target.value.toLowerCase();
                    const rows = document.querySelectorAll('tbody tr');

                    rows.forEach(row => {
                        const text = row.textContent.toLowerCase();
                        row.style.display = text.includes(searchTerm) ? '' : 'none';
                    });
                });
            }
        });
    </script>
@endsection
