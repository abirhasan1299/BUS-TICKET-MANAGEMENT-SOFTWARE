
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
                                 }else if($d->status=='purchased'){
                                     echo "success";
                                 }else if($d->status=='failed'){
                                     echo "danger";
                                 }else if($d->status=='cancelled'){
                                     echo "secondary";
                                 }
                            @endphp"> {{ucfirst($d->status)}} </span>
                            </td>
                            <td>৳ {{ $d->sit_count*($d->slots->price-($d->slots->price*($d->slots->discount/100)))  }}</td>
                            <td>
                                {{ \Carbon\Carbon::parse($d->created_at)->diffForHumans() }}
                            </td>
                            <td>
                                @if($d->status=='purchased')
                                    <a href="#" role="button" class="btn btn-sm btn-primary"><i class="bi bi-download"></i>   Ticket</a>
                                @endif
                                @if($d->status=='pending' || $d->status=='failed')
                                        <div class="d-flex justify-content-start">

                                            <form method="post" action="{{route('payment.pay')}}">
                                                @csrf
                                                <input type="hidden" name="cart_id" value="{{$d->id}}">
                                                <input type="hidden" name="slot_id" value="{{$d->slots->id}}">
                                                <input type="hidden" name="amount" value="{{ $d->sit_count*($d->slots->price-($d->slots->price*($d->slots->discount/100)))  }}">

                                                <button class="btn btn-sm btn-primary" type="submit"><i class="bi bi-credit-card"></i>  </button>
                                            </form>

                                            <form style="margin-left: 5px;" action="{{route('users.cart.trash',$d->id)}}" method="post" onclick="confirm('Are You Sure ?')">
                                                @method('DELETE')
                                                @csrf
                                                <button type="submit"  class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i> </button>
                                            </form>
                                        </div>
                                @endif


                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
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
        </script>
@endsection
