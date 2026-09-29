<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">
            Booking Management
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">

            <div class="rounded-lg bg-white p-6 shadow">

                <form
                    method="GET"
                    class="mb-6 flex flex-wrap gap-3"
                >
                    <input
                        name="search"
                        value="{{ request('search') }}"
                        placeholder="Booking, customer or trip..."
                        class="rounded-md border-gray-300"
                    >

                    <select
                        name="status"
                        class="rounded-md border-gray-300"
                    >
                        <option value="">All Booking Status</option>

                        @foreach (
                            ['pending', 'confirmed', 'cancelled']
                            as $status
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

                    <select
                        name="payment_status"
                        class="rounded-md border-gray-300"
                    >
                        <option value="">All Payment Status</option>

                        <option
                            value="unpaid"
                            @selected(
                                request('payment_status') === 'unpaid'
                            )
                        >
                            Unpaid
                        </option>

                        <option
                            value="paid"
                            @selected(
                                request('payment_status') === 'paid'
                            )
                        >
                            Paid
                        </option>
                    </select>

                    <x-primary-button>
                        Filter
                    </x-primary-button>

                    <a
                        href="{{ route('admin.bookings.index') }}"
                        class="rounded border px-4 py-2"
                    >
                        Reset
                    </a>
                </form>

                <div class="overflow-x-auto">

                    <table class="w-full">
                        <thead>
                            <tr class="border-b text-left">
                                <th class="p-3">Booking</th>
                                <th class="p-3">Customer</th>
                                <th class="p-3">Trip</th>
                                <th class="p-3">Pax</th>
                                <th class="p-3">Total</th>
                                <th class="p-3">Status</th>
                                <th class="p-3">Payment</th>
                                <th class="p-3"></th>
                            </tr>
                        </thead>

                        <tbody>

                            @forelse ($bookings as $booking)

                                <tr class="border-b">
                                    <td class="p-3">
                                        {{ $booking->booking_no }}
                                    </td>

                                    <td class="p-3">
                                        {{ $booking->user->name }}
                                    </td>

                                    <td class="p-3">
                                        {{ $booking->trip->title }}
                                    </td>

                                    <td class="p-3">
                                        {{ $booking->participants->count() }}
                                    </td>

                                    <td class="p-3">
                                        RM {{ number_format(
                                            $booking->total_amount,
                                            2
                                        ) }}
                                    </td>

                                    <td class="p-3">
                                        {{ ucfirst($booking->status) }}
                                    </td>

                                    <td class="p-3">
                                        {{ ucfirst(
                                            $booking->payment_status
                                        ) }}
                                    </td>

                                    <td class="p-3">
                                        <a
                                            href="{{ route(
                                                'admin.bookings.show',
                                                $booking
                                            ) }}"
                                            class="text-indigo-600"
                                        >
                                            Manage
                                        </a>
                                    </td>
                                </tr>

                            @empty

                                <tr>
                                    <td
                                        colspan="8"
                                        class="p-6 text-center"
                                    >
                                        No bookings found.
                                    </td>
                                </tr>

                            @endforelse

                        </tbody>
                    </table>

                </div>

                <div class="mt-6">
                    {{ $bookings->links() }}
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
