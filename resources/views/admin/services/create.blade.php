{{-- resources/views/admin/services/create.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl">Create Service</h2>
    </x-slot>

    <div class="p-6 max-w-xl">
        <form method="POST" action="{{ route('admin.services.store') }}">
            @csrf

            <div class="mb-3">
                <label>Name</label>
                <input class="w-full" name="name" value="{{ old('name') }}">
                @error('name') <div>{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <label>Price (in cents)</label>
                <input class="w-full" type="number" name="price_cents"
                       value="{{ old('price_cents') }}">
                @error('price_cents') <div>{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <label>Duration (minutes)</label>
                <input class="w-full" type="number" name="duration_minutes"
                       value="{{ old('duration_minutes', 30) }}">
                @error('duration_minutes') <div>{{ $message }}</div> @enderror
            </div>

            <label class="inline-flex items-center gap-2 mb-4">
                <input type="checkbox" name="active" value="1"
                       {{ old('active', true) ? 'checked' : '' }}>
                Active
            </label>

            <div class="flex gap-3">
                <button type="submit" class="underline">Save</button>
                <a href="{{ route('admin.services.index') }}" class="underline">
                    Cancel
                </a>
            </div>

        </form>
    </div>
</x-app-layout>