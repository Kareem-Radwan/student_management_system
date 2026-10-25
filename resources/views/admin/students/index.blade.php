<x-app-layout>
    <div class="min-h-screen bg-gray-50 py-10">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

            {{-- Header --}}
            <div class="mb-8 flex flex-col justify-between gap-4 sm:flex-row sm:items-center">
                <div>
                    <h1 class="text-3xl font-bold tracking-tight text-gray-900">
                        Students Management
                    </h1>
                    <p class="mt-2 text-sm text-gray-500">
                        Manage student accounts, academic information, and parent relationships.
                    </p>
                </div>

                <a href="{{ route('students.create') }}"
                    class="inline-flex items-center justify-center gap-2 rounded-lg bg-indigo-600 px-5 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-indigo-700">
                    <span class="text-lg">+</span>
                    Add New Student
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
                            <p class="text-sm font-medium text-gray-500">Total Students</p>
                            <p class="mt-2 text-3xl font-bold text-gray-900">
                                {{ $students->count() }}
                            </p>
                        </div>
                        <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-indigo-50 text-indigo-600">
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
                            <p class="text-sm font-medium text-gray-500">Active Students</p>
                            <p class="mt-2 text-3xl font-bold text-green-600">
                                {{ $students->where('is_active', true)->count() }}
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

            {{-- Students Table --}}
            <div class="overflow-hidden rounded-xl border border-gray-200 bg-white shadow-sm">

                <div
                    class="flex flex-col justify-between gap-3 border-b border-gray-200 px-6 py-5 sm:flex-row sm:items-center">
                    <div>
                        <h2 class="text-lg font-semibold text-gray-900">All Students</h2>
                        <p class="mt-1 text-sm text-gray-500">
                            A list of all registered students and their linked parents.
                        </p>
                    </div>

                    <span
                        class="inline-flex w-fit items-center rounded-full bg-gray-100 px-3 py-1 text-xs font-semibold text-gray-600">
                        {{ $students->count() }} Records
                    </span>
                </div>

                @forelse ($students as $student)
                    @if ($loop->first)
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th
                                            class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">
                                            Student
                                        </th>
                                        <th
                                            class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">
                                            Student ID
                                        </th>
                                        <th
                                            class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">
                                            Class / Section
                                        </th>
                                        <th
                                            class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">
                                            Parents
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
                        {{-- Student --}}
                        <td class="whitespace-nowrap px-6 py-5">
                            <div class="flex items-center gap-3">
                                <div
                                    class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-indigo-100 text-sm font-bold text-indigo-700">
                                    {{ strtoupper(substr($student->user->name ?? '?', 0, 1)) }}
                                </div>
                                <div>
                                    <p class="font-semibold text-gray-900">
                                        {{ $student->user->name ?? 'Unknown User' }}
                                    </p>
                                    <p class="mt-1 text-sm text-gray-500">
                                        {{ $student->user->email ?? 'No email available' }}
                                    </p>
                                </div>
                            </div>
                        </td>

                        {{-- Student ID --}}
                        <td class="whitespace-nowrap px-6 py-5">
                            <span
                                class="rounded-md bg-gray-100 px-2.5 py-1 font-mono text-sm font-medium text-gray-700">
                                {{ $student->student_id }}
                            </span>
                        </td>

                        {{-- Class / Section --}}
                        <td class="whitespace-nowrap px-6 py-5">
                            <p class="text-sm font-medium text-gray-900">
                                {{ $student->class ?? 'Not assigned' }}
                            </p>
                            <p class="mt-1 text-xs text-gray-500">
                                Section: {{ $student->section ?? '—' }}
                            </p>
                        </td>

                        {{-- Parents --}}
                        <td class="px-6 py-5">
                            @forelse ($student->parents as $parent)
                                <div class="mb-2 last:mb-0">
                                    <p class="text-sm font-medium text-gray-800">
                                        {{ ucfirst($parent->user->name) ?? 'Unknown Parent' }}
                                        @if ($parent->pivot->is_primary)
                                            <span
                                                class="ml-1 rounded-full bg-indigo-50 px-2 py-0.5 text-xs font-medium text-indigo-700">
                                                Primary
                                            </span>
                                        @endif
                                    </p>
                                    <p class="text-xs text-gray-500">
                                        {{ ucfirst($parent->relationship) }}
                                    </p>
                                </div>
                            @empty
                                <span class="text-sm italic text-gray-400">No parents linked</span>
                            @endforelse
                        </td>

                        {{-- Status --}}
                        <td class="whitespace-nowrap px-6 py-5">
                            @if ($student->is_active)
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
                                <a href="{{ route('students.show', $student) }}"
                                    class="text-sm font-semibold text-indigo-600 transition hover:text-indigo-800">
                                    View
                                </a>

                                <form action="{{ route('students.destroy', $student) }}" method="POST"
                                    onsubmit="return confirm('Are you sure you want to delete this student?')">
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
                            d="M17 20h5v-2a3 3 0 00-5.356-1.857M9 20H4v-2a3 3 0 015.356-1.857M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                </div>

                <h3 class="mt-4 text-lg font-semibold text-gray-900">No students found</h3>
                <p class="mt-2 text-sm text-gray-500">
                    Get started by creating your first student account.
                </p>

                <a href="{{ route('students.create') }}"
                    class="mt-6 inline-flex items-center rounded-lg bg-indigo-600 px-4 py-2.5 text-sm font-semibold text-white hover:bg-indigo-700">
                    Add First Student
                </a>
            </div>
            @endforelse
        </div>

        <p class="mt-4 text-xs text-gray-400">
            Student Management · Administration
        </p>

    </div>
    </div>
</x-app-layout>
