<x-app-layout>
    <div class="min-h-screen bg-gray-50 py-10">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

            {{-- Header --}}
            <div class="mb-8 flex flex-col justify-between gap-4 sm:flex-row sm:items-center">
                <div>
                    <div class="mb-2 flex items-center gap-2 text-sm text-gray-500">
                        <a href="{{ route('parents.index') }}" class="hover:text-pink-600">
                            Parents
                        </a>
                        <span>/</span>
                        <span>Parent Details</span>
                    </div>

                    <h1 class="text-3xl font-bold tracking-tight text-gray-900">
                        Parent Profile
                    </h1>
                    <p class="mt-2 text-sm text-gray-500">
                        View the parent's personal information and linked students.
                    </p>
                </div>

                <a href="{{ route('parents.index') }}"
                    class="inline-flex items-center justify-center rounded-lg border border-gray-300 bg-white px-5 py-2.5 text-sm font-semibold text-gray-700 shadow-sm hover:bg-gray-50">
                    &larr; Back to Parents
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

            {{-- Parent Profile Header --}}
            <div class="mb-6 overflow-hidden rounded-xl border border-gray-200 bg-white shadow-sm">
                <div class="bg-gradient-to-r from-pink-700 to-pink-500 px-6 py-8 sm:px-8">
                    <div class="flex flex-col gap-5 sm:flex-row sm:items-center">
                        <div
                            class="flex h-20 w-20 shrink-0 items-center justify-center rounded-full border-4 border-white/30 bg-white text-3xl font-bold text-pink-700 shadow-sm">
                            {{ strtoupper(substr($parent->user->name ?? '?', 0, 1)) }}
                        </div>

                        <div class="flex-1">
                            <h2 class="text-2xl font-bold text-white">
                                {{ $parent->user->name ?? 'Unknown Parent' }}
                            </h2>
                            <p class="mt-1 text-sm text-pink-100">
                                {{ $parent->user->email ?? 'No email available' }}
                            </p>
                            <div class="mt-3 flex flex-wrap items-center gap-2">
                                <span class="rounded-md bg-white/15 px-3 py-1 text-sm font-medium capitalize text-white">
                                    {{ $parent->relationship }}
                                </span>

                                @if ($parent->is_active)
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
                        <p class="text-sm font-medium text-gray-500">Phone</p>
                        <p class="mt-2 text-lg font-semibold text-gray-900">
                            {{ $parent->phone ?? 'Not provided' }}
                        </p>
                    </div>

                    <div class="p-5">
                        <p class="text-sm font-medium text-gray-500">Occupation</p>
                        <p class="mt-2 text-lg font-semibold text-gray-900">
                            {{ $parent->occupation ?? 'Not provided' }}
                        </p>
                    </div>

                    <div class="p-5">
                        <p class="text-sm font-medium text-gray-500">Linked Students</p>
                        <p class="mt-2 text-lg font-semibold text-gray-900">
                            {{ $parent->students->count() }}
                        </p>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">

                {{-- Contact Information --}}
                <div class="space-y-6 lg:col-span-2">

                    <div class="overflow-hidden rounded-xl border border-gray-200 bg-white shadow-sm">
                        <div class="border-b border-gray-200 px-6 py-5">
                            <h2 class="text-lg font-semibold text-gray-900">Contact Information</h2>
                            <p class="mt-1 text-sm text-gray-500">Parent's personal and contact details.</p>
                        </div>

                        <div class="grid grid-cols-1 gap-x-8 gap-y-6 p-6 sm:grid-cols-2">
                            <div>
                                <p class="text-sm text-gray-500">Full Name</p>
                                <p class="mt-1 font-medium text-gray-900">
                                    {{ $parent->user->name ?? '—' }}
                                </p>
                            </div>

                            <div>
                                <p class="text-sm text-gray-500">Email Address</p>
                                <p class="mt-1 break-words font-medium text-gray-900">
                                    {{ $parent->user->email ?? '—' }}
                                </p>
                            </div>

                            <div>
                                <p class="text-sm text-gray-500">Relationship</p>
                                <p class="mt-1 font-medium capitalize text-gray-900">
                                    {{ $parent->relationship ?? '—' }}
                                </p>
                            </div>

                            <div>
                                <p class="text-sm text-gray-500">Phone Number</p>
                                <p class="mt-1 font-medium text-gray-900">
                                    {{ $parent->phone ?? 'Not provided' }}
                                </p>
                            </div>

                            <div>
                                <p class="text-sm text-gray-500">Occupation</p>
                                <p class="mt-1 font-medium text-gray-900">
                                    {{ $parent->occupation ?? 'Not provided' }}
                                </p>
                            </div>

                            <div>
                                <p class="text-sm text-gray-500">Emergency Contact</p>
                                <p class="mt-1 font-medium text-gray-900">
                                    {{ $parent->emergency_contact ?? 'Not provided' }}
                                </p>
                            </div>

                            <div class="sm:col-span-2">
                                <p class="text-sm text-gray-500">Address</p>
                                <p class="mt-1 whitespace-pre-line font-medium text-gray-900">
                                    {{ $parent->address ?? 'Not provided' }}
                                </p>
                            </div>
                        </div>
                    </div>

                </div>

                {{-- Students Sidebar --}}
                <div class="space-y-6">

                    {{-- Add Student Form --}}
                    <div class="overflow-hidden rounded-xl border border-gray-200 bg-white shadow-sm">
                        <div class="border-b border-gray-200 bg-pink-50 px-6 py-5">
                            <h2 class="text-lg font-semibold text-gray-900">Manage Students</h2>
                            <p class="mt-1 text-sm text-gray-500">Link or unlink students for this parent.</p>
                        </div>

                        <div class="p-6">
                            <form action="{{ route('parents.link-student', $parent) }}" method="POST">
                                @csrf
                                <div class="space-y-4">
                                    <div>
                                        <label for="student_id" class="block text-sm font-medium text-gray-700">
                                            Select Student
                                        </label>
                                        <select id="student_id" name="student_id" required
                                            class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500">
                                            <option value="">Choose a student...</option>
                                            @php
                                                $availableStudents = \App\Models\Student::with('user')
                                                    ->where('is_active', true)
                                                    ->get();
                                            @endphp
                                            @foreach ($availableStudents as $availableStudent)
                                                <option value="{{ $availableStudent->id }}">
                                                    {{ $availableStudent->user->name }} - {{ $availableStudent->student_id }}
                                                    @if ($parent->students->contains($availableStudent->id))
                                                        (Already linked)
                                                    @endif
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('student_id')
                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="flex items-center gap-2">
                                        <input type="checkbox" id="is_primary" name="is_primary" value="1"
                                            class="h-4 w-4 rounded border-gray-300 text-pink-600 focus:ring-pink-500">
                                        <label for="is_primary" class="text-sm font-medium text-gray-700">
                                            Set as primary student
                                        </label>
                                    </div>

                                    <button type="submit"
                                        class="w-full rounded-lg bg-pink-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-pink-700 focus:outline-none focus:ring-2 focus:ring-pink-500 focus:ring-offset-2">
                                        Link Student
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                    {{-- Linked Students List --}}
                    <div class="overflow-hidden rounded-xl border border-gray-200 bg-white shadow-sm">
                        <div class="border-b border-gray-200 px-6 py-5">
                            <div class="flex items-center justify-between gap-3">
                                <div>
                                    <h2 class="text-lg font-semibold text-gray-900">Linked Students</h2>
                                    <p class="mt-1 text-sm text-gray-500">Students associated with this parent.</p>
                                </div>
                                <span class="rounded-full bg-pink-50 px-3 py-1 text-sm font-semibold text-pink-700">
                                    {{ $parent->students->count() }}
                                </span>
                            </div>
                        </div>

                        <div class="divide-y divide-gray-100">
                            @forelse ($parent->students as $student)
                                <div class="p-5">
                                    <div class="flex items-start gap-3">
                                        <div
                                            class="flex h-11 w-11 shrink-0 items-center justify-center rounded-full bg-pink-50 font-semibold text-pink-700">
                                            {{ strtoupper(substr($student->user->name ?? '?', 0, 1)) }}
                                        </div>

                                        <div class="min-w-0 flex-1">
                                            <div class="flex flex-wrap items-center gap-2">
                                                <h3 class="break-words font-semibold text-gray-900">
                                                    {{ $student->user->name ?? 'Unknown Student' }}
                                                </h3>

                                                @if ($student->pivot->is_primary)
                                                    <span
                                                        class="rounded-full bg-pink-50 px-2 py-0.5 text-xs font-semibold text-pink-700">
                                                        Primary
                                                    </span>
                                                @endif
                                            </div>

                                            <p class="mt-1 text-sm text-gray-500">
                                                {{ $student->student_id }} - {{ $student->class ?? 'N/A' }}
                                            </p>

                                            @if ($student->user?->email)
                                                <p class="mt-2 break-all text-sm text-gray-600">
                                                    {{ $student->user->email }}
                                                </p>
                                            @endif

                                            <form action="{{ route('parents.unlink-student', [$parent, $student]) }}"
                                                method="POST" class="mt-3"
                                                onsubmit="return confirm('Are you sure you want to unlink this student?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="inline-flex items-center gap-1 rounded-lg border border-red-200 bg-red-50 px-3 py-1.5 text-sm font-medium text-red-700 hover:bg-red-100 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2">
                                                    <svg class="h-4 w-4" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                    </svg>
                                                    Unlink
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="px-6 py-10 text-center">
                                    <p class="font-medium text-gray-700">No students linked</p>
                                    <p class="mt-1 text-sm text-gray-500">
                                        No student accounts are currently associated with this parent.
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
                                class="flex h-10 w-10 items-center justify-center rounded-full {{ $parent->is_active ? 'bg-green-50 text-green-600' : 'bg-gray-100 text-gray-500' }}">
                                @if ($parent->is_active)
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
                                    {{ $parent->is_active ? 'Active Account' : 'Inactive Account' }}
                                </p>
                                <p class="mt-1 text-sm text-gray-500">
                                    {{ $parent->is_active ? 'This parent is currently active.' : 'This parent is currently inactive.' }}
                                </p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            {{-- Footer --}}
            <div class="mt-8 flex gap-3">
                <a href="{{ route('parents.index') }}"
                    class="inline-flex items-center justify-center rounded-lg border border-gray-300 bg-white px-5 py-2.5 text-sm font-semibold text-gray-700 shadow-sm hover:bg-gray-50">
                    &larr; Back to Parents
                </a>
            </div>

        </div>
    </div>
</x-app-layout>
