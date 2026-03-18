{{-- resources/views/bookings/create.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <div class="page-shell py-0">
            <h2 class="section-title">Book an Appointment</h2>
            <p class="section-subtitle">Choose a service, date, and time slot.</p>
        </div>
    </x-slot>

    <div class="page-shell">
        <div class="max-w-2xl mx-auto card">
            <div class="card-body">
                @if(session('status'))
                    <div class="alert-success mb-6">
                        {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('bookings.store') }}" class="space-y-6">
                    @csrf

                    <div>
                        <label class="label">Service</label>
                        <select name="service_id" class="select">
                            <option value="">-- Select a Service --</option>
                            @foreach($services as $service)
                                <option value="{{ $service->id }}" {{ old('service_id') == $service->id ? 'selected' : '' }}>
                                    {{ $service->name }} ({{ number_format($service->price_cents / 100, 2) }}€ · {{ $service->duration_minutes }} min)
                                </option>
                            @endforeach
                        </select>
                        @error('service_id') <div class="error-text">{{ $message }}</div> @enderror
                    </div>

                    <div class="grid gap-6 md:grid-cols-2">
                        <div>
                            <label class="label">Date</label>
                            <input type="date" name="booking_date" class="input" value="{{ old('booking_date') }}">
                            @error('booking_date') <div class="error-text">{{ $message }}</div> @enderror
                        </div>

                        <div>
                            <label class="label">Time</label>
                            <input type="time" name="booking_time" class="input" value="{{ old('booking_time') }}">
                            @error('booking_time') <div class="error-text">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div>
                        <label class="label">Notes</label>
                        <textarea name="notes" rows="4" class="textarea">{{ old('notes') }}</textarea>
                        @error('notes') <div class="error-text">{{ $message }}</div> @enderror
                    </div>

                    <button type="submit" class="btn-primary w-full">Submit Booking</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>