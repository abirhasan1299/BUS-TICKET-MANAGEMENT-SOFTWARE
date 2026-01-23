@extends('layout.master')
@section('title', 'Create Coupon')
@section('content')

    <div class="row">
        <div class="col-lg-12">
            <div class="dashboard-card">
                <!-- Card Header -->
                <div class="card-header border-bottom bg-transparent p-4">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center">
                            <div class="icon-wrapper bg-primary bg-opacity-10 p-3 rounded-3 me-3">
                                <i class="bi bi-percent text-primary fs-4"></i>
                            </div>
                            <div>
                                <h4 class="mb-1 fw-bold">Create New Coupon</h4>
                                <p class="text-muted mb-0">Add discount coupons to your system</p>
                            </div>
                        </div>
                        <div class="badge bg-primary bg-opacity-10 text-primary px-3 py-2">
                            <i class="bi bi-plus-circle me-1"></i> New
                        </div>
                    </div>
                </div>

                <div class="card-body p-4">
                    <form action="{{ route('coupon.store') }}" method="POST" id="couponForm">
                        @csrf

                        <div class="row">
                            <!-- Left Column: Form Fields -->
                            <div class="col-lg-8">
                                <div class="row">
                                    <!-- Coupon Name -->
                                    <div class="col-md-6 mb-4">
                                        <label class="form-label fw-semibold mb-2">
                                            <i class="bi bi-tag me-2 text-primary"></i> Coupon Name
                                        </label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-light border-end-0">
                                                <i class="bi bi-tag text-muted"></i>
                                            </span>
                                            <input type="text"
                                                   name="name"
                                                   class="form-control @error('name') is-invalid @enderror"
                                                   placeholder="e.g., Summer Sale, Welcome Offer"
                                                   value="{{ old('name') }}"
                                                   required>
                                        </div>
                                        @error('name')
                                        <div class="invalid-feedback d-block mt-2">
                                            <i class="bi bi-exclamation-circle me-2"></i> {{ $message }}
                                        </div>
                                        @enderror
                                    </div>

                                    <!-- Coupon Code -->
                                    <div class="col-md-6 mb-4">
                                        <label class="form-label fw-semibold mb-2">
                                            <i class="bi bi-code-slash me-2 text-primary"></i> Coupon Code
                                        </label>
                                        <div class="input-group">
                                            <input type="text"
                                                   name="coupon_code"
                                                   class="form-control @error('coupon_code') is-invalid @enderror"
                                                   id="codeInput"
                                                   placeholder="SUMMER25"
                                                   value="{{ old('coupon_code') }}"
                                                   required>
                                            <button type="button"
                                                    class="btn btn-outline-primary border-start-0"
                                                    onclick="generateCode()">
                                                <i class="bi bi-arrow-repeat"></i> Generate
                                            </button>
                                        </div>
                                        @error('coupon_code')
                                        <div class="invalid-feedback d-block mt-2">
                                            <i class="bi bi-exclamation-circle me-2"></i> {{ $message }}
                                        </div>
                                        @enderror
                                    </div>

                                    <!-- Discount Percentage -->
                                    <div class="col-md-6 mb-4">
                                        <label class="form-label fw-semibold mb-2">
                                            <i class="bi bi-percent me-2 text-primary"></i> Discount Percentage
                                        </label>
                                        <div class="input-group">
                                            <input type="number"
                                                   name="discount"
                                                   class="form-control @error('discount') is-invalid @enderror"
                                                   id="discountInput"
                                                   placeholder="Enter percentage"
                                                   min="1"
                                                   max="100"
                                                   value="{{ old('discount') }}"
                                                   required>
                                            <span class="input-group-text bg-light">%</span>
                                        </div>
                                        @error('discount')
                                        <div class="invalid-feedback d-block mt-2">
                                            <i class="bi bi-exclamation-circle me-2"></i> {{ $message }}
                                        </div>
                                        @enderror
                                    </div>

                                    <!-- Expiry Date -->
                                    <div class="col-md-6 mb-4">
                                        <label class="form-label fw-semibold mb-2">
                                            <i class="bi bi-calendar me-2 text-primary"></i> Expiry Date
                                        </label>
                                        <div class="input-group">
                                            <input type="text"
                                                   name="expire"
                                                   class="form-control datepicker @error('expire') is-invalid @enderror"
                                                   id="expiryInput"
                                                   placeholder="Select expiry date"
                                                   value="{{ old('expire') }}"
                                                   required>
                                            <span class="input-group-text bg-light">
                                                <i class="bi bi-calendar text-muted"></i>
                                            </span>
                                        </div>
                                        @error('expire')
                                        <div class="invalid-feedback d-block mt-2">
                                            <i class="bi bi-exclamation-circle me-2"></i> {{ $message }}
                                        </div>
                                        @enderror
                                    </div>

                                    <!-- Status -->
                                    <div class="col-12 mb-4">
                                        <label class="form-label fw-semibold mb-3">
                                            <i class="bi bi-toggle-on me-2 text-primary"></i> Status
                                        </label>
                                        <div class="row g-3">
                                            <div class="col-md-6">
                                                <div class="form-check-card">
                                                    <input class="form-check-input"
                                                           type="radio"
                                                           name="status"
                                                           id="activeStatus"
                                                           value="1"
                                                        {{ old('status', '1') == '1' ? 'checked' : '' }}>
                                                    <label class="form-check-label w-100" for="activeStatus">
                                                        <div class="card status-card status-card-active h-100">
                                                            <div class="card-body text-center p-4">
                                                                <i class="bi bi-check-circle-fill text-success fs-2 mb-3"></i>
                                                                <h6 class="fw-bold mb-2">Active</h6>
                                                                <p class="text-muted small mb-0">Coupon will be immediately usable</p>
                                                            </div>
                                                        </div>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-check-card">
                                                    <input class="form-check-input"
                                                           type="radio"
                                                           name="status"
                                                           id="inactiveStatus"
                                                           value="0"
                                                        {{ old('status') == '0' ? 'checked' : '' }}>
                                                    <label class="form-check-label w-100" for="inactiveStatus">
                                                        <div class="card status-card status-card-inactive h-100">
                                                            <div class="card-body text-center p-4">
                                                                <i class="bi bi-x-circle-fill text-danger fs-2 mb-3"></i>
                                                                <h6 class="fw-bold mb-2">Inactive</h6>
                                                                <p class="text-muted small mb-0">Save as draft for later use</p>
                                                            </div>
                                                        </div>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        @error('status')
                                        <div class="invalid-feedback d-block mt-2">
                                            <i class="bi bi-exclamation-circle me-2"></i> {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Right Column: Preview -->
                            <div class="col-lg-4">
                                <div class="sticky-top" style="top: 100px;">
                                    <div class="preview-card border-0 bg-light rounded-3 h-100">
                                        <div class="card-body p-4">
                                            <h6 class="fw-bold mb-3 text-primary">Coupon Preview</h6>

                                            <!-- Coupon Card Preview -->
                                            <div class="coupon-preview bg-white border rounded-3 p-4 mb-4">
                                                <div class="text-center mb-3">
                                                    <div class="coupon-icon bg-primary bg-opacity-10 rounded-circle p-3 d-inline-block mb-3">
                                                        <i class="bi bi-percent text-primary fs-2"></i>
                                                    </div>
                                                    <h5 id="previewName" class="fw-bold">Summer Sale</h5>
                                                    <div class="coupon-code bg-light rounded-2 p-2 mb-3">
                                                        <code id="previewCode" class="fs-5 fw-bold text-primary">SUMMER25</code>
                                                    </div>
                                                    <div class="discount-badge bg-success bg-opacity-10 text-success rounded-pill px-3 py-1 d-inline-block mb-3">
                                                        <span id="previewDiscount" class="fw-bold">25%</span> OFF
                                                    </div>
                                                    <p class="text-muted small mb-0">
                                                        Expires: <span id="previewExpiry" class="fw-semibold">Dec 31, 2024</span>
                                                    </p>
                                                </div>
                                            </div>

                                            <!-- Status Badge -->
                                            <div class="status-preview">
                                                <label class="form-label fw-semibold mb-2">Current Status</label>
                                                <div class="d-flex align-items-center justify-content-between">
                                                    <span class="fw-semibold" id="previewStatusText">Active</span>
                                                    <span class="badge bg-success" id="previewStatusBadge">Active</span>
                                                </div>
                                            </div>

                                            <!-- Form Actions -->
                                            <div class="border-top mt-4 pt-4">
                                                <div class="d-grid gap-2">
                                                    <button type="submit" class="btn btn-primary btn-lg">
                                                        <i class="bi bi-plus-circle me-2"></i> Create Coupon
                                                    </button>
                                                    <button type="reset" class="btn btn-outline-secondary">
                                                        <i class="bi bi-x-circle me-2"></i> Reset Form
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

                <!-- Footer Note -->
                <div class="card-footer border-top bg-transparent p-4">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <div class="d-flex align-items-center">
                                <i class="bi bi-info-circle-fill text-primary me-3 fs-5"></i>
                                <div>
                                    <h6 class="mb-1 fw-semibold">Coupon Guidelines</h6>
                                    <ul class="mb-0 text-muted small">
                                        <li>Coupon codes must be unique and easy to remember</li>
                                        <li>Set reasonable expiry dates to encourage timely usage</li>
                                        <li>Consider seasonal promotions for higher engagement</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 text-end">
                            <a href="{{ route('coupon.index') }}" class="btn btn-outline-primary">
                                <i class="bi bi-eye me-1"></i> View All Coupons
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        /* Enhanced Form Styles */
        .dashboard-card {
            border: 1px solid rgba(0, 0, 0, 0.05);
            border-radius: 16px;
            box-shadow: var(--box-shadow);
            background: white;
        }

        .card-header {
            background: linear-gradient(135deg, rgba(255, 107, 53, 0.05), rgba(255, 159, 28, 0.05));
            border-radius: 16px 16px 0 0 !important;
        }

        .input-group .form-control,
        .input-group .input-group-text {
            border: 1px solid #E2E8F0;
            background: #F8FAFC;
            transition: var(--transition);
        }

        .input-group .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.25rem rgba(255, 107, 53, 0.15);
            background: white;
        }

        .input-group .input-group-text {
            color: #64748B;
            border-right: 0;
        }

        .input-group .btn-outline-primary {
            border: 1px solid var(--primary-color);
            color: var(--primary-color);
            transition: var(--transition);
        }

        .input-group .btn-outline-primary:hover {
            background: var(--primary-color);
            color: white;
        }

        /* Status Cards */
        .form-check-card {
            position: relative;
        }

        .form-check-card .form-check-input {
            position: absolute;
            opacity: 0;
            cursor: pointer;
        }

        .form-check-card .form-check-input:checked + label .status-card {
            border-color: var(--primary-color);
            background: rgba(255, 107, 53, 0.05);
            box-shadow: 0 4px 12px rgba(255, 107, 53, 0.1);
        }

        .status-card {
            border: 2px solid #E2E8F0;
            border-radius: 12px;
            cursor: pointer;
            transition: var(--transition);
            height: 100%;
        }

        .status-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.08);
        }

        .status-card-active:hover {
            border-color: rgba(46, 196, 182, 0.5);
        }

        .status-card-inactive:hover {
            border-color: rgba(231, 29, 54, 0.5);
        }

        /* Preview Section */
        .preview-card {
            background: linear-gradient(135deg, #F8FAFC, #F1F5F9);
        }

        .coupon-preview {
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
            border: 1px solid rgba(0, 0, 0, 0.08);
        }

        .coupon-icon {
            width: 80px;
            height: 80px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .coupon-code {
            font-family: 'Courier New', monospace;
            border: 2px dashed var(--primary-color);
        }

        .discount-badge {
            font-weight: 600;
        }

        /* Status Badge */
        .badge {
            padding: 0.5em 1em;
            font-weight: 500;
        }

        /* Buttons */
        .btn-primary {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            border: none;
            padding: 0.75rem 1.5rem;
            border-radius: 10px;
            font-weight: 600;
            transition: var(--transition);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(255, 107, 53, 0.3);
        }

        .btn-outline-secondary {
            border: 1px solid #E2E8F0;
            color: #64748B;
            transition: var(--transition);
        }

        .btn-outline-secondary:hover {
            background: #F1F5F9;
            transform: translateY(-2px);
        }

        .btn-outline-primary {
            border: 1px solid var(--primary-color);
            color: var(--primary-color);
            transition: var(--transition);
        }

        .btn-outline-primary:hover {
            background: var(--primary-color);
            color: white;
            transform: translateY(-2px);
        }

        /* Form Labels */
        .form-label {
            color: #1E293B;
            font-weight: 600;
        }

        /* Invalid Feedback */
        .invalid-feedback {
            font-size: 0.875rem;
        }

        /* Footer */
        .card-footer {
            background: linear-gradient(135deg, rgba(255, 107, 53, 0.02), rgba(255, 159, 28, 0.02));
        }

        /* Responsive */
        @media (max-width: 992px) {
            .preview-card {
                margin-top: 2rem;
            }

            .sticky-top {
                position: static !important;
            }
        }

        @media (max-width: 768px) {
            .card-header .d-flex {
                flex-direction: column;
                align-items: flex-start !important;
                gap: 1rem;
            }

            .card-header .badge {
                align-self: flex-start;
            }

            .card-footer .row {
                flex-direction: column;
                gap: 1rem;
            }

            .card-footer .text-end {
                text-align: left !important;
            }

            .form-check-card {
                margin-bottom: 1rem;
            }
        }
    </style>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize date picker
            flatpickr(".datepicker", {
                dateFormat: "Y-m-d",
                minDate: "today",
                position: "auto right",
                onChange: function(selectedDates, dateStr, instance) {
                    updatePreview();
                }
            });

            // Generate coupon code
            window.generateCode = function() {
                const prefix = ['SUMMER', 'WINTER', 'SPRING', 'AUTUMN', 'WELCOME', 'SPECIAL'];
                const suffix = Math.floor(100 + Math.random() * 900);
                const randomPrefix = prefix[Math.floor(Math.random() * prefix.length)];
                const code = `${randomPrefix}${suffix}`;

                document.getElementById('codeInput').value = code;
                updatePreview();
                showToast('Coupon code generated!', 'success');
            }

            // Update preview function
            function updatePreview() {
                const name = document.querySelector('input[name="name"]').value || 'Summer Sale';
                const code = document.getElementById('codeInput').value || 'SUMMER25';
                const discount = document.getElementById('discountInput').value || '25';
                const expiry = document.getElementById('expiryInput').value;
                const active = document.getElementById('activeStatus').checked;

                // Update preview elements
                document.getElementById('previewName').textContent = name;
                document.getElementById('previewCode').textContent = code;
                document.getElementById('previewDiscount').textContent = discount + '%';

                if (expiry) {
                    const date = new Date(expiry);
                    document.getElementById('previewExpiry').textContent = date.toLocaleDateString('en-US', {
                        year: 'numeric',
                        month: 'short',
                        day: 'numeric'
                    });
                } else {
                    document.getElementById('previewExpiry').textContent = 'Not set';
                }

                const statusText = document.getElementById('previewStatusText');
                const statusBadge = document.getElementById('previewStatusBadge');

                if (active) {
                    statusText.textContent = 'Active';
                    statusBadge.textContent = 'Active';
                    statusBadge.className = 'badge bg-success';
                } else {
                    statusText.textContent = 'Inactive';
                    statusBadge.textContent = 'Inactive';
                    statusBadge.className = 'badge bg-danger';
                }
            }

            // Add event listeners for live updates
            document.querySelector('input[name="name"]').addEventListener('input', updatePreview);
            document.getElementById('codeInput').addEventListener('input', updatePreview);
            document.getElementById('discountInput').addEventListener('input', updatePreview);
            document.getElementById('expiryInput').addEventListener('change', updatePreview);
            document.querySelectorAll('input[name="status"]').forEach(radio => {
                radio.addEventListener('change', updatePreview);
            });

            // Form validation
            const form = document.getElementById('couponForm');
            form.addEventListener('submit', function(e) {
                const discount = document.getElementById('discountInput').value;

                if (discount < 1 || discount > 100) {
                    e.preventDefault();
                    showToast('Discount must be between 1% and 100%', 'error');
                    return false;
                }

                // Disable submit button during submission
                const submitBtn = this.querySelector('button[type="submit"]');
                const originalText = submitBtn.innerHTML;
                submitBtn.innerHTML = '<i class="bi bi-hourglass-split me-2"></i> Creating...';
                submitBtn.disabled = true;

                // Re-enable after 5 seconds if form doesn't submit
                setTimeout(() => {
                    submitBtn.innerHTML = originalText;
                    submitBtn.disabled = false;
                }, 5000);
            });

            // Reset form handler
            form.addEventListener('reset', function() {
                setTimeout(() => {
                    updatePreview();
                    showToast('Form has been reset', 'info');
                }, 100);
            });

            // Toast notification function
            function showToast(message, type = 'success') {
                const toastId = 'toast-' + Date.now();
                const toastHTML = `
                <div id="${toastId}" class="toast-notification fade-in show">
                    <div class="toast-header ${type === 'success' ? 'bg-success bg-opacity-10' : 'bg-danger bg-opacity-10'}">
                        <i class="bi bi-${type === 'success' ? 'check-circle-fill text-success' : 'exclamation-circle-fill text-danger'} me-2"></i>
                        <strong class="me-auto">${type === 'success' ? 'Success' : 'Error'}</strong>
                        <button type="button" class="btn-close" onclick="document.getElementById('${toastId}').remove()"></button>
                    </div>
                    <div class="toast-body">
                        ${message}
                    </div>
                </div>
            `;

                const container = document.createElement('div');
                container.innerHTML = toastHTML;
                const toast = container.firstChild;

                // Add styles
                Object.assign(toast.style, {
                    position: 'fixed',
                    top: '100px',
                    right: '30px',
                    minWidth: '300px',
                    background: 'white',
                    borderRadius: '12px',
                    boxShadow: '0 10px 30px rgba(0, 0, 0, 0.15)',
                    zIndex: '9999',
                    animation: 'fadeIn 0.3s ease-out'
                });

                document.body.appendChild(toast);

                // Auto remove after 3 seconds
                setTimeout(() => {
                    if (toast.parentNode) {
                        toast.style.opacity = '0';
                        toast.style.transform = 'translateX(100px)';
                        setTimeout(() => {
                            if (toast.parentNode) {
                                toast.remove();
                            }
                        }, 300);
                    }
                }, 3000);
            }

            // Initialize preview
            updatePreview();
        });
    </script>
@endsection
