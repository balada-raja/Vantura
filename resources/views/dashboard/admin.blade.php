<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-100">
            Admin — All Bookings
        </h2>
    </x-slot>

    <div class="py-8 max-w-7xl mx-auto px-4">
        @include('partials.alerts')

        {{-- Status Filter --}}
        <form method="GET" action="{{ route('dashboard') }}" class="mb-6 flex gap-2 flex-wrap">
            @foreach(['', 'pending', 'approved', 'rejected'] as $s)
                <button type="submit" name="status" value="{{ $s }}"
                        class="px-4 py-2 rounded text-sm border transition
                        border-gray-300 dark:border-gray-600
                        {{ $status === $s
                            ? 'bg-blue-600 text-white'
                            : 'bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-200' }}">
                    {{ $s === '' ? 'All' : ucfirst($s) }}
                </button>
            @endforeach
        </form>

        <div class="overflow-x-auto ">
            <table class="w-full bg-white dark:bg-gray-800
                          rounded-xl shadow
                          border border-gray-200 dark:border-gray-700
                          text-sm ">

                <thead class="bg-gray-100 dark:bg-gray-700">
                    <tr class="text-gray-700 dark:text-gray-200">
                        <th class="px-4 py-3 text-left">User</th>
                        <th class="px-4 py-3 text-left">Facility</th>
                        <th class="px-4 py-3 text-left">Start</th>
                        <th class="px-4 py-3 text-left">End</th>
                        <th class="px-4 py-3 text-left">Status</th>
                        <th class="px-4 py-3 text-left">Actions</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($bookings as $booking)
                        <tr class="border-t border-gray-200 dark:border-gray-700
                                   hover:bg-gray-50 dark:hover:bg-gray-700 transition">

                            <td class="px-4 py-3 text-gray-800 dark:text-gray-100">
                                {{ $booking->user->name }}
                            </td>

                            <td class="px-4 py-3 text-gray-700 dark:text-gray-300">
                                {{ $booking->facility->name }}
                            </td>

                            <td class="px-4 py-3 text-gray-700 dark:text-gray-300">
                                {{ $booking->start_time->format('d M Y H:i') }}
                            </td>

                            <td class="px-4 py-3 text-gray-700 dark:text-gray-300">
                                {{ $booking->end_time->format('d M Y H:i') }}
                            </td>

                            <td class="px-4 py-3">
                                <span class="px-2 py-1 rounded text-xs font-semibold
                                    {{ $booking->status === 'approved'
                                        ? 'bg-green-100 text-green-700 dark:bg-green-900 dark:text-green-300' : '' }}
                                    {{ $booking->status === 'pending'
                                        ? 'bg-yellow-100 text-yellow-700 dark:bg-yellow-900 dark:text-yellow-300' : '' }}
                                    {{ $booking->status === 'rejected'
                                        ? 'bg-red-100 text-red-700 dark:bg-red-900 dark:text-red-300' : '' }}">
                                    {{ ucfirst($booking->status) }}
                                </span>
                            </td>

                            <td class="px-4 py-3 flex gap-2">
                                @if($booking->status === 'pending')

                                    <form action="{{ route('bookings.approve', $booking) }}" method="POST">
                                        @csrf @method('PATCH')
                                        <button class="px-2 py-1 bg-green-600 text-white text-xs rounded hover:bg-green-700 transition">
                                            Approve
                                        </button>
                                    </form>

                                    <form action="{{ route('bookings.reject', $booking) }}" method="POST">
                                        @csrf @method('PATCH')
                                        <button class="px-2 py-1 bg-red-600 text-white text-xs rounded hover:bg-red-700 transition">
                                            Reject
                                        </button>
                                    </form>
                                @else
                                    <span class="text-gray-400 dark:text-gray-500 text-xs">—</span>
                                @endif
                            </td>
                        </tr>

                    @empty
                        <tr>
                            <td colspan="6"
                                class="px-4 py-6 text-center text-gray-400 dark:text-gray-500">
                                No bookings found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-6 dark:text-gray-300">
            {{ $bookings->links() }}
        </div>
    </div>
</x-app-layout>
