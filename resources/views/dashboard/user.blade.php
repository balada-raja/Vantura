<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">My Bookings</h2>
    </x-slot>

    <div class="py-8 max-w-5xl mx-auto px-4">
        @include('partials.alerts')

        <table class="w-full bg-white rounded-lg shadow text-sm">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-3 text-left">Facility</th>
                    <th class="px-4 py-3 text-left">Start</th>
                    <th class="px-4 py-3 text-left">End</th>
                    <th class="px-4 py-3 text-left">Status</th>
                    <th class="px-4 py-3 text-left">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($bookings as $booking)
                    <tr class="border-t">
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
                        <td class="px-4 py-3">
                            @if($booking->status === 'pending')
                                <form action="{{ route('bookings.cancel', $booking) }}" method="POST"
                                      onsubmit="return confirm('Cancel this booking?')">
                                    @csrf @method('DELETE')
                                    <button class="text-red-600 hover:underline text-xs">Cancel</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-4 py-6 text-center text-gray-400">No bookings yet.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="mt-4">{{ $bookings->links() }}</div>
    </div>
</x-app-layout>
