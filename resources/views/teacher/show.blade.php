<x-app-layout>
    <div class="min-h-screen bg-gray-50 px-4 py-10 sm:px-6 lg:px-8">
        <div class="mx-auto max-w-5xl">

            {{-- Header --}}
            <div class="mb-8 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <h1 class="text-3xl font-bold tracking-tight text-gray-900">
                        Teacher Profile
                    </h1>
                    <p class="mt-2 text-sm text-gray-600">
                        View the teacher's account and professional information.
                    </p>
                </div>

                <a href="{{ route('teachers.index') }}"
                    class="inline-flex items-center justify-center rounded-lg border border-gray-300
                           bg-white px-5 py-3 text-sm font-semibold text-gray-700 shadow-sm
                           transition hover:bg-gray-50 focus:outline-none
                           focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                    &larr; Back to Teachers
                </a>
            </div>

            {{-- Profile Card --}}
            <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm">

                {{-- Profile Header --}}
                <div class="border-b border-gray-200 bg-white p-6 sm:p-8">
                    <div class="flex flex-col gap-5 sm:flex-row sm:items-center">
                        <div
                            class="flex h-20 w-20 shrink-0 items-center justify-center rounded-2xl bg-indigo-100 text-3xl font-bold text-indigo-700">
                            {{ strtoupper(substr($teacher->user->name ?? 'T', 0, 1)) }}
                        </div>

                        <div class="min-w-0 flex-1">
                            <h2 class="break-words text-2xl font-bold text-gray-900">
                                {{ $teacher->user->name ?? 'Unknown Teacher' }}
                            </h2>

                            <p class="mt-2 break-all text-sm text-gray-500">
                                {{ $teacher->user->email ?? 'No email available' }}
                            </p>

                            <div class="mt-3 flex flex-wrap items-center gap-2">
                                <span
                                    class="inline-flex rounded-md bg-indigo-50 px-3 py-1 text-xs font-semibold text-indigo-700">
                                    {{ ucfirst($teacher->user->role ?? 'teacher') }}
                                </span>

                                <span
                                    class="inline-flex rounded-md bg-gray-100 px-3 py-1 text-xs font-medium text-gray-600">
                                    Teacher ID: {{ $teacher->id }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Account Information --}}
                <div class="p-6 sm:p-8">
                    <h3 class="text-lg font-bold text-gray-900">
                        Account Information
                    </h3>
                    <p class="mt-1 text-sm text-gray-500">
                        Basic information associated with the teacher's user account.
                    </p>

                    <div class="mt-6 grid grid-cols-1 gap-6 sm:grid-cols-2">
                        <div class="rounded-xl border border-gray-200 bg-gray-50 p-4">
                            <p class="text-xs font-medium uppercase tracking-wide text-gray-400">
                                Full Name
                            </p>
                            <p class="mt-2 break-words text-sm font-semibold text-gray-900">
                                {{ $teacher->user->name ?? 'Not available' }}
                            </p>
                        </div>

                        <div class="rounded-xl border border-gray-200 bg-gray-50 p-4">
                            <p class="text-xs font-medium uppercase tracking-wide text-gray-400">
                                Email Address
                            </p>
                            <p class="mt-2 break-all text-sm font-semibold text-gray-900">
                                {{ $teacher->user->email ?? 'Not available' }}
                            </p>
                        </div>

                        <div class="rounded-xl border border-gray-200 bg-gray-50 p-4">
                            <p class="text-xs font-medium uppercase tracking-wide text-gray-400">
                                Account Role
                            </p>
                            <p class="mt-2 text-sm font-semibold text-gray-900">
                                {{ ucfirst($teacher->user->role ?? 'teacher') }}
                            </p>
                        </div>

                        <div class="rounded-xl border border-gray-200 bg-gray-50 p-4">
                            <p class="text-xs font-medium uppercase tracking-wide text-gray-400">
                                User ID
                            </p>
                            <p class="mt-2 text-sm font-semibold text-gray-900">
                                {{ $teacher->user->id ?? 'Not available' }}
                            </p>
                        </div>
                    </div>
                </div>

                {{-- Professional Information --}}
                <div class="border-t border-gray-200 p-6 sm:p-8">
                    <h3 class="text-lg font-bold text-gray-900">
                        Professional Information
                    </h3>
                    <p class="mt-1 text-sm text-gray-500">
                        Department, qualifications, and teaching specialization.
                    </p>

                    <div class="mt-6 grid grid-cols-1 gap-6 sm:grid-cols-2">
                        <div>
                            <p class="text-sm font-medium text-gray-500">
                                Department
                            </p>
                            <p class="mt-2 break-words text-base font-semibold text-gray-900">
                                {{ $teacher->department ?: 'Not specified' }}
                            </p>
                        </div>

                        <div>
                            <p class="text-sm font-medium text-gray-500">
                                Qualification
                            </p>
                            <p class="mt-2 break-words text-base font-semibold text-gray-900">
                                {{ $teacher->qualification ?: 'Not specified' }}
                            </p>
                        </div>

                        <div>
                            <p class="text-sm font-medium text-gray-500">
                                Specialization
                            </p>
                            <p class="mt-2 break-words text-base font-semibold text-gray-900">
                                {{ $teacher->specialization ?: 'Not specified' }}
                            </p>
                        </div>

                        <div>
                            <p class="text-sm font-medium text-gray-500">
                                Joining Date
                            </p>
                            <p class="mt-2 text-base font-semibold text-gray-900">
                                {{ $teacher->join_date
                                    ? \Illuminate\Support\Carbon::parse($teacher->join_date)->format('F d, Y')
                                    : 'Not specified' }}
                            </p>
                        </div>
                    </div>
                </div>

                {{-- Record Information --}}
                <div class="border-t border-gray-200 bg-gray-50 px-6 p-6 sm:px-8">
                    <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">
                        <p class="text-xs text-gray-500">
                            Teacher Record ID: {{ $teacher->id }}
                        </p>

                        <p class="text-xs text-gray-500">
                            Created:
                            {{ $teacher->created_at ? $teacher->created_at->format('M d, Y h:i A') : 'Not available' }}
                        </p>
                    </div>
                </div>

            </div>

        </div>
    </div>
</x-app-layout>
