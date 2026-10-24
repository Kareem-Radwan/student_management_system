<nav x-data="{ open: false }" class="bg-white border-b border-gray-100 p-2">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">

            {{-- Logo --}}
            <div class="flex items-center">
                <a href="{{ route('dashboard') }}">
                    <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
                </a>
            </div>

            {{-- Desktop Navigation --}}
            <div class="hidden sm:flex sm:items-center sm:space-x-6">

                {{-- Dashboard --}}
                <x-nav-link :href="route('dashboard')">
                    Dashboard
                </x-nav-link>

                {{-- Teachers Dropdown --}}
                <div x-data="{ dropdown: false }" class="relative">
                    <button @click="dropdown = !dropdown" @click.outside="dropdown = false"
                        class="inline-flex items-center gap-2 px-3 py-2 text-sm font-medium
                               text-gray-600 hover:text-gray-900 transition">
                        Teachers
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 9-7 7-7-7" />
                        </svg>
                    </button>

                    <div x-show="dropdown" x-cloak x-transition
                        class="absolute left-0 z-50 mt-2 w-48 rounded-lg border border-gray-200
                               bg-white py-2 shadow-lg">

                        <a href="{{ route('teachers.index') }}"
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                            Show All Teachers
                        </a>

                        <a href="{{ route('teachers.create') }}"
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                            Create Teacher
                        </a>
                    </div>
                </div>

                {{-- Subjects Dropdown --}}
                <div x-data="{ dropdown: false }" class="relative">
                    <button @click="dropdown = !dropdown" @click.outside="dropdown = false"
                        class="inline-flex items-center gap-2 px-3 py-2 text-sm font-medium
                               text-gray-600 hover:text-gray-900 transition">
                        Subjects
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 9-7 7-7-7" />
                        </svg>
                    </button>

                    <div x-show="dropdown" x-cloak x-transition
                        class="absolute left-0 z-50 mt-2 w-48 rounded-lg border border-gray-200
                               bg-white py-2 shadow-lg">

                        <a href="{{ route('subjects.index') }}"
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                            Show All Subjects
                        </a>

                        <a href="{{ route('subjects.create') }}"
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                            Create Subject
                        </a>
                    </div>
                </div>

                {{-- Admins Dropdown --}}
                <div x-data="{ dropdown: false }" class="relative">
                    <button @click="dropdown = !dropdown" @click.outside="dropdown = false"
                        class="inline-flex items-center gap-2 px-3 py-2 text-sm font-medium
                               text-gray-600 hover:text-gray-900 transition">
                        Admins
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 9-7 7-7-7" />
                        </svg>
                    </button>

                    <div x-show="dropdown" x-cloak x-transition
                        class="absolute left-0 z-50 mt-2 w-48 rounded-lg border border-gray-200
                               bg-white py-2 shadow-lg">

                        <a href="{{ route('admins.index') }}"
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                            Show All Admins
                        </a>

                        <a href="{{ route('admins.create') }}"
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                            Create Admin
                        </a>
                    </div>
                </div>

            </div>

            {{-- Profile Dropdown --}}
            <div class="hidden sm:flex sm:items-center">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button
                            class="inline-flex items-center gap-2 rounded-md bg-white px-3 py-2
                                       text-sm font-medium text-gray-500 hover:text-gray-700
                                       focus:outline-none transition">
                            {{ Auth::user()->name }}

                            <svg class="h-4 w-4 fill-current" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                    clip-rule="evenodd" />
                            </svg>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            Profile
                        </x-dropdown-link>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault(); this.closest('form').submit();">
                                Log Out
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            {{-- Mobile Hamburger --}}
            <div class="flex items-center sm:hidden">
                <button @click="open = !open"
                    class="inline-flex items-center justify-center rounded-md p-2
                           text-gray-400 hover:bg-gray-100 hover:text-gray-500
                           focus:outline-none transition">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

        </div>
    </div>

    {{-- Mobile Navigation --}}
    <div x-show="open" x-cloak x-transition class="sm:hidden border-t border-gray-100">

        <div class="space-y-1 px-4 py-3">

            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                Dashboard
            </x-responsive-nav-link>

            {{-- Mobile Teachers --}}
            <div x-data="{ dropdown: false }" class="py-1">
                <button @click="dropdown = !dropdown"
                    class="flex w-full items-center justify-between rounded-md px-3 py-2
                           text-left text-sm font-medium text-gray-700 hover:bg-gray-100">
                    Teachers
                    <svg class="h-4 w-4 transition-transform" :class="{ 'rotate-180': dropdown }" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 9-7 7-7-7" />
                    </svg>
                </button>

                <div x-show="dropdown" x-cloak class="ml-4 mt-1 space-y-1 border-l-2 border-indigo-100 pl-3">
                    <x-responsive-nav-link :href="route('teachers.index')">
                        Show All Teachers
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('teachers.create')">
                        Create Teacher
                    </x-responsive-nav-link>
                </div>
            </div>

            {{-- Mobile Subjects --}}
            <div x-data="{ dropdown: false }" class="py-1">
                <button @click="dropdown = !dropdown"
                    class="flex w-full items-center justify-between rounded-md px-3 py-2
                           text-left text-sm font-medium text-gray-700 hover:bg-gray-100">
                    Subjects
                    <svg class="h-4 w-4 transition-transform" :class="{ 'rotate-180': dropdown }" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 9-7 7-7-7" />
                    </svg>
                </button>

                <div x-show="dropdown" x-cloak class="ml-4 mt-1 space-y-1 border-l-2 border-indigo-100 pl-3">
                    <x-responsive-nav-link :href="route('subjects.index')">
                        Show All Subjects
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('subjects.create')">
                        Create Subject
                    </x-responsive-nav-link>
                </div>
            </div>

            {{-- Mobile Admins --}}
            <div x-data="{ dropdown: false }" class="py-1">
                <button @click="dropdown = !dropdown"
                    class="flex w-full items-center justify-between rounded-md px-3 py-2
                           text-left text-sm font-medium text-gray-700 hover:bg-gray-100">
                    Admins
                    <svg class="h-4 w-4 transition-transform" :class="{ 'rotate-180': dropdown }" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 9-7 7-7-7" />
                    </svg>
                </button>

                <div x-show="dropdown" x-cloak class="ml-4 mt-1 space-y-1 border-l-2 border-indigo-100 pl-3">
                    <x-responsive-nav-link :href="route('admins.index')">
                        Show All Admins
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('admins.create')">
                        Create Admin
                    </x-responsive-nav-link>
                </div>
            </div>

        </div>

        {{-- Mobile Account Information --}}
        <div class="border-t border-gray-200 px-4 py-4">
            <div class="text-base font-medium text-gray-800">
                {{ Auth::user()->name }}
            </div>
            <div class="text-sm font-medium text-gray-500">
                {{ Auth::user()->email }}
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    Profile
                </x-responsive-nav-link>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')"
                        onclick="event.preventDefault(); this.closest('form').submit();">
                        Log Out
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>

    </div>
</nav>
