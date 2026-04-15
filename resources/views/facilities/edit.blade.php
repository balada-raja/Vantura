<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-100">
            Edit Facility
        </h2>
    </x-slot>

    <div class="py-8 max-w-2xl mx-auto px-4">
        @include('partials.alerts')

        <form action="{{ route('facilities.update', $facility) }}"
              method="POST"
              enctype="multipart/form-data"
              class="bg-white dark:bg-gray-800 rounded-lg shadow p-6 space-y-4">
            @csrf
            @method('PUT')

            {{-- Name --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                    Name
                </label>
                <input type="text" name="name"
                       value="{{ old('name', $facility->name) }}"
                       class="mt-1 w-full border-gray-300 dark:border-gray-600
                              bg-white dark:bg-gray-700
                              text-gray-900 dark:text-gray-100
                              rounded-md shadow-sm focus:ring focus:ring-blue-200">
            </div>

            {{-- Category --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                    Category
                </label>
                <select name="category"
                        class="mt-1 w-full border-gray-300 dark:border-gray-600
                               bg-white dark:bg-gray-700
                               text-gray-900 dark:text-gray-100
                               rounded-md shadow-sm">
                    @foreach($categories as $cat)
                        <option value="{{ $cat }}"
                            {{ old('category', $facility->category) === $cat ? 'selected' : '' }}>
                            {{ ucfirst($cat) }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Capacity --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                    Capacity
                </label>
                <input type="number" name="capacity"
                       value="{{ old('capacity', $facility->capacity) }}"
                       min="1"
                       class="mt-1 w-full border-gray-300 dark:border-gray-600
                              bg-white dark:bg-gray-700
                              text-gray-900 dark:text-gray-100
                              rounded-md shadow-sm">
            </div>

            {{-- Booking Type --}}
<div>
    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
        Booking Type
    </label>

    <select name="type"
        class="mt-1 w-full border-gray-300 dark:border-gray-600
               bg-white dark:bg-gray-700
               text-gray-900 dark:text-gray-100
               rounded-md shadow-sm">

        <option value="exclusive"
            {{ old('type', $facility->type) === 'exclusive' ? 'selected' : '' }}>
            Exclusive (Cannot Share Time Slot)
        </option>

        <option value="shared"
            {{ old('type', $facility->type) === 'shared' ? 'selected' : '' }}>
            Shared (Capacity Based)
        </option>

    </select>

    @error('type')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
    @enderror
</div>

            {{-- Description --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                    Description
                </label>
                <textarea name="description" rows="3"
                          class="mt-1 w-full border-gray-300 dark:border-gray-600
                                 bg-white dark:bg-gray-700
                                 text-gray-900 dark:text-gray-100
                                 rounded-md shadow-sm">{{ old('description', $facility->description) }}</textarea>
            </div>

            {{-- Current Image --}}
            @if($facility->image)
                <div>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mb-2">
                        Current Image
                    </p>
                    <img src="{{ asset('storage/' . $facility->image) }}"
                         class="w-full h-48 object-cover rounded">
                </div>
            @endif

            {{-- Upload New Image --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                    Replace Image
                </label>
                <input type="file" name="image"
                       class="mt-1 w-full text-sm text-gray-700 dark:text-gray-200">
            </div>

            <button type="submit"
                    class="w-full bg-blue-600 text-white py-2 rounded-md hover:bg-blue-700 transition">
                Update Facility
            </button>
        </form>
    </div>
</x-app-layout>
