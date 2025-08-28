@extends('layout.master')
@section('title','Home | Route')
@section('content')
    <style>
        .table-container {
            max-width: 1100px;
            margin: 40px auto;
            padding: 20px;
            background: #fff;
            border-radius: 15px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        }
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
{{--    filter--}}
    <form action="{{route('route.filter')}}" method="post">
        @csrf
    <div class="d-flex justify-content-between">
        <div>
            <a href="{{route('route.create')}}" class="btn btn-primary" role="button"><i class="bi bi-plus-lg"></i> Add Route</a>
        </div>
        <div>
            <input type="text"  name="route_code" class="form-control" placeholder="Route Code" required>
        </div>
        <div>
            <input type="text"  name="start_location" class="form-control" placeholder="Start Location">
        </div>
        <div>
            <input type="text"  name="end_location" class="form-control" placeholder="End Location">
        </div>
        <div>
            <input type="text"  name="distance" class="form-control" placeholder="Distance">
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
        <th>Route Code</th>
        <th>Start</th>
        <th>End</th>
        <th>Distance (km)</th>
        <th>Estimated Time</th>
        <th>Status</th>
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
        <td>{{$d->route_code}}</td>
        <td>{{$d->start_location}}</td>
        <td>{{$d->end_location}}</td>
        <td>{{$d->distance}}</td>
        <td>{{$d->estemated_time}} hrs</td>
        <td>
            <span class="badge bg-{{$d->status==0?'danger':'success'}}">
                {{$d->status==0?'Inactive':'Active'}}</span>
        </td>
        <td class="text-center d-flex justify-content-center">

            <a class="action-btn edit" title="Edit" href="{{route('route.edit',$d->id)}}"><i class="bi bi-pencil-square"></i></a>
            <form action="{{route('route.destroy',$d->id)}}" method="post">
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
