@extends('layout.master')
@section('title','Create | Routes')
@section('content')

    <style>
        body {
            background: #f5f7fa;
            font-family: 'Segoe UI', sans-serif;
        }
        #routeForm{
            width: 60%;
            margin: auto;
        }
        .form-title {
            text-align: center;
            margin-bottom: 25px;
            font-weight: 700;
            color: #004a8f;
        }
        .btn-primary {
            background: linear-gradient(45deg, #007acc, #004a8f);
            border: none;
        }
        .btn-primary:hover {
            background: linear-gradient(45deg, #004a8f, #007acc);
        }
        .form-check-input:checked {
            background-color: #007acc;
            border-color: #007acc;
        }
    </style>

    <h2 class="form-title  mt-4">Add New Route</h2>
    <form id="routeForm" method="post" action="{{route('route.store')}}" autocomplete="off" >
        @csrf
        <div class="row g-3">
            <div class="col-md-6">
                <label for="routeCode" class="form-label">Route Code</label>
                <input type="text" class="form-control" name="route_code"  readonly value="{{$code}}" >
                @error('route_code')
                    <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
            <div class="col-md-6">
                <label for="startLocation" class="form-label">Start Location</label>
                <input type="text" class="form-control" name="start_location" placeholder="e.g., Dhaka" value="{{old('start_location')}}">
                @error('start_location')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
            <div class="col-md-6">
                <label for="endLocation" class="form-label">End Location</label>
                <input type="text" class="form-control" name="end_location" placeholder="e.g., Chittagong" value="{{old('end_location')}}">
                @error('end_location')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
            <div class="col-md-6">
                <label for="distance" class="form-label">Distance (km)</label>
                <input type="number" class="form-control" name="distance" placeholder="e.g., 250" min="0" step="0.1" value="{{old('distance')}}">
                @error('distance')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
            <div class="col-md-6">
                <label for="estimatedTime" class="form-label">Estimated Time</label>
                <input type="text" class="form-control"  name="estemated_time" placeholder="e.g., 06:30 hrs" value="{{old('estemated_time')}}">
                @error('estemated_time')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
            <div class="col-md-6">
                <label class="form-label d-block">Status</label>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="status" id="activeStatus" value="1" checked>
                    <label class="form-check-label" for="activeStatus">Active</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="status" id="inactiveStatus" value="0">
                    <label class="form-check-label" for="inactiveStatus">Inactive</label>
                </div>
                @error('status')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
        </div>
        <div class="d-flex justify-content-start mt-4">
            <button type="submit" class="btn btn-primary">Save Route</button>
        </div>
    </form>
@endsection
