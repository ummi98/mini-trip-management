<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">
            Manage Booking
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
                        <strong>Booking:</strong>
                        {{ $booking->booking_no }}
                    </p>

                    <p>
                        <strong>Customer:</strong>
                        {{ $booking->user->name }}
                    </p>

                    <p>
                        <strong>Email:</strong>
                        {{ $booking->user->email }}
                    </p>

                    <p>
                        <strong>Trip:</strong>
                        {{ $booking->trip->title }}
                    </p>

                    <p>
                        <strong>Total:</strong>
                        RM {{ number_format(
                            $booking->total_amount,
                            2
                        ) }}
                    </p>
                </div>

                <form
                    method="POST"
                    action="{{ route(
                        'admin.bookings.update',
                        $booking
                    ) }}"
                    class="mt-8 grid gap-4 md:grid-cols-2"
                >
                    @csrf
                    @method('PATCH')

                    <div>
                        <x-input-label value="Booking Status" />

                        <select
                            name="status"
                            class="mt-1 w-full rounded-md border-gray-300"
                        >
                            @foreach (
                                ['pending', 'confirmed', 'cancelled']
                                as $status
                            )
                                <option
                                    value="{{ $status }}"
                                    @selected(
                                        $booking->status === $status
                                    )
                                >
                                    {{ ucfirst($status) }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <x-input-label value="Payment Status" />

                        <select
                            name="payment_status"
                            class="mt-1 w-full rounded-md border-gray-300"
                        >
                            @foreach (['unpaid', 'paid'] as $status)
                                <option
                                    value="{{ $status }}"
                                    @selected(
                                        $booking->payment_status
                                        === $status
                                    )
                                >
                                    {{ ucfirst($status) }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <x-primary-button>
                            Update Booking
                        </x-primary-button>
                    </div>

                </form>

                <h3 class="mt-10 text-lg font-bold">
                    Participants
                </h3>

                <div class="mt-4 overflow-x-auto">

                    <table class="w-full">
                        <thead>
                            <tr class="border-b text-left">
                                <th class="p-3">Name</th>
                                <th class="p-3">Passport</th>
                                <th class="p-3">Expiry</th>
                                <th class="p-3">Nationality</th>
                                <th class="p-3">File</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse (
                                $booking->participants as $participant
                            )

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

                                    <td class="p-3">
                                        @if ($participant->passport_file)
                                            <a
                                                href="{{ asset(
                                                    'storage/' .
                                                    $participant
                                                        ->passport_file
                                                ) }}"
                                                target="_blank"
                                                class="text-indigo-600"
                                            >
                                                View
                                            </a>
                                        @else
                                            -
                                        @endif
                                    </td>
                                </tr>

                            @empty

                                <tr>
                                    <td
                                        colspan="5"
                                        class="p-4 text-center"
                                    >
                                        No participants.
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
