@extends('layout.master')
@section('title', 'Edit Slot')
@section('page-title', 'Edit Slot')
@section('breadcrumb', 'Update Slot Details')

@section('action-buttons')
    <a href="{{ route('slot.index') }}" class="btn btn-outline-secondary">
        <i class="bi bi-arrow-left me-1"></i> Back to Slots
    </a>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="dashboard-card">
                <!-- Form Header -->
                <div class="card-header border-0 bg-transparent p-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="mb-0 fw-bold">Update Ticket Slot</h5>
                            <p class="text-muted mb-0">Modify slot details and schedule information</p>
                        </div>
                        <div class="badge bg-primary bg-opacity-10 text-primary px-3 py-2">
                            <i class="bi bi-ticket-perforated me-1"></i> SLOT#{{ $data->slot_code }}
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <form action="{{ route('slot.update', $data->id) }}" method="POST" id="slotForm">
                        @csrf
                        @method('PUT')

                        <div class="row g-4">
                            <!-- Route Selection -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label fw-semibold">Route <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                    <span class="input-group-text bg-light">
                                        <i class="bi bi-sign-turn-right text-primary"></i>
                                    </span>
                                        <select class="form-select select2 @error('route_id') is-invalid @enderror"
                                                id="route_id"
                                                name="route_id"
                                                required>
                                            <option value="">SELECT ROUTE</option>
                                            @foreach($route as $r)
                                                <option value="{{ $r->id }}"
                                                        {{ $data->route_id == $r->id ? 'selected' : '' }}
                                                        data-distance="{{ $r->distance }}"
                                                        data-estimated="{{ $r->estemated_time }}">
                                                    {{ $r->start_location }} → {{ $r->end_location }} ({{ $r->route_code }})
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('route_id')
                                    <div class="invalid-feedback d-block">
                                        <i class="bi bi-exclamation-circle me-1"></i> {{ $message }}
                                    </div>
                                    @enderror
                                    <div class="form-text text-muted small">
                                        <i class="bi bi-info-circle me-1"></i> Select the route for this slot
                                    </div>
                                </div>
                            </div>

                            <!-- Bus Selection -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label fw-semibold">Bus <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                    <span class="input-group-text bg-light">
                                        <i class="bi bi-bus-front text-primary"></i>
                                    </span>
                                        <select class="form-select select2 @error('bus_id') is-invalid @enderror"
                                                id="bus_id"
                                                name="bus_id"
                                                required>
                                            <option value="">SELECT BUS</option>
                                            @foreach($bus as $b)
                                                <option value="{{ $b->id }}"
                                                        {{ $data->bus_id == $b->id ? 'selected' : '' }}
                                                        data-capacity="{{ $b->seat_capacity }}"
                                                        data-type="{{ $b->type }}">
                                                    {{ $b->bus_name }} - {{ $b->bus_code }} ({{ $b->type }})
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('bus_id')
                                    <div class="invalid-feedback d-block">
                                        <i class="bi bi-exclamation-circle me-1"></i> {{ $message }}
                                    </div>
                                    @enderror
                                    <div class="form-text text-muted small">
                                        <i class="bi bi-info-circle me-1"></i> Select the bus for this journey
                                    </div>
                                </div>
                            </div>

                            <!-- Driver Selection -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label fw-semibold">Driver <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                    <span class="input-group-text bg-light">
                                        <i class="bi bi-person-badge text-primary"></i>
                                    </span>
                                        <select class="form-select select2 @error('driver_id') is-invalid @enderror"
                                                id="driver_id"
                                                name="driver_id"
                                                required>
                                            <option value="">SELECT DRIVER</option>
                                            @foreach($driver as $d)
                                                <option value="{{ $d->id }}"
                                                    {{ $data->driver_id == $d->id ? 'selected' : '' }}>
                                                    {{ $d->name }} - {{ $d->driver_code }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('driver_id')
                                    <div class="invalid-feedback d-block">
                                        <i class="bi bi-exclamation-circle me-1"></i> {{ $message }}
                                    </div>
                                    @enderror
                                    <div class="form-text text-muted small">
                                        <i class="bi bi-info-circle me-1"></i> Select the driver for this journey
                                    </div>
                                </div>
                            </div>

                            <!-- Schedule -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label fw-semibold">Schedule <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                    <span class="input-group-text bg-light">
                                        <i class="bi bi-calendar-event text-primary"></i>
                                    </span>
                                        <input type="text"
                                               class="form-control @error('schedule') is-invalid @enderror"
                                               id="schedule"
                                               name="schedule"
                                               placeholder="Select date & time"
                                               value="{{ $data->schedule }}"
                                               required>
                                    </div>
                                    @error('schedule')
                                    <div class="invalid-feedback d-block">
                                        <i class="bi bi-exclamation-circle me-1"></i> {{ $message }}
                                    </div>
                                    @enderror
                                    <div class="form-text text-muted small">
                                        <i class="bi bi-info-circle me-1"></i> Select departure date and time
                                    </div>
                                </div>
                            </div>

                            <!-- Pricing Section -->
                            <div class="col-12">
                                <div class="card border-0 bg-light rounded-3 mt-2">
                                    <div class="card-body">
                                        <h6 class="fw-bold mb-3 d-flex align-items-center">
                                            <i class="bi bi-cash-coin me-2 text-success"></i>
                                            Pricing Information
                                        </h6>
                                        <div class="row">
                                            <!-- Price -->
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label fw-semibold">Base Price <span class="text-danger">*</span></label>
                                                    <div class="input-group">
                                                    <span class="input-group-text bg-light">
                                                        <i class="bi bi-currency-dollar text-primary"></i>
                                                    </span>
                                                        <input type="number"
                                                               class="form-control @error('price') is-invalid @enderror"
                                                               id="price"
                                                               name="price"
                                                               placeholder="Enter base price"
                                                               value="{{ $data->price }}"
                                                               min="0"
                                                               step="0.01"
                                                               required>
                                                        <span class="input-group-text bg-light">$</span>
                                                    </div>
                                                    @error('price')
                                                    <div class="invalid-feedback d-block">
                                                        <i class="bi bi-exclamation-circle me-1"></i> {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <!-- Discount -->
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label fw-semibold">Discount (%)</label>
                                                    <div class="input-group">
                                                    <span class="input-group-text bg-light">
                                                        <i class="bi bi-percent text-primary"></i>
                                                    </span>
                                                        <input type="number"
                                                               class="form-control @error('discount') is-invalid @enderror"
                                                               id="discount"
                                                               name="discount"
                                                               placeholder="Enter discount percentage"
                                                               value="{{ $data->discount }}"
                                                               min="0"
                                                               max="100"
                                                               step="0.1">
                                                        <span class="input-group-text bg-light">%</span>
                                                    </div>
                                                    @error('discount')
                                                    <div class="invalid-feedback d-block">
                                                        <i class="bi bi-exclamation-circle me-1"></i> {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <!-- Final Price Preview -->
                                            <div class="col-12">
                                                <div class="bg-white p-3 rounded-2 border mt-3">
                                                    <div class="row align-items-center">
                                                        <div class="col-md-4">
                                                            <div class="text-center">
                                                                <div class="text-muted small">Base Price</div>
                                                                <div class="fw-bold" id="basePricePreview">${{ $data->price }}</div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="text-center">
                                                                <div class="text-muted small">Discount</div>
                                                                <div class="fw-bold text-danger" id="discountPreview">{{ $data->discount }}%</div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="text-center">
                                                                <div class="text-muted small">Final Price</div>
                                                                <div class="fw-bold h4 text-success" id="finalPricePreview">
                                                                    ${{ $data->price - round($data->price * ($data->discount / 100)) }}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Status Selection -->
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="form-label fw-semibold">Slot Status <span class="text-danger">*</span></label>
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <div class="form-check-card">
                                                <input class="form-check-input" type="radio" name="status" id="activeStatus" value="1" {{ $data->status == 1 ? 'checked' : '' }}>
                                                <label class="form-check-label w-100" for="activeStatus">
                                                    <div class="card border-0 bg-success bg-opacity-10 p-3 text-center">
                                                        <i class="bi bi-check-circle-fill text-success fs-4 mb-2"></i>
                                                        <div class="fw-semibold">Active</div>
                                                        <small class="text-muted">Slot is available for booking</small>
                                                    </div>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-check-card">
                                                <input class="form-check-input" type="radio" name="status" id="inactiveStatus" value="0" {{ $data->status == 0 ? 'checked' : '' }}>
                                                <label class="form-check-label w-100" for="inactiveStatus">
                                                    <div class="card border-0 bg-danger bg-opacity-10 p-3 text-center">
                                                        <i class="bi bi-x-circle-fill text-danger fs-4 mb-2"></i>
                                                        <div class="fw-semibold">Inactive</div>
                                                        <small class="text-muted">Slot is not available</small>
                                                    </div>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    @error('status')
                                    <div class="invalid-feedback d-block mt-2">
                                        <i class="bi bi-exclamation-circle me-1"></i> {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Selected Details Preview -->
                            <div class="col-12">
                                <div class="card border-0 bg-primary bg-opacity-5 rounded-3">
                                    <div class="card-body">
                                        <h6 class="fw-bold mb-3 text-primary">Slot Summary</h6>
                                        <div class="row">
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label text-muted small">Selected Route</label>
                                                <div class="fw-semibold" id="selectedRoutePreview">
                                                    {{ optional($data->busRoute)->start_location ?? '—' }} → {{ optional($data->busRoute)->end_location ?? '—' }}
                                                </div>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label text-muted small">Selected Bus</label>
                                                <div class="fw-semibold" id="selectedBusPreview">
                                                    {{ optional($data->busInfo)->bus_name ?? '—' }}
                                                </div>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label text-muted small">Selected Driver</label>
                                                <div class="fw-semibold" id="selectedDriverPreview">
                                                    {{ optional($data->driverInfo)->name ?? '—' }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Form Actions -->
                        <div class="row mt-5">
                            <div class="col-12">
                                <div class="d-flex justify-content-between align-items-center pt-4 border-top">
                                    <div>
                                        <a href="{{ route('slot.index') }}" class="btn btn-outline-secondary px-4">
                                            <i class="bi bi-x-circle me-1"></i> Cancel
                                        </a>
                                    </div>
                                    <div class="d-flex gap-3">
                                        <button type="reset" class="btn btn-outline-warning px-4">
                                            <i class="bi bi-arrow-clockwise me-1"></i> Reset Changes
                                        </button>
                                        <button type="submit" class="btn btn-primary px-4">
                                            <i class="bi bi-check-circle me-1"></i> Update Slot
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

                <!-- Form Footer -->
                <div class="card-footer border-0 bg-transparent p-4">
                    <div class="alert alert-info border-0 mb-0">
                        <div class="d-flex align-items-center">
                            <i class="bi bi-info-circle-fill me-3 fs-5 text-info"></i>
                            <div>
                                <h6 class="mb-1">Updating Slot Information</h6>
                                <p class="mb-0 small">You can modify any details of this ticket slot. All changes will be reflected immediately in the system. Make sure to verify all information before saving.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        /* Custom Styles */
        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-label {
            font-weight: 600;
            margin-bottom: 0.5rem;
            color: #1e293b;
        }

        .form-check-input {
            position: absolute;
            opacity: 0;
        }

        .form-check-card {
            position: relative;
        }

        .form-check-card .form-check-input:checked + label .card {
            border: 2px solid var(--primary-color) !important;
            background-color: rgba(255, 107, 53, 0.15) !important;
        }

        .form-check-card label {
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .form-check-card label:hover .card {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .form-check-card .card {
            transition: all 0.2s ease;
            border: 2px solid transparent;
        }

        /* Select2 Custom Styles */
        .select2-container--bootstrap5 .select2-selection {
            border: 1px solid #e2e8f0 !important;
            border-radius: 10px !important;
            padding: 0.75rem !important;
            height: auto !important;
            min-height: 56px;
        }

        .select2-container--bootstrap5 .select2-selection:focus {
            border-color: var(--primary-color) !important;
            box-shadow: 0 0 0 0.25rem rgba(255, 107, 53, 0.1) !important;
        }

        .select2-container--bootstrap5 .select2-selection--single .select2-selection__rendered {
            line-height: 1.5 !important;
            padding: 0 !important;
        }

        .select2-container--bootstrap5 .select2-selection__arrow {
            height: 100% !important;
        }

        .select2-dropdown {
            border: 1px solid #e2e8f0 !important;
            border-radius: 10px !important;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1) !important;
        }

        .select2-search--dropdown .select2-search__field {
            border: 1px solid #e2e8f0 !important;
            border-radius: 8px !important;
            padding: 0.5rem 0.75rem !important;
            margin: 0.5rem !important;
            width: calc(100% - 1rem) !important;
        }

        .select2-results__option {
            padding: 0.75rem 1rem !important;
        }

        .select2-results__option--highlighted {
            background-color: rgba(255, 107, 53, 0.1) !important;
            color: var(--primary-color) !important;
        }

        .input-group-text {
            background-color: #f8fafc;
            border-color: #e2e8f0;
            color: #64748b;
        }

        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.25rem rgba(255, 107, 53, 0.1);
        }

        .invalid-feedback {
            font-size: 0.875rem;
            margin-top: 0.25rem;
        }

        .form-text {
            font-size: 0.875rem;
            margin-top: 0.25rem;
        }

        /* Button Styles */
        .btn-primary {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            border: none;
            padding: 0.625rem 1.75rem;
            border-radius: 10px;
            font-weight: 600;
            transition: all 0.2s ease;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(255, 107, 53, 0.3);
        }

        .btn-outline-secondary, .btn-outline-warning {
            border-width: 1px;
            transition: all 0.2s ease;
        }

        .btn-outline-secondary:hover {
            background-color: rgba(100, 116, 139, 0.1);
            transform: translateY(-2px);
        }
        .dashboard-card{
            padding:30px;
        }

        .btn-outline-warning:hover {
            background-color: rgba(255, 191, 105, 0.1);
            transform: translateY(-2px);
        }

        /* Alert Styles */
        .alert-info {
            background-color: rgba(76, 201, 240, 0.1);
            border-color: rgba(76, 201, 240, 0.2);
            color: #0c5460;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .card-body {
                padding: 1.5rem !important;
            }

            .d-flex.justify-content-between {
                flex-direction: column;
                gap: 1rem;
            }

            .d-flex.gap-3 {
                width: 100%;
                justify-content: space-between;
            }

            .btn {
                width: 100%;
                margin-bottom: 0.5rem;
            }

            .col-md-6 {
                margin-bottom: 1rem;
            }

            .select2-container--bootstrap5 .select2-selection {
                min-height: 52px;
                padding: 0.5rem !important;
            }
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize Flatpickr for datetime picker
            flatpickr("#schedule", {
                enableTime: true,
                dateFormat: "Y-m-d H:i",
                time_24hr: false,
                minuteIncrement: 15,
                minDate: "today",
                defaultDate: "{{ $data->schedule }}"
            });

            // Initialize Select2
            $('.select2').select2({
                theme: 'bootstrap-5',
                width: '100%',
                placeholder: 'Select an option',
                allowClear: true,
                dropdownParent: $('#slotForm')
            });

            // Initialize tooltips
            const tooltips = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            tooltips.map(function(tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });

            // Price preview calculation
            function updatePricePreview() {
                const price = parseFloat(document.getElementById('price').value) || 0;
                const discount = parseFloat(document.getElementById('discount').value) || 0;

                // Update preview elements
                document.getElementById('basePricePreview').textContent = '$' + price.toFixed(2);
                document.getElementById('discountPreview').textContent = discount + '%';

                const discountAmount = price * (discount / 100);
                const finalPrice = price - discountAmount;
                document.getElementById('finalPricePreview').textContent = '$' + finalPrice.toFixed(2);
            }

            // Update selected items preview
            function updateSelectedPreview() {
                const routeSelect = document.getElementById('route_id');
                const busSelect = document.getElementById('bus_id');
                const driverSelect = document.getElementById('driver_id');

                if (routeSelect) {
                    const selectedRoute = routeSelect.options[routeSelect.selectedIndex];
                    document.getElementById('selectedRoutePreview').textContent =
                        selectedRoute.text || '—';
                }

                if (busSelect) {
                    const selectedBus = busSelect.options[busSelect.selectedIndex];
                    document.getElementById('selectedBusPreview').textContent =
                        selectedBus.text || '—';
                }

                if (driverSelect) {
                    const selectedDriver = driverSelect.options[driverSelect.selectedIndex];
                    document.getElementById('selectedDriverPreview').textContent =
                        selectedDriver.text || '—';
                }
            }

            // Event listeners for live updates
            document.getElementById('price')?.addEventListener('input', updatePricePreview);
            document.getElementById('discount')?.addEventListener('input', updatePricePreview);
            document.getElementById('route_id')?.addEventListener('change', updateSelectedPreview);
            document.getElementById('bus_id')?.addEventListener('change', updateSelectedPreview);
            document.getElementById('driver_id')?.addEventListener('change', updateSelectedPreview);

            // Form validation styling
            const inputs = document.querySelectorAll('.form-control[required]');
            inputs.forEach(input => {
                input.addEventListener('blur', function() {
                    if (this.value.trim() === '') {
                        this.classList.add('is-invalid');
                    } else {
                        this.classList.remove('is-invalid');
                    }
                });
            });

            // Form submission feedback
            const form = document.getElementById('slotForm');
            if (form) {
                form.addEventListener('submit', function(e) {
                    const submitButton = this.querySelector('button[type="submit"]');
                    if (submitButton) {
                        submitButton.innerHTML = '<i class="bi bi-hourglass-split me-1"></i> Updating...';
                        submitButton.disabled = true;
                    }
                });
            }

            // Form reset handler
            const resetButton = document.querySelector('button[type="reset"]');
            if (resetButton) {
                resetButton.addEventListener('click', function() {
                    // Remove all validation classes
                    inputs.forEach(input => {
                        input.classList.remove('is-invalid');
                    });

                    // Reset to original values
                    setTimeout(() => {
                        updatePricePreview();
                        updateSelectedPreview();
                    }, 100);
                });
            }

            // Initialize previews on page load
            updatePricePreview();
            updateSelectedPreview();
        });
    </script>
@endsection
