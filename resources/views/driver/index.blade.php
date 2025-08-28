@extends('layout.master')
@section('title','Home | Driver')
@section('content')
    <style>
        .table thead {
            background: linear-gradient(45deg, #007acc, #004a8f);
            color: #fff;
        }
        .table-hover tbody tr:hover {
            background-color: rgba(0, 122, 204, 0.08);
            transition: 0.3s;
        }
        .action-btn {
            border: none;
            background: transparent;
            cursor: pointer;
            font-size: 1.2rem;
            margin: 0 5px;
        }
        .action-btn.view { color: #17a2b8; }
        .action-btn.edit { color: #ffc107; }
        .action-btn.delete { color: #dc3545; }
        .action-btn:hover { transform: scale(1.2); }
        .table-title {
            font-weight: 700;
            font-size: 1.6rem;
            color: #004a8f;
            margin-bottom: 15px;
            text-align: center;
        }
    </style>

    {{--alert--}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Done !</strong> {{session('success')}}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if(session('danger'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Done !</strong> {{session('danger')}}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    {{--    filter--}}
    <form action="{{route('driver.filter')}}" method="post">
        @csrf
        <div class="d-flex justify-content-between">
            <div>
                <a href="{{route('driver.create')}}" class="btn btn-primary" role="button"><i class="bi bi-plus-lg"></i> Add Driver</a>
            </div>
            <div>
                <input type="text"  name="driver_code" class="form-control" placeholder="Driver Code" required>
            </div>
            <div>
                <input type="text" id="date"  name="dob" class="form-control" placeholder="YY-MM-DD">
            </div>
            <div>
                <input type="text"  name="phone" class="form-control" placeholder="Phone Number">
            </div>
            <div>
                <input type="text"  name="license_number" class="form-control" placeholder="License Number">
            </div>
            <div>
                <button type="submit" class="form-control btn btn-success"><i class="bi bi-funnel"></i> Filter</button>
            </div>
        </div>
    </form>

    {{-- table--}}
    <table class="table table-hover align-middle mt-5">
        <thead>
        <tr>
            <th>SL</th>
            <th>Driver Code</th>
            <th>Name</th>
            <th>Phone</th>
            <th>City</th>
            <th>Status</th>
            <th>Exipred License</th>
            <th class="text-center">Actions</th>
        </tr>
        </thead>
        @php
            $count=1;
        @endphp
        <tbody>
        @foreach($data as $d)
            <tr>
                <td>{{$count++}}</td>
                <td>{{$d->driver_code}}</td>
                <td>{{$d->name}}</td>
                <td>{{$d->phone}}</td>
                <td>{{$d->city}}</td>
                <td>
                    <span class="badge bg-{{$d->status==0?'danger':'success'}}">
                {{$d->status==0?'Inactive':'Active'}}</span>
                </td>
                <td>
                    {{\Carbon\Carbon::today()->diffInDays(\Carbon\Carbon::parse($d->license_expiry_date),false)}} Days
                </td>
                <td class="text-center d-flex justify-content-center">

                    <a class="action-btn view" title="Edit" href="{{route('driver.show',$d->id)}}"><i class="bi bi-eye"></i></a>

                    <a class="action-btn edit" title="Edit" href="{{route('driver.edit',$d->id)}}"><i class="bi bi-pencil-square"></i></a>

                    <form action="{{route('driver.destroy',$d->id)}}" method="post" onsubmit="return confirm('Are You Sure ?')">
                        @method('DELETE')
                        @csrf
                        <button type="submit" class="action-btn delete" title="Delete"><i class="bi bi-trash-fill"></i></button>
                    </form>


                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <br>
    <div class="d-flex justify-content-center">
        {{$data->links()}}
    </div>

@endsection
