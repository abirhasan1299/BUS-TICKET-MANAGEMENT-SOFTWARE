@extends('layout.master')
@section('title','Create | Slot')
@section('content')
    <style>
#slotForm{
    margin: auto;
    width: 50%;
}
        h2 {
            color: #004a8f;
            margin-bottom: 30px;
            font-weight: 700;
            text-align: center;
        }
        /* Search input inside Select2 dropdown */
        .select2-container .select2-search--dropdown .select2-search__field {
            background-color: #fff;       /* white background */
            color: #495057;               /* standard text color */
            border: 1px solid #ced4da;    /* Bootstrap input border */
            border-radius: 0.25rem;       /* match Bootstrap input radius */
            padding: 0.375rem 0.75rem;    /* match Bootstrap padding */
        }

        /* Optional: remove black outline when focused */
        .select2-container .select2-search--dropdown .select2-search__field:focus {
            border-color: #86b7fe;        /* Bootstrap focus color */
            box-shadow: 0 0 0 0.25rem rgba(13,110,253,.25);
            outline: none;
        }
        /* Increase the height of Select2 input */
        .select2-container--bootstrap5 .select2-selection--single {
            height: 55px;               /* new height */
            padding: 0.5rem 0.75rem;    /* adjust padding for vertical centering */
            border-radius: 0.5rem;      /* optional, bigger radius looks modern */
            border: 1px solid #ced4da;  /* keep Bootstrap style */
            box-shadow: none;
        }


        .form-label {
            font-weight: 600;
            color: #555;
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

    <h2>Add New Slot</h2>
    <form id="slotForm" action="{{route('slot.store')}}" method="POST">
         @csrf
        <div class="row g-3">
            <!-- Route Select -->
            <div class="col-md-6">
                <label for="route_id" class="form-label">Route</label>
                <select class="form-select select2" id="route_id" name="route_id">
                    <option value="">SELECT ROUTE</option>
                    <!-- Example dynamic routes -->
                    @foreach($route as $r)
                    <option value="{{$r->id}}">{{$r->start_location}} to {{$r->end_location}}</option>
                    @endforeach
                </select>
                @error('route_id')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>

            <!-- Bus Select -->
            <div class="col-md-6">
                <label for="bus_id" class="form-label">Bus</label>
                <select class="form-select select2" id="bus_id" name="bus_id">
                    <option value="">Select Bus</option>
                    <!-- Example dynamic buses -->
                    @foreach($bus as $b)
                        <option value="{{$b->id}}">{{$b->bus_name}} - {{$b->bus_code}}</option>
                    @endforeach
                </select>
                @error('bus_id')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>

            <!-- Driver Select -->
            <div class="col-md-6">
                <label for="driver_id" class="form-label">Driver</label>
                <select class="form-select select2" id="driver_id" name="driver_id">
                    <option value="">Select Driver</option>
                    <!-- Example dynamic drivers -->
                    @foreach($driver as $d)
                        <option value="{{$d->id}}">{{$d->name}} - {{$d->driver_code}}</option>
                    @endforeach
                </select>
                @error('driver_id')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>

            <!-- Schedule -->
            <div class="col-md-6">
                <label for="schedule" class="form-label">Schedule</label>
                <input type="text"  placeholder="Select date & time" class="form-control" id="schedule" name="schedule" >
                @error('schedule')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>

            <!-- Price -->
            <div class="col-md-6">
                <label for="price" class="form-label">Price</label>
                <input type="number" class="form-control" id="price" name="price" placeholder="Enter price">
                @error('price')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>

            <!-- Discount -->
            <div class="col-md-6">
                <label for="discount" class="form-label">Discount (%)</label>
                <input type="number" class="form-control" id="discount" name="discount" placeholder="Optional">
                @error('discount')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>

            <!-- Status -->
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
            </div>
        </div>

        <div class="mt-4 d-flex justify-content-center">
            <button type="submit" class="btn btn-primary btn-lg">Save Slot</button>
        </div>
    </form>

@endsection
