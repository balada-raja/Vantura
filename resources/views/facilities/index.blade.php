<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">Facilities</h2>
    </x-slot>



    <div class="py-8 max-w-7xl mx-auto px-4">
        @include('partials.alerts')

        {{-- Add Button (Admin Only) --}}
        @if(auth()->user()->isAdmin())
            <form action="{{ route('facilities.create') }}" method="GET" class="mb-4">
                <button type="submit"
                    class="px-3 py-1 rounded text-sm border
                        {{ request()->routeIs('facilities.create')
                        ? 'bg-blue-600 text-white'
                        : 'bg-white text-gray-700' }}">
                    Add Facility
                </button>
            </form>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @forelse($facilities as $facility)
                <div class="bg-white rounded-lg shadow p-6">
                    <h3 class="text-lg font-bold text-gray-900">{{ $facility->name }}</h3>
                    <p class="text-sm text-gray-500 capitalize mt-1">{{ $facility->category }}</p>
                    <p class="text-sm mt-2">Capacity: {{ $facility->capacity }}</p>
                    <p class="text-sm text-gray-600 mt-2">
                        {{ \Illuminate\Support\Str::limit($facility->description, 80) }}
                    </p>

                    <div class="mt-4 flex gap-2">
                        <a href="{{ route('facilities.show', $facility) }}"
                           class="px-3 py-1 bg-blue-600 text-white text-sm rounded hover:bg-blue-700">
                            View
                        </a>

                        @if(auth()->user()->isAdmin())
                            <a href="{{ route('facilities.edit', $facility) }}"
                               class="px-3 py-1 bg-yellow-500 text-white text-sm rounded hover:bg-yellow-600">
                                Edit
                            </a>

                            <form action="{{ route('facilities.destroy', $facility) }}" method="POST"
                                  onsubmit="return confirm('Delete this facility?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="px-3 py-1 bg-red-600 text-white text-sm rounded hover:bg-red-700">
                                    Delete
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            @empty
                <p class="text-gray-500 col-span-3">No facilities found.</p>
            @endforelse
        </div>

        <div class="mt-6">
            {{ $facilities->links() }}
        </div>
    </div>
</x-app-layout>
