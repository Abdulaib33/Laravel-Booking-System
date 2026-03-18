{{-- resources/views/admin/services/edit.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-100">
            Edit Service
        </h2>
    </x-slot>

    <div class="p-6 max-w-xl mx-auto">
        <form method="POST"
              action="{{ route('admin.services.update', $service) }}"
              class="bg-white dark:bg-gray-900 shadow-lg rounded-2xl p-6 space-y-5 border border-gray-100 dark:border-gray-800">
            @csrf
            @method('PUT')

            {{-- Name --}}
            <div>
                <label class="block mb-1 text-sm font-medium text-gray-700 dark:text-gray-300">
                    Name
                </label>
                <input name="name"
                       value="{{ old('name', $service->name) }}"
                       class="w-full rounded-lg border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-100 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                @error('name')
                    <div class="text-sm text-red-500 mt-1">{{ $message }}</div>
                @enderror
            </div>

            {{-- Price --}}
            <div>
                <label class="block mb-1 text-sm font-medium text-gray-700 dark:text-gray-300">
                    Price (in cents)
                </label>
                <input type="number"
                       name="price_cents"
                       value="{{ old('price_cents', $service->price_cents) }}"
                       class="w-full rounded-lg border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-100 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                @error('price_cents')
                    <div class="text-sm text-red-500 mt-1">{{ $message }}</div>
                @enderror
            </div>

            {{-- Duration --}}
            <div>
                <label class="block mb-1 text-sm font-medium text-gray-700 dark:text-gray-300">
                    Duration (minutes)
                </label>
                <input type="number"
                       name="duration_minutes"
                       value="{{ old('duration_minutes', $service->duration_minutes) }}"
                       class="w-full rounded-lg border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-100 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                @error('duration_minutes')
                    <div class="text-sm text-red-500 mt-1">{{ $message }}</div>
                @enderror
            </div>

            {{-- Active --}}
            <label class="flex items-center gap-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                <input type="checkbox"
                       name="active"
                       value="1"
                       class="rounded border-gray-300 text-blue-600 focus:ring-blue-500"
                       {{ old('active', $service->active) ? 'checked' : '' }}>
                Active
            </label>

            {{-- Actions --}}
            <div class="flex gap-3 pt-2">
                <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white font-medium px-4 py-2 rounded-lg transition shadow">
                    Update
                </button>

                <a href="{{ route('admin.services.index') }}"
                   class="px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-700 text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 transition">
                    Back
                </a>
            </div>

        </form>
    </div>
</x-app-layout>