<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-wrap items-center justify-between gap-3">
            <div>
                <p class="text-xs font-semibold uppercase tracking-[0.2em] text-indigo-500">Your travel workspace</p>
                <h2 class="mt-1 text-2xl font-bold tracking-tight text-slate-900">Overview</h2>
            </div>
            <span class="rounded-full border border-slate-200 bg-white px-4 py-2 text-sm text-slate-500">{{ now()->format('l, d M Y') }}</span>
        </div>
    </x-slot>

    @php
        $isCustomer = auth()->user()->role === 'customer';
        $tripsUrl = route($isCustomer ? 'customer.trips.index' : 'trips.index');
        $bookingsUrl = route($isCustomer ? 'customer.bookings.index' : 'admin.bookings.index');
    @endphp

    <div class="mx-auto flex max-w-7xl flex-col gap-8 px-4 py-8 sm:px-6 lg:px-8">
        <section class="relative isolate overflow-hidden rounded-[2rem] bg-slate-950 p-7 text-white sm:p-10 lg:p-12">
            <div aria-hidden="true" class="pointer-events-none absolute -right-16 -top-32 h-96 w-96 rounded-full bg-indigo-600/30 blur-3xl"></div>
            <svg aria-hidden="true" class="pointer-events-none absolute inset-y-0 right-0 hidden h-full w-2/5 text-indigo-300/20 lg:block" viewBox="0 0 400 300" fill="none">
                <circle cx="270" cy="150" r="115" stroke="currentColor" />
                <circle cx="270" cy="150" r="80" stroke="currentColor" />
                <path d="M20 250C50 90 140 280 205 150S320 30 400 80" stroke="currentColor" stroke-width="2" stroke-dasharray="7 9" />
                <circle cx="205" cy="150" r="8" fill="#a5b4fc" stroke="none" />
                <path d="m286 82 40-12-13 40-9-19-18-9Z" fill="#c7d2fe" stroke="none" />
            </svg>
            <div class="relative max-w-2xl">
                <span class="inline-flex items-center gap-2 rounded-full border border-white/15 bg-white/5 px-3 py-1.5 text-xs font-medium text-indigo-200">
                    <span class="h-1.5 w-1.5 rounded-full bg-emerald-400"></span>
                    A little planning. A great journey.
                </span>
                <h1 class="mt-6 break-words text-3xl font-bold tracking-tight sm:text-4xl">Welcome back, {{ auth()->user()->name }}.</h1>
                <p class="mt-4 max-w-lg text-base leading-7 text-slate-300">
                    {{ $isCustomer ? 'Your next adventure starts here. Discover a new destination and keep every booking in one place.' : 'Great trips start with a clear view. Bring your trips, bookings, and travellers together in one place.' }}
                </p>
                <div class="mt-7 flex flex-wrap gap-3">
                    <a href="{{ $isCustomer ? $tripsUrl : route('trips.create') }}" class="inline-flex items-center gap-3 rounded-xl bg-indigo-500 px-5 py-3 text-sm font-semibold text-white transition hover:bg-indigo-400">
                        {{ $isCustomer ? 'Explore trips' : 'Create a trip' }} <span aria-hidden="true">&rarr;</span>
                    </a>
                    <a href="{{ $bookingsUrl }}" class="rounded-xl border border-white/20 bg-white/5 px-5 py-3 text-sm font-semibold text-white transition hover:bg-white/10">{{ $isCustomer ? 'My bookings' : 'Manage bookings' }}</a>
                </div>
            </div>
        </section>

        <section aria-label="Travel statistics" class="grid gap-4 sm:grid-cols-2 {{ $isCustomer ? 'lg:grid-cols-3' : 'lg:grid-cols-4' }}">
            <a href="{{ $tripsUrl }}" class="dashboard-card group">
                <div class="flex items-center justify-between gap-3"><p class="text-sm font-medium text-slate-500">{{ $isCustomer ? 'Available trips' : 'Total trips' }}</p><span class="stat-icon bg-indigo-50 text-indigo-600" aria-hidden="true">↗</span></div>
                <p class="text-4xl font-bold tracking-tight text-slate-900">{{ number_format($tripCount) }}</p>
                <p class="text-xs text-slate-500">{{ $isCustomer ? 'Find your next destination' : 'All your journeys, organised' }} <span class="text-indigo-500" aria-hidden="true">&rarr;</span></p>
            </a>
            <a href="{{ $bookingsUrl }}" class="dashboard-card group">
                <div class="flex items-center justify-between gap-3"><p class="text-sm font-medium text-slate-500">{{ $isCustomer ? 'My bookings' : 'Total bookings' }}</p><span class="stat-icon bg-sky-50 text-sky-600" aria-hidden="true">≡</span></div>
                <p class="text-4xl font-bold tracking-tight text-slate-900">{{ number_format($bookingCount) }}</p>
                <p class="text-xs text-slate-500">Every reservation in one place <span class="text-indigo-500" aria-hidden="true">&rarr;</span></p>
            </a>
            <div class="dashboard-card">
                <div class="flex items-center justify-between gap-3"><p class="text-sm font-medium text-slate-500">Pending bookings</p><span class="stat-icon bg-amber-50 text-amber-600" aria-hidden="true">◷</span></div>
                <p class="text-4xl font-bold tracking-tight text-slate-900">{{ number_format($pendingCount) }}</p>
                <p class="text-xs text-slate-500">{{ $pendingCount > 0 ? 'Awaiting confirmation' : 'You’re all caught up' }}</p>
            </div>
            @if (! $isCustomer)
                <div class="dashboard-card">
                    <div class="flex items-center justify-between gap-3"><p class="text-sm font-medium text-slate-500">Participants</p><span class="stat-icon bg-emerald-50 text-emerald-600" aria-hidden="true">♧</span></div>
                    <p class="text-4xl font-bold tracking-tight text-slate-900">{{ number_format($participantCount) }}</p>
                    <p class="text-xs text-slate-500">Travellers joining your journeys</p>
                </div>
            @endif
        </section>

        <section>
            <div class="mb-5 flex items-center gap-3"><h2 class="text-lg font-bold text-slate-900">Where to next?</h2><span class="h-px flex-1 bg-slate-200"></span></div>
            <div class="grid gap-4 md:grid-cols-3">
                <a href="{{ $tripsUrl }}" class="quick-link"><span class="text-xs font-semibold uppercase tracking-widest text-indigo-500">01 / Discover</span><h3 class="text-lg font-bold text-slate-900">{{ $isCustomer ? 'Find your next escape' : 'Your trip collection' }}</h3><p class="text-sm leading-6 text-slate-500">{{ $isCustomer ? 'Browse destinations, dates, and details for your next getaway.' : 'Review destinations, manage availability, and plan what comes next.' }}</p><span class="text-sm font-semibold text-indigo-600">{{ $isCustomer ? 'Explore trips' : 'Manage trips' }} &rarr;</span></a>
                <a href="{{ $bookingsUrl }}" class="quick-link"><span class="text-xs font-semibold uppercase tracking-widest text-indigo-500">02 / Organise</span><h3 class="text-lg font-bold text-slate-900">Bookings made simple</h3><p class="text-sm leading-6 text-slate-500">Keep track of reservations and check the details that matter.</p><span class="text-sm font-semibold text-indigo-600">View bookings &rarr;</span></a>
                <a href="{{ route('profile.edit') }}" class="quick-link"><span class="text-xs font-semibold uppercase tracking-widest text-indigo-500">03 / Personalise</span><h3 class="text-lg font-bold text-slate-900">Make yourself at home</h3><p class="text-sm leading-6 text-slate-500">Keep your profile up to date and manage your account settings.</p><span class="text-sm font-semibold text-indigo-600">Account settings &rarr;</span></a>
            </div>
        </section>
        <p class="pb-2 text-center text-xs text-slate-400">MiniTrip <span class="px-2" aria-hidden="true">/</span> Less planning hassle. More memorable journeys.</p>
    </div>
</x-app-layout>
