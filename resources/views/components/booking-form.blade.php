<section class="booking-section" id="booking-form" aria-labelledby="booking-title">
    <div class="container">
        <form class="booking-form" action="{{ route('booking-enquiries.store') }}" method="POST" data-booking-form>
            @csrf
            <h2 class="visually-hidden" id="booking-title">Plan your journey</h2>

            @if (session('booking_success'))
                <p class="booking-message booking-message--success" role="status">{{ session('booking_success') }}</p>
            @endif
            @if (session('booking_error'))
                <p class="booking-message booking-message--error" role="alert">{{ session('booking_error') }}</p>
            @endif
            @if ($errors->any())
                <div class="booking-message booking-message--error" role="alert" tabindex="-1">
                    <p>Please check the following fields and submit the form again:</p>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="booking-form__fields">
                <label class="booking-field">
                    <span>From <strong aria-hidden="true">*</strong></span>
                    <input type="text" name="pickup_location" autocomplete="address-level2" maxlength="255" placeholder="Select Destination" value="{{ old('pickup_location') }}" required @if ($errors->has('pickup_location')) aria-invalid="true" aria-describedby="booking-pickup-error" @endif>
                    @error('pickup_location')<span class="booking-field__error" id="booking-pickup-error">{{ $message }}</span>@enderror
                </label>
                <label class="booking-field">
                    <span>To <strong aria-hidden="true">*</strong></span>
                    <input type="text" name="destination" autocomplete="address-level2" maxlength="255" placeholder="Select Destination" value="{{ old('destination') }}" required @if ($errors->has('destination')) aria-invalid="true" aria-describedby="booking-destination-error" @endif>
                    @error('destination')<span class="booking-field__error" id="booking-destination-error">{{ $message }}</span>@enderror
                </label>
                <label class="booking-field">
                    <span>When <strong aria-hidden="true">*</strong></span>
                    <input type="date" name="travel_date" min="{{ now()->toDateString() }}" value="{{ old('travel_date') }}" required @if ($errors->has('travel_date')) aria-invalid="true" aria-describedby="booking-date-error" @endif>
                    @error('travel_date')<span class="booking-field__error" id="booking-date-error">{{ $message }}</span>@enderror
                </label>
                <label class="booking-field">
                    <span>Time</span>
                    <input type="time" name="pickup_time" value="{{ old('pickup_time') }}" @if ($errors->has('pickup_time')) aria-invalid="true" aria-describedby="booking-time-error" @endif>
                    @error('pickup_time')<span class="booking-field__error" id="booking-time-error">{{ $message }}</span>@enderror
                </label>
                <label class="booking-field">
                    <span>Seat <strong aria-hidden="true">*</strong></span>
                    <input type="number" name="passenger_count" min="1" max="10000" inputmode="numeric" placeholder="Set Seat" value="{{ old('passenger_count') }}" required @if ($errors->has('passenger_count')) aria-invalid="true" aria-describedby="booking-passengers-error" @endif>
                    @error('passenger_count')<span class="booking-field__error" id="booking-passengers-error">{{ $message }}</span>@enderror
                </label>
                <button class="button button--primary booking-form__submit" type="submit">
                    Submit
                    <svg viewBox="0 0 20 20" aria-hidden="true" focusable="false"><path d="M4 10h12m-5-5 5 5-5 5" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" /></svg>
                </button>
            </div>

            <details class="booking-form__contact" @if ($errors->has('name') || $errors->has('phone') || $errors->has('email') || $errors->has('message') || $errors->has('vehicle_type')) open @endif>
                <summary>Contact details <span>(needed for a reply)</span></summary>
                <div class="booking-form__contact-fields">
                    <label class="booking-field">
                        <span>Name <strong aria-hidden="true">*</strong></span>
                        <input type="text" name="name" autocomplete="name" maxlength="150" value="{{ old('name') }}" required @if ($errors->has('name')) aria-invalid="true" aria-describedby="booking-name-error" @endif>
                        @error('name')<span class="booking-field__error" id="booking-name-error">{{ $message }}</span>@enderror
                    </label>
                    <label class="booking-field">
                        <span>Phone <strong aria-hidden="true">*</strong></span>
                        <input type="tel" name="phone" autocomplete="tel" maxlength="30" inputmode="tel" value="{{ old('phone') }}" required @if ($errors->has('phone')) aria-invalid="true" aria-describedby="booking-phone-error" @endif>
                        @error('phone')<span class="booking-field__error" id="booking-phone-error">{{ $message }}</span>@enderror
                    </label>
                    <label class="booking-field">
                        <span>Email (optional)</span>
                        <input type="email" name="email" autocomplete="email" maxlength="255" value="{{ old('email') }}" @if ($errors->has('email')) aria-invalid="true" aria-describedby="booking-email-error" @endif>
                        @error('email')<span class="booking-field__error" id="booking-email-error">{{ $message }}</span>@enderror
                    </label>
                    <label class="booking-field">
                        <span>Vehicle preference (optional)</span>
                        <select name="vehicle_type" @if ($errors->has('vehicle_type')) aria-invalid="true" aria-describedby="booking-vehicle-error" @endif>
                            <option value="">No preference</option>
                            <option value="ac_bus" @selected(old('vehicle_type') === 'ac_bus')>AC Bus</option>
                            <option value="non_ac_bus" @selected(old('vehicle_type') === 'non_ac_bus')>Non-AC Bus</option>
                            <option value="tempo_traveller" @selected(old('vehicle_type') === 'tempo_traveller')>Tempo Traveller</option>
                            <option value="urbania" @selected(old('vehicle_type') === 'urbania')>Force Urbania</option>
                        </select>
                        @error('vehicle_type')<span class="booking-field__error" id="booking-vehicle-error">{{ $message }}</span>@enderror
                    </label>
                    <label class="booking-field booking-field--message">
                        <span>Additional details (optional)</span>
                        <textarea name="message" rows="2" maxlength="10000" placeholder="Stops, luggage or other trip details">{{ old('message') }}</textarea>
                        @error('message')<span class="booking-field__error">{{ $message }}</span>@enderror
                    </label>
                </div>
            </details>

            <label class="booking-field booking-field--honeypot" aria-hidden="true">
                <span>Leave this field empty</span>
                <input type="text" name="website" tabindex="-1" autocomplete="off">
            </label>
        </form>
    </div>
</section>
