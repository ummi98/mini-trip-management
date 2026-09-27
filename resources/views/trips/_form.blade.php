<div class="space-y-6">

    <div>
        <x-input-label for="title" value="Trip Title" />
        <x-text-input
            id="title"
            name="title"
            type="text"
            class="mt-1 block w-full"
            :value="old('title', $trip->title ?? '')"
            required
        />
        <x-input-error :messages="$errors->get('title')" class="mt-2" />
    </div>

    <div>
        <x-input-label for="destination" value="Destination" />
        <x-text-input
            id="destination"
            name="destination"
            type="text"
            class="mt-1 block w-full"
            :value="old('destination', $trip->destination ?? '')"
            required
        />
        <x-input-error :messages="$errors->get('destination')" class="mt-2" />
    </div>

    <div>
        <x-input-label for="description" value="Description" />

        <textarea
            id="description"
            name="description"
            rows="4"
            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"
        >{{ old('description', $trip->description ?? '') }}</textarea>

        <x-input-error
            :messages="$errors->get('description')"
            class="mt-2"
        />
    </div>

    <div class="grid grid-cols-1 gap-6 md:grid-cols-2">

        <div>
            <x-input-label for="start_date" value="Start Date" />
            <x-text-input
                id="start_date"
                name="start_date"
                type="date"
                class="mt-1 block w-full"
                :value="old(
                    'start_date',
                    isset($trip)
                        ? $trip->start_date->format('Y-m-d')
                        : ''
                )"
                required
            />
            <x-input-error
                :messages="$errors->get('start_date')"
                class="mt-2"
            />
        </div>

        <div>
            <x-input-label for="end_date" value="End Date" />
            <x-text-input
                id="end_date"
                name="end_date"
                type="date"
                class="mt-1 block w-full"
                :value="old(
                    'end_date',
                    isset($trip)
                        ? $trip->end_date->format('Y-m-d')
                        : ''
                )"
                required
            />
            <x-input-error
                :messages="$errors->get('end_date')"
                class="mt-2"
            />
        </div>

    </div>

    <div class="grid grid-cols-1 gap-6 md:grid-cols-2">

        <div>
            <x-input-label for="price" value="Price (RM)" />
            <x-text-input
                id="price"
                name="price"
                type="number"
                step="0.01"
                min="0"
                class="mt-1 block w-full"
                :value="old('price', $trip->price ?? '')"
                required
            />
            <x-input-error
                :messages="$errors->get('price')"
                class="mt-2"
            />
        </div>

        <div>
            <x-input-label for="max_capacity" value="Maximum Capacity" />
            <x-text-input
                id="max_capacity"
                name="max_capacity"
                type="number"
                min="1"
                class="mt-1 block w-full"
                :value="old(
                    'max_capacity',
                    $trip->max_capacity ?? ''
                )"
                required
            />
            <x-input-error
                :messages="$errors->get('max_capacity')"
                class="mt-2"
            />
        </div>

    </div>

    <div>
        <x-input-label for="status" value="Status" />

        <select
            id="status"
            name="status"
            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"
            required
        >
            @foreach (['draft', 'available', 'closed'] as $status)
                <option
                    value="{{ $status }}"
                    @selected(
                        old('status', $trip->status ?? 'draft') === $status
                    )
                >
                    {{ ucfirst($status) }}
                </option>
            @endforeach
        </select>

        <x-input-error
            :messages="$errors->get('status')"
            class="mt-2"
        />
    </div>

    <div>
        <x-primary-button>
            {{ $buttonText }}
        </x-primary-button>
    </div>

</div>
