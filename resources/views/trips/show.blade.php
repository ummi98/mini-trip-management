<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Trip Details
        </h2>
    </x-slot>

    <div class="py-12">

        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white shadow-sm sm:rounded-lg">

                <div class="p-6 space-y-4">

                    <h1 class="text-2xl font-bold">
                        {{ $trip->title }}
                    </h1>

                    <div>
                        <strong>Destination:</strong>
                        {{ $trip->destination }}
                    </div>

                    <div>
                        <strong>Date:</strong>
                        {{ $trip->start_date->format('d M Y') }}
                        -
                        {{ $trip->end_date->format('d M Y') }}
                    </div>

                    <div>
                        <strong>Price:</strong>
                        RM {{ number_format($trip->price, 2) }}
                    </div>

                    <div>
                        <strong>Maximum Capacity:</strong>
                        {{ $trip->max_capacity }}
                    </div>

                    <div>
                        <strong>Status:</strong>
                        {{ ucfirst($trip->status) }}
                    </div>

                    <div>
                        <strong>Description:</strong>

                        <p class="mt-2 text-gray-600">
                            {{ $trip->description ?: '-' }}
                        </p>
                    </div>

                    <div class="pt-4">

                        <a
                            href="{{ route('trips.index') }}"
                            class="text-blue-600"
                        >
                            ← Back to Trips
                        </a>

                    </div>

                </div>

            </div>

        </div>

    </div>

</x-app-layout>
