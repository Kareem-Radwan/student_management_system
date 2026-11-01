<x-app-layout>
    <div class="min-h-screen bg-gray-50 py-10">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

            {{-- Welcome Header --}}
            <div class="mb-10 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <p class="text-sm font-semibold uppercase tracking-wider text-indigo-600">
                        Administration Panel
                    </p>

                    <h1 class="mt-2 text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">
                        Welcome, {{ Auth::user()->name }}
                    </h1>

                    <p class="mt-3 text-gray-500">
                        Manage your school's subjects, teachers, students, parents, and administrators.
                    </p>
                </div>
            </div>

            {{-- Statistics --}}
            <div class="mb-10 grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-3">


                {{-- Subjects --}}
                <div class="rounded-2xl border border-gray-200 bg-white p-6 shadow-sm">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-500">
                                Total Subjects
                            </p>
                            <p class="mt-3 text-3xl font-bold text-gray-900">
                                {{ $subjects }}
                            </p>
                        </div>

                        <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-blue-100 text-blue-600">
                            <svg class="h-7 w-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5S19.832 5.477 21 6.253v13C19.832 18.477 18.246 18 16.5 18s-3.332.477-4.5 1.253" />
                            </svg>
                        </div>
                    </div>

                    <a href="{{ route('subjects.index') }}"
                        class="mt-5 inline-flex items-center gap-2 text-sm font-semibold text-blue-600 hover:text-blue-700">
                        View subjects
                        <span aria-hidden="true">&rarr;</span>
                    </a>
                </div>

                {{-- Teachers --}}
                <div class="rounded-2xl border border-gray-200 bg-white p-6 shadow-sm">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-500">
                                Total Teachers
                            </p>
                            <p class="mt-3 text-3xl font-bold text-gray-900">
                                {{ $teachers }}
                            </p>
                        </div>

                        <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-green-100 text-green-600">
                            <svg class="h-7 w-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 20h5v-2a4 4 0 00-5-3.87M9 20H2v-2a4 4 0 017.75-1.25M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a3 3 0 10-6 0 3 3 0 006 0z" />
                            </svg>
                        </div>
                    </div>

                    <a href="{{ route('teachers.index') }}"
                        class="mt-5 inline-flex items-center gap-2 text-sm font-semibold text-green-600 hover:text-green-700">
                        View teachers
                        <span aria-hidden="true">&rarr;</span>
                    </a>
                </div>

                {{-- Admins --}}
                <div class="rounded-2xl border border-gray-200 bg-white p-6 shadow-sm">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-500">
                                Total Administrators
                            </p>
                            <p class="mt-3 text-3xl font-bold text-gray-900">
                                {{ $admins }}
                            </p>
                        </div>

                        <div
                            class="flex h-14 w-14 items-center justify-center rounded-2xl bg-purple-100 text-purple-600">
                            <svg class="h-7 w-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 11a4 4 0 100-8 4 4 0 000 8zm-7 10v-2a7 7 0 0114 0v2m2-13v6m3-3h-6" />
                            </svg>
                        </div>
                    </div>

                    <a href="{{ route('admins.index') }}"
                        class="mt-5 inline-flex items-center gap-2 text-sm font-semibold text-purple-600 hover:text-purple-700">
                        View administrators
                        <span aria-hidden="true">&rarr;</span>
                    </a>
                </div>

                {{-- Students --}}
                <div class="rounded-2xl border border-gray-200 bg-white p-6 shadow-sm">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-500">
                                Total Students
                            </p>
                            <p class="mt-3 text-3xl font-bold text-gray-900">
                                {{ $students }}
                            </p>
                        </div>

                        <div
                            class="flex h-14 w-14 items-center justify-center rounded-2xl bg-orange-100 text-orange-600">
                            <svg class="h-7 w-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 14l9-5-9-5-9 5 9 5zm0 0v6m0-6l-9-5m9 5l9-5M12 14l9-5-9-5-9 5 9 5z" />
                            </svg>
                        </div>
                    </div>

                    <a href="{{ route('students.index') }}"
                        class="mt-5 inline-flex items-center gap-2 text-sm font-semibold text-orange-600 hover:text-orange-700">
                        View students
                        <span aria-hidden="true">&rarr;</span>
                    </a>
                </div>

                {{-- Parents --}}
                <div class="rounded-2xl border border-gray-200 bg-white p-6 shadow-sm">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-500">
                                Total Parents
                            </p>
                            <p class="mt-3 text-3xl font-bold text-gray-900">
                                {{ $parents }}
                            </p>
                        </div>

                        <div
                            class="flex h-14 w-14 items-center justify-center rounded-2xl bg-pink-100 text-pink-600">
                            <svg class="h-7 w-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                        </div>
                    </div>

                    <a href="{{ route('parents.index') }}"
                        class="mt-5 inline-flex items-center gap-2 text-sm font-semibold text-pink-600 hover:text-pink-700">
                        View parents
                        <span aria-hidden="true">&rarr;</span>
                    </a>
                </div>
            </div>

            {{-- Quick Actions --}}
            <div class="mb-10">
                <div class="mb-5">
                    <h2 class="text-xl font-bold text-gray-900">
                        Quick Actions
                    </h2>
                    <p class="mt-1 text-sm text-gray-500">
                        Create new records and accounts.
                    </p>
                </div>

                <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-5">

                    {{-- Create Subject --}}
                    <div
                        class="rounded-2xl border border-gray-200 bg-white p-6 shadow-sm transition hover:border-blue-300 hover:shadow-md">
                        <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-blue-100 text-blue-600">
                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4v16m8-8H4" />
                            </svg>
                        </div>

                        <h3 class="mt-5 text-lg font-bold text-gray-900">
                            Create Subject
                        </h3>
                        <p class="mt-2 text-sm leading-6 text-gray-500">
                            Add a new subject to your school's curriculum.
                        </p>

                        <a href="{{ route('subjects.create') }}"
                            class="mt-5 inline-flex w-full items-center justify-center rounded-xl bg-blue-600 px-4 py-3 text-sm font-semibold text-white transition hover:bg-blue-700">
                            Add Subject
                        </a>
                    </div>

                    {{-- Create Teacher --}}
                    <div
                        class="rounded-2xl border border-gray-200 bg-white p-6 shadow-sm transition hover:border-green-300 hover:shadow-md">
                        <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-green-100 text-green-600">
                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M18 20H6a2 2 0 01-2-2v-1a6 6 0 0112 0v1a2 2 0 01-2 2zm-6-10a4 4 0 100-8 4 4 0 000 8zm7-1v6m-3-3h6" />
                            </svg>
                        </div>

                        <h3 class="mt-5 text-lg font-bold text-gray-900">
                            Create Teacher
                        </h3>
                        <p class="mt-2 text-sm leading-6 text-gray-500">
                            Register a teacher and configure their account.
                        </p>

                        <a href="{{ route('teachers.create') }}"
                            class="mt-5 inline-flex w-full items-center justify-center rounded-xl bg-green-600 px-4 py-3 text-sm font-semibold text-white transition hover:bg-green-700">
                            Add Teacher
                        </a>
                    </div>

                    {{-- Create Admin --}}
                    <div
                        class="rounded-2xl border border-gray-200 bg-white p-6 shadow-sm transition hover:border-purple-300 hover:shadow-md">
                        <div
                            class="flex h-12 w-12 items-center justify-center rounded-xl bg-purple-100 text-purple-600">
                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 11a4 4 0 100-8 4 4 0 000 8zm-7 10v-2a7 7 0 0114 0v2m2-13v6m3-3h-6" />
                            </svg>
                        </div>

                        <h3 class="mt-5 text-lg font-bold text-gray-900">
                            Create Admin
                        </h3>
                        <p class="mt-2 text-sm leading-6 text-gray-500">
                            Create another administrator account.
                        </p>

                        <a href="{{ route('admins.create') }}"
                            class="mt-5 inline-flex w-full items-center justify-center rounded-xl bg-purple-600 px-4 py-3 text-sm font-semibold text-white transition hover:bg-purple-700">
                            Add Administrator
                        </a>
                    </div>

                    {{-- Create Student --}}
                    <div
                        class="rounded-2xl border border-gray-200 bg-white p-6 shadow-sm transition hover:border-orange-300 hover:shadow-md">
                        <div
                            class="flex h-12 w-12 items-center justify-center rounded-xl bg-orange-100 text-orange-600">
                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 14l9-5-9-5-9 5 9 5zm0 0v6m0-6l-9-5m9 5l9-5M12 14l9-5-9-5-9 5 9 5z" />
                            </svg>
                        </div>

                        <h3 class="mt-5 text-lg font-bold text-gray-900">
                            Create Student
                        </h3>
                        <p class="mt-2 text-sm leading-6 text-gray-500">
                            Register a new student and configure their account.
                        </p>

                        <a href="{{ route('students.create') }}"
                            class="mt-5 inline-flex w-full items-center justify-center rounded-xl bg-orange-600 px-4 py-3 text-sm font-semibold text-white transition hover:bg-orange-700">
                            Add Student
                        </a>
                    </div>

                    {{-- Create Parent --}}
                    <div
                        class="rounded-2xl border border-gray-200 bg-white p-6 shadow-sm transition hover:border-pink-300 hover:shadow-md">
                        <div
                            class="flex h-12 w-12 items-center justify-center rounded-xl bg-pink-100 text-pink-600">
                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                        </div>

                        <h3 class="mt-5 text-lg font-bold text-gray-900">
                            Create Parent
                        </h3>
                        <p class="mt-2 text-sm leading-6 text-gray-500">
                            Register a new parent and configure their account.
                        </p>

                        <a href="{{ route('parents.create') }}"
                            class="mt-5 inline-flex w-full items-center justify-center rounded-xl bg-pink-600 px-4 py-3 text-sm font-semibold text-white transition hover:bg-pink-700">
                            Add Parent
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
