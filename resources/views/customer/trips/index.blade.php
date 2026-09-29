<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">
            Available Trips
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">

            <form method="GET" class="mb-6 flex gap-3">
                <input
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Search trip or destination..."
                    class="rounded-md border-gray-300"
                >

                <x-primary-button>
                    Search
                </x-primary-button>

                <a
                    href="{{ route('customer.trips.index') }}"
                    class="rounded-md border px-4 py-2"
                >
                    Reset
                </a>
            </form>

            <div class="grid gap-6 md:grid-cols-3">

                @forelse ($trips as $trip)
                    @php
                        $used = $trip->participants()->count();
                        $remaining = max(
                            0,
                            $trip->max_capacity - $used
                        );
                    @endphp

                    <div class="rounded-lg bg-white p-6 shadow">

                        <h3 class="text-lg font-bold">
                            {{ $trip->title }}
                        </h3>

                        <p class="mt-2 text-gray-600">
                            {{ $trip->destination }}
                        </p>

                        <p class="mt-3">
                            {{ $trip->start_date->format('d M Y') }}
                            -
                            {{ $trip->end_date->format('d M Y') }}
                        </p>

                        <p class="mt-2 font-semibold">
                            RM {{ number_format($trip->price, 2) }}
                        </p>

                        <p class="mt-2 text-sm">
                            Remaining Seats:
                            <strong>{{ $remaining }}</strong>
                        </p>

                        <a
                            href="{{ route(
                                'customer.trips.show',
                                $trip
                            ) }}"
                            class="mt-4 inline-block text-indigo-600"
                        >
                            View Details
                        </a>

                    </div>

                @empty
                    <p>No available trips found.</p>
                @endforelse

            </div>

            <div class="mt-6">
                {{ $trips->links() }}
            </div>

        </div>
    </div>
</x-app-layout>
