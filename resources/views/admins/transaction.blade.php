@extends('layout.master')
@section('title', 'Payment Transactions')
@section('content')
    <div class="row">
        <div class="col-12">
            <!-- Stats Cards -->
            <div class="row mb-4">
                <div class="col-md-3 mb-3">
                    <div class="dashboard-card h-100">
                        <div class="card-body p-3">
                            <div class="d-flex align-items-center">
                                <div class="icon-wrapper bg-primary bg-opacity-10 p-3 rounded-3 me-3">
                                    <i class="bi bi-check-circle-fill text-primary fs-4"></i>
                                </div>
                                <div>
                                    <h6 class="mb-1 text-muted">Successful</h6>
                                    <h4 class="mb-0 fw-bold">0</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-3">
                    <div class="dashboard-card h-100">
                        <div class="card-body p-3">
                            <div class="d-flex align-items-center">
                                <div class="icon-wrapper bg-warning bg-opacity-10 p-3 rounded-3 me-3">
                                    <i class="bi bi-clock-history text-warning fs-4"></i>
                                </div>
                                <div>
                                    <h6 class="mb-1 text-muted">Pending</h6>
                                    <h4 class="mb-0 fw-bold">0</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-3">
                    <div class="dashboard-card h-100">
                        <div class="card-body p-3">
                            <div class="d-flex align-items-center">
                                <div class="icon-wrapper bg-danger bg-opacity-10 p-3 rounded-3 me-3">
                                    <i class="bi bi-x-circle-fill text-danger fs-4"></i>
                                </div>
                                <div>
                                    <h6 class="mb-1 text-muted">Failed</h6>
                                    <h4 class="mb-0 fw-bold">0</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-3">
                    <div class="dashboard-card h-100">
                        <div class="card-body p-3">
                            <div class="d-flex align-items-center">
                                <div class="icon-wrapper bg-info bg-opacity-10 p-3 rounded-3 me-3">
                                    <i class="bi bi-graph-up text-info fs-4"></i>
                                </div>
                                <div>
                                    <h6 class="mb-1 text-muted">This Month</h6>
                                    <h4 class="mb-0 fw-bold">{{ number_format($cart_count, 2) }} BDT</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Card -->
            <div class="dashboard-card">
                <!-- Card Header -->
                <div class="card-header border-0 bg-transparent p-4 pb-0">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <div class="d-flex align-items-center">
                            <div class="icon-wrapper bg-primary bg-opacity-10 p-3 rounded-3 me-3">
                                <i class="bi bi-credit-card-2-front text-primary fs-4"></i>
                            </div>
                            <div>
                                <h4 class="mb-1 fw-bold">Payment Transactions</h4>
                                <p class="text-muted mb-0">Track and manage all bus ticket payments</p>
                            </div>
                        </div>
                        <div class="d-flex gap-2">
                            <div class="dropdown">
                                <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                    <i class="bi bi-funnel me-2"></i> Filter
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li><h6 class="dropdown-header">Status</h6></li>
                                    <li><a class="dropdown-item filter-status active" href="#" data-status="all">All Transactions</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li><a class="dropdown-item filter-status" href="#" data-status="paid">Paid</a></li>
                                    <li><a class="dropdown-item filter-status" href="#" data-status="pending">Pending</a></li>
                                    <li><a class="dropdown-item filter-status" href="#" data-status="failed">Failed</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-body p-4">
                    <!-- Search Bar -->
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <div class="search-wrapper position-relative">
                                <i class="bi bi-search position-absolute top-50 start-0 translate-middle-y ms-3 text-muted"></i>
                                <input type="text"
                                       id="searchInput"
                                       class="form-control ps-5"
                                       placeholder="Search by Transaction ID, Bus Name, Route...">
                                <button class="search-clear btn btn-link position-absolute top-50 end-0 translate-middle-y me-3 text-muted d-none"
                                        id="clearSearch">
                                    <i class="bi bi-x-lg"></i>
                                </button>
                            </div>
                        </div>
                        <div class="col-md-6 text-end">
                            <div class="d-flex justify-content-end gap-2">
                                <button class="btn btn-outline-secondary">
                                    <i class="bi bi-download me-2"></i> Export
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Transactions Table -->
                    <div class="table-responsive">
                        <table class="table table-hover align-middle" id="paymentTable">
                            <thead>
                            <tr class="bg-light">
                                <th class="text-center" width="60">#</th>
                                <th>Transaction Details</th>
                                <th>Bus Information</th>
                                <th class="text-end">Amount</th>
                                <th>Date & Time</th>
                                <th>Status</th>

                            </tr>
                            </thead>
                            <tbody>
                            @php $count = 1; @endphp
                            @foreach($data as $d)
                                <tr class="transaction-row fade-in"
                                    data-status="{{ strtolower($d->status) }}"
                                    data-search="{{ strtolower($d->transaction_id . ' ' . $d->slots->busInfo->bus_name . ' ' . $d->slots->busRoute->start_location . ' ' . $d->slots->busRoute->end_location) }}">
                                    <td class="text-center fw-semibold text-muted">{{ $count++ }}</td>

                                    <td>
                                        <div class="d-flex flex-column">
                                            <span class="fw-bold text-primary">TXN#{{ $d->transaction_id }}</span>
                                            <small class="text-muted">
                                                <i class="bi bi-person me-1"></i>
                                                Customer Payment
                                            </small>
                                        </div>
                                    </td>

                                    <td>
                                        <div class="d-flex flex-column">
                                            <span class="fw-semibold">{{ $d->slots->busInfo->bus_name }}</span>
                                            <small class="text-muted">
                                                <i class="bi bi-signpost-split me-1"></i>
                                                {{ $d->slots->busRoute->start_location }} → {{ $d->slots->busRoute->end_location }}
                                            </small>
                                            <small class="text-muted">
                                                <i class="bi bi-calendar3 me-1"></i>
                                                {{ $d->created_at->format('M d, Y') }}
                                            </small>
                                        </div>
                                    </td>

                                    <td class="text-end">
                                        <div class="d-flex flex-column align-items-end">
                                            <span class="fw-bold fs-5 text-dark">{{ number_format($d->amount, 2) }}</span>
                                            <small class="text-muted">BDT</small>
                                        </div>
                                    </td>

                                    <td>
                                        <div class="d-flex flex-column">
                                            <span class="fw-semibold">{{ $d->created_at->format('d M Y') }}</span>
                                            <small class="text-muted">
                                                <i class="bi bi-clock me-1"></i>
                                                {{ $d->created_at->format('h:i A') }}
                                            </small>
                                        </div>
                                    </td>

                                    <td>
                                        @php
                                            $statusConfig = [
                                                'paid' => ['class' => 'badge bg-success bg-opacity-10 text-success border border-success', 'icon' => 'bi-check-circle-fill', 'label' => 'Paid'],
                                                'pending' => ['class' => 'badge bg-warning bg-opacity-10 text-warning border border-warning', 'icon' => 'bi-clock-history', 'label' => 'Pending'],
                                                'failed' => ['class' => 'badge bg-danger bg-opacity-10 text-danger border border-danger', 'icon' => 'bi-x-circle-fill', 'label' => 'Failed'],
                                            ];
                                            $config = $statusConfig[$d->status] ?? ['class' => 'badge bg-secondary bg-opacity-10 text-secondary', 'icon' => 'bi-question-circle', 'label' => 'Unknown'];
                                        @endphp
                                        <span class="badge {{ $config['class'] }} d-inline-flex align-items-center gap-1">
                                                <i class="bi {{ $config['icon'] }}"></i>
                                                {{ $config['label'] }}
                                            </span>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                        @if($data->isEmpty())
                            <div class="text-center py-5">
                                <div class="empty-state-icon mb-4">
                                    <i class="bi bi-receipt-cutoff text-muted" style="font-size: 4rem;"></i>
                                </div>
                                <h4 class="text-muted mb-3">No Payment Transactions</h4>
                                <p class="text-muted mb-4">There are no payment records to display.</p>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Card Footer -->
                <div class="card-footer border-0 bg-transparent p-4">
                    @if($data->hasPages())
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="text-muted">
                                Showing {{ $data->firstItem() ?? 0 }} to {{ $data->lastItem() ?? 0 }} of {{ $data->total() }} entries
                            </div>
                            <div>
                                {{ $data->links() }}
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <style>
        /* Search Wrapper */
        .search-wrapper .form-control {
            border-radius: 10px;
            border: 1px solid #E2E8F0;
            background: #F8FAFC;
            padding-left: 2.5rem;
            transition: var(--transition);
        }

        .search-wrapper .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.25rem rgba(255, 107, 53, 0.15);
            background: white;
        }

        /* Table Styles */
        .table {
            border-radius: 10px;
            overflow: hidden;
        }

        .table thead th {
            border-bottom: 2px solid #E2E8F0;
            font-weight: 600;
            color: #64748B;
            text-transform: uppercase;
            font-size: 0.85rem;
            letter-spacing: 0.05em;
            padding: 1rem 1.5rem;
        }

        .table tbody tr {
            transition: var(--transition);
            border-bottom: 1px solid #F1F5F9;
        }

        .table tbody tr:hover {
            background-color: rgba(255, 107, 53, 0.03);
            transform: translateY(-1px);
        }

        .table tbody td {
            padding: 1rem 1.5rem;
            vertical-align: middle;
        }

        /* Status Badges */
        .badge {
            font-weight: 500;
            padding: 0.35rem 0.75rem;
            border-radius: 6px;
        }

        /* Action Buttons */
        .btn-outline-secondary {
            border-color: #E2E8F0;
            color: #64748B;
            transition: var(--transition);
        }

        .btn-outline-secondary:hover {
            background-color: #F1F5F9;
            border-color: #CBD5E1;
        }

        /* Dropdown Menu */
        .dropdown-menu {
            border: none;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
            border-radius: 12px;
            padding: 0.5rem;
        }

        .dropdown-item {
            padding: 0.75rem 1rem;
            border-radius: 8px;
            font-weight: 500;
            transition: var(--transition);
        }

        .dropdown-item:hover {
            background-color: #F1F5F9;
        }

        /* Icon Wrapper */
        .icon-wrapper {
            width: 56px;
            height: 56px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* Pagination */
        .pagination {
            margin-bottom: 0;
        }

        .page-link {
            border: none;
            color: #64748B;
            padding: 0.5rem 0.75rem;
            margin: 0 0.25rem;
            border-radius: 8px;
            transition: var(--transition);
        }

        .page-link:hover {
            background-color: #F1F5F9;
            color: var(--primary-color);
        }

        .page-item.active .page-link {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            border: none;
        }

        /* Fade-in Animation */
        .fade-in {
            animation: fadeIn 0.5s ease-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* Responsive */
        @media (max-width: 768px) {
            .card-header .d-flex {
                flex-direction: column;
                align-items: flex-start;
                gap: 1rem;
            }

            .card-header .d-flex > div:last-child {
                align-self: flex-end;
            }

            .search-wrapper {
                margin-bottom: 1rem;
            }

            .table-responsive {
                border-radius: 10px;
                border: 1px solid #E2E8F0;
            }

            .table thead {
                display: none;
            }

            .table tbody tr {
                display: block;
                margin-bottom: 1rem;
                border: 1px solid #E2E8F0;
                border-radius: 10px;
                padding: 1rem;
            }

            .table tbody td {
                display: flex;
                justify-content: space-between;
                align-items: center;
                padding: 0.75rem 0;
                border-bottom: 1px solid #F1F5F9;
            }

            .table tbody td:last-child {
                border-bottom: none;
            }

            .table tbody td::before {
                content: attr(data-label);
                font-weight: 600;
                color: #64748B;
                text-transform: uppercase;
                font-size: 0.8rem;
                margin-right: 1rem;
            }

            .table tbody td.text-center {
                justify-content: center;
            }

            .table tbody td.text-end {
                justify-content: space-between;
            }
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('searchInput');
            const clearSearch = document.getElementById('clearSearch');
            const filterStatusItems = document.querySelectorAll('.filter-status');
            const transactionRows = document.querySelectorAll('.transaction-row');

            // Calculate stats
            function calculateStats() {
                let paid = 0, pending = 0, failed = 0;

                transactionRows.forEach(row => {
                    const status = row.getAttribute('data-status');
                    switch(status) {
                        case 'paid': paid++; break;
                        case 'pending': pending++; break;
                        case 'failed': failed++; break;
                    }
                });

                // Update stats cards (you can uncomment these if you add elements for them)
                // document.querySelectorAll('.dashboard-card')[0].querySelector('h4').textContent = paid;
                // document.querySelectorAll('.dashboard-card')[1].querySelector('h4').textContent = pending;
                // document.querySelectorAll('.dashboard-card')[2].querySelector('h4').textContent = failed;
            }

            // Search functionality
            searchInput.addEventListener('keyup', function() {
                const filter = this.value.toLowerCase().trim();
                clearSearch.classList.toggle('d-none', !filter);

                transactionRows.forEach(row => {
                    const searchData = row.getAttribute('data-search');
                    const display = searchData.includes(filter) ? '' : 'none';
                    row.style.display = display;
                });
            });

            // Clear search
            clearSearch.addEventListener('click', function() {
                searchInput.value = '';
                clearSearch.classList.add('d-none');
                transactionRows.forEach(row => {
                    row.style.display = '';
                });
                searchInput.focus();
            });

            // Filter by status
            filterStatusItems.forEach(item => {
                item.addEventListener('click', function(e) {
                    e.preventDefault();
                    const status = this.getAttribute('data-status');

                    // Update active filter
                    filterStatusItems.forEach(i => i.classList.remove('active'));
                    this.classList.add('active');

                    // Update dropdown button text
                    const dropdownBtn = document.querySelector('[data-bs-toggle="dropdown"]');
                    if (status === 'all') {
                        dropdownBtn.innerHTML = '<i class="bi bi-funnel me-2"></i> Filter';
                    } else {
                        dropdownBtn.innerHTML = `<i class="bi bi-funnel me-2"></i> ${this.textContent}`;
                    }

                    // Show/hide rows
                    transactionRows.forEach(row => {
                        const rowStatus = row.getAttribute('data-status');
                        const shouldShow = status === 'all' || rowStatus === status;
                        row.style.display = shouldShow ? '' : 'none';
                    });
                });
            });

            // Initialize
            calculateStats();

            // Add data-labels for mobile responsive
            if (window.innerWidth <= 768) {
                const headers = ['#', 'Transaction Details', 'Bus Information', 'Amount', 'Date & Time', 'Status', 'Actions'];
                transactionRows.forEach(row => {
                    const cells = row.querySelectorAll('td');
                    cells.forEach((cell, index) => {
                        cell.setAttribute('data-label', headers[index]);
                    });
                });
            }
        });
    </script>
@endsection
