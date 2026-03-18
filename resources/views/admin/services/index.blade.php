{{-- resources/views/admin/services/index.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl">Admin • Services</h2>
            <a href="{{ route('admin.services.create') }}" class=" underline bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg shadow transition">
                + New Service
            </a>
        </div>
    </x-slot>

    <div class="p-6">

        @if(session('status'))
            <div class="mb-4">{{ session('status') }}</div>
        @endif

        <table class="w-full">
            <thead>
                <tr>
                    <th class="text-left">Name</th>
                    <th class="text-left">Price (€)</th>
                    <th class="text-left">Duration (min)</th>
                    <th class="text-left">Active</th>
                    <th class="text-left">Actions</th>
                </tr>
            </thead>

            <tbody>
                @foreach($services as $service)
                    <tr class="border-t">
                        <td class="py-2">{{ $service->name }}</td>

                        <td class="py-2">
                            {{ number_format($service->price_cents / 100, 2) }}
                        </td>

                        <td class="py-2">
                            {{ $service->duration_minutes }}
                        </td>

                        <td class="py-2">
                            {{ $service->active ? 'Yes' : 'No' }}
                        </td>

                        <td class="py-2 flex gap-3">
                            <a class="underline"
                               href="{{ route('admin.services.edit', $service) }}">
                                Edit
                            </a>

                            <form method="POST"
                                  action="{{ route('admin.services.destroy', $service) }}"
                                  onsubmit="return confirm('Delete this service?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="underline">
                                    Delete
                                </button>
                            </form>

                            <a class="underline" href="{{ route('admin.services.show', $service) }}">View</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-4">
            {{ $services->links() }}
        </div>

    </div>
</x-app-layout>