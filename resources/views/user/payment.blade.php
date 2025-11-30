@extends('layout.user')
@section('title','Payment')
@section('content')

    <style>
        body {
            background: #f5f7fa;
            font-family: 'Segoe UI', sans-serif;
        }
        .table-card {
            background: #ffffff;
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.08);
        }
        .table thead th {
            background: #1e3c72;
            color: #fff;
            border: none;
        }
        .search-box {
            background: #ffffff;
            border-radius: 14px;
            padding: 12px 18px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.06);
        }
    </style>
</head>
<body>
<div class="container py-5">
    <h2 class="fw-bold text-center mb-4">🚌 Bus Ticket Payment Information</h2>

    <!-- Search Box -->
    <div class="search-box mb-4">
        <input type="text" id="searchInput" class="form-control" placeholder="Search transactions (Name, Transaction ID, Bus Name, Seat)..." />
    </div>

    <!-- Table Card -->
    <div class="table-card">
        <table class="table table-hover" id="paymentTable">
            <thead>
            <tr>
                <th>SL</th>
                <th>Transaction ID</th>
                <th>Bus Name</th>
                <th>Amount</th>
                <th>Date</th>
                <th>Status</th>
            </tr>
            </thead>
            <tbody>
                @php
                    $count=1;
                @endphp
            @foreach($data as $d)
            <tr>
                <td>{{ $count++ }}</td>
                <td>TXN#{{$d->transaction_id}}</td>
                <td> {{ $d->slots->busInfo->bus_name }} </td>
                <td>BDT {{ $d->amount }}</td>
                <td>{{ $d->created_at->format('d-m-Y') }}</td>
                <td>
                    @php
                        if($d->status == 'paid'){
                            echo '<span class="badge bg-success">Paid</span>';
                        }else if ($d->status=='pending'){
                            echo '<span class="badge bg-warning text-dark">Pending</span>';
                        }else if($d->status=='failed'){
                            echo '<span class="badge bg-danger">Failed</span>';
                        }else {
                            echo '<span class="badge bg-secondary">Something Wrong</span>';
                        }
                    @endphp

                </td>
            </tr>
            @endforeach
            </tbody>

        </table>
        {{$data->links()}}
    </div>
</div>

<script>
    // Search filter
    document.getElementById('searchInput').addEventListener('keyup', function () {
        let filter = this.value.toLowerCase();
        let rows = document.querySelectorAll('#paymentTable tbody tr');

        rows.forEach(row => {
            let text = row.innerText.toLowerCase();
            row.style.display = text.includes(filter) ? '' : 'none';
        });
    });
</script>

@endsection
