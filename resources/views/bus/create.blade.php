@extends('layout.master')

@section('title','Create | Bus')

@section('content')
    <style>
        #form{
            width: 80%;
            margin: auto;
        }
        #subtitle{
            margin-left: 50px;
            color:grey;
            font-size: 15px;
        }
    </style>
        <h2 class="fw-bold text-center mb-4">Add New Bus</h2>

    <form action="{{ route('bus.store') }}" method="POST" id="form">
        @csrf

        <div class="row g-4">
            <!-- Left Column -->
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label fw-semibold">Bus Code</label>
                    <input type="text" name="bus_code" class="form-control" value="{{ old('bus_code', $busCode) }}" readonly>
                    @error('bus_code')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Registration Number</label>
                    <input type="text" name="registration_number" class="form-control" placeholder="Enter Registration Number" value="{{ old('registration_number') }}" required>
                    @error('registration_number')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Bus Name</label>
                    <input type="text" name="bus_name" class="form-control" placeholder="Enter Bus Name" value="{{ old('bus_name') }}" required>
                    @error('bus_name')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Bus Owner Info</label>
                    <input type="text" name="bus_owner_info" class="form-control" placeholder="Enter Owner Information" value="{{ old('bus_owner_info') }}" required>
                    @error('bus_owner_info')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold d-block">Type</label>
                    <div class="btn-group" role="group" aria-label="Bus Type">
                        <input type="radio" class="btn-check" name="type" id="typeAC" value="AC" {{ old('type') == 'AC' ? 'checked' : '' }} >
                        <label class="btn btn-outline-primary" for="typeAC">AC</label>

                        <input type="radio" class="btn-check" name="type" id="typeNonAC" value="Non-AC" {{ old('type') == 'Non-AC' ? 'checked' : '' }}>
                        <label class="btn btn-outline-secondary" for="typeNonAC">Non-AC</label>

                        <input type="radio" class="btn-check" name="type" id="typeSleeper" value="Sleeper" {{ old('type') == 'Sleeper' ? 'checked' : '' }}>
                        <label class="btn btn-outline-info" for="typeSleeper">Sleeper</label>
                    </div>
                    @error('type')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Seat Capacity</label>
                    <input type="number" name="seat_capacity" class="form-control" placeholder="Enter Total Seats" value="{{ old('seat_capacity') }}" required>
                    @error('seat_capacity')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Available Seats</label>
                    <input type="number" name="available_seats" class="form-control" placeholder="Enter Available Seats" value="{{ old('available_seats') }}">
                    @error('available_seats')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <!-- Right Column -->
            <div class="col-md-6">
                <!-- Boolean Options -->
                <div class="mb-3">
                    <label class="form-label fw-semibold">WiFi</label><br>
                    <div class="btn-group" role="group">
                        <input type="radio" class="btn-check" name="wifi" id="wifi1" value="1" {{ old('wifi') == '1' ? 'checked' : '' }}>
                        <label class="btn btn-outline-success" for="wifi1">Yes</label>

                        <input type="radio" class="btn-check" name="wifi" id="wifi0" value="0" {{ old('wifi', '0') == '0' ? 'checked' : '' }}>
                        <label class="btn btn-outline-danger" for="wifi0">No</label>
                        <span id="subtitle">Check If Wifi Facilities Exist ?</span>
                    </div>
                    @error('wifi')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">TV</label><br>
                    <div class="btn-group" role="group">
                        <input type="radio" class="btn-check" name="tv" id="tv1" value="1" {{ old('tv') == '1' ? 'checked' : '' }}>
                        <label class="btn btn-outline-success" for="tv1">Yes</label>

                        <input type="radio" class="btn-check" name="tv" id="tv0" value="0" {{ old('tv', '0') == '0' ? 'checked' : '' }}>
                        <label class="btn btn-outline-danger" for="tv0">No</label>
                        <span id="subtitle">Check If Television Facilities Exist ?</span>
                    </div>
                    @error('tv')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">AC</label><br>
                    <div class="btn-group" role="group">
                        <input type="radio" class="btn-check" name="ac" id="ac1" value="1" {{ old('ac') == '1' ? 'checked' : '' }}>
                        <label class="btn btn-outline-success" for="ac1">Yes</label>

                        <input type="radio" class="btn-check" name="ac" id="ac0" value="0" {{ old('ac', '0') == '0' ? 'checked' : '' }}>
                        <label class="btn btn-outline-danger" for="ac0">No</label>
                        <span id="subtitle">Check If Air Condition Facilities Exist ?</span>
                    </div>
                    @error('ac')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Charging Port</label><br>
                    <div class="btn-group" role="group">
                        <input type="radio" class="btn-check" name="charging_port" id="charging1" value="1" {{ old('charging_port') == '1' ? 'checked' : '' }}>
                        <label class="btn btn-outline-success" for="charging1">Yes</label>

                        <input type="radio" class="btn-check" name="charging_port" id="charging0" value="0" {{ old('charging_port', '0') == '0' ? 'checked' : '' }}>
                        <label class="btn btn-outline-danger" for="charging0">No</label>
                        <span id="subtitle">Check If Charging Port Facilities Exist ?</span>
                    </div>
                    @error('charging_port')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Washroom</label><br>
                    <div class="btn-group" role="group">
                        <input type="radio" class="btn-check" name="washroom" id="washroom1" value="1" {{ old('washroom') == '1' ? 'checked' : '' }}>
                        <label class="btn btn-outline-success" for="washroom1">Yes</label>

                        <input type="radio" class="btn-check" name="washroom" id="washroom0" value="0" {{ old('washroom', '0') == '0' ? 'checked' : '' }}>
                        <label class="btn btn-outline-danger" for="washroom0">No</label>
                        <span id="subtitle">Check If Washroom / Toilet Facilities Exist ?</span>
                    </div>
                    @error('washroom')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold d-block">Status</label>
                    <div class="btn-group" role="group" aria-label="Status">
                        <input type="radio" class="btn-check" name="status" id="statusActive" value="active" {{ old('status', 'active') == 'active' ? 'checked' : '' }}>
                        <label class="btn btn-outline-success" for="statusActive">Active</label>

                        <input type="radio" class="btn-check" name="status" id="statusInactive" value="inactive" {{ old('status') == 'inactive' ? 'checked' : '' }}>
                        <label class="btn btn-outline-danger" for="statusInactive">Inactive</label>

                        <input type="radio" class="btn-check" name="status" id="statusMaintenance" value="maintenance" {{ old('status') == 'maintenance' ? 'checked' : '' }}>
                        <label class="btn btn-outline-warning" for="statusMaintenance">Maintenance</label>
                    </div>
                    @error('status')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Fitness Expiry</label>
                    <input type="text" id="date" name="fitness_expiry" class="form-control" placeholder="Select Date" value="{{ old('fitness_expiry') }}">
                    @error('fitness_expiry')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Additional Info</label>
                    <textarea name="additional_info" rows="2" class="form-control" placeholder="Enter any extra details">{{ old('additional_info') }}</textarea>
                    @error('additional_info')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>

        <div class="text-center mt-4">
            <button type="submit" class="btn btn-success px-4">
                <i class="bi bi-save me-1"></i> Save Bus
            </button>
            <a href="{{ route('bus.index') }}" class="btn btn-secondary px-4 ms-2">
                <i class="bi bi-arrow-left-circle me-1"></i> Back
            </a>
        </div>
    </form>



@endsection
