<x-app-layout>
    <div class="min-h-screen bg-gray-50 py-10">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

            {{-- Header --}}
            <div class="mb-8 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <h1 class="text-3xl font-bold tracking-tight text-gray-900">
                        Administrators
                    </h1>
                    <p class="mt-2 text-sm text-gray-500">
                        Manage administrator accounts and their contact information.
                    </p>
                </div>

                <a href="{{ route('admins.create') }}"
                    class="inline-flex items-center justify-center gap-2 rounded-xl bg-indigo-600 px-5 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                    </svg>
                    Add Administrator
                </a>
            </div>

            {{-- Summary --}}
            <div class="mb-8 rounded-2xl border border-gray-200 bg-white p-6 shadow-sm">
                <div class="flex items-center gap-4">
                    <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-indigo-100 text-indigo-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 11c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zM5 21v-2a7 7 0 0114 0v2H5z" />
                        </svg>
                    </div>

                    <div>
                        <p class="text-sm font-medium text-gray-500">
                            Total Administrators
                        </p>
                        <p class="mt-1 text-2xl font-bold text-gray-900">
                            {{ $admins->count() }}
                        </p>
                    </div>
                </div>
            </div>

            {{-- Admin Cards --}}
            @forelse ($admins as $admin)
                @if ($loop->first)
                    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
                @endif

                <div
                    class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm transition hover:-translate-y-1 hover:shadow-md">
                    <div class="p-6">
                        <div class="flex items-center gap-4">
                            {{-- Avatar --}}
                            <div
                                class="flex h-14 w-14 shrink-0 items-center justify-center rounded-2xl bg-indigo-100 text-xl font-bold uppercase text-indigo-700">
                                {{ strtoupper(substr($admin->name, 0, 1)) }}
                            </div>

                            <div class="min-w-0 flex-1">
                                <h2 class="truncate text-lg font-semibold text-gray-900">
                                    {{ $admin->name }}
                                </h2>
                                <span
                                    class="mt-1 inline-flex items-center rounded-full bg-indigo-50 px-2.5 py-1 text-xs font-semibold text-indigo-700">
                                    Administrator
                                </span>
                            </div>
                        </div>

                        <div class="mt-6 border-t border-gray-100 pt-5">
                            <p class="mb-2 text-xs font-semibold uppercase tracking-wider text-gray-400">
                                Email Address
                            </p>

                            <div class="flex items-center gap-3 text-sm text-gray-600">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 shrink-0 text-gray-400"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M3 8l9 6 9-6M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>

                                <span class="break-all">
                                    {{ $admin->email }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center justify-between border-t border-gray-100 bg-gray-50 px-6 py-4">
                        <p class="text-xs text-gray-500">
                            Administrator account
                        </p>

                        <form action="{{ route('admins.destroy', $admin->id) }}" method="POST"
                            onsubmit="return confirm('Are you sure you want to delete this administrator?');">
                            @csrf
                            @method('DELETE')

                            <button type="submit"
                                class="inline-flex items-center gap-2 rounded-lg border border-red-200 bg-white px-3 py-2 text-sm font-semibold text-red-600 transition hover:border-red-300 hover:bg-red-50 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6M9 7V4a1 1 0 011-1h4a1 1 0 011 1v3M4 7h16" />
                                </svg>

                                Delete
                            </button>
                        </form>
                    </div>
                </div>

                @if ($loop->last)
        </div>
        @endif

    @empty
        {{-- Empty State --}}
        <div class="rounded-2xl border-2 border-dashed border-gray-300 bg-white px-6 py-16 text-center">
            <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-full bg-gray-100">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-gray-400" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="1.8">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M12 11c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zM5 21v-2a7 7 0 0114 0v2H5z" />
                </svg>
            </div>

            <h3 class="mt-5 text-lg font-semibold text-gray-900">
                No administrators found
            </h3>

            <p class="mx-auto mt-2 max-w-sm text-sm text-gray-500">
                Get started by creating an administrator account to help manage your system.
            </p>

            <a href="{{ route('admins.create') }}"
                class="mt-6 inline-flex items-center justify-center rounded-xl bg-indigo-600 px-5 py-3 text-sm font-semibold text-white transition hover:bg-indigo-700">
                Add First Administrator
            </a>
        </div>
        @endforelse

    </div>
    </div>
</x-app-layout>
