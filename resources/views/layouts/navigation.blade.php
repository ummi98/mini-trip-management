<nav aria-label="Main navigation" x-data="{ open: false }" @keydown.escape.window="open = false"
    class="sticky top-0 z-50 border-b border-slate-200/80 bg-white/95 backdrop-blur">

    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="flex h-20 items-center justify-between">

            {{-- LEFT --}}
            <div class="flex items-center gap-6">

                {{-- BRAND --}}
                <a href="{{ route('dashboard') }}"
                    class="group flex items-center gap-3">

                    <div
                        class="flex h-11 w-11 items-center justify-center rounded-2xl
                               bg-gradient-to-br from-indigo-600 to-violet-600
                               text-white shadow-lg shadow-indigo-200
                               transition group-hover:scale-105">

                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="h-6 w-6"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                            stroke-width="2">

                            <path stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M17.8 19.2L16 11l3.5-3.5
                                   C21 6 21.5 4 21 3
                                   c-1-.5-3 0-4.5 1.5
                                   L13 8 4.8 6.2
                                   c-.5-.1-.9.1-1.1.5
                                   l-.3.5 6.6 3.3-3 3
                                   -2-.5-2.5 0-3 1
                                   l4 2 2 4c1-.5 1.5-1 1-3
                                   l3-3 3.3 6.6.5-.3
                                   c.4-.2.6-.6.5-1.1z" />
                        </svg>
                    </div>

                    <div class="block">
                        <div class="text-lg font-extrabold tracking-tight text-slate-900">
                            MiniTrip
                        </div>

                        <div class="-mt-1 text-[10px] font-bold uppercase tracking-[0.2em]
                                    text-indigo-500">
                            Travel Management
                        </div>
                    </div>
                </a>

                {{-- DESKTOP NAVIGATION --}}
                <div class="hidden items-center gap-2 lg:flex">

                    {{-- Dashboard --}}
                    <a href="{{ route('dashboard') }}"
                        class="rounded-xl px-4 py-2.5 text-sm font-semibold transition
                        {{ request()->routeIs('dashboard')
                            ? 'bg-indigo-50 text-indigo-700'
                            : 'text-slate-500 hover:bg-slate-50 hover:text-slate-900' }}">

                        Dashboard
                    </a>

                    {{-- ADMIN / STAFF --}}
                    @if (in_array(auth()->user()->role, ['admin', 'staff']))

                        <a href="{{ route('trips.index') }}"
                            class="rounded-xl px-4 py-2.5 text-sm font-semibold transition
                            {{ request()->routeIs('trips.*')
                                ? 'bg-indigo-50 text-indigo-700'
                                : 'text-slate-500 hover:bg-slate-50 hover:text-slate-900' }}">

                            Trips
                        </a>

                        <a href="{{ route('admin.bookings.index') }}"
                            class="rounded-xl px-4 py-2.5 text-sm font-semibold transition
                            {{ request()->routeIs('admin.bookings.*')
                                ? 'bg-indigo-50 text-indigo-700'
                                : 'text-slate-500 hover:bg-slate-50 hover:text-slate-900' }}">

                            Bookings
                        </a>

                    @endif

                    {{-- CUSTOMER --}}
                    @if (auth()->user()->role === 'customer')

                        <a href="{{ route('customer.trips.index') }}"
                            class="rounded-xl px-4 py-2.5 text-sm font-semibold transition
                            {{ request()->routeIs('customer.trips.*')
                                ? 'bg-indigo-50 text-indigo-700'
                                : 'text-slate-500 hover:bg-slate-50 hover:text-slate-900' }}">

                            Explore Trips
                        </a>

                        <a href="{{ route('customer.bookings.index') }}"
                            class="rounded-xl px-4 py-2.5 text-sm font-semibold transition
                            {{ request()->routeIs('customer.bookings.*')
                                ? 'bg-indigo-50 text-indigo-700'
                                : 'text-slate-500 hover:bg-slate-50 hover:text-slate-900' }}">

                            My Bookings
                        </a>

                    @endif

                </div>
            </div>

            {{-- RIGHT --}}
            <div class="hidden items-center gap-4 lg:flex">

                {{-- ROLE --}}
                <span
                    class="rounded-full bg-indigo-50 px-3 py-1.5
                           text-xs font-bold uppercase tracking-wide text-indigo-700">
                    {{ auth()->user()->role }}
                </span>

                {{-- USER DROPDOWN --}}
                <x-dropdown align="right" width="48">

                    <x-slot name="trigger">

                        <button type="button" :aria-expanded="open.toString()" aria-label="Account menu"
                            class="flex items-center gap-3 rounded-2xl border border-slate-200
                                   bg-white px-3 py-2 transition
                                   hover:border-indigo-200 hover:bg-indigo-50/50">

                            {{-- Avatar --}}
                            <div
                                class="flex h-9 w-9 items-center justify-center rounded-xl
                                       bg-gradient-to-br from-indigo-500 to-violet-600
                                       text-sm font-bold text-white">

                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}

                            </div>

                            <div class="text-left">
                                <div class="max-w-[130px] truncate text-sm font-bold text-slate-800">
                                    {{ Auth::user()->name }}
                                </div>

                                <div class="max-w-[130px] truncate text-xs text-slate-400">
                                    {{ Auth::user()->email }}
                                </div>
                            </div>

                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="h-4 w-4 text-slate-400"
                                viewBox="0 0 20 20"
                                fill="currentColor">

                                <path fill-rule="evenodd"
                                    d="M5.23 7.21a.75.75 0 011.06.02L10
                                       11.168l3.71-3.938a.75.75 0
                                       111.08 1.04l-4.25 4.5a.75.75
                                       0 01-1.08 0l-4.25-4.5a.75.75
                                       0 01.02-1.06z"
                                    clip-rule="evenodd" />
                            </svg>

                        </button>

                    </x-slot>

                    <x-slot name="content">

                        <div class="border-b border-slate-100 px-4 py-3">
                            <div class="text-xs font-semibold uppercase tracking-wider text-slate-400">
                                Account
                            </div>
                        </div>

                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile Settings') }}
                        </x-dropdown-link>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link
                                :href="route('logout')"
                                onclick="event.preventDefault();
                                         this.closest('form').submit();">

                                {{ __('Log Out') }}

                            </x-dropdown-link>
                        </form>

                    </x-slot>

                </x-dropdown>

            </div>

            {{-- MOBILE BUTTON --}}
            <div class="flex lg:hidden">

                <button type="button" @click="open = !open" :aria-expanded="open.toString()" aria-controls="mobile-navigation" aria-label="Toggle navigation"
                    class="rounded-xl p-2.5 text-slate-500
                           hover:bg-slate-100 hover:text-slate-900">

                    <svg x-show="!open"
                        xmlns="http://www.w3.org/2000/svg"
                        class="h-6 w-6"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor">

                        <path stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                    </svg>

                    <svg x-show="open"
                        x-cloak
                        xmlns="http://www.w3.org/2000/svg"
                        class="h-6 w-6"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor">

                        <path stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>

                </button>

            </div>

        </div>
    </div>

    {{-- MOBILE MENU --}}
    <div id="mobile-navigation" x-show="open"
        x-transition
        x-cloak
        class="border-t border-slate-100 bg-white px-4 py-4 lg:hidden">

        <div class="space-y-1">

            <a href="{{ route('dashboard') }}"
                class="block rounded-xl px-4 py-3 text-sm font-semibold
                {{ request()->routeIs('dashboard')
                    ? 'bg-indigo-50 text-indigo-700'
                    : 'text-slate-600' }}">
                Dashboard
            </a>

            @if (in_array(auth()->user()->role, ['admin', 'staff']))

                <a href="{{ route('trips.index') }}"
                    class="block rounded-xl px-4 py-3 text-sm font-semibold
                    {{ request()->routeIs('trips.*')
                        ? 'bg-indigo-50 text-indigo-700'
                        : 'text-slate-600' }}">
                    Trips
                </a>

                <a href="{{ route('admin.bookings.index') }}"
                    class="block rounded-xl px-4 py-3 text-sm font-semibold
                    {{ request()->routeIs('admin.bookings.*')
                        ? 'bg-indigo-50 text-indigo-700'
                        : 'text-slate-600' }}">
                    Bookings
                </a>

            @endif

            @if (auth()->user()->role === 'customer')

                <a href="{{ route('customer.trips.index') }}"
                    class="block rounded-xl px-4 py-3 text-sm font-semibold
                    {{ request()->routeIs('customer.trips.*')
                        ? 'bg-indigo-50 text-indigo-700'
                        : 'text-slate-600' }}">
                    Explore Trips
                </a>

                <a href="{{ route('customer.bookings.index') }}"
                    class="block rounded-xl px-4 py-3 text-sm font-semibold
                    {{ request()->routeIs('customer.bookings.*')
                        ? 'bg-indigo-50 text-indigo-700'
                        : 'text-slate-600' }}">
                    My Bookings
                </a>

            @endif

        </div>

        {{-- Mobile User --}}
        <div class="mt-4 border-t border-slate-100 pt-4">

            <div class="mb-3 flex items-center gap-3 px-3">

                <div
                    class="flex h-10 w-10 items-center justify-center rounded-xl
                           bg-indigo-600 font-bold text-white">

                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}

                </div>

                <div class="min-w-0">
                    <div class="truncate text-sm font-bold text-slate-800">
                        {{ Auth::user()->name }}
                    </div>

                    <div class="truncate text-xs text-slate-400">
                        {{ Auth::user()->email }}
                    </div>
                </div>

            </div>

            <a href="{{ route('profile.edit') }}"
                class="block rounded-xl px-4 py-3 text-sm font-semibold text-slate-600">
                Profile Settings
            </a>

            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <button type="submit"
                    class="w-full rounded-xl px-4 py-3 text-left
                           text-sm font-semibold text-red-600
                           hover:bg-red-50">
                    Log Out
                </button>
            </form>

        </div>

    </div>

</nav>
