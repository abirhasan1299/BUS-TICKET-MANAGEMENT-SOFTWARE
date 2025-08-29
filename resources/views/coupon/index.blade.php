@extends('layout.master')
@section('title','Coupon')
@section('content')
    {{--alert--}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Done !</strong> {{session('success')}}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if(session('danger'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Sorry !</strong> {{session('danger')}}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <form action="{{route('coupon.filter')}}" method="post" autocomplete="off">
        @csrf
    <div class="d-flex justify-content-between">
        <div>
            <a href="{{route('coupon.create')}}" class="btn btn-primary" role="button"><i class="bi bi-plus-lg"></i> Add Coupon</a>
        </div>
        <div>
            <input type="text" name="name" class="form-control" placeholder="Coupon Name" required>
        </div>
        <div>
            <input type="text" name="coupon_code" class="form-control" placeholder="Coupon Code">
        </div>
        <div>
            <input type="text" name="date" id="date" class="form-control" placeholder="Search by Date">
        </div>
        <div>
            <button type="submit" class="btn btn-success"><i class="bi bi-funnel"></i> Filter</button>
        </div>
    </div>
    </form>
          @csrf
    <table class="table table-hover align-middle mt-5">
        <thead>
        <tr>
            <th>SL</th>
            <th>Coupon Name</th>
            <th>Code</th>
            <th>Uses</th>
            <th>Exipre Date</th>
            <th>Status</th>
            <th class="text-center">Actions</th>
        </tr>
        </thead>

        <tbody>
@forelse($data as $d)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$d->name}}</td>
                <td>{{$d->coupon_code}}</td>
                <td>{{$d->count}}</td>
                <td>{{\Carbon\Carbon::parse($d->expire)->format('d M, Y')}}</td>
                <td>
                    <span class="badge bg-{{$d->status=='1'?'success':'danger'}}">
                        {{$d->status=='1'?'Active':'Inactive'}}
                    </span>
                </td>

                <td class="text-center d-flex justify-content-center">
                    <form action="{{route('coupon.destroy',$d->id)}}" method="post" onsubmit="return confirm('Are You Sure ?')">
                        @method('DELETE')
                        @csrf
                        <button type="submit" class="btn btn-sm btn-danger text-white" title="Delete"><i class="bi bi-trash-fill"></i></button>
                    </form>
                </td>
            </tr>
@empty
    <tr >
        <td colspan="7" class="text-center text-danger">No Data Found</td>
    </tr>
@endforelse
        </tbody>
    </table>
    <br>
    <div class="d-flex justify-content-end">
        {{$data->links()}}
    </div>
@endsection
