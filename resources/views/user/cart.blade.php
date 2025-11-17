
@extends('layout.user')
@section('title','Cart')

@section('content')
        <div class="card shadow-lg border-0 rounded-3">
            <div class="card-header bg-primary text-white py-3">
                <h5 class="mb-0">My Tickets</h5>
            </div>

            <div class="card-body p-0">
                <table class="table table-hover table-striped align-middle mb-0">
                    <thead class="table-light">
                    <tr>
                        <th>SL</th>
                        <th>Ticket</th>
                        <th>Seats</th>
                        <th>Status</th>
                        <th>Amount</th>
                        <th>Purchased At</th>
                        <th>Action</th>
                    </tr>
                    </thead>
@php $count=1; @endphp
                    <tbody>
@foreach($data as $d)

                    <tr>
                        <td>{{$count++}}</td>
                        <td>{{$d->slots->busRoute->start_location}} to {{$d->slots->busRoute->end_location}}</td>
                        <td>{{$d->sit_list}}</td>
                        <td>
                            <span class="badge bg-@php
                             if($d->status=='pending')
                                 {
                                     echo "warning";
                                 }else if($d->status=='paid'){
                                     echo "success";
                                 }else if($d->status=='cancelled'){
                                     echo "danger";
                                 }
                            @endphp"> {{ucfirst($d->status)}} </span>
                        </td>
                        <td>৳ {{ $d->sit_count*($d->slots->price-($d->slots->price*($d->slots->discount/100)))  }}</td>
                        <td>
                            {{ \Carbon\Carbon::parse($d->created_at)->diffForHumans() }}
                        </td>
                        <td>
                            <div class="d-flex">
                                <a href="#" class="btn btn-sm btn-outline-primary"><i class="bi bi-credit-card"></i> Pay</a>

                                <form action="{{route('users.cart.trash',$d->id)}}" method="post" onclick="confirm('Are You Sure ?')">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit"  class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i> Trash</button>
                                </form>
                            </div>

                        </td>
                    </tr>
@endforeach
                    </tbody>
                </table>
            </div>
        </div>
@endsection
