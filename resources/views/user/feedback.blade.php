@extends('layout.user')
@section('title','Submit Feedback')
@section('content')

    <div class="feedback-submission-container">
        <!-- Progress Steps -->
        <div class="progress-steps">
            <div class="step active">
                <div class="step-number">1</div>
                <div class="step-label">Trip Details</div>
            </div>
            <div class="step active">
                <div class="step-number">2</div>
                <div class="step-label">Your Experience</div>
            </div>
            <div class="step">
                <div class="step-number">3</div>
                <div class="step-label">Submit</div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="feedback-content">
            <!-- Trip Summary -->
            <div class="trip-summary">
                <div class="summary-header">
                    <h2 class="summary-title">
                        <i class="bi bi-ticket-detailed"></i>
                        Trip Details
                    </h2>
                    <div class="ticket-badge">
                        <i class="bi bi-ticket-perforated"></i>
                        TKT-{{$PaymentData->transaction_id}}
                    </div>
                </div>

                <div class="summary-content">
                    <div class="journey-info">
                        <div class="location from">
                            <div class="location-label">From</div>
                            <div class="location-name">{{$Cartdata->slots->busRoute->start_location}}</div>

                        </div>

                        <div class="journey-line">
                            <div class="line"></div>
                            <div class="duration">{{$Cartdata->slots->busRoute->estemated_time}} hrs</div>
                        </div>

                        <div class="location to">
                            <div class="location-label">To</div>
                            <div class="location-name">{{$Cartdata->slots->busRoute->end_location}}</div>
                        </div>
                    </div>

                    <div class="trip-details-grid">
                        <div class="detail-item">
                            <div class="detail-icon">
                                <i class="bi bi-bus-front"></i>
                            </div>
                            <div class="detail-content">
                                <div class="detail-label">Bus</div>
                                <div class="detail-value">
                                    {{$Cartdata->slots->busInfo->bus_name}}
                                </div>
                            </div>
                        </div>

                        <div class="detail-item">
                            <div class="detail-icon">
                                <i class="bi bi-calendar3"></i>
                            </div>
                            <div class="detail-content">
                                <div class="detail-label">Date</div>
                                <div class="detail-value">
                                    {{\Carbon\Carbon::parse($Cartdata->slots->schedule)->format('F d, Y |  h:i A')}}
                                </div>
                            </div>
                        </div>

                        <div class="detail-item">
                            <div class="detail-icon">
                                <i class="bi bi-person-check"></i>
                            </div>
                            <div class="detail-content">
                                <div class="detail-label">Seats</div>
                                <div class="detail-value">{{$Cartdata->sit_list}}</div>
                            </div>
                        </div>

                        <div class="detail-item">
                            <div class="detail-icon">
                                <i class="bi bi-cash-stack"></i>
                            </div>
                            <div class="detail-content">
                                <div class="detail-label">Amount</div>
                                <div class="detail-value">BDT {{$PaymentData->amount}}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Feedback Form -->
            <form action="{{route('feedback.store')}}" method="post"  id="feedbackForm" class="feedback-form">
                @csrf
                <input type="hidden" name="cart_id" value="{{$Cartdata->id}}">
                <input type="hidden" name="slot_id" value="{{$Cartdata->slots->id}}">
                <!-- Overall Rating -->
                <div class="rating-section">
                    <div class="section-header">
                        <h3 class="section-title">
                            <i class="bi bi-star"></i>
                            Overall Experience
                        </h3>
                        <p class="section-subtitle">How was your journey overall?</p>
                    </div>

                    <div class="rating-input">
                        <div class="rating-visual">
                            <div class="stars-container">
                                @for($i = 1; $i <= 5; $i++)
                                    <div class="star-wrapper" data-rating="{{ $i }}">
                                        <i class="bi bi-star"></i>
                                        <div class="rating-label">{{ $i }}</div>
                                    </div>
                                @endfor
                            </div>
                            <div class="rating-descriptions">
                                <div class="description-item" data-rating="1">
                                    <div class="description-title">Poor</div>
                                    <div class="description-text">Very dissatisfied</div>
                                </div>
                                <div class="description-item" data-rating="2">
                                    <div class="description-title">Fair</div>
                                    <div class="description-text">Below expectations</div>
                                </div>
                                <div class="description-item" data-rating="3">
                                    <div class="description-title">Good</div>
                                    <div class="description-text">Met expectations</div>
                                </div>
                                <div class="description-item" data-rating="4">
                                    <div class="description-title">Very Good</div>
                                    <div class="description-text">Exceeded expectations</div>
                                </div>
                                <div class="description-item" data-rating="5">
                                    <div class="description-title">Excellent</div>
                                    <div class="description-text">Outstanding experience</div>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" id="overallRating" name="overall_rating" value="0">
                        <div class="rating-selected">
                            <span class="selected-label">Your rating:</span>
                            <span class="selected-value" id="selectedRating">Not rated yet</span>
                        </div>
                    </div>
                </div>

                <!-- Category Ratings -->
                <div class="category-section">
                    <div class="section-header">
                        <h3 class="section-title">
                            <i class="bi bi-sliders"></i>
                            Rate Specific Aspects
                        </h3>
                        <p class="section-subtitle">Help us understand what we did well and where we can improve</p>
                    </div>

                    <div class="categories-grid">
                        <div class="category-card" data-category="cleanliness">
                            <div class="category-header">
                                <div class="category-icon">
                                    <i class="bi bi-bucket"></i>
                                </div>
                                <div class="category-info">
                                    <h4 class="category-title">Bus Cleanliness</h4>
                                    <p class="category-subtitle">Cleanliness of seats, windows, and floors</p>
                                </div>
                            </div>
                            <div class="category-rating">
                                <div class="rating-stars">
                                    @for($i = 1; $i <= 5; $i++)
                                        <i class="bi bi-star" data-value="{{ $i }}"></i>
                                    @endfor
                                </div>
                                <span class="rating-text" id="cleanlinessText">Select rating</span>
                            </div>
                            <input type="hidden" name="cleanliness_rating" value="0">
                        </div>

                        <div class="category-card" data-category="driver">
                            <div class="category-header">
                                <div class="category-icon">
                                    <i class="bi bi-person-badge"></i>
                                </div>
                                <div class="category-info">
                                    <h4 class="category-title">Driver & Staff</h4>
                                    <p class="category-subtitle">Professionalism, safety, and courtesy</p>
                                </div>
                            </div>
                            <div class="category-rating">
                                <div class="rating-stars">
                                    @for($i = 1; $i <= 5; $i++)
                                        <i class="bi bi-star" data-value="{{ $i }}"></i>
                                    @endfor
                                </div>
                                <span class="rating-text" id="driverText">Select rating</span>
                            </div>
                            <input type="hidden" name="driver_rating" value="0">
                        </div>

                        <div class="category-card" data-category="comfort">
                            <div class="category-header">
                                <div class="category-icon">
                                    <i class="bi bi-emoji-smile"></i>
                                </div>
                                <div class="category-info">
                                    <h4 class="category-title">Comfort & Seating</h4>
                                    <p class="category-subtitle">Seat comfort, legroom, and amenities</p>
                                </div>
                            </div>
                            <div class="category-rating">
                                <div class="rating-stars">
                                    @for($i = 1; $i <= 5; $i++)
                                        <i class="bi bi-star" data-value="{{ $i }}"></i>
                                    @endfor
                                </div>
                                <span class="rating-text" id="comfortText">Select rating</span>
                            </div>
                            <input type="hidden" name="comfort_rating" value="0">
                        </div>

                        <div class="category-card" data-category="punctuality">
                            <div class="category-header">
                                <div class="category-icon">
                                    <i class="bi bi-clock"></i>
                                </div>
                                <div class="category-info">
                                    <h4 class="category-title">Punctuality</h4>
                                    <p class="category-subtitle">On-time departure and arrival</p>
                                </div>
                            </div>
                            <div class="category-rating">
                                <div class="rating-stars">
                                    @for($i = 1; $i <= 5; $i++)
                                        <i class="bi bi-star" data-value="{{ $i }}"></i>
                                    @endfor
                                </div>
                                <span class="rating-text" id="punctualityText">Select rating</span>
                            </div>
                            <input type="hidden" name="punctuality_rating" value="0">
                        </div>
                    </div>
                </div>

                <!-- Detailed Feedback -->
                <div class="comments-section">
                    <div class="section-header">
                        <h3 class="section-title">
                            <i class="bi bi-chat-left-text"></i>
                            Share Your Thoughts
                        </h3>
                        <p class="section-subtitle">Tell us more about your experience (optional but appreciated)</p>
                    </div>

                    <div class="comment-input">
                        <div class="input-header">
                            <label for="comments">Your Detailed Feedback</label>
                            <div class="char-counter">
                                <span id="charCount">0</span>/1000 characters
                            </div>
                        </div>
                        <textarea id="comments" name="comments" rows="5"
                                  placeholder="What did you enjoy most about your journey? Is there anything we could improve? Your feedback helps us provide better service..."
                                  class="comment-textarea"></textarea>

                        <div class="suggestions">
                            <div class="suggestion-label">Suggestions to get started:</div>
                            <div class="suggestion-items">
                                <button type="button" class="suggestion-btn" data-suggestion="The driver was very professional and drove safely">
                                    <i class="bi bi-lightning"></i>
                                    Professional driver
                                </button>
                                <button type="button" class="suggestion-btn" data-suggestion="The bus was clean and well-maintained">
                                    <i class="bi bi-lightning"></i>
                                    Clean bus
                                </button>
                                <button type="button" class="suggestion-btn" data-suggestion="Comfortable seats with good legroom">
                                    <i class="bi bi-lightning"></i>
                                    Comfortable seats
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Recommendation -->
                <div class="recommendation-section">
                    <div class="section-header">
                        <h3 class="section-title">
                            <i class="bi bi-hand-thumbs-up"></i>
                            Would You Recommend Us?
                        </h3>
                        <p class="section-subtitle">Your recommendation helps other travelers</p>
                    </div>

                    <div class="recommendation-options">
                        <label class="recommend-option">
                            <input type="radio" name="recommendation" value="yes">
                            <div class="option-card">
                                <div class="option-icon success">
                                    <i class="bi bi-hand-thumbs-up-fill"></i>
                                </div>
                                <div class="option-content">
                                    <div class="option-title">Yes, definitely</div>
                                    <div class="option-description">I would recommend to friends and family</div>
                                </div>
                            </div>
                        </label>

                        <label class="recommend-option">
                            <input type="radio" name="recommendation" value="maybe">
                            <div class="option-card">
                                <div class="option-icon warning">
                                    <i class="bi bi-hand-thumbs-up"></i>
                                </div>
                                <div class="option-content">
                                    <div class="option-title">Maybe</div>
                                    <div class="option-description">With some improvements</div>
                                </div>
                            </div>
                        </label>

                        <label class="recommend-option">
                            <input type="radio" name="recommendation" value="no">
                            <div class="option-card">
                                <div class="option-icon danger">
                                    <i class="bi bi-hand-thumbs-down"></i>
                                </div>
                                <div class="option-content">
                                    <div class="option-title">Probably not</div>
                                    <div class="option-description">I would not recommend</div>
                                </div>
                            </div>
                        </label>
                    </div>
                </div>

                <!-- Submit Section -->
                <div class="submit-section">
                    <div class="privacy-note">
                        <i class="bi bi-shield-check"></i>
                        <span>Your feedback is anonymous and helps us improve our services.</span>
                    </div>

                    <div class="submit-buttons">
                        <button type="submit" class="btn-submit-feedback">
                            <i class="bi bi-send-check"></i>
                            Submit Feedback
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Success Modal -->
    <div class="modal fade" id="successModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="success-animation">
                        <div class="checkmark">✓</div>
                    </div>
                    <h3 class="text-center mb-3">Thank You for Your Feedback!</h3>
                    <p class="text-center text-muted mb-4">
                        Your valuable feedback has been submitted successfully.
                        We appreciate you taking the time to share your experience with us.
                    </p>

                </div>
            </div>
        </div>
    </div>

    <style>
        .feedback-submission-container {
            max-width: 1000px;
            margin: 0 auto;
            padding: 2rem 1rem;
        }

        /* Progress Steps */
        .progress-steps {
            display: flex;
            justify-content: space-between;
            margin-bottom: 3rem;
            position: relative;
        }

        .progress-steps::before {
            content: '';
            position: absolute;
            top: 24px;
            left: 50px;
            right: 50px;
            height: 3px;
            background: #e2e8f0;
            z-index: 1;
        }

        .step {
            display: flex;
            flex-direction: column;
            align-items: center;
            position: relative;
            z-index: 2;
        }

        .step-number {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: #f1f5f9;
            border: 3px solid #e2e8f0;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            color: #64748b;
            margin-bottom: 0.5rem;
            transition: all 0.3s ease;
        }

        .step.active .step-number {
            background: #3b82f6;
            border-color: #3b82f6;
            color: white;
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
        }

        .step-label {
            font-size: 0.9rem;
            color: #64748b;
            font-weight: 500;
        }

        .step.active .step-label {
            color: #1e293b;
            font-weight: 600;
        }

        /* Trip Summary */
        .trip-summary {
            background: white;
            border-radius: 20px;
            padding: 2rem;
            margin-bottom: 2rem;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
            border: 1px solid #e2e8f0;
        }

        .summary-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
        }

        .summary-title {
            font-size: 1.5rem;
            font-weight: 600;
            color: #1e293b;
            display: flex;
            align-items: center;
            gap: 10px;
            margin: 0;
        }

        .ticket-badge {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 8px 16px;
            border-radius: 12px;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .journey-info {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 2rem;
            padding: 2rem;
            background: #f8fafc;
            border-radius: 16px;
        }

        .location {
            text-align: center;
            flex: 1;
        }

        .location-label {
            font-size: 0.9rem;
            color: #64748b;
            margin-bottom: 8px;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .location-name {
            font-size: 1.5rem;
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 4px;
        }

        .location-time {
            font-size: 1.1rem;
            color: #3b82f6;
            font-weight: 500;
        }

        .journey-line {
            position: relative;
            flex: 2;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .journey-line .line {
            width: 100%;
            height: 2px;
            background: linear-gradient(90deg, #667eea 0%, #764ba2 100%);
            position: relative;
        }

        .journey-line .line::before,
        .journey-line .line::after {
            content: '';
            position: absolute;
            width: 12px;
            height: 12px;
            background: #667eea;
            border-radius: 50%;
            top: 50%;
            transform: translateY(-50%);
        }

        .journey-line .line::before {
            left: 0;
        }

        .journey-line .line::after {
            right: 0;
            background: #764ba2;
        }

        .duration {
            background: white;
            padding: 6px 16px;
            border-radius: 20px;
            font-size: 0.9rem;
            font-weight: 500;
            color: #475569;
            margin-top: 8px;
            border: 1px solid #e2e8f0;
        }

        .trip-details-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1.5rem;
        }

        .detail-item {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 1.2rem;
            background: white;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            transition: all 0.2s ease;
        }

        .detail-item:hover {
            border-color: #cbd5e1;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            transform: translateY(-2px);
        }

        .detail-icon {
            width: 48px;
            height: 48px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.2rem;
        }

        .detail-content {
            flex: 1;
        }

        .detail-label {
            font-size: 0.85rem;
            color: #64748b;
            margin-bottom: 4px;
        }

        .detail-value {
            font-weight: 500;
            color: #1e293b;
            font-size: 1rem;
        }

        /* Feedback Form Sections */
        .section-header {
            margin-bottom: 2rem;
        }

        .section-title {
            font-size: 1.3rem;
            font-weight: 600;
            color: #1e293b;
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 8px;
        }

        .section-subtitle {
            color: #64748b;
            margin: 0;
        }

        /* Overall Rating */
        .rating-section {
            background: white;
            border-radius: 20px;
            padding: 2rem;
            margin-bottom: 2rem;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
            border: 1px solid #e2e8f0;
        }

        .rating-visual {
            margin-bottom: 2rem;
        }

        .stars-container {
            display: flex;
            justify-content: center;
            gap: 0.5rem;
            margin-bottom: 2rem;
        }

        .star-wrapper {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 8px;
            cursor: pointer;
            transition: all 0.2s ease;
            padding: 1rem;
            border-radius: 12px;
        }

        .star-wrapper:hover {
            background: #f8fafc;
        }

        .star-wrapper i {
            font-size: 3.5rem;
            color: #cbd5e1;
            transition: all 0.2s ease;
        }

        .star-wrapper.active i {
            color: #fbbf24;
            transform: scale(1.1);
        }

        .rating-label {
            font-size: 0.9rem;
            font-weight: 500;
            color: #64748b;
        }

        .star-wrapper.active .rating-label {
            color: #1e293b;
            font-weight: 600;
        }

        .rating-descriptions {
            display: flex;
            justify-content: space-between;
            max-width: 800px;
            margin: 0 auto;
        }

        .description-item {
            text-align: center;
            padding: 1rem;
            opacity: 0.5;
            transition: all 0.2s ease;
            cursor: pointer;
            border-radius: 12px;
            flex: 1;
            max-width: 150px;
        }

        .description-item:hover,
        .description-item.active {
            opacity: 1;
            background: #f8fafc;
        }

        .description-title {
            font-weight: 600;
            color: #1e293b;
            margin-bottom: 4px;
        }

        .description-text {
            font-size: 0.85rem;
            color: #64748b;
        }

        .rating-selected {
            text-align: center;
            padding: 1rem;
            background: #f8fafc;
            border-radius: 12px;
            border: 2px dashed #cbd5e1;
        }

        .selected-label {
            color: #64748b;
            margin-right: 8px;
        }

        .selected-value {
            font-weight: 600;
            color: #1e293b;
            font-size: 1.1rem;
        }

        /* Category Ratings */
        .category-section {
            background: white;
            border-radius: 20px;
            padding: 2rem;
            margin-bottom: 2rem;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
            border: 1px solid #e2e8f0;
        }

        .categories-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 1.5rem;
        }

        .category-card {
            padding: 1.5rem;
            border: 2px solid #e2e8f0;
            border-radius: 16px;
            transition: all 0.3s ease;
        }

        .category-card:hover {
            border-color: #cbd5e1;
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
        }

        .category-card.active {
            border-color: #3b82f6;
            background: linear-gradient(135deg, rgba(59, 130, 246, 0.05) 0%, rgba(59, 130, 246, 0.02) 100%);
        }

        .category-header {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-bottom: 1.5rem;
        }

        .category-icon {
            width: 50px;
            height: 50px;
            background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.2rem;
        }

        .category-title {
            font-size: 1.1rem;
            font-weight: 600;
            color: #1e293b;
            margin: 0 0 4px 0;
        }

        .category-subtitle {
            font-size: 0.85rem;
            color: #64748b;
            margin: 0;
        }

        .category-rating {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }

        .rating-stars {
            display: flex;
            gap: 4px;
        }

        .rating-stars i {
            font-size: 1.8rem;
            color: #cbd5e1;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .rating-stars i:hover,
        .rating-stars i.active {
            color: #f59e0b;
            transform: scale(1.1);
        }

        .rating-text {
            font-size: 0.9rem;
            color: #64748b;
            font-style: italic;
        }

        /* Comments Section */
        .comments-section {
            background: white;
            border-radius: 20px;
            padding: 2rem;
            margin-bottom: 2rem;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
            border: 1px solid #e2e8f0;
        }

        .comment-input {
            position: relative;
        }

        .input-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
        }

        .input-header label {
            font-weight: 500;
            color: #1e293b;
            font-size: 1rem;
        }

        .char-counter {
            font-size: 0.85rem;
            color: #94a3b8;
        }

        .comment-textarea {
            width: 100%;
            padding: 1.5rem;
            border: 2px solid #e2e8f0;
            border-radius: 12px;
            font-size: 1rem;
            resize: vertical;
            min-height: 150px;
            transition: all 0.3s ease;
            font-family: inherit;
        }

        .comment-textarea:focus {
            outline: none;
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }

        .suggestions {
            margin-top: 1.5rem;
        }

        .suggestion-label {
            font-size: 0.9rem;
            color: #64748b;
            margin-bottom: 0.75rem;
        }

        .suggestion-items {
            display: flex;
            flex-wrap: wrap;
            gap: 0.75rem;
        }

        .suggestion-btn {
            background: #f1f5f9;
            border: 1px solid #e2e8f0;
            color: #475569;
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-size: 0.9rem;
            display: flex;
            align-items: center;
            gap: 6px;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .suggestion-btn:hover {
            background: #e2e8f0;
            border-color: #cbd5e1;
        }

        /* Recommendation Section */
        .recommendation-section {
            background: white;
            border-radius: 20px;
            padding: 2rem;
            margin-bottom: 2rem;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
            border: 1px solid #e2e8f0;
        }

        .recommendation-options {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
        }

        .recommend-option {
            position: relative;
        }

        .recommend-option input {
            display: none;
        }

        .recommend-option input:checked + .option-card {
            border-color: #3b82f6;
            background: linear-gradient(135deg, rgba(59, 130, 246, 0.05) 0%, rgba(59, 130, 246, 0.02) 100%);
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.15);
        }

        .option-card {
            padding: 1.5rem;
            border: 2px solid #e2e8f0;
            border-radius: 16px;
            cursor: pointer;
            transition: all 0.3s ease;
            height: 100%;
        }

        .option-card:hover {
            border-color: #cbd5e1;
            transform: translateY(-2px);
        }

        .option-icon {
            width: 50px;
            height: 50px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            margin-bottom: 1rem;
        }

        .option-icon.success {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            color: white;
        }

        .option-icon.warning {
            background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
            color: white;
        }

        .option-icon.danger {
            background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
            color: white;
        }

        .option-title {
            font-weight: 600;
            color: #1e293b;
            margin-bottom: 4px;
        }

        .option-description {
            font-size: 0.85rem;
            color: #64748b;
        }

        /* Submit Section */
        .submit-section {
            background: white;
            border-radius: 20px;
            padding: 2rem;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
            border: 1px solid #e2e8f0;
        }

        .privacy-note {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 1rem;
            background: #f8fafc;
            border-radius: 12px;
            margin-bottom: 2rem;
            color: #475569;
        }

        .privacy-note i {
            color: #10b981;
            font-size: 1.2rem;
        }

        .submit-buttons {
            display: flex;
            justify-content: flex-end;
            gap: 1rem;
        }

        .btn-save-draft {
            background: #f1f5f9;
            color: #475569;
            border: 2px solid #e2e8f0;
            padding: 1rem 2rem;
            border-radius: 12px;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 8px;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .btn-save-draft:hover {
            background: #e2e8f0;
            border-color: #cbd5e1;
        }

        .btn-submit-feedback {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            color: white;
            border: none;
            padding: 1rem 2.5rem;
            border-radius: 12px;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn-submit-feedback:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(16, 185, 129, 0.3);
        }

        /* Success Modal */
        .success-animation {
            text-align: center;
            margin-bottom: 2rem;
        }

        .checkmark {
            display: inline-block;
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            color: white;
            font-size: 3rem;
            line-height: 80px;
            border-radius: 50%;
            animation: checkmark 0.5s ease;
        }

        @keyframes checkmark {
            0% { transform: scale(0); }
            50% { transform: scale(1.2); }
            100% { transform: scale(1); }
        }

        .modal-actions {
            display: flex;
            justify-content: center;
            gap: 1rem;
            margin-top: 2rem;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .feedback-submission-container {
                padding: 1rem;
            }

            .progress-steps {
                flex-direction: column;
                align-items: flex-start;
                gap: 1.5rem;
            }

            .progress-steps::before {
                display: none;
            }

            .step {
                flex-direction: row;
                gap: 1rem;
            }

            .journey-info {
                flex-direction: column;
                gap: 2rem;
                padding: 1.5rem;
            }

            .journey-line {
                transform: rotate(90deg);
                width: 100px;
            }

            .categories-grid {
                grid-template-columns: 1fr;
            }

            .recommendation-options {
                grid-template-columns: 1fr;
            }

            .submit-buttons {
                flex-direction: column;
            }

            .btn-save-draft,
            .btn-submit-feedback {
                width: 100%;
                justify-content: center;
            }
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Overall Rating
            const starWrappers = document.querySelectorAll('.star-wrapper');
            const overallRatingInput = document.getElementById('overallRating');
            const selectedRatingText = document.getElementById('selectedRating');
            const descriptionItems = document.querySelectorAll('.description-item');

            const ratingTexts = {
                1: 'Poor - Very dissatisfied',
                2: 'Fair - Below expectations',
                3: 'Good - Met expectations',
                4: 'Very Good - Exceeded expectations',
                5: 'Excellent - Outstanding experience'
            };

            starWrappers.forEach(wrapper => {
                wrapper.addEventListener('click', function() {
                    const rating = parseInt(this.getAttribute('data-rating'));
                    overallRatingInput.value = rating;
                    selectedRatingText.textContent = ratingTexts[rating];

                    // Update stars
                    starWrappers.forEach(star => {
                        const starRating = parseInt(star.getAttribute('data-rating'));
                        star.classList.toggle('active', starRating <= rating);
                        star.querySelector('i').className = starRating <= rating ? 'bi bi-star-fill' : 'bi bi-star';
                    });

                    // Update descriptions
                    descriptionItems.forEach(item => {
                        const itemRating = parseInt(item.getAttribute('data-rating'));
                        item.classList.toggle('active', itemRating === rating);
                    });
                });

                // Hover effects
                wrapper.addEventListener('mouseenter', function() {
                    const rating = parseInt(this.getAttribute('data-rating'));
                    starWrappers.forEach(star => {
                        const starRating = parseInt(star.getAttribute('data-rating'));
                        star.querySelector('i').className = starRating <= rating ? 'bi bi-star-fill' : 'bi bi-star';
                    });
                });

                wrapper.addEventListener('mouseleave', function() {
                    const currentRating = parseInt(overallRatingInput.value);
                    starWrappers.forEach(star => {
                        const starRating = parseInt(star.getAttribute('data-rating'));
                        star.querySelector('i').className = starRating <= currentRating ? 'bi bi-star-fill' : 'bi bi-star';
                    });
                });
            });

            descriptionItems.forEach(item => {
                item.addEventListener('click', function() {
                    const rating = parseInt(this.getAttribute('data-rating'));
                    starWrappers.forEach(wrapper => {
                        if (parseInt(wrapper.getAttribute('data-rating')) === rating) {
                            wrapper.click();
                        }
                    });
                });
            });

            // Category Ratings
            const categoryCards = document.querySelectorAll('.category-card');
            const categoryTexts = {
                cleanliness: ['Select rating', 'Poor', 'Fair', 'Good', 'Very Good', 'Excellent'],
                driver: ['Select rating', 'Poor', 'Fair', 'Good', 'Very Good', 'Excellent'],
                comfort: ['Select rating', 'Poor', 'Fair', 'Good', 'Very Good', 'Excellent'],
                punctuality: ['Select rating', 'Poor', 'Fair', 'Good', 'Very Good', 'Excellent']
            };

            categoryCards.forEach(card => {
                const category = card.getAttribute('data-category');
                const stars = card.querySelectorAll('.rating-stars i');
                const ratingText = card.querySelector('.rating-text');
                const hiddenInput = card.querySelector('input[type="hidden"]');

                stars.forEach(star => {
                    star.addEventListener('click', function() {
                        const rating = parseInt(this.getAttribute('data-value'));
                        hiddenInput.value = rating;
                        ratingText.textContent = categoryTexts[category][rating];
                        card.classList.add('active');

                        // Update all stars in this category
                        stars.forEach(s => {
                            const starValue = parseInt(s.getAttribute('data-value'));
                            s.className = starValue <= rating ? 'bi bi-star-fill active' : 'bi bi-star';
                        });
                    });

                    // Hover effects
                    star.addEventListener('mouseenter', function() {
                        const rating = parseInt(this.getAttribute('data-value'));
                        stars.forEach(s => {
                            const starValue = parseInt(s.getAttribute('data-value'));
                            s.className = starValue <= rating ? 'bi bi-star-fill' : 'bi bi-star';
                        });
                    });

                    star.addEventListener('mouseleave', function() {
                        const currentRating = parseInt(hiddenInput.value);
                        stars.forEach(s => {
                            const starValue = parseInt(s.getAttribute('data-value'));
                            s.className = starValue <= currentRating ? 'bi bi-star-fill active' : 'bi bi-star';
                        });
                    });
                });
            });

            // Character Counter
            const commentsTextarea = document.getElementById('comments');
            const charCount = document.getElementById('charCount');

            commentsTextarea.addEventListener('input', function() {
                const length = this.value.length;
                charCount.textContent = length;

                if (length > 1000) {
                    charCount.style.color = '#ef4444';
                    this.value = this.value.substring(0, 1000);
                } else if (length > 800) {
                    charCount.style.color = '#f59e0b';
                } else {
                    charCount.style.color = '#94a3b8';
                }
            });

            // Suggestion Buttons
            document.querySelectorAll('.suggestion-btn').forEach(button => {
                button.addEventListener('click', function() {
                    const suggestion = this.getAttribute('data-suggestion');
                    commentsTextarea.value = suggestion;
                    commentsTextarea.dispatchEvent(new Event('input'));
                    commentsTextarea.focus();
                });
            });

            // Form Submission
            const feedbackForm = document.getElementById('feedbackForm');

            feedbackForm.addEventListener('submit', function(e) {
                e.preventDefault();

                // Validate overall rating
                if (overallRatingInput.value === '0') {
                    alert('Please provide an overall rating before submitting.');
                    starWrappers[0].scrollIntoView({ behavior: 'smooth', block: 'center' });
                    return;
                }



                // Simulate API call
                setTimeout(() => {
                     feedbackForm.submit();
                }, 3000);
                // Show success modal
                const successModal = new bootstrap.Modal(document.getElementById('successModal'));
                successModal.show();
            });


        });
    </script>
@endsection
