{{-- resources/views/admin/services/index.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-100">
                Admin • Services
            </h2>

            <a href="{{ route('admin.services.create') }}"
               class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg shadow transition">
                + New Service
            </a>
        </div>
    </x-slot>

    <div class="p-6 max-w-6xl mx-auto">

        @if(session('status'))
            <div class="mb-4 rounded-lg bg-green-100 text-green-700 px-4 py-3 border border-green-200">
                {{ session('status') }}
            </div>
        @endif

        {{-- Table Card --}}
        <div class="bg-white dark:bg-gray-900 shadow-lg rounded-2xl border border-gray-100 dark:border-gray-800 overflow-hidden">
            <table class="w-full text-sm">
                <thead class="bg-gray-50 dark:bg-gray-800 text-gray-600 dark:text-gray-300">
                    <tr>
                        <th class="text-left px-4 py-3 font-medium">Name</th>
                        <th class="text-left px-4 py-3 font-medium">Price (€)</th>
                        <th class="text-left px-4 py-3 font-medium">Duration (min)</th>
                        <th class="text-left px-4 py-3 font-medium">Active</th>
                        <th class="text-left px-4 py-3 font-medium">Actions</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
                    @foreach($services as $service)
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-800 transition">

                            <td class="px-4 py-3 font-medium text-gray-800 dark:text-gray-100">
                                {{ $service->name }}
                            </td>

                            <td class="px-4 py-3 text-gray-700 dark:text-gray-200">
                                {{ number_format($service->price_cents / 100, 2) }}
                            </td>

                            <td class="px-4 py-3 text-gray-700 dark:text-gray-200">
                                {{ $service->duration_minutes }}
                            </td>

                            <td class="px-4 py-3">
                                <span class="px-2 py-1 rounded-full text-xs font-medium
                                    {{ $service->active 
                                        ? 'bg-green-100 text-green-700' 
                                        : 'bg-gray-200 text-gray-700' }}">
                                    {{ $service->active ? 'Active' : 'Inactive' }}
                                </span>
                            </td>

                            <td class="px-4 py-3 flex items-center gap-2">

                                <a href="{{ route('admin.services.edit', $service) }}"
                                   class="text-blue-600 hover:underline text-sm font-medium">
                                    Edit
                                </a>

                                <a href="{{ route('admin.services.show', $service) }}"
                                   class="text-gray-600 dark:text-gray-300 hover:underline text-sm">
                                    View
                                </a>

                                <form method="POST"
                                      action="{{ route('admin.services.destroy', $service) }}"
                                      onsubmit="return confirm('Delete this service?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="text-red-600 hover:underline text-sm">
                                        Delete
                                    </button>
                                </form>

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-6">
            {{ $services->links() }}
        </div>

    </div>
</x-app-layout>