<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">Admin — All Bookings</h2>
    </x-slot>

    <div class="py-8 max-w-7xl mx-auto px-4">
        @include('partials.alerts')

        {{-- Status Filter --}}
        <form method="GET" action="{{ route('dashboard') }}" class="mb-4 flex gap-2">
            @foreach(['', 'pending', 'approved', 'rejected'] as $s)
                <button type="submit" name="status" value="{{ $s }}"
                        class="px-3 py-1 rounded text-sm border
                            {{ $status === $s ? 'bg-blue-600 text-white' : 'bg-white text-gray-700' }}">
                    {{ $s === '' ? 'All' : ucfirst($s) }}
                </button>
            @endforeach
        </form>

        <table class="w-full bg-white rounded-lg shadow text-sm">
            <thead class="bg-gray-100">
                <tr>
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
                    <tr class="border-t">
                        <td class="px-4 py-3">{{ $booking->user->name }}</td>
                        <td class="px-4 py-3">{{ $booking->facility->name }}</td>
                        <td class="px-4 py-3">{{ $booking->start_time->format('d M Y H:i') }}</td>
                        <td class="px-4 py-3">{{ $booking->end_time->format('d M Y H:i') }}</td>
                        <td class="px-4 py-3">
                            <span class="px-2 py-1 rounded text-xs font-semibold
                                {{ $booking->status === 'approved' ? 'bg-green-100 text-green-700' : '' }}
                                {{ $booking->status === 'pending'  ? 'bg-yellow-100 text-yellow-700' : '' }}
                                {{ $booking->status === 'rejected' ? 'bg-red-100 text-red-700' : '' }}">
                                {{ ucfirst($booking->status) }}
                            </span>
                        </td>
                        <td class="px-4 py-3 flex gap-2">
                            @if($booking->status === 'pending')
                                <form action="{{ route('bookings.approve', $booking) }}" method="POST">
                                    @csrf @method('PATCH')
                                    <button class="px-2 py-1 bg-green-600 text-white text-xs rounded hover:bg-green-700">
                                        Approve
                                    </button>
                                </form>
                                <form action="{{ route('bookings.reject', $booking) }}" method="POST">
                                    @csrf @method('PATCH')
                                    <button class="px-2 py-1 bg-red-600 text-white text-xs rounded hover:bg-red-700">
                                        Reject
                                    </button>
                                </form>
                            @else
                                <span class="text-gray-400 text-xs">—</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-4 py-6 text-center text-gray-400">No bookings found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="mt-4">{{ $bookings->links() }}</div>
    </div>
</x-app-layout>
