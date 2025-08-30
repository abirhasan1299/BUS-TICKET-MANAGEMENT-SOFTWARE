@extends('layout.master')
@section('title','Create User')

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="card shadow-lg border-0 rounded-4">
                    <div class="card-header bg-gradient  text-center rounded-top-4"
                         style="background: linear-gradient(135deg, #4b6cb7, #182848);">
                        <h3 class="mb-0 fw-bold">Create New User</h3>
                    </div>
                    <div class="card-body p-4">
                        <form action="{{ route('users.store') }}" method="POST">
                            @csrf

                            {{-- Username --}}
                            <div class="mb-3">
                                <label for="username" class="form-label fw-semibold">Username</label>
                                <input type="text" class="form-control form-control-lg rounded-3 shadow-sm"
                                       id="username" name="name" placeholder="Enter username" required>
                            </div>

                            {{-- Email --}}
                            <div class="mb-3">
                                <label for="email" class="form-label fw-semibold">Email</label>
                                <input type="email" class="form-control form-control-lg rounded-3 shadow-sm"
                                       id="email" name="email" placeholder="Enter email" required>
                            </div>

                            {{-- Password --}}
                            <div class="mb-3">
                                <label for="password" class="form-label fw-semibold">Password</label>
                                <input type="password" class="form-control form-control-lg rounded-3 shadow-sm"
                                       id="password" name="password" placeholder="Enter password" required>
                            </div>

                            {{-- Role --}}
                            <div class="mb-4">
                                <label for="role" class="form-label fw-semibold">Role</label>
                                <select class="form-select form-select-lg rounded-3 shadow-sm"
                                        id="role" name="role" required>
                                    <option value="" disabled selected>-- Select Role --</option>
                                    <option value="Super Admin">Super Admin</option>
                                    <option value="Admin">Admin</option>
                                    <option value="Editor">Editor</option>
                                    <option value="Manager">Manager</option>
                                </select>
                            </div>

                            {{-- Submit Button --}}
                            <div class="d-grid">
                                <button type="submit" class="btn btn-lg text-white fw-bold rounded-3 shadow"
                                        style="background: linear-gradient(135deg, #36d1dc, #5b86e5);
                                           transition: all 0.3s;">
                                    <i class="bi bi-person-plus-fill me-2"></i> Create User
                                </button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>

    {{-- Extra CSS for hover effects --}}
    <style>
        .btn:hover {
            transform: translateY(-2px);
            opacity: 0.9;
        }
    </style>
@endsection
