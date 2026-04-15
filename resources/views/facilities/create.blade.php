<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">Add Facility</h2>
    </x-slot>

    <div class="py-8 max-w-2xl mx-auto px-4">
        @include('partials.alerts')

        <form action="{{ route('facilities.store') }}" method="POST" enctype="multipart/form-data"
            class="bg-white dark:bg-gray-800 rounded-lg shadow p-6 space-y-4">
            @csrf

            <div>
                <label class="block text-sm font-medium text-gray-700">Name</label>
                <input type="text" name="name" value="{{ old('name') }}"
                       class="mt-1 w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-200">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Category</label>
                <select name="category" class="mt-1 w-full border-gray-300 rounded-md shadow-sm">
                    @foreach($categories as $cat)
                        <option value="{{ $cat }}" {{ old('category') === $cat ? 'selected' : '' }}>
                            {{ ucfirst($cat) }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Capacity</label>
                <input type="number" name="capacity" value="{{ old('capacity') }}" min="1"
                       class="mt-1 w-full border-gray-300 rounded-md shadow-sm">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-200">
                    Booking Type
                </label>

                <select name="type"
                    class="mt-1 w-full border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700
               text-gray-900 dark:text-gray-100
               rounded-md shadow-sm focus:ring focus:ring-blue-200">

                <option value="exclusive" {{ old('type') === 'exclusive' ? 'selected' : '' }}>
                    Exclusive (Cannot Share Time Slot)
                </option>

                <option value="shared" {{ old('type') === 'shared' ? 'selected' : '' }}>
                    Shared (Capacity Based)
                </option>

                </select>

                @error('type')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Description</label>
                <textarea name="description" rows="3"
                          class="mt-1 w-full border-gray-300 rounded-md shadow-sm">{{ old('description') }}</textarea>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-200">
                    Facility Image
                </label>
                <input type="file" name="image"
                    class="mt-1 w-full text-sm text-gray-700 dark:text-gray-200">
            </div>

            <button type="submit"
                    class="w-full bg-blue-600 text-white py-2 rounded-md hover:bg-blue-700">
                Create Facility
            </button>
        </form>
    </div>
</x-app-layout>
