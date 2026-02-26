<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">Add Facility</h2>
    </x-slot>

    <div class="py-8 max-w-2xl mx-auto px-4">
        @include('partials.alerts')

        <form action="{{ route('facilities.update', $facility) }}" method="POST" ...>
        @csrf @method('PUT')
        {{-- pre-fill values with $facility->field instead of old() --}}
        value="{{ old('name', $facility->name) }}"

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
                <label class="block text-sm font-medium text-gray-700">Description</label>
                <textarea name="description" rows="3"
                          class="mt-1 w-full border-gray-300 rounded-md shadow-sm">{{ old('description') }}</textarea>
            </div>

            <button type="submit"
                    class="w-full bg-blue-600 text-white py-2 rounded-md hover:bg-blue-700">
                Create Facility
            </button>
        </form>
    </div>
</x-app-layout>
