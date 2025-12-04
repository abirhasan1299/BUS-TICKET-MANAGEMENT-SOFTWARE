@extends('layout.user')
@section('title','Payment')

@section('content')
    <div class="payment-container">
        <!-- Header Section -->
        <div class="payment-header">
            <div class="header-content">
                <h1 class="header-title">
                    <i class="bi bi-credit-card-2-front"></i>
                    Payment Transactions
                </h1>
                <p class="header-subtitle">Track and manage all your bus ticket payments in one place</p>
            </div>
            <div class="header-stats">
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="bi bi-cash-stack"></i>
                    </div>
                    <div class="stat-content">
                        <span class="stat-value">{{ $data->count() }}</span>
                        <span class="stat-label">Total Transactions</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Search and Filter Section -->
        <div class="filter-section">
            <div class="search-wrapper">
                <i class="bi bi-search search-icon"></i>
                <input type="text"
                       id="searchInput"
                       class="search-input"
                       placeholder="Search by Transaction ID, Bus Name, Seat, or Status..."
                       aria-label="Search transactions">
                <button class="search-clear" id="clearSearch" title="Clear search">
                    <i class="bi bi-x-lg"></i>
                </button>
            </div>

            <div class="filter-options">
                <div class="dropdown">
                    <button class="filter-btn" type="button" id="statusFilter" data-bs-toggle="dropdown">
                        <i class="bi bi-funnel"></i>
                        Filter by Status
                        <i class="bi bi-chevron-down ms-2"></i>
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item filter-status" href="#" data-status="all">All Statuses</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item filter-status" href="#" data-status="paid">Paid</a></li>
                        <li><a class="dropdown-item filter-status" href="#" data-status="pending">Pending</a></li>
                        <li><a class="dropdown-item filter-status" href="#" data-status="failed">Failed</a></li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Transactions Table -->
        <div class="transactions-table">
            <div class="table-responsive">
                <table class="modern-table" id="paymentTable">
                    <thead>
                    <tr>
                        <th class="text-center">#</th>
                        <th>Transaction Details</th>
                        <th>Bus Information</th>
                        <th>Amount</th>
                        <th>Date & Time</th>
                        <th>Status</th>
                        <th class="text-center">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @php $count = 1; @endphp
                    @foreach($data as $d)
                        <tr class="transaction-row"
                            data-status="{{ strtolower($d->status) }}"
                            data-search="{{ strtolower($d->transaction_id . ' ' . $d->slots->busInfo->bus_name) }}">
                            <td class="text-center serial">{{ $count++ }}</td>

                            <td class="transaction-info">
                                <div class="transaction-id">TXN#{{ $d->transaction_id }}</div>
                                <div class="transaction-meta">
                                    <span class="meta-item">
                                        <i class="bi bi-calendar3 me-1"></i>
                                        {{ $d->created_at->format('M d, Y') }}
                                    </span>
                                </div>
                            </td>

                            <td class="bus-info">
                                <div class="bus-name">{{ $d->slots->busInfo->bus_name }}</div>
                                <div class="bus-meta">
                                    <span class="meta-item">
                                        <i class="bi bi-geo-alt me-1"></i>
                                        {{ $d->slots->busRoute->start_location }} → {{ $d->slots->busRoute->end_location }}
                                    </span>
                                </div>
                            </td>

                            <td class="amount-info">
                                <div class="amount-display">
                                    <span class="currency">BDT</span>
                                    <span class="amount">{{ number_format($d->amount, 2) }}</span>
                                </div>
                            </td>

                            <td class="datetime-info">
                                <div class="date-display">
                                    {{ $d->created_at->format('d M Y') }}
                                </div>
                                <div class="time-display">
                                    <i class="bi bi-clock me-1"></i>
                                    {{ $d->created_at->format('h:i A') }}
                                </div>
                            </td>

                            <td class="status-cell">
                                @php
                                    $statusConfig = [
                                        'paid' => ['class' => 'status-paid', 'icon' => 'bi-check-circle', 'label' => 'Paid'],
                                        'pending' => ['class' => 'status-pending', 'icon' => 'bi-clock', 'label' => 'Pending'],
                                        'failed' => ['class' => 'status-failed', 'icon' => 'bi-x-circle', 'label' => 'Failed'],
                                    ];
                                    $config = $statusConfig[$d->status] ?? ['class' => 'status-unknown', 'icon' => 'bi-question-circle', 'label' => 'Unknown'];
                                @endphp
                                <span class="status-badge {{ $config['class'] }}">
                                    <i class="bi {{ $config['icon'] }} me-1"></i>
                                    {{ $config['label'] }}
                                </span>
                            </td>

                            <td class="actions-cell text-center">
                                <div class="action-menu">
                                    <a role="button" href="#" class="btn-action view-details"
                                            title="View Details">
                                        <i class="bi bi-eye"></i>
                                    </a>

                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

            @if($data->isEmpty())
                <div class="empty-state">
                    <div class="empty-icon">
                        <i class="bi bi-receipt-cutoff"></i>
                    </div>
                    <h3>No Payment History</h3>
                    <p>You haven't made any payments yet. Book a ticket to see transactions here.</p>
                </div>
            @endif
        </div>

        <!-- Pagination -->
        @if($data->hasPages())
            <div class="pagination-section">
                <div class="pagination-info">
                    Showing {{ $data->firstItem() ?? 0 }} to {{ $data->lastItem() ?? 0 }} of {{ $data->total() }} entries
                </div>
                <div class="pagination-links">
                    {{ $data->links() }}
                </div>
            </div>
        @endif
    </div>

    <style>
        .payment-container {
            background: #fff;
            border-radius: 24px;
            overflow: hidden;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.08);
            margin-bottom: 2rem;
        }

        .payment-header {
            background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
            color: white;
            padding: 40px 32px;
            position: relative;
            overflow: hidden;
        }

        .payment-header::before {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            width: 300px;
            height: 300px;
            background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, rgba(255,255,255,0) 70%);
            border-radius: 50%;
            transform: translate(30%, -30%);
        }

        .header-content {
            position: relative;
            z-index: 2;
        }

        .header-title {
            font-size: 2.25rem;
            font-weight: 700;
            margin: 0 0 12px 0;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .header-title i {
            font-size: 2rem;
            color: rgba(255, 255, 255, 0.9);
        }

        .header-subtitle {
            font-size: 1.1rem;
            opacity: 0.9;
            margin: 0;
        }

        .header-stats {
            position: absolute;
            bottom: -25px;
            right: 32px;
            z-index: 2;
        }

        .stat-card {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 16px;
            padding: 20px;
            min-width: 180px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .stat-icon {
            background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
            width: 50px;
            height: 50px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.5rem;
        }

        .stat-content {
            display: flex;
            flex-direction: column;
        }

        .stat-value {
            font-size: 1.75rem;
            font-weight: 700;
            color: #1e293b;
            line-height: 1;
        }

        .stat-label {
            font-size: 0.85rem;
            color: #64748b;
            margin-top: 4px;
        }

        .filter-section {
            padding: 32px;
            background: #f8fafc;
            border-bottom: 1px solid #e2e8f0;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 20px;
            flex-wrap: wrap;
        }

        .search-wrapper {
            flex: 1;
            min-width: 300px;
            position: relative;
        }

        .search-input {
            width: 100%;
            padding: 16px 52px 16px 48px;
            border: 2px solid #e2e8f0;
            border-radius: 12px;
            font-size: 1rem;
            background: white;
            transition: all 0.3s ease;
        }

        .search-input:focus {
            outline: none;
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }

        .search-icon {
            position: absolute;
            left: 16px;
            top: 50%;
            transform: translateY(-50%);
            color: #94a3b8;
            font-size: 1.1rem;
        }

        .search-clear {
            position: absolute;
            right: 16px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: #94a3b8;
            cursor: pointer;
            padding: 4px;
            border-radius: 4px;
            transition: all 0.2s ease;
        }

        .search-clear:hover {
            color: #64748b;
            background: #f1f5f9;
        }

        .filter-options {
            display: flex;
            gap: 12px;
        }

        .filter-btn {
            background: white;
            border: 2px solid #e2e8f0;
            padding: 14px 20px;
            border-radius: 12px;
            font-weight: 500;
            color: #475569;
            display: flex;
            align-items: center;
            transition: all 0.2s ease;
            cursor: pointer;
        }

        .filter-btn:hover {
            border-color: #cbd5e1;
            background: #f8fafc;
        }

        .transactions-table {
            padding: 0;
        }

        .modern-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
        }

        .modern-table thead {
            background: #f8fafc;
        }

        .modern-table thead th {
            padding: 20px 24px;
            font-weight: 600;
            color: #475569;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            border-bottom: 2px solid #e2e8f0;
            white-space: nowrap;
        }

        .transaction-row {
            border-bottom: 1px solid #f1f5f9;
            transition: all 0.2s ease;
        }

        .transaction-row:hover {
            background: #f8fafc;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        }

        .modern-table tbody td {
            padding: 24px;
            vertical-align: middle;
        }

        .serial {
            font-weight: 600;
            color: #475569;
            font-size: 1rem;
        }

        .transaction-info .transaction-id {
            font-weight: 600;
            color: #1e293b;
            font-size: 1rem;
            margin-bottom: 6px;
        }

        .transaction-meta {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
        }

        .meta-item {
            font-size: 0.85rem;
            color: #64748b;
            display: flex;
            align-items: center;
        }

        .bus-info .bus-name {
            font-weight: 600;
            color: #334155;
            margin-bottom: 6px;
        }

        .bus-meta {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
        }

        .amount-info .amount-display {
            display: flex;
            align-items: baseline;
            gap: 4px;
        }

        .currency {
            font-size: 0.9rem;
            color: #64748b;
            font-weight: 500;
        }

        .amount {
            font-size: 1.25rem;
            font-weight: 700;
            color: #1e293b;
        }

        .datetime-info .date-display {
            font-weight: 500;
            color: #334155;
            margin-bottom: 4px;
        }

        .time-display {
            font-size: 0.85rem;
            color: #64748b;
            display: flex;
            align-items: center;
        }

        .status-badge {
            display: inline-flex;
            align-items: center;
            padding: 8px 16px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 500;
            white-space: nowrap;
            border: 1px solid transparent;
        }

        .status-paid {
            background: linear-gradient(135deg, #d1fae5 0%, #a7f3d0 100%);
            color: #065f46;
            border-color: #10b981;
        }

        .status-pending {
            background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%);
            color: #92400e;
            border-color: #f59e0b;
        }

        .status-failed {
            background: linear-gradient(135deg, #fee2e2 0%, #fecaca 100%);
            color: #991b1b;
            border-color: #ef4444;
        }

        .status-unknown {
            background: #f1f5f9;
            color: #475569;
            border-color: #cbd5e1;
        }

        .action-menu {
            display: flex;
            justify-content: center;
            gap: 8px;
        }

        .btn-action {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            border: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.2s ease;
            background: #f1f5f9;
            color: #475569;
            font-size: 1.1rem;
        }

        .btn-action:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .view-details:hover {
            background: #3b82f6;
            color: white;
        }

        .download-receipt:hover {
            background: #10b981;
            color: white;
        }

        .empty-state {
            padding: 80px 20px;
            text-align: center;
            color: #64748b;
        }

        .empty-icon {
            font-size: 4rem;
            color: #cbd5e1;
            margin-bottom: 1.5rem;
        }

        .empty-state h3 {
            color: #475569;
            margin-bottom: 0.75rem;
            font-size: 1.5rem;
        }

        .empty-state p {
            max-width: 400px;
            margin: 0 auto;
            line-height: 1.6;
        }

        .pagination-section {
            padding: 24px 32px;
            border-top: 1px solid #e2e8f0;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 16px;
        }

        .pagination-info {
            color: #64748b;
            font-size: 0.9rem;
        }

        .pagination-links {
            display: flex;
            justify-content: center;
        }

        @media (max-width: 768px) {
            .payment-header {
                padding: 30px 24px;
                text-align: center;
            }

            .header-title {
                font-size: 1.75rem;
                justify-content: center;
            }

            .header-stats {
                position: relative;
                bottom: auto;
                right: auto;
                margin-top: 30px;
                display: flex;
                justify-content: center;
            }

            .filter-section {
                padding: 24px;
                flex-direction: column;
            }

            .search-wrapper {
                min-width: 100%;
            }

            .modern-table thead {
                display: none;
            }

            .transaction-row {
                display: block;
                margin: 20px 24px;
                padding: 20px;
                background: white;
                border-radius: 16px;
                box-shadow: 0 4px 16px rgba(0, 0, 0, 0.08);
            }

            .modern-table tbody td {
                display: flex;
                justify-content: space-between;
                align-items: center;
                padding: 16px 0;
                border-bottom: 1px solid #f1f5f9;
            }

            .modern-table tbody td:before {
                content: attr(data-label);
                font-weight: 600;
                color: #64748b;
                font-size: 0.85rem;
                text-transform: uppercase;
            }

            .modern-table tbody td:last-child {
                border-bottom: none;
                padding-top: 20px;
                border-top: 2px solid #f1f5f9;
            }

            .pagination-section {
                flex-direction: column;
                text-align: center;
            }
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('searchInput');
            const clearSearch = document.getElementById('clearSearch');
            const filterStatusItems = document.querySelectorAll('.filter-status');
            const transactionRows = document.querySelectorAll('.transaction-row');

            // Search functionality
            searchInput.addEventListener('keyup', function() {
                const filter = this.value.toLowerCase();
                clearSearch.style.display = filter ? 'block' : 'none';

                transactionRows.forEach(row => {
                    const searchData = row.getAttribute('data-search');
                    const display = searchData.includes(filter) ? '' : 'none';
                    row.style.display = display;
                });
            });

            // Clear search
            clearSearch.addEventListener('click', function() {
                searchInput.value = '';
                clearSearch.style.display = 'none';
                transactionRows.forEach(row => {
                    row.style.display = '';
                });
            });

            // Filter by status
            filterStatusItems.forEach(item => {
                item.addEventListener('click', function(e) {
                    e.preventDefault();
                    const status = this.getAttribute('data-status');

                    // Update active filter
                    filterStatusItems.forEach(i => i.classList.remove('active'));
                    this.classList.add('active');

                    transactionRows.forEach(row => {
                        const rowStatus = row.getAttribute('data-status');
                        const shouldShow = status === 'all' || rowStatus === status;
                        row.style.display = shouldShow ? '' : 'none';
                    });
                });
            });




        });
    </script>
@endsection
