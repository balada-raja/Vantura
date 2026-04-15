<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-100">Book: {{ $facility->name }}</h2>
    </x-slot>

    <div class="py-8 max-w-xl mx-auto px-4">
        @include('partials.alerts')

        <form action="{{ route('bookings.store') }}" method="POST"
              class="bg-white rounded-lg shadow p-6 space-y-4">
            @csrf
            <input type="hidden" name="facility_id" value="{{ $facility->id }}">

            <div>
                <label class="block text-sm font-medium text-gray-700">Start Date & Time</label>
                <input type="datetime-local" name="start_time" value="{{ old('start_time') }}"
                       class="mt-1 w-full border-gray-300 rounded-md shadow-sm">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">End Date & Time</label>
                <input type="datetime-local" name="end_time" value="{{ old('end_time') }}"
                       class="mt-1 w-full border-gray-300 rounded-md shadow-sm">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700"> Partisipan </label>
                <input type="number" name="participants" min="1" value="1"
                        class="mt-1 w-full border-gray-300 rounded-md shadow-sm">
            </div>

            <div class="mt-4">
                <div class="g-recaptcha"
                    data-sitekey="{{ config('services.recaptcha.site_key') }}">
                </div>

                @error('captcha')
                <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit"
                    class="w-full bg-green-600 text-white py-2 rounded-md hover:bg-green-700">
                Submit Booking
            </button>
        </form>
    </div>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</x-app-layout>
