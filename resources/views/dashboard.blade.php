<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">
            Dashboard
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">

            <div class="grid gap-6 md:grid-cols-4">

                <div class="rounded-lg bg-white p-6 shadow">
                    <p class="text-sm text-gray-500">
                        Trips
                    </p>

                    <p class="mt-2 text-3xl font-bold">
                        {{ $tripCount }}
                    </p>
                </div>

                <div class="rounded-lg bg-white p-6 shadow">
                    <p class="text-sm text-gray-500">
                        Bookings
                    </p>

                    <p class="mt-2 text-3xl font-bold">
                        {{ $bookingCount }}
                    </p>
                </div>

                <div class="rounded-lg bg-white p-6 shadow">
                    <p class="text-sm text-gray-500">
                        Pending Bookings
                    </p>

                    <p class="mt-2 text-3xl font-bold">
                        {{ $pendingCount }}
                    </p>
                </div>

                @if (auth()->user()->role !== 'customer')
                    <div class="rounded-lg bg-white p-6 shadow">
                        <p class="text-sm text-gray-500">
                            Participants
                        </p>

                        <p class="mt-2 text-3xl font-bold">
                            {{ $participantCount }}
                        </p>
                    </div>
                @endif

            </div>

        </div>
    </div>
</x-app-layout>