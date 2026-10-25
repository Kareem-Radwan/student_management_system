<x-app-layout>
    <div class="min-h-screen bg-gray-50 py-10">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

            {{-- Header --}}
            <div class="mb-8 flex flex-col justify-between gap-4 sm:flex-row sm:items-center">
                <div>
                    <div class="mb-2 flex items-center gap-2 text-sm text-gray-500">
                        <a href="{{ route('students.index') }}" class="hover:text-indigo-600">
                            Students
                        </a>
                        <span>/</span>
                        <span>Student Details</span>
                    </div>

                    <h1 class="text-3xl font-bold tracking-tight text-gray-900">
                        Student Profile
                    </h1>
                    <p class="mt-2 text-sm text-gray-500">
                        View the student's personal, academic, and family information.
                    </p>
                </div>

                <a href="{{ route('students.index') }}"
                    class="inline-flex items-center justify-center rounded-lg border border-gray-300 bg-white px-5 py-2.5 text-sm font-semibold text-gray-700 shadow-sm hover:bg-gray-50">
                    &larr; Back to Students
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

            {{-- Student Profile Header --}}
            <div class="mb-6 overflow-hidden rounded-xl border border-gray-200 bg-white shadow-sm">
                <div class="bg-gradient-to-r from-indigo-700 to-indigo-500 px-6 py-8 sm:px-8">
                    <div class="flex flex-col gap-5 sm:flex-row sm:items-center">
                        <div
                            class="flex h-20 w-20 shrink-0 items-center justify-center rounded-full border-4 border-white/30 bg-white text-3xl font-bold text-indigo-700 shadow-sm">
                            {{ strtoupper(substr($student->user->name ?? '?', 0, 1)) }}
                        </div>

                        <div class="flex-1">
                            <h2 class="text-2xl font-bold text-white">
                                {{ $student->user->name ?? 'Unknown Student' }}
                            </h2>
                            <p class="mt-1 text-sm text-indigo-100">
                                {{ $student->user->email ?? 'No email available' }}
                            </p>
                            <div class="mt-3 flex flex-wrap items-center gap-2">
                                <span class="rounded-md bg-white/15 px-3 py-1 font-mono text-sm font-medium text-white">
                                    ID: {{ $student->student_id }}
                                </span>

                                @if ($student->is_active)
                                    <span
                                        class="rounded-full bg-green-100 px-3 py-1 text-xs font-semibold text-green-800">
                                        Active
                                    </span>
                                @else
                                    <span
                                        class="rounded-full bg-gray-200 px-3 py-1 text-xs font-semibold text-gray-700">
                                        Inactive
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Quick Information --}}
                <div class="grid grid-cols-1 divide-y divide-gray-200 sm:grid-cols-3 sm:divide-x sm:divide-y-0">
                    <div class="p-5">
                        <p class="text-sm font-medium text-gray-500">Class</p>
                        <p class="mt-2 text-lg font-semibold text-gray-900">
                            {{ $student->class ?? 'Not assigned' }}
                        </p>
                    </div>

                    <div class="p-5">
                        <p class="text-sm font-medium text-gray-500">Section</p>
                        <p class="mt-2 text-lg font-semibold text-gray-900">
                            {{ $student->section ?? 'Not assigned' }}
                        </p>
                    </div>

                    <div class="p-5">
                        <p class="text-sm font-medium text-gray-500">Admission Date</p>
                        <p class="mt-2 text-lg font-semibold text-gray-900">
                            {{ $student->admission_date ? \Carbon\Carbon::parse($student->admission_date)->format('M d, Y') : 'Not provided' }}
                        </p>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">

                {{-- Personal Information --}}
                <div class="space-y-6 lg:col-span-2">

                    <div class="overflow-hidden rounded-xl border border-gray-200 bg-white shadow-sm">
                        <div class="border-b border-gray-200 px-6 py-5">
                            <h2 class="text-lg font-semibold text-gray-900">Personal Information</h2>
                            <p class="mt-1 text-sm text-gray-500">Student's personal and contact details.</p>
                        </div>

                        <div class="grid grid-cols-1 gap-x-8 gap-y-6 p-6 sm:grid-cols-2">
                            <div>
                                <p class="text-sm text-gray-500">Full Name</p>
                                <p class="mt-1 font-medium text-gray-900">
                                    {{ $student->user->name ?? '—' }}
                                </p>
                            </div>

                            <div>
                                <p class="text-sm text-gray-500">Email Address</p>
                                <p class="mt-1 break-words font-medium text-gray-900">
                                    {{ $student->user->email ?? '—' }}
                                </p>
                            </div>

                            <div>
                                <p class="text-sm text-gray-500">Date of Birth</p>
                                <p class="mt-1 font-medium text-gray-900">
                                    {{ $student->date_of_birth ? \Carbon\Carbon::parse($student->date_of_birth)->format('M d, Y') : '—' }}
                                </p>
                            </div>

                            <div>
                                <p class="text-sm text-gray-500">Gender</p>
                                <p class="mt-1 font-medium capitalize text-gray-900">
                                    {{ $student->gender ?? '—' }}
                                </p>
                            </div>

                            <div>
                                <p class="text-sm text-gray-500">Phone Number</p>
                                <p class="mt-1 font-medium text-gray-900">
                                    {{ $student->phone ?? 'Not provided' }}
                                </p>
                            </div>

                            <div>
                                <p class="text-sm text-gray-500">Emergency Contact</p>
                                <p class="mt-1 font-medium text-gray-900">
                                    {{ $student->emergency_contact ?? 'Not provided' }}
                                </p>
                            </div>

                            <div class="sm:col-span-2">
                                <p class="text-sm text-gray-500">Address</p>
                                <p class="mt-1 whitespace-pre-line font-medium text-gray-900">
                                    {{ $student->address ?? 'Not provided' }}
                                </p>
                            </div>
                        </div>
                    </div>

                    {{-- Academic Information --}}
                    <div class="overflow-hidden rounded-xl border border-gray-200 bg-white shadow-sm">
                        <div class="border-b border-gray-200 px-6 py-5">
                            <h2 class="text-lg font-semibold text-gray-900">Academic Information</h2>
                            <p class="mt-1 text-sm text-gray-500">Student's enrollment and class details.</p>
                        </div>

                        <div class="grid grid-cols-1 gap-x-8 gap-y-6 p-6 sm:grid-cols-2">
                            <div>
                                <p class="text-sm text-gray-500">Student ID</p>
                                <p class="mt-1 font-mono font-semibold text-indigo-700">
                                    {{ $student->student_id }}
                                </p>
                            </div>

                            <div>
                                <p class="text-sm text-gray-500">Roll Number</p>
                                <p class="mt-1 font-medium text-gray-900">
                                    {{ $student->roll_number ?? 'Not assigned' }}
                                </p>
                            </div>

                            <div>
                                <p class="text-sm text-gray-500">Class</p>
                                <p class="mt-1 font-medium text-gray-900">
                                    {{ $student->class ?? 'Not assigned' }}
                                </p>
                            </div>

                            <div>
                                <p class="text-sm text-gray-500">Section</p>
                                <p class="mt-1 font-medium text-gray-900">
                                    {{ $student->section ?? 'Not assigned' }}
                                </p>
                            </div>

                            <div>
                                <p class="text-sm text-gray-500">Admission Date</p>
                                <p class="mt-1 font-medium text-gray-900">
                                    {{ $student->admission_date ? \Carbon\Carbon::parse($student->admission_date)->format('M d, Y') : 'Not provided' }}
                                </p>
                            </div>

                            <div>
                                <p class="text-sm text-gray-500">Enrollment Status</p>
                                <p
                                    class="mt-1 font-medium {{ $student->is_active ? 'text-green-700' : 'text-gray-500' }}">
                                    {{ $student->is_active ? 'Currently Active' : 'Currently Inactive' }}
                                </p>
                            </div>
                        </div>
                    </div>

                </div>

                {{-- Parents Sidebar --}}
                <div class="space-y-6">

                    <div class="overflow-hidden rounded-xl border border-gray-200 bg-white shadow-sm">
                        <div class="border-b border-gray-200 px-6 py-5">
                            <div class="flex items-center justify-between gap-3">
                                <div>
                                    <h2 class="text-lg font-semibold text-gray-900">Linked Parents</h2>
                                    <p class="mt-1 text-sm text-gray-500">Parents associated with this student.</p>
                                </div>
                                <span class="rounded-full bg-indigo-50 px-3 py-1 text-sm font-semibold text-indigo-700">
                                    {{ $student->parents->count() }}
                                </span>
                            </div>
                        </div>

                        <div class="divide-y divide-gray-100">
                            @forelse ($student->parents as $parent)
                                <div class="p-5">
                                    <div class="flex items-start gap-3">
                                        <div
                                            class="flex h-11 w-11 shrink-0 items-center justify-center rounded-full bg-indigo-50 font-semibold text-indigo-700">
                                            {{ strtoupper(substr($parent->user->name ?? '?', 0, 1)) }}
                                        </div>

                                        <div class="min-w-0 flex-1">
                                            <div class="flex flex-wrap items-center gap-2">
                                                <h3 class="break-words font-semibold text-gray-900">
                                                    {{ $parent->user->name ?? 'Unknown Parent' }}
                                                </h3>

                                                @if ($parent->pivot->is_primary)
                                                    <span
                                                        class="rounded-full bg-indigo-50 px-2 py-0.5 text-xs font-semibold text-indigo-700">
                                                        Primary
                                                    </span>
                                                @endif
                                            </div>

                                            <p class="mt-1 text-sm capitalize text-gray-500">
                                                {{ $parent->relationship ?? 'Relationship not specified' }}
                                            </p>

                                            @if ($parent->user?->email)
                                                <p class="mt-2 break-all text-sm text-gray-600">
                                                    {{ $parent->user->email }}
                                                </p>
                                            @endif

                                            @if ($parent->phone)
                                                <p class="mt-1 text-sm text-gray-600">
                                                    {{ $parent->phone }}
                                                </p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="px-6 py-10 text-center">
                                    <p class="font-medium text-gray-700">No parents linked</p>
                                    <p class="mt-1 text-sm text-gray-500">
                                        No parent accounts are currently associated with this student.
                                    </p>
                                </div>
                            @endforelse
                        </div>
                    </div>

                    {{-- Account Status --}}
                    <div class="rounded-xl border border-gray-200 bg-white p-6 shadow-sm">
                        <h2 class="text-lg font-semibold text-gray-900">Account Status</h2>

                        <div class="mt-4 flex items-center gap-3">
                            <span
                                class="flex h-10 w-10 items-center justify-center rounded-full {{ $student->is_active ? 'bg-green-50 text-green-600' : 'bg-gray-100 text-gray-500' }}">
                                @if ($student->is_active)
                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7" />
                                    </svg>
                                @else
                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                @endif
                            </span>

                            <div>
                                <p class="font-semibold text-gray-900">
                                    {{ $student->is_active ? 'Active Account' : 'Inactive Account' }}
                                </p>
                                <p class="mt-1 text-sm text-gray-500">
                                    {{ $student->is_active ? 'This student is currently active.' : 'This student is currently inactive.' }}
                                </p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            {{-- Footer --}}
            <div class="mt-8 flex justify-start">
                <a href="{{ route('students.index') }}"
                    class="inline-flex items-center justify-center rounded-lg border border-gray-300 bg-white px-5 py-2.5 text-sm font-semibold text-gray-700 shadow-sm hover:bg-gray-50">
                    &larr; Back to Students
                </a>
            </div>

        </div>
    </div>
</x-app-layout>
