<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-100">
            Facilities
        </h2>
    </x-slot>

    <div class="py-8 max-w-7xl mx-auto px-4">
        @include('partials.alerts')

        {{-- Add Button (Admin Only) --}}
        @if(auth()->user()->isAdmin())
            <form action="{{ route('facilities.create') }}" method="GET" class="mb-6">
                <button type="submit"
                    class="px-4 py-2 rounded text-sm border transition
                    border-gray-300 dark:border-gray-600
                    {{ request()->routeIs('facilities.create')
                        ? 'bg-blue-600 text-white'
                        : 'bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-200' }}">
                    Add Facility
                </button>
            </form>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @forelse($facilities as $facility)
                <div class="bg-white dark:bg-gray-800 rounded-lg  shadow
                            border border-gray-200 dark:border-gray-700
                            p-6 transition hover:shadow-lg">

                    <h3 class="text-lg font-bold text-gray-900 dark:text-gray-100">
                        {{ $facility->name }}
                    </h3>

                    <p class="text-sm text-gray-500 dark:text-gray-400 capitalize mt-1">
                        {{ $facility->category }}
                    </p>

                    <p class="text-sm mt-2 text-gray-700 dark:text-gray-300">
                        Capacity: {{ $facility->capacity }}
                    </p>

                    <p class="text-sm text-gray-600 dark:text-gray-400 mt-2">
                        {{ \Illuminate\Support\Str::limit($facility->description, 80) }}
                    </p>

                    <div class="mt-4 flex flex-wrap gap-2">

                        {{-- View --}}
                        <a href="{{ route('facilities.show', $facility) }}"
                           class="px-3 py-1 bg-blue-600 text-white text-sm rounded hover:bg-blue-700 transition">
                            View
                        </a>

                        @if(auth()->user()->isAdmin())

                            {{-- Edit --}}
                            <a href="{{ route('facilities.edit', $facility) }}"
                               class="px-3 py-1 bg-yellow-500 text-white text-sm rounded hover:bg-yellow-600 transition">
                                Edit
                            </a>

                            {{-- Delete --}}
                            <form action="{{ route('facilities.destroy', $facility) }}"
                                  method="POST"
                                  onsubmit="return confirm('Delete this facility?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="px-3 py-1 bg-red-600 text-white text-sm rounded hover:bg-red-700 transition">
                                    Delete
                                </button>
                            </form>

                        @endif
                    </div>
                </div>

            @empty
                <p class="text-gray-500 dark:text-gray-400 col-span-3 text-center">
                    No facilities found.
                </p>
            @endforelse
        </div>

        <div class="mt-6 dark:text-gray-300">
            {{ $facilities->links() }}
        </div>
    </div>
</x-app-layout>
