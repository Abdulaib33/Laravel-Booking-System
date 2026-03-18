{{-- resources/views/bookings/create.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl">Book an Appointment</h2>
    </x-slot>

    <div class="p-6 max-w-xl">

        @if(session('status'))
            <div class="mb-4 text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('bookings.store') }}">
            @csrf

            {{-- Service --}}
            <div class="mb-4">
                <label class="block mb-1">Service</label>
                <select name="service_id" class="w-full rounded-lg border-gray-300 dark:border-gray-700 dark:text-gray-100 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <option value="">-- Select a Service --</option>
                    @foreach($services as $service)
                        <option value="{{ $service->id }}"
                            {{ old('service_id') == $service->id ? 'selected' : '' }}>
                            {{ $service->name }}
                            ({{ number_format($service->price_cents / 100, 2) }}€ -
                            {{ $service->duration_minutes }} min)
                        </option>
                    @endforeach
                </select>
                @error('service_id') <div>{{ $message }}</div> @enderror
            </div>

            {{-- Date --}}
            <div class="mb-4">
                <label class="block mb-1">Date</label>
                <input type="date"
                       name="booking_date"
                       class="w-full rounded-lg border-gray-300 dark:border-gray-700 dark:text-gray-100 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                       value="{{ old('booking_date') }}">
                @error('booking_date') <div>{{ $message }}</div> @enderror
            </div>

            {{-- Time --}}
            <div class="mb-4">
                <label class="block mb-1">Time</label>
                <input type="time"
                       name="booking_time"
                       class="w-full rounded-lg border-gray-300 dark:border-gray-700 dark:text-gray-100 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                       value="{{ old('booking_time') }}">
                @error('booking_time') <div>{{ $message }}</div> @enderror
            </div>

            {{-- Notes --}}
            <div class="mb-4">
                <label class="block mb-1">Notes (optional)</label>
                <textarea name="notes"
                          rows="3"
                          class="w-full rounded-lg border-gray-300 dark:border-gray-700 dark:text-gray-100 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">{{ old('notes') }}</textarea>
                @error('notes') <div>{{ $message }}</div> @enderror
            </div>

            <button type="submit" class="underline">
                Submit Booking
            </button>

        </form>
    </div>
</x-app-layout>