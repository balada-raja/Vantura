<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-100">{{ $facility->name }}</h2>
    </x-slot>

    <div class="py-8 max-w-3xl mx-auto px-4">
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
            <p class="text-gray-500 dark:text-gray-400 capitalize">{{ $facility->category }}</p>
            <p class="mt-2"><strong>Capacity:</strong> {{ $facility->capacity }}</p>
            <p class="mt-2 text-gray-700 dark:text-gray-300">{{ $facility->description }}</p>
            @if($facility->image)
            <img src="{{ asset('storage/' . $facility->image) }}"
                class="w-full h-64 object-cover rounded mb-4">
            @endif
            <a href="{{ route('bookings.create', $facility) }}"
               class="mt-6 inline-block px-6 py-2 bg-green-600 text-white rounded hover:bg-green-700">
                Book This Facility
            </a>
        </div>
    </div>
</x-app-layout>
