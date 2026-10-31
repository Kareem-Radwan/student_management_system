<x-app-layout>
    <div class="min-h-screen bg-gray-50 py-10">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

            {{-- Header --}}
            <div class="mb-8 flex flex-col justify-between gap-4 sm:flex-row sm:items-center">
                <div>
                    <h1 class="text-3xl font-bold tracking-tight text-gray-900">
                        Parents Management
                    </h1>
                    <p class="mt-2 text-sm text-gray-500">
                        Manage parent accounts and their relationships with students.
                    </p>
                </div>

                <a href="{{ route('parents.create') }}"
                    class="inline-flex items-center justify-center gap-2 rounded-lg bg-pink-600 px-5 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-pink-700">
                    <span class="text-lg">+</span>
                    Add New Parent
                </a>
            </div>

            {{-- Flash Messages --}}
            @if (session('success'))
                <div class="mb-6 rounded-lg border border-green-200 bg-green-50 p-4 text-sm font-medium text-green-700">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="mb-6 rounded-lg border border-red-200 bg-red-50 p-4 text-sm font-medium text-red-700">
                    {{ session('error') }}
                </div>
            @endif

            {{-- Statistics --}}
            <div class="mb-8 grid grid-cols-1 gap-5 sm:grid-cols-2">
                <div class="rounded-xl border border-gray-200 bg-white p-6 shadow-sm">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-500">Total Parents</p>
                            <p class="mt-2 text-3xl font-bold text-gray-900">
                                {{ $parents->count() }}
                            </p>
                        </div>
                        <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-pink-50 text-pink-600">
                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="rounded-xl border border-gray-200 bg-white p-6 shadow-sm">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-500">Active Parents</p>
                            <p class="mt-2 text-3xl font-bold text-green-600">
                                {{ $parents->where('is_active', true)->count() }}
                            </p>
                        </div>
                        <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-green-50 text-green-600">
                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Parents Table --}}
            <div class="overflow-hidden rounded-xl border border-gray-200 bg-white shadow-sm">

                <div
                    class="flex flex-col justify-between gap-3 border-b border-gray-200 px-6 py-5 sm:flex-row sm:items-center">
                    <div>
                        <h2 class="text-lg font-semibold text-gray-900">All Parents</h2>
                        <p class="mt-1 text-sm text-gray-500">
                            A list of all registered parents and their linked students.
                        </p>
                    </div>

                    <span
                        class="inline-flex w-fit items-center rounded-full bg-gray-100 px-3 py-1 text-xs font-semibold text-gray-600">
                        {{ $parents->count() }} Records
                    </span>
                </div>

                @forelse ($parents as $parent)
                    @if ($loop->first)
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th
                                            class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">
                                            Parent
                                        </th>
                                        <th
                                            class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">
                                            Relationship
                                        </th>
                                        <th
                                            class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">
                                            Contact
                                        </th>
                                        <th
                                            class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">
                                            Linked Students
                                        </th>
                                        <th
                                            class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">
                                            Status
                                        </th>
                                        <th
                                            class="px-6 py-4 text-right text-xs font-semibold uppercase tracking-wider text-gray-500">
                                            Actions
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-100 bg-white">
                    @endif

                    <tr class="transition hover:bg-gray-50">
                        {{-- Parent --}}
                        <td class="whitespace-nowrap px-6 py-5">
                            <div class="flex items-center gap-3">
                                <div
                                    class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-pink-100 text-sm font-bold text-pink-700">
                                    {{ strtoupper(substr($parent->user->name ?? '?', 0, 1)) }}
                                </div>
                                <div>
                                    <p class="font-semibold text-gray-900">
                                        {{ $parent->user->name ?? 'Unknown User' }}
                                    </p>
                                    <p class="mt-1 text-sm text-gray-500">
                                        {{ $parent->user->email ?? 'No email available' }}
                                    </p>
                                </div>
                            </div>
                        </td>

                        {{-- Relationship --}}
                        <td class="whitespace-nowrap px-6 py-5">
                            <span
                                class="inline-flex items-center rounded-full bg-gray-100 px-3 py-1 text-sm font-medium capitalize text-gray-800">
                                {{ $parent->relationship }}
                            </span>
                        </td>

                        {{-- Contact --}}
                        <td class="whitespace-nowrap px-6 py-5">
                            <p class="text-sm font-medium text-gray-900">
                                {{ $parent->phone ?? 'Not provided' }}
                            </p>
                            @if ($parent->occupation)
                                <p class="mt-1 text-xs text-gray-500">
                                    {{ $parent->occupation }}
                                </p>
                            @endif
                        </td>

                        {{-- Students --}}
                        <td class="px-6 py-5">
                            @forelse ($parent->students as $student)
                                <div class="mb-2 last:mb-0">
                                    <p class="text-sm font-medium text-gray-800">
                                        {{ ucfirst($student->user->name) ?? 'Unknown Student' }}
                                        @if ($student->pivot->is_primary)
                                            <span
                                                class="ml-1 rounded-full bg-pink-50 px-2 py-0.5 text-xs font-medium text-pink-700">
                                                Primary
                                            </span>
                                        @endif
                                    </p>
                                    <p class="text-xs text-gray-500">
                                        {{ $student->class ?? 'N/A' }} - {{ $student->section ?? 'N/A' }}
                                    </p>
                                </div>
                            @empty
                                <span class="text-sm italic text-gray-400">No students linked</span>
                            @endforelse
                        </td>

                        {{-- Status --}}
                        <td class="whitespace-nowrap px-6 py-5">
                            @if ($parent->is_active)
                                <span
                                    class="inline-flex items-center gap-1.5 rounded-full bg-green-50 px-3 py-1 text-xs font-semibold text-green-700">
                                    <span class="h-1.5 w-1.5 rounded-full bg-green-500"></span>
                                    Active
                                </span>
                            @else
                                <span
                                    class="inline-flex items-center gap-1.5 rounded-full bg-gray-100 px-3 py-1 text-xs font-semibold text-gray-600">
                                    <span class="h-1.5 w-1.5 rounded-full bg-gray-400"></span>
                                    Inactive
                                </span>
                            @endif
                        </td>

                        {{-- Actions --}}
                        <td class="whitespace-nowrap px-6 py-5 text-right">
                            <div class="flex items-center justify-end gap-3">
                                <a href="{{ route('parents.show', $parent) }}"
                                    class="text-sm font-semibold text-pink-600 transition hover:text-pink-800">
                                    View
                                </a>

                                <form action="{{ route('parents.destroy', $parent) }}" method="POST"
                                    onsubmit="return confirm('Are you sure you want to delete this parent?')">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                        class="text-sm font-semibold text-red-600 transition hover:text-red-800">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>

                    @if ($loop->last)
                        </tbody>
                        </table>
            </div>
            @endif
        @empty
            <div class="px-6 py-16 text-center">
                <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-full bg-gray-100">
                    <svg class="h-8 w-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                </div>

                <h3 class="mt-4 text-lg font-semibold text-gray-900">No parents found</h3>
                <p class="mt-2 text-sm text-gray-500">
                    Get started by creating your first parent account.
                </p>

                <a href="{{ route('parents.create') }}"
                    class="mt-6 inline-flex items-center rounded-lg bg-pink-600 px-4 py-2.5 text-sm font-semibold text-white hover:bg-pink-700">
                    Add First Parent
                </a>
            </div>
            @endforelse
        </div>

        <p class="mt-4 text-xs text-gray-400">
            Parent Management · Administration
        </p>

    </div>
    </div>
</x-app-layout>
