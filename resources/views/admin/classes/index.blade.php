<x-app-layout>
    <div class="min-h-screen bg-gray-50 py-10">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mb-8 flex flex-col justify-between gap-4 sm:flex-row sm:items-center">
                <div>
                    <h1 class="text-3xl font-bold tracking-tight text-gray-900">Classes</h1>
                    <p class="mt-2 text-sm text-gray-500">Manage classes, teachers, schedules and enrollment.</p>
                </div>
                <a href="{{ route('classes.create') }}"
                    class="inline-flex items-center justify-center gap-2 rounded-lg bg-indigo-600 px-5 py-3 text-sm font-semibold text-white shadow-sm hover:bg-indigo-700">
                    <span class="text-lg">+</span> Create Class
                </a>
            </div>

            @if (session('success'))
                <div class="mb-6 rounded-lg border border-green-200 bg-green-50 p-4 text-sm font-medium text-green-700">{{ session('success') }}</div>
            @endif

            <div class="overflow-x-auto rounded-xl border border-gray-200 bg-white shadow-sm">
                <table class="min-w-full divide-y divide-gray-200 text-sm">
                    <thead class="bg-gray-50 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">
                        <tr>
                            <th class="px-4 py-3">Class</th>
                            <th class="px-4 py-3">Department</th>
                            <th class="px-4 py-3">Teacher</th>
                            <th class="px-4 py-3">Schedule</th>
                            <th class="px-4 py-3">Students</th>
                            <th class="px-4 py-3">Requests</th>
                            <th class="px-4 py-3 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse ($classes as $class)
                            <tr>
                                <td class="px-4 py-3 font-medium text-gray-900">{{ $class->name }}</td>
                                <td class="px-4 py-3">{{ $class->department }}</td>
                                <td class="px-4 py-3">{{ $class->teacher->user->name }}</td>
                                <td class="px-4 py-3">
                                    @foreach ($class->schedules as $slot)
                                        <div>{{ $slot->label() }}</div>
                                    @endforeach
                                </td>
                                <td class="px-4 py-3">{{ $class->students_count }}</td>
                                <td class="px-4 py-3">
                                    @if ($class->pending_requests_count)
                                        <span class="rounded-full bg-yellow-100 px-2 py-1 text-xs font-semibold text-yellow-800">{{ $class->pending_requests_count }} pending</span>
                                    @else
                                        <span class="text-gray-400">—</span>
                                    @endif
                                </td>
                                <td class="px-4 py-3 text-right">
                                    <a href="{{ route('classes.show', $class) }}" class="font-medium text-indigo-600 hover:underline">View</a>
                                    <a href="{{ route('classes.edit', $class) }}" class="ml-3 font-medium text-gray-600 hover:underline">Edit</a>
                                    <form action="{{ route('classes.destroy', $class) }}" method="POST" class="ml-3 inline"
                                        onsubmit="return confirm('Delete this class?')">
                                        @csrf @method('DELETE')
                                        <button class="font-medium text-red-600 hover:underline">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="7" class="px-4 py-8 text-center text-gray-500">No classes yet.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
