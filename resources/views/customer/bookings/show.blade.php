<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">
            Booking Details
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-5xl sm:px-6 lg:px-8">

            @if (session('success'))
                <div class="mb-4 rounded bg-green-100 p-4 text-green-700">
                    {{ session('success') }}
                </div>
            @endif

            <div class="rounded-lg bg-white p-6 shadow">

                <div class="grid gap-4 md:grid-cols-2">

                    <p>
                        <strong>Booking No:</strong>
                        {{ $booking->booking_no }}
                    </p>

                    <p>
                        <strong>Trip:</strong>
                        {{ $booking->trip->title }}
                    </p>

                    <p>
                        <strong>Status:</strong>
                        {{ ucfirst($booking->status) }}
                    </p>

                    <p>
                        <strong>Payment:</strong>
                        {{ ucfirst($booking->payment_status) }}
                    </p>

                    <p>
                        <strong>Total:</strong>
                        RM {{ number_format(
                            $booking->total_amount,
                            2
                        ) }}
                    </p>

                </div>

                <div class="mt-8 flex items-center justify-between">

                    <h3 class="text-lg font-bold">
                        Participants
                    </h3>

                    @if ($booking->status !== 'cancelled')
                        <a
                            href="{{ route(
                                'customer.participants.create',
                                $booking
                            ) }}"
                            class="rounded bg-gray-800 px-4 py-2 text-white"
                        >
                            Add Participant
                        </a>
                    @endif

                </div>

                <div class="mt-4 overflow-x-auto">

                    <table class="w-full">
                        <thead>
                            <tr class="border-b text-left">
                                <th class="p-3">Name</th>
                                <th class="p-3">Passport</th>
                                <th class="p-3">Expiry</th>
                                <th class="p-3">Nationality</th>
                            </tr>
                        </thead>

                        <tbody>

                            @forelse ($booking->participants as $participant)

                                <tr class="border-b">
                                    <td class="p-3">
                                        {{ $participant->name }}
                                    </td>

                                    <td class="p-3">
                                        {{ $participant->passport_no }}
                                    </td>

                                    <td class="p-3">
                                        {{ $participant->passport_expiry
                                            ?->format('d M Y') ?? '-' }}
                                    </td>

                                    <td class="p-3">
                                        {{ $participant->nationality ?? '-' }}
                                    </td>
                                </tr>

                            @empty

                                <tr>
                                    <td
                                        colspan="4"
                                        class="p-4 text-center text-gray-500"
                                    >
                                        No participants registered yet.
                                    </td>
                                </tr>

                            @endforelse

                        </tbody>
                    </table>

                </div>

            </div>
        </div>
    </div>
</x-app-layout>
