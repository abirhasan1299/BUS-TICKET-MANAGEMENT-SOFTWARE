@extends('layout.master')
@section('title','Users')
@section('content')
    <style>
        a{
            text-decoration: none;
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
    @if(session('danger'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Error !</strong> {{session('danger')}}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <a href="{{route('users.create')}}" class="btn btn-primary" role="button"><i class="bi bi-plus-lg"></i> Add User</a>


    {{-- table--}}
    <table class="table table-hover table-striped align-middle mt-5">
        <thead >
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Email</th>
            <th>Role</th>
            <th>Joined</th>
            <th>Forget</th>
            <th class="text-center">Actions</th>
        </tr>
        </thead>
        <tbody>
@forelse($users as $user)
    <tr>
        <td>{{$loop->iteration}}</td>
        <td>{{$user->name}}</td>
        <td>{{$user->email}}</td>
        <td>{{$user->role}}</td>
        <td>
            {{\Carbon\Carbon::parse($user->created_at)->diffForHumans()}}
        </td>
        <td>
            <a href="#" class="btn btn-sm btn-warning">Reset Password</a>
        </td>
        <td>
            <a href="#" class="text-primary me-2" title="Edit">
                <i class="bi bi-pencil-square"></i>
            </a>
            <form action="#" method="POST" class="d-inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-link p-0 text-danger" onclick="return confirm('Are you sure to delete?')" title="Delete">
                    <i class="bi bi-trash-fill"></i>
                </button>
            </form>
        </td>
    </tr>
@empty
    <tr>
        <td class="text-danger text-center" colspan="7">No Data Found</td>
    </tr>
@endforelse
        </tbody>
    </table>



@endsection
