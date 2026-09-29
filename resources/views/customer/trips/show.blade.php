<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">
            Trip Details
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-4xl sm:px-6 lg:px-8">

            @if (session('error'))
                <div class="mb-4 rounded bg-red-100 p-4 text-red-700">
                    {{ session('error') }}
                </div>
            @endif

            <div class="rounded-lg bg-white p-6 shadow">

                <h1 class="text-2xl font-bold">
                    {{ $trip->title }}
                </h1>

                <div class="mt-6 space-y-3">

                    <p>
                        <strong>Destination:</strong>
                        {{ $trip->destination }}
                    </p>

                    <p>
                        <strong>Travel Date:</strong>
                        {{ $trip->start_date->format('d M Y') }}
                        -
                        {{ $trip->end_date->format('d M Y') }}
                    </p>

                    <p>
                        <strong>Price:</strong>
                        RM {{ number_format($trip->price, 2) }}
                        / participant
                    </p>

                    <p>
                        <strong>Capacity:</strong>
                        {{ $participantCount }}
                        /
                        {{ $trip->max_capacity }}
                    </p>

                    <p>
                        <strong>Remaining Seats:</strong>
                        {{ $remainingSeats }}
                    </p>

                    <p>
                        <strong>Description:</strong>
                        {{ $trip->description ?: '-' }}
                    </p>

                </div>

                <div class="mt-8">

                    @if ($remainingSeats > 0)

                        <form
                            method="POST"
                            action="{{ route(
                                'customer.bookings.store',
                                $trip
                            ) }}"
                        >
                            @csrf

                            <x-primary-button>
                                Book This Trip
                            </x-primary-button>
                        </form>

                    @else

                        <span class="font-semibold text-red-600">
                            Trip Full
                        </span>

                    @endif

                </div>

            </div>
        </div>
    </div>
</x-app-layout>
