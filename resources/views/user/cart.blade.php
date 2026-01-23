@extends('layout.user')
@section('title','Cart')

@section('content')
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{session('success')}}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>{{session('error')}}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="table-container">
        <div class="table-header">
            <h2 class="table-title">My Tickets</h2>
            <p class="table-subtitle">Manage your ticket purchases and reservations</p>
        </div>

        <div class="table-responsive">
            <table class="modern-table">
                <thead>
                <tr>
                    <th class="text-center">#</th>
                    <th>Ticket Details</th>
                    <th>Seats</th>
                    <th>Status</th>
                    <th>Coupon</th>
                    <th>Purchased</th>
                    <th class="text-center">Actions</th>
                </tr>
                </thead>
                <tbody>
                @php $count=1; @endphp
                @foreach($data as $d)
                    <tr class="table-row">
                        <td class="text-center serial">{{$count++}}</td>

                        <td class="ticket-info">
                            <div class="route-info">
                                <span class="from-location">{{$d->slots->busRoute->start_location}}</span>
                                <i class="bi bi-arrow-right mx-2 text-muted"></i>
                                <span class="to-location">{{$d->slots->busRoute->end_location}}</span>
                            </div>
                        </td>

                        <td class="seats-info">
                            <span class="seat-count">{{$d->sit_count}} seat{{$d->sit_count > 1 ? 's' : ''}}</span>
                            <small class="seat-numbers d-block text-muted">{{$d->sit_list}}</small>
                        </td>

                        <td class="status-cell">
                            @php
                                $statusConfig = [
                                    'pending' => ['class' => 'status-pending', 'icon' => 'bi-clock'],
                                    'purchased' => ['class' => 'status-success', 'icon' => 'bi-check-circle'],
                                    'failed' => ['class' => 'status-failed', 'icon' => 'bi-x-circle'],
                                    'cancelled' => ['class' => 'status-cancelled', 'icon' => 'bi-slash-circle']
                                ];
                                $config = $statusConfig[$d->status] ?? $statusConfig['pending'];
                            @endphp
                            <span class="status-badge {{$config['class']}}">
                                    <i class="bi {{$config['icon']}} me-1"></i>
                                    {{ucfirst($d->status)}}
                                </span>
                        </td>


                        <td class="coupon-cell">
                            @if(!empty($d->coupon))
                                <div class="coupon-info">
                                    <span class="coupon-name">{{$d->coupons->name}}</span>
                                    <span class="coupon-discount">{{$d->coupons->discount}}% </span>
                                </div>
                            @else
                                <span class="no-coupon">No coupon</span>
                            @endif
                        </td>

                        <td class="time-cell">
                            <div class="time-info">
                                <i class="bi bi-calendar3 me-1 text-primary"></i>
                                {{ \Carbon\Carbon::parse($d->created_at)->diffForHumans() }}
                            </div>
                        </td>

                        <td class="actions-cell">
                            @if($d->status == 'purchased')
                                <div class="action-buttons">
                                    <a href="{{route('users.ticket.info',\Illuminate\Support\Facades\Crypt::encrypt($d->id))}}"
                                       class="btn-action btn-download"
                                       title="Download Ticket">
                                        <i class="bi bi-download"></i>
                                        Ticket
                                    </a>
                                    <a href="{{route('feedback.home',\Illuminate\Support\Facades\Crypt::encrypt($d->id))}}"
                                       class="btn-action btn-feedback"
                                       title="Give Feedback">
                                        <i class="bi bi-chat-dots"></i>
                                        Feedback
                                    </a>
                                </div>
                            @endif
                            @if($d->status == 'pending' || $d->status == 'failed')
                                <div class="action-buttons">
                                    <form method="post" action="{{route('payment.pay')}}" class="d-inline">
                                        @csrf
                                        <input type="hidden" name="cart_id" value="{{$d->id}}">
                                        @if(!empty($d->coupon))
                                            <input type="hidden" name="amount" value="{{ $d->sit_count*($d->slots->price-($d->slots->price*(($d->slots->discount+intval($d->coupons->discount))/100)))  }}">
                                        @else
                                            <input type="hidden" name="amount" value="{{ $d->sit_count*($d->slots->price-($d->slots->price*($d->slots->discount/100)))  }}">
                                        @endif
                                        <input type="hidden" name="slot_id" value="{{$d->slots->id}}">
                                        <button type="submit" class="btn-action btn-pay" title="Make Payment">
                                            <i class="bi bi-credit-card"></i>
                                            Pay Now
                                        </button>
                                    </form>

                                    <form action="{{route('users.cart.trash',$d->id)}}" method="post"
                                          onsubmit="return confirm('Are you sure you want to remove this ticket?')"
                                          class="d-inline ms-2">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" class="btn-action btn-delete" title="Remove Ticket">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        @if($data->isEmpty())
            <div class="empty-state">
                <div class="empty-icon">
                    <i class="bi bi-ticket-detailed"></i>
                </div>
                <h3>No Tickets Found</h3>
                <p>You haven't purchased or reserved any tickets yet.</p>
            </div>
        @endif
    </div>

    <div class="pagination-container">
        {{$data->links()}}
    </div>

    <style>
        .table-container {
            background: #fff;
            border-radius: 16px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            overflow: hidden;
            margin-bottom: 2rem;
        }

        .table-header {
            padding: 24px 32px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }

        .table-title {
            font-size: 1.75rem;
            font-weight: 600;
            margin: 0;
        }

        .table-subtitle {
            opacity: 0.9;
            margin: 8px 0 0 0;
            font-size: 0.95rem;
        }

        .table-responsive {
            overflow-x: auto;
        }

        .modern-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
        }

        .modern-table thead {
            background-color: #f8fafc;
        }

        .modern-table thead th {
            padding: 20px 16px;
            font-weight: 600;
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: #64748b;
            border-bottom: 2px solid #e2e8f0;
            white-space: nowrap;
        }

        .table-row {
            transition: all 0.2s ease;
            border-bottom: 1px solid #f1f5f9;
        }

        .table-row:hover {
            background-color: #f8fafc;
            transform: translateY(-1px);
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        }

        .modern-table tbody td {
            padding: 20px 16px;
            vertical-align: middle;
        }

        .serial {
            font-weight: 600;
            color: #475569;
            font-size: 0.95rem;
        }

        .ticket-info .route-info {
            font-weight: 500;
            color: #1e293b;
            display: flex;
            align-items: center;
        }

        .from-location, .to-location {
            padding: 4px 8px;
            background: #f1f5f9;
            border-radius: 6px;
        }

        .seats-info .seat-count {
            font-weight: 500;
            color: #334155;
        }

        .seat-numbers {
            font-size: 0.8rem;
            margin-top: 4px;
        }

        .status-badge {
            display: inline-flex;
            align-items: center;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 500;
            white-space: nowrap;
        }

        .status-pending {
            background-color: #fef3c7;
            color: #92400e;
            border: 1px solid #fbbf24;
        }

        .status-success {
            background-color: #d1fae5;
            color: #065f46;
            border: 1px solid #10b981;
        }

        .status-failed {
            background-color: #fee2e2;
            color: #991b1b;
            border: 1px solid #ef4444;
        }

        .status-cancelled {
            background-color: #f1f5f9;
            color: #475569;
            border: 1px solid #cbd5e1;
        }

        .amount-display .amount {
            font-weight: 600;
            color: #0f172a;
            font-size: 1.1rem;
        }

        .coupon-info {
            display: flex;
            flex-direction: column;
            gap: 4px;
        }

        .coupon-name {
            font-size: 0.85rem;
            color: #475569;
        }

        .coupon-discount {
            background: #10b981;
            color: white;
            padding: 2px 8px;
            border-radius: 12px;
            font-size: 0.75rem;
            font-weight: 500;
            display: inline-block;
            width: fit-content;
        }

        .no-coupon {
            color: #94a3b8;
            font-style: italic;
            font-size: 0.9rem;
        }

        .time-info {
            display: flex;
            align-items: center;
            color: #64748b;
            font-size: 0.9rem;
        }

        .actions-cell {
            min-width: 200px;
        }

        .action-buttons {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .btn-action {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 8px 16px;
            border-radius: 8px;
            font-size: 0.85rem;
            font-weight: 500;
            text-decoration: none;
            transition: all 0.2s ease;
            border: none;
            cursor: pointer;
        }

        .btn-download {
            background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
            color: white;
        }

        .btn-download:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
        }

        .btn-feedback {
            background: #f1f5f9;
            color: #475569;
            border: 1px solid #cbd5e1;
        }

        .btn-feedback:hover {
            background: #e2e8f0;
            transform: translateY(-1px);
        }

        .btn-pay {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            color: white;
        }

        .btn-pay:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
        }

        .btn-delete {
            background: #fef2f2;
            color: #ef4444;
            padding: 8px 12px;
        }

        .btn-delete:hover {
            background: #fee2e2;
            transform: translateY(-1px);
        }

        .empty-state {
            padding: 60px 20px;
            text-align: center;
            color: #64748b;
        }

        .empty-icon {
            font-size: 4rem;
            color: #cbd5e1;
            margin-bottom: 1rem;
        }

        .empty-state h3 {
            color: #475569;
            margin-bottom: 0.5rem;
        }

        .pagination-container {
            display: flex;
            justify-content: center;
            padding: 20px 0;
        }

        @media (max-width: 768px) {
            .table-header {
                padding: 20px 24px;
            }

            .table-title {
                font-size: 1.5rem;
            }

            .modern-table thead {
                display: none;
            }

            .table-row {
                display: block;
                margin-bottom: 20px;
                padding: 20px;
                background: white;
                border-radius: 12px;
                box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
            }

            .modern-table tbody td {
                display: flex;
                justify-content: space-between;
                align-items: center;
                padding: 12px 0;
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
            }

            .actions-cell {
                padding-top: 16px;
                border-top: 2px solid #f1f5f9;
            }

            .action-buttons {
                flex-wrap: wrap;
                justify-content: center;
            }
        }
    </style>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
            integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
            crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
            integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
            crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
            integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
            crossorigin="anonymous"></script>

    <!-- If you want to use the popup integration, -->
    <script>
        var obj = {};

        $('#sslczPayBtn').prop('postdata', obj);

        (function (window, document) {
            var loader = function () {
                var script = document.createElement("script"), tag = document.getElementsByTagName("script")[0];
                // script.src = "https://seamless-epay.sslcommerz.com/embed.min.js?" + Math.random().toString(36).substring(7); // USE THIS FOR LIVE
                script.src = "https://sandbox.sslcommerz.com/embed.min.js?" + Math.random().toString(36).substring(7); // USE THIS FOR SANDBOX
                tag.parentNode.insertBefore(script, tag);
            };

            window.addEventListener ? window.addEventListener("load", loader, false) : window.attachEvent("onload", loader);
        })(window, document);

        // Add mobile responsiveness for table cells
        document.addEventListener('DOMContentLoaded', function() {
            if (window.innerWidth <= 768) {
                const headers = document.querySelectorAll('.modern-table thead th');
                const cells = document.querySelectorAll('.modern-table tbody td');

                headers.forEach((header, index) => {
                    const label = header.textContent;
                    cells.forEach(cell => {
                        if (cell.cellIndex === index) {
                            cell.setAttribute('data-label', label);
                        }
                    });
                });
            }
        });
    </script>
@endsection
