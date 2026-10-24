<x-app-layout>
    <div class="min-h-screen bg-gray-50 px-4 py-10 sm:px-6 lg:px-8">
        <div class="mx-auto max-w-7xl">

            {{-- Header --}}
            <div class="mb-8 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <h1 class="text-3xl font-bold tracking-tight text-gray-900">
                        Teachers
                    </h1>
                    <p class="mt-2 text-sm text-gray-600">
                        View and manage all registered teachers and their professional information.
                    </p>
                </div>

                <a href="{{ route('teachers.create') }}"
                    class="inline-flex items-center justify-center rounded-lg bg-indigo-600
                           px-5 py-3 text-sm font-semibold text-white shadow-sm
                           transition hover:bg-indigo-700 focus:outline-none
                           focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                    + Create Teacher
                </a>
            </div>

            {{-- Success Message --}}
            @if (session('success'))
                <div class="mb-6 rounded-lg border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-700">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Teachers --}}
            @if ($teachers->isEmpty())
                <div class="rounded-xl border border-dashed border-gray-300 bg-white px-6 py-16 text-center">
                    <h2 class="text-lg font-semibold text-gray-900">
                        No teachers found
                    </h2>
                    <p class="mt-2 text-sm text-gray-500">
                        Add your first teacher to get started.
                    </p>

                    <a href="{{ route('teachers.create') }}"
                        class="mt-5 inline-flex rounded-lg bg-indigo-600 px-5 py-3
                               text-sm font-semibold text-white transition hover:bg-indigo-700">
                        Create Your First Teacher
                    </a>
                </div>
            @else
                <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
                    @foreach ($teachers as $teacher)
                        <div
                            class="flex flex-col rounded-xl border border-gray-200 bg-white p-6 shadow-sm transition hover:-translate-y-1 hover:shadow-md">

                            {{-- Teacher Header --}}
                            <div class="mb-5 flex items-start gap-4">
                                <div
                                    class="flex h-12 w-12 shrink-0 items-center justify-center rounded-full bg-indigo-100 text-lg font-bold text-indigo-700">
                                    {{ strtoupper(substr($teacher->user->name ?? 'T', 0, 1)) }}
                                </div>

                                <div class="min-w-0 flex-1">
                                    <h2 class="break-words text-xl font-bold text-gray-900">
                                        {{ $teacher->user->name ?? 'Unknown Teacher' }}
                                    </h2>

                                    <p class="mt-1 break-all text-sm text-gray-500">
                                        {{ $teacher->user->email ?? 'No email available' }}
                                    </p>

                                    <span
                                        class="mt-2 inline-flex rounded-md bg-indigo-50 px-3 py-1 text-xs font-semibold text-indigo-700">
                                        {{ $teacher->user->role ?? 'Teacher' }}
                                    </span>
                                </div>
                            </div>

                            {{-- Teacher Details --}}
                            <div class="flex-1 space-y-4 border-t border-gray-100 pt-5">

                                <div>
                                    <p class="text-xs font-medium uppercase tracking-wide text-gray-400">
                                        Department
                                    </p>
                                    <p class="mt-1 break-words text-sm font-medium text-gray-800">
                                        {{ $teacher->department ?: 'Not specified' }}
                                    </p>
                                </div>

                                <div>
                                    <p class="text-xs font-medium uppercase tracking-wide text-gray-400">
                                        Qualification
                                    </p>
                                    <p class="mt-1 break-words text-sm text-gray-700">
                                        {{ $teacher->qualification ?: 'Not specified' }}
                                    </p>
                                </div>

                                <div>
                                    <p class="text-xs font-medium uppercase tracking-wide text-gray-400">
                                        Specialization
                                    </p>
                                    <p class="mt-1 break-words text-sm text-gray-700">
                                        {{ $teacher->specialization ?: 'Not specified' }}
                                    </p>
                                </div>

                                <div>
                                    <p class="text-xs font-medium uppercase tracking-wide text-gray-400">
                                        Joining Date
                                    </p>
                                    <p class="mt-1 text-sm text-gray-700">
                                        {{ $teacher->join_date
                                            ? \Illuminate\Support\Carbon::parse($teacher->join_date)->format('M d, Y')
                                            : 'Not specified' }}
                                    </p>
                                </div>
                            </div>

                            {{-- Footer --}}
                            <div
                                class="mt-6 flex flex-wrap items-center justify-between gap-3 border-t border-gray-100 pt-4">
                                <span class="text-xs text-gray-400">
                                    Teacher ID: {{ $teacher->id }}
                                </span>

                                <div class="flex items-center gap-2">
                                    {{-- View Details --}}
                                    <a href="{{ route('teachers.show', $teacher) }}"
                                        class="inline-flex items-center rounded-lg bg-indigo-50 px-4 py-2
                   text-sm font-semibold text-indigo-700 transition hover:bg-indigo-100">
                                        View Details
                                    </a>

                                    {{-- Delete Teacher --}}
                                    <form action="{{ route('teachers.destroy', $teacher) }}" method="POST"
                                        onsubmit="return confirm('Are you sure you want to delete this teacher? This action cannot be undone.');">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                            class="inline-flex items-center rounded-lg bg-red-50 px-4 py-2
                       text-sm font-semibold text-red-700 transition hover:bg-red-100
                       focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2">
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                {{-- Pagination --}}
                @if (method_exists($teachers, 'links'))
                    <div class="mt-8">
                        {{ $teachers->links() }}
                    </div>
                @endif
            @endif

        </div>
    </div>
</x-app-layout>
