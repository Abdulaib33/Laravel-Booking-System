{{-- resources/views/admin/bookings/index.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-100">
                Admin • Bookings
            </h2>
        </div>
    </x-slot>

    <div class="p-6 max-w-6xl mx-auto">

        @if(session('status'))
            <div class="mb-4 rounded-lg bg-green-100 text-green-700 px-4 py-3 border border-green-200">
                {{ session('status') }}
            </div>
        @endif

        {{-- Filter --}}
        <div class="mb-4">
            <form method="GET"
                  class="flex items-center gap-3 bg-white dark:bg-gray-900 p-4 rounded-xl shadow border border-gray-100 dark:border-gray-800 w-fit">
                
                <label class="text-sm font-medium text-gray-700 dark:text-gray-300">
                    Status:
                </label>

                <select name="status"
                        onchange="this.form.submit()"
                        class="rounded-lg border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-100 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <option value="">All</option>
                    @foreach(['pending','approved','rejected','completed'] as $s)
                        <option value="{{ $s }}" {{ $status === $s ? 'selected' : '' }}>
                            {{ ucfirst($s) }}
                        </option>
                    @endforeach
                </select>
            </form>
        </div>

        {{-- Table Card --}}
        <div class="bg-white dark:bg-gray-900 shadow-lg rounded-2xl border border-gray-100 dark:border-gray-800 overflow-hidden">
            <table class="w-full text-sm">
                <thead class="bg-gray-50 dark:bg-gray-800 text-gray-600 dark:text-gray-300">
                    <tr>
                        <th class="text-left px-4 py-3 font-medium">Customer</th>
                        <th class="text-left px-4 py-3 font-medium">Service</th>
                        <th class="text-left px-4 py-3 font-medium">Date</th>
                        <th class="text-left px-4 py-3 font-medium">Time</th>
                        <th class="text-left px-4 py-3 font-medium">Status</th>
                        <th class="text-left px-4 py-3 font-medium">Change Status</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
                    @foreach($bookings as $booking)
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-800 transition">
                            
                            <td class="px-4 py-3">
                                <div class="font-medium text-gray-800 dark:text-gray-100">
                                    {{ $booking->user->name }}
                                </div>
                                <div class="text-xs text-gray-500">
                                    {{ $booking->user->email }}
                                </div>
                            </td>

                            <td class="px-4 py-3 text-gray-700 dark:text-gray-200">
                                {{ $booking->service->name }}
                            </td>

                            <td class="px-4 py-3 text-gray-700 dark:text-gray-200">
                                {{ $booking->booking_date->format('Y-m-d') }}
                            </td>

                            <td class="px-4 py-3 text-gray-700 dark:text-gray-200">
                                {{ $booking->booking_time }}
                            </td>

                            <td class="px-4 py-3">
                                <span class="px-2 py-1 rounded-full text-xs font-medium
                                    @if($booking->status === 'approved') bg-green-100 text-green-700
                                    @elseif($booking->status === 'pending') bg-yellow-100 text-yellow-700
                                    @elseif($booking->status === 'rejected') bg-red-100 text-red-700
                                    @else bg-gray-200 text-gray-700 @endif">
                                    {{ ucfirst($booking->status) }}
                                </span>
                            </td>

                            <td class="px-4 py-3">
                                <form method="POST"
                                      action="{{ route('admin.bookings.status', $booking) }}"
                                      class="flex items-center gap-2">
                                    @csrf
                                    @method('PATCH')

                                    <select name="status"
                                            class="rounded-lg border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-100 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                        @foreach(['pending','approved','rejected','completed'] as $s)
                                            <option value="{{ $s }}"
                                                {{ $booking->status === $s ? 'selected' : '' }}>
                                                {{ ucfirst($s) }}
                                            </option>
                                        @endforeach
                                    </select>

                                    <button type="submit"
                                            class="bg-blue-600 hover:bg-blue-700 text-white text-sm px-3 py-1.5 rounded-lg transition shadow">
                                        Update
                                    </button>
                                </form>
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-6">
            {{ $bookings->links() }}
        </div>

    </div>
</x-app-layout>