{{-- resources/views/admin/bookings/index.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <div class="page-shell py-0">
            <h2 class="section-title">Admin Bookings</h2>
            <p class="section-subtitle">Review and update appointment requests.</p>
        </div>
    </x-slot>

    <div class="page-shell">
        @if(session('status'))
            <div class="alert-success mb-6">
                {{ session('status') }}
            </div>
        @endif

        <div class="card mb-6">
            <div class="card-body">
                <form method="GET" class="flex flex-col gap-4 md:flex-row md:items-end">
                    <div class="w-full md:w-64">
                        <label class="label">Filter by status</label>
                        <select name="status" class="select" onchange="this.form.submit()">
                            <option value="">All</option>
                            @foreach(['pending','approved','rejected','completed'] as $s)
                                <option value="{{ $s }}" {{ $status === $s ? 'selected' : '' }}>{{ ucfirst($s) }}</option>
                            @endforeach
                        </select>
                    </div>
                </form>
            </div>
        </div>

        <div class="table-wrap">
            <table class="table">
                <thead>
                    <tr>
                        <th>Customer</th>
                        <th>Service</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Status</th>
                        <th>Change Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($bookings as $booking)
                        @php
                            $statusClass = match($booking->status) {
                                'approved' => 'badge-success',
                                'pending' => 'badge-warning',
                                'rejected' => 'badge-danger',
                                'completed' => 'badge-neutral',
                                default => 'badge-neutral',
                            };
                        @endphp

                        <tr>
                            <td>
                                <div class="font-medium">{{ $booking->user->name }}</div>
                                <div class="text-slate-500 text-xs">{{ $booking->user->email }}</div>
                            </td>
                            <td>{{ $booking->service->name }}</td>
                            <td>{{ $booking->booking_date->format('Y-m-d') }}</td>
                            <td>{{ $booking->booking_time }}</td>
                            <td>
                                <span class="{{ $statusClass }}">{{ ucfirst($booking->status) }}</span>
                            </td>
                            <td>
                                <form method="POST" action="{{ route('admin.bookings.status', $booking) }}" class="flex gap-2">
                                    @csrf
                                    @method('PATCH')

                                    <select name="status" class="select max-w-[160px]">
                                        @foreach(['pending','approved','rejected','completed'] as $s)
                                            <option value="{{ $s }}" {{ $booking->status === $s ? 'selected' : '' }}>
                                                {{ ucfirst($s) }}
                                            </option>
                                        @endforeach
                                    </select>

                                    <button type="submit" class="btn-primary">Update</button>
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