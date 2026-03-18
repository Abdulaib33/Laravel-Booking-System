{{-- resources/views/admin/bookings/index.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl">Admin • Bookings</h2>
        </div>
    </x-slot>

    <div class="p-6">

        @if(session('status'))
            <div class="mb-4 text-green-600">
                {{ session('status') }}
            </div>
        @endif

        {{-- Filter --}}
        <div class="mb-4">
            <form method="GET" class="flex gap-3 items-center">
                <label>Status:</label>
                <select name="status" onchange="this.form.submit()" class="rounded-lg border-gray-300 dark:bg-gray-800 dark:text-gray-100 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <option value="">All</option>
                    @foreach(['pending','approved','rejected','completed'] as $s)
                        <option value="{{ $s }}" {{ $status === $s ? 'selected' : '' }}>
                            {{ ucfirst($s) }}
                        </option>
                    @endforeach
                </select>
            </form>
        </div>

        <table class="w-full">
            <thead>
                <tr>
                    <th class="text-left">Customer</th>
                    <th class="text-left">Service</th>
                    <th class="text-left">Date</th>
                    <th class="text-left">Time</th>
                    <th class="text-left">Status</th>
                    <th class="text-left">Change Status</th>
                </tr>
            </thead>

            <tbody>
                @foreach($bookings as $booking)
                    <tr class="border-t">
                        <td class="py-2">
                            {{ $booking->user->name }}
                            <br>
                            <small>{{ $booking->user->email }}</small>
                        </td>

                        <td class="py-2">
                            {{ $booking->service->name }}
                        </td>

                        <td class="py-2">
                            {{ $booking->booking_date->format('Y-m-d') }}
                        </td>

                        <td class="py-2">
                            {{ $booking->booking_time }}
                        </td>

                        <td class="py-2">
                            {{ ucfirst($booking->status) }}
                        </td>

                        <td class="py-2">
                            <form method="POST"
                                  action="{{ route('admin.bookings.status', $booking) }}">
                                @csrf
                                @method('PATCH')

                                <select name="status" class="rounded-lg border-gray-300 dark:bg-gray-800 dark:text-gray-100 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                    @foreach(['pending','approved','rejected','completed'] as $s)
                                        <option value="{{ $s }}"
                                            {{ $booking->status === $s ? 'selected' : '' }}>
                                            {{ ucfirst($s) }}
                                        </option>
                                    @endforeach
                                </select>

                                <button type="submit" class="underline ml-2 bg-blue-600 hover:bg-blue-700 text-white text-sm px-3 py-1.5 rounded-lg transition shadow">
                                    Update
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-4">
            {{ $bookings->links() }}
        </div>

    </div>
</x-app-layout>