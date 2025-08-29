@extends('layout.master')
@section('title','Coupon Filter')
@section('content')

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
        @forelse($model as $d)
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

@endsection
