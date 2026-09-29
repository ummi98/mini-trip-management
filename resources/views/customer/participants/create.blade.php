<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">
            Register Participant
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-3xl sm:px-6 lg:px-8">

            @if (session('error'))
                <div class="mb-4 rounded bg-red-100 p-4 text-red-700">
                    {{ session('error') }}
                </div>
            @endif

            <div class="rounded-lg bg-white p-6 shadow">

                <p class="mb-6">
                    Booking:
                    <strong>{{ $booking->booking_no }}</strong>
                    —
                    {{ $booking->trip->title }}
                </p>

                <form
                    method="POST"
                    enctype="multipart/form-data"
                    action="{{ route(
                        'customer.participants.store',
                        $booking
                    ) }}"
                    class="space-y-5"
                >
                    @csrf

                    <div>
                        <x-input-label value="Full Name" />

                        <x-text-input
                            name="name"
                            class="mt-1 block w-full"
                            :value="old('name')"
                            required
                        />

                        <x-input-error
                            :messages="$errors->get('name')"
                            class="mt-2"
                        />
                    </div>

                    <div>
                        <x-input-label value="Passport Number" />

                        <x-text-input
                            name="passport_no"
                            class="mt-1 block w-full"
                            :value="old('passport_no')"
                            required
                        />

                        <x-input-error
                            :messages="$errors->get('passport_no')"
                            class="mt-2"
                        />
                    </div>

                    <div>
                        <x-input-label value="Passport Expiry" />

                        <x-text-input
                            type="date"
                            name="passport_expiry"
                            class="mt-1 block w-full"
                            :value="old('passport_expiry')"
                        />

                        <x-input-error
                            :messages="$errors->get('passport_expiry')"
                            class="mt-2"
                        />
                    </div>

                    <div>
                        <x-input-label value="Date of Birth" />

                        <x-text-input
                            type="date"
                            name="date_of_birth"
                            class="mt-1 block w-full"
                            :value="old('date_of_birth')"
                        />
                    </div>

                    <div>
                        <x-input-label value="Nationality" />

                        <x-text-input
                            name="nationality"
                            class="mt-1 block w-full"
                            :value="old('nationality')"
                        />
                    </div>

                    <div>
                        <x-input-label value="Passport Copy" />

                        <input
                            type="file"
                            name="passport_file"
                            accept=".pdf,.jpg,.jpeg,.png"
                            class="mt-1 block w-full"
                        />

                        <x-input-error
                            :messages="$errors->get('passport_file')"
                            class="mt-2"
                        />
                    </div>

                    <x-primary-button>
                        Register Participant
                    </x-primary-button>

                </form>

            </div>
        </div>
    </div>
</x-app-layout>
