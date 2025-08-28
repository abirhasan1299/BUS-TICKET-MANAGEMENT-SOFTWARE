@extends('layout.master')
@section('title','Driver | Create')
@section('content')
    <div class="container mt-2">
        <div class="card shadow-lg border-0 rounded-4">

            <div class="card-body p-4">
                <form action="{{ route('driver.update',$data->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row g-4">
                        <!-- Left Column -->
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label class="form-label fw-bold">Driver Code</label>
                                <input type="text" name="driver_code" class="form-control"  readonly id="driver_code" value="{{old('driver_code',$data->driver_code)}}">
                                @error('driver_code')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label class="form-label fw-bold">Govt. ID</label>
                                <input type="text" name="gov_id" class="form-control" placeholder="Enter Govt. ID" value="{{old('gov_id',$data->gov_id)}}" required>
                                @error('gov_id')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label class="form-label fw-bold">Name</label>
                                <input type="text" name="name" class="form-control" placeholder="Enter Full Name" value="{{old('name',$data->name)}}" required>
                                @error('name')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label class="form-label fw-bold">Phone</label>
                                <input type="text" name="phone" class="form-control" placeholder="Enter Phone Number" value="{{old('phone',$data->phone)}}" required>
                                @error('phone')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label class="form-label fw-bold">Email</label>
                                <input type="email" name="email" class="form-control" placeholder="Enter Email (optional)" value="{{old('email',$data->email)}}">
                                @error('email')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label class="form-label fw-bold">City</label>
                                <input type="text" name="city" class="form-control" placeholder="Enter City" value="{{old('city',$data->city)}}">
                                @error('city')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>

                        <!-- Right Column -->
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label class="form-label fw-bold">Postal Code</label>
                                <input type="text" name="postal_code" class="form-control" placeholder="Enter Postal Code" value="{{old('postal_code',$data->postal_code)}}" required>
                                @error('postal_code')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label class="form-label fw-bold">License Number</label>
                                <input type="text" name="license_number" class="form-control" value="{{old('license_number',$data->license_number)}}" placeholder="Enter License Number" required>
                                @error('license_number')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label class="form-label fw-bold">License Expiry Date</label>
                                <input type="date" id="date" placeholder="YY-MM-DD" name="license_expiry_date" value="{{old('license_expiry_date',$data->license_expiry_date)}}" class="form-control">
                                @error('license_expiry_date')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label class="form-label fw-bold">Address</label>
                                <textarea name="address" rows="2" class="form-control" placeholder="Enter Address">{{old('address',$data->address)}}</textarea>
                                @error('address')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label class="form-label fw-bold">Date of Birth</label>
                                <input type="date" placeholder="YY-MM-DD" id="date" name="dob" value="{{old('dob',$data->dob)}}" class="form-control" required>
                                @error('dob')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>

                            <div class="form-group mb-3 ">
                                <label class="form-label fw-bold mt-3">Status</label>
                                <div class="form-check form-check-inline " style="margin-left: 20px;">
                                    <input class="form-check-input" type="radio" name="status" id="activeStatus" value="1" {{old('status',$data->status)==1?'checked':''}}>
                                    <label class="form-check-label" for="activeStatus">Active</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="status" id="inactiveStatus" value="0" {{old('status',$data->status)==0?'checked':''}}>
                                    <label class="form-check-label" for="inactiveStatus">Inactive</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="text-center mt-4">
                        <button type="submit" class="btn btn-success px-4">
                            <i class="bi bi-save me-1"></i> Update Driver
                        </button>
                        <a href="{{ route('driver.index') }}" class="btn btn-secondary px-4 ms-2">
                            <i class="bi bi-arrow-left-circle me-1"></i> Back
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
