<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">
            My Bookings
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">

            <div class="overflow-hidden bg-white shadow sm:rounded-lg">

                <table class="w-full">
                    <thead>
                        <tr class="border-b text-left">
                            <th class="p-4">Booking</th>
                            <th class="p-4">Trip</th>
                            <th class="p-4">Participants</th>
                            <th class="p-4">Amount</th>
                            <th class="p-4">Status</th>
                            <th class="p-4">Payment</th>
                            <th class="p-4"></th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse ($bookings as $booking)

                            <tr class="border-b">
                                <td class="p-4">
                                    {{ $booking->booking_no }}
                                </td>

                                <td class="p-4">
                                    {{ $booking->trip->title }}
                                </td>

                                <td class="p-4">
                                    {{ $booking->participants->count() }}
                                </td>

                                <td class="p-4">
                                    RM {{ number_format(
                                        $booking->total_amount,
                                        2
                                    ) }}
                                </td>

                                <td class="p-4">
                                    {{ ucfirst($booking->status) }}
                                </td>

                                <td class="p-4">
                                    {{ ucfirst(
                                        $booking->payment_status
                                    ) }}
                                </td>

                                <td class="p-4">
                                    <a
                                        href="{{ route(
                                            'customer.bookings.show',
                                            $booking
                                        ) }}"
                                        class="text-indigo-600"
                                    >
                                        View
                                    </a>
                                </td>
                            </tr>

                        @empty

                            <tr>
                                <td
                                    colspan="7"
                                    class="p-6 text-center"
                                >
                                    No bookings yet.
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
</x-app-layout>
