{{-- resources/views/admin/services/edit.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl">Edit Service</h2>
    </x-slot>

    <div class="p-6 max-w-xl">
        <form method="POST"
              action="{{ route('admin.services.update', $service) }}">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label>Name</label>
                <input class="w-full rounded-lg border-gray-300 dark:border-gray-700 dark:text-gray-100 focus:ring-2 focus:ring-blue-500 focus:border-blue-500" name="name"
                       value="{{ old('name', $service->name) }}">
                @error('name') <div>{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <label>Price (in cents)</label>
                <input class="w-full rounded-lg border-gray-300 dark:border-gray-700 dark:text-gray-100 focus:ring-2 focus:ring-blue-500 focus:border-blue-500" type="number" name="price_cents"
                       value="{{ old('price_cents', $service->price_cents) }}">
                @error('price_cents') <div>{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <label>Duration (minutes)</label>
                <input class="w-full rounded-lg border-gray-300 dark:border-gray-700 dark:text-gray-100 focus:ring-2 focus:ring-blue-500 focus:border-blue-500" type="number" name="duration_minutes"
                       value="{{ old('duration_minutes', $service->duration_minutes) }}">
                @error('duration_minutes') <div>{{ $message }}</div> @enderror
            </div>

            <label class="inline-flex items-center gap-2 mb-4">
                <input type="checkbox" name="active" value="1" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500"
                       {{ old('active', $service->active) ? 'checked' : '' }}>
                Active
            </label>

            <div class="flex gap-3">
                <button type="submit" class="underline">Update</button>
                <a href="{{ route('admin.services.index') }}" 
                        class="underline bg-blue-600 hover:bg-blue-700 text-white font-medium px-4 py-2 rounded-lg transition shadow">
                    Back
                </a>
            </div>

        </form>
    </div>
</x-app-layout>