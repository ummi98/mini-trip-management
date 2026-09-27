<x-app-layout>

    <x-slot name="header">
        <div class="flex justify-between items-center">

            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Trip Management
            </h2>

            <a
                href="{{ route('trips.create') }}"
                class="px-4 py-2 bg-gray-800 text-white rounded-md"
            >
                Add Trip
            </a>

        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if (session('success'))
                <div
                    class="mb-4 p-4 bg-green-100 text-green-800 rounded"
                >
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white shadow-sm sm:rounded-lg">

                <div class="p-6">

                    <form
                        method="GET"
                        action="{{ route('trips.index') }}"
                        class="mb-6 flex gap-3"
                    >

                        <input
                            type="text"
                            name="search"
                            value="{{ request('search') }}"
                            placeholder="Search title or destination..."
                            class="rounded-md border-gray-300"
                        >

                        <select
                            name="status"
                            class="rounded-md border-gray-300"
                        >
                            <option value="">All Status</option>

                            @foreach (
                                ['draft', 'available', 'closed'] as $status
                            )
                                <option
                                    value="{{ $status }}"
                                    @selected(
                                        request('status') === $status
                                    )
                                >
                                    {{ ucfirst($status) }}
                                </option>
                            @endforeach
                        </select>

                        <x-primary-button>
                            Search
                        </x-primary-button>

                        <a
                            href="{{ route('trips.index') }}"
                            class="px-4 py-2 border rounded-md"
                        >
                            Reset
                        </a>

                    </form>

                    <div class="overflow-x-auto">

                        <table class="w-full">

                            <thead>
                                <tr class="border-b text-left">
                                    <th class="p-3">Trip</th>
                                    <th class="p-3">Destination</th>
                                    <th class="p-3">Date</th>
                                    <th class="p-3">Price</th>
                                    <th class="p-3">Capacity</th>
                                    <th class="p-3">Status</th>
                                    <th class="p-3">Action</th>
                                </tr>
                            </thead>

                            <tbody>

                                @forelse ($trips as $trip)

                                    <tr class="border-b">

                                        <td class="p-3">
                                            {{ $trip->title }}
                                        </td>

                                        <td class="p-3">
                                            {{ $trip->destination }}
                                        </td>

                                        <td class="p-3">
                                            {{ $trip->start_date->format('d M Y') }}
                                            -
                                            {{ $trip->end_date->format('d M Y') }}
                                        </td>

                                        <td class="p-3">
                                            RM {{ number_format($trip->price, 2) }}
                                        </td>

                                        <td class="p-3">
                                            {{ $trip->max_capacity }}
                                        </td>

                                        <td class="p-3">
                                            {{ ucfirst($trip->status) }}
                                        </td>

                                        <td class="p-3">
                                            <div class="flex gap-3">

                                                <a
                                                    href="{{ route(
                                                        'trips.show',
                                                        $trip
                                                    ) }}"
                                                    class="text-blue-600"
                                                >
                                                    View
                                                </a>

                                                <a
                                                    href="{{ route(
                                                        'trips.edit',
                                                        $trip
                                                    ) }}"
                                                    class="text-indigo-600"
                                                >
                                                    Edit
                                                </a>

                                                <form
                                                    method="POST"
                                                    action="{{ route(
                                                        'trips.destroy',
                                                        $trip
                                                    ) }}"
                                                >
                                                    @csrf
                                                    @method('DELETE')

                                                    <button
                                                        type="submit"
                                                        class="text-red-600"
                                                        onclick="return confirm(
                                                            'Delete this trip?'
                                                        )"
                                                    >
                                                        Delete
                                                    </button>

                                                </form>

                                            </div>
                                        </td>

                                    </tr>

                                @empty

                                    <tr>
                                        <td
                                            colspan="7"
                                            class="p-6 text-center text-gray-500"
                                        >
                                            No trips found.
                                        </td>
                                    </tr>

                                @endforelse

                            </tbody>

                        </table>

                    </div>

                    <div class="mt-6">
                        {{ $trips->links() }}
                    </div>

                </div>

            </div>

        </div>
    </div>

</x-app-layout>
