{{-- resources/views/bookings/create.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-100">
            Book an Appointment
        </h2>
    </x-slot>

    <div class="p-6 max-w-xl mx-auto">

        @if(session('status'))
            <div class="mb-4 rounded-lg bg-green-100 text-green-700 px-4 py-3 border border-green-200">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('bookings.store') }}"
              class="bg-white dark:bg-gray-900 shadow-lg rounded-2xl p-6 space-y-5 border border-gray-100 dark:border-gray-800">
            @csrf

            {{-- Service --}}
            <div>
                <label class="block mb-1 text-sm font-medium text-gray-700 dark:text-gray-300">
                    Service
                </label>
                <select name="service_id"
                        class="w-full rounded-lg border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-100 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
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
                @error('service_id')
                    <div class="text-sm text-red-500 mt-1">{{ $message }}</div>
                @enderror
            </div>

            {{-- Date --}}
            <div>
                <label class="block mb-1 text-sm font-medium text-gray-700 dark:text-gray-300">
                    Date
                </label>
                <input type="date"
                       name="booking_date"
                       value="{{ old('booking_date') }}"
                       class="w-full rounded-lg border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-100 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                @error('booking_date')
                    <div class="text-sm text-red-500 mt-1">{{ $message }}</div>
                @enderror
            </div>

            {{-- Time --}}
            <div>
                <label class="block mb-1 text-sm font-medium text-gray-700 dark:text-gray-300">
                    Time
                </label>
                <input type="time"
                       name="booking_time"
                       value="{{ old('booking_time') }}"
                       class="w-full rounded-lg border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-100 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                @error('booking_time')
                    <div class="text-sm text-red-500 mt-1">{{ $message }}</div>
                @enderror
            </div>

            {{-- Notes --}}
            <div>
                <label class="block mb-1 text-sm font-medium text-gray-700 dark:text-gray-300">
                    Notes (optional)
                </label>
                <textarea name="notes"
                          rows="3"
                          class="w-full rounded-lg border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-100 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">{{ old('notes') }}</textarea>
                @error('notes')
                    <div class="text-sm text-red-500 mt-1">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit"
                    class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-2.5 rounded-lg transition duration-200 shadow-md">
                Submit Booking
            </button>

        </form>
    </div>
</x-app-layout>