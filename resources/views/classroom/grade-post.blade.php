<x-app-layout>
    <div class="min-h-screen bg-gray-50 py-10">
        <div class="mx-auto max-w-5xl space-y-6 px-4 sm:px-6 lg:px-8">
            <div>
                <a href="{{ route('my-classes.show', $class) }}" class="text-sm text-indigo-600 hover:underline">&larr; {{ $class->name }}</a>
                <h1 class="mt-2 text-2xl font-bold text-gray-900">Grades</h1>
                <p class="mt-2 whitespace-pre-line text-sm text-gray-600">{{ $post->caption }}</p>
                <p class="mt-1 text-xs text-gray-400">Max marks: {{ $post->max_marks }}</p>
            </div>

            @if (session('success'))
                <div class="rounded-lg border border-green-200 bg-green-50 p-4 text-sm font-medium text-green-700">{{ session('success') }}</div>
            @endif
            @if ($errors->any())
                <div class="rounded-lg border border-red-200 bg-red-50 p-4 text-sm text-red-700">
                    <ul class="list-inside list-disc">@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
                </div>
            @endif

            <form method="POST" action="{{ route('my-classes.posts.grades', $post) }}" class="overflow-x-auto rounded-xl bg-white shadow-sm ring-1 ring-gray-200">
                @csrf
                <table class="min-w-full divide-y divide-gray-200 text-sm">
                    <thead class="bg-gray-50 text-left text-xs font-semibold uppercase text-gray-500">
                        <tr>
                            <th class="px-4 py-3">Student</th>
                            <th class="px-4 py-3">Emails</th>
                            <th class="px-4 py-3">Marks / {{ $post->max_marks }}</th>
                            <th class="px-4 py-3">Notes</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse ($students as $student)
                            @php($grade = $grades->get($student->id))
                            <tr>
                                <td class="px-4 py-3 font-medium text-gray-900">{{ $student->user->name }}</td>
                                <td class="px-4 py-3 text-xs text-gray-600">
                                    <div>Student: {{ $student->user->email }}</div>
                                    @foreach ($student->parents as $parent)
                                        <div>Parent: {{ $parent->user->email }}</div>
                                    @endforeach
                                </td>
                                <td class="px-4 py-3">
                                    <input type="number" step="0.01" min="0" max="{{ $post->max_marks }}"
                                        name="grades[{{ $student->id }}][marks]"
                                        value="{{ old("grades.{$student->id}.marks", $grade?->marks) }}"
                                        class="w-28 rounded-lg border-gray-300 shadow-sm">
                                </td>
                                <td class="px-4 py-3">
                                    <input type="text" name="grades[{{ $student->id }}][notes]"
                                        value="{{ old("grades.{$student->id}.notes", $grade?->notes) }}"
                                        class="w-full rounded-lg border-gray-300 shadow-sm">
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="4" class="px-4 py-6 text-center text-gray-500">No students in this class.</td></tr>
                        @endforelse
                    </tbody>
                </table>
                @if ($students->isNotEmpty())
                    <div class="border-t p-4 text-right">
                        <button class="rounded-lg bg-indigo-600 px-5 py-2 text-sm font-semibold text-white hover:bg-indigo-700">Save grades</button>
                    </div>
                @endif
            </form>
        </div>
    </div>
</x-app-layout>
