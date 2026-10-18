<x-app-layout>
    <div class="min-h-screen bg-gray-50 px-4 py-10 sm:px-6 lg:px-8">
        <div class="mx-auto max-w-7xl">

            {{-- Header --}}
            <div class="mb-8 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <h1 class="text-3xl font-bold tracking-tight text-gray-900">
                        Subjects
                    </h1>
                    <p class="mt-2 text-sm text-gray-600">
                        View and manage all available subjects.
                    </p>
                </div>

                <a href="{{ route('subjects.create') }}"
                    class="inline-flex items-center justify-center rounded-lg bg-indigo-600
                          px-5 py-3 text-sm font-semibold text-white shadow-sm
                          transition hover:bg-indigo-700 focus:outline-none
                          focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                    + Create Subject
                </a>
            </div>

            {{-- Subjects --}}
            @if ($subjects->isEmpty())
                <div
                    class="rounded-xl border border-dashed border-gray-300 bg-white
                            px-6 py-16 text-center">
                    <h2 class="text-lg font-semibold text-gray-900">
                        No subjects found
                    </h2>
                    <p class="mt-2 text-sm text-gray-500">
                        Create your first subject to get started.
                    </p>
                </div>
            @else
                <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
                    @foreach ($subjects as $subject)
                        <div
                            class="flex flex-col rounded-xl border border-gray-200
                                    bg-white p-6 shadow-sm transition
                                    hover:-translate-y-1 hover:shadow-md">

                            <div class="mb-4 flex items-start justify-between gap-3">
                                <h2 class="text-xl font-bold text-gray-900">
                                    {{ $subject->name }}
                                </h2>

                                <span
                                    class="shrink-0 rounded-md bg-indigo-50 px-3 py-1
                                             text-xs font-semibold text-indigo-700">
                                    {{ $subject->code }}
                                </span>
                            </div>

                            <p
                                class="flex-1 whitespace-pre-line break-words text-sm
                                      leading-6 text-gray-600">
                                {{ $subject->description ?: 'No description provided.' }}
                            </p>

                            <div class="mt-5 border-t flex justify-between border-gray-100 pt-4">
                                <span class="text-xs text-gray-400">
                                    Subject ID: {{ $subject->id }}
                                </span>
                                <span class="text-xs text-gray-400">
                                    Created At: {{ $subject->created_at->format('M d, Y h:i A') }}
                                </span>
                            </div>
                        </div>
                    @endforeach
                </div>

                {{-- Pagination, if enabled in the controller --}}
                @if (method_exists($subjects, 'links'))
                    <div class="mt-8">
                        {{ $subjects->links() }}
                    </div>
                @endif
            @endif

        </div>
    </div>
</x-app-layout>
