<x-app-layout>
    <div class="min-h-screen bg-gray-50 py-10" x-data="{ tab: 'posts' }">
        <div class="mx-auto max-w-5xl space-y-6 px-4 sm:px-6 lg:px-8">
            <div>
                <a href="{{ route('my-classes.index') }}" class="text-sm text-indigo-600 hover:underline">&larr; My Classes</a>
                <h1 class="mt-2 text-3xl font-bold text-gray-900">{{ $class->name }}</h1>
                <p class="mt-1 text-sm text-gray-500">{{ $class->department }} · Teacher: {{ $class->teacher->user->name }}
                    @if ($class->teacher->specialization) ({{ $class->teacher->specialization }}) @endif
                </p>
                <div class="mt-2 text-sm text-gray-600">
                    @foreach ($class->schedules as $slot)
                        <span class="mr-2 inline-block rounded bg-gray-100 px-2 py-1">{{ $slot->label() }}</span>
                    @endforeach
                </div>
            </div>

            @if (session('success'))
                <div class="rounded-lg border border-green-200 bg-green-50 p-4 text-sm font-medium text-green-700">{{ session('success') }}</div>
            @endif
            @if ($errors->any())
                <div class="rounded-lg border border-red-200 bg-red-50 p-4 text-sm text-red-700">
                    <ul class="list-inside list-disc">@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
                </div>
            @endif

            <div class="flex gap-2 border-b border-gray-200">
                @foreach (['posts' => 'Posts', 'materials' => 'Materials', 'students' => 'Students'] as $key => $label)
                    <button type="button" @click="tab = '{{ $key }}'"
                        :class="tab === '{{ $key }}' ? 'border-indigo-600 text-indigo-600' : 'border-transparent text-gray-500 hover:text-gray-700'"
                        class="border-b-2 px-4 py-2 text-sm font-semibold">{{ $label }}</button>
                @endforeach
            </div>

            {{-- Posts --}}
            <div x-show="tab === 'posts'" class="space-y-4">
                @if ($isTeacher)
                    <form method="POST" action="{{ route('my-classes.posts.store', $class) }}" enctype="multipart/form-data"
                        class="space-y-3 rounded-xl bg-white p-5 shadow-sm ring-1 ring-gray-200">
                        @csrf
                        <h3 class="font-semibold text-gray-800">New post (e.g. homework)</h3>
                        <textarea name="caption" rows="3" required placeholder="Caption" class="w-full rounded-lg border-gray-300 shadow-sm">{{ old('caption') }}</textarea>
                        <div class="grid grid-cols-1 gap-3 sm:grid-cols-2">
                            <input type="file" name="image" accept="image/*" class="text-sm">
                            <div>
                                <label class="text-xs text-gray-500">Max marks</label>
                                <input type="number" name="max_marks" min="1" value="{{ old('max_marks', 100) }}" required class="w-full rounded-lg border-gray-300 shadow-sm">
                            </div>
                        </div>
                        <button class="rounded-lg bg-indigo-600 px-4 py-2 text-sm font-semibold text-white hover:bg-indigo-700">Publish</button>
                    </form>
                @endif

                @forelse ($class->posts as $post)
                    <div class="rounded-xl bg-white p-5 shadow-sm ring-1 ring-gray-200">
                        <p class="whitespace-pre-line text-gray-800">{{ $post->caption }}</p>
                        @if ($post->image_path)
                            <img src="{{ route('my-classes.posts.image', $post) }}" alt="Post image" class="mt-3 max-h-96 rounded-lg">
                        @endif
                        <p class="mt-3 text-xs text-gray-400">{{ $post->created_at->diffForHumans() }} · Max marks: {{ $post->max_marks }}</p>

                        @if ($isTeacher)
                            <div class="mt-3 flex gap-3 text-sm">
                                <a href="{{ route('my-classes.posts.show', $post) }}" class="font-semibold text-indigo-600 hover:underline">Grades</a>
                                <form method="POST" action="{{ route('my-classes.posts.destroy', $post) }}" onsubmit="return confirm('Delete this post?')">
                                    @csrf @method('DELETE')
                                    <button class="font-semibold text-red-600 hover:underline">Delete</button>
                                </form>
                            </div>
                        @else
                            @php($grade = $myGrades->get($post->id))
                            <div class="mt-3 rounded-lg bg-gray-50 p-3 text-sm">
                                @if ($grade)
                                    <p class="font-semibold text-gray-800">Your grade: {{ rtrim(rtrim($grade->marks, '0'), '.') }} / {{ $post->max_marks }}</p>
                                    @if ($grade->notes)<p class="mt-1 text-gray-600">Note: {{ $grade->notes }}</p>@endif
                                @else
                                    <p class="text-gray-500">Not graded yet.</p>
                                @endif
                            </div>
                        @endif
                    </div>
                @empty
                    <p class="text-sm text-gray-500">No posts yet.</p>
                @endforelse
            </div>

            {{-- Materials --}}
            <div x-show="tab === 'materials'" x-cloak class="space-y-4">
                @if ($isTeacher)
                    <form method="POST" action="{{ route('my-classes.materials.store', $class) }}" enctype="multipart/form-data"
                        class="space-y-3 rounded-xl bg-white p-5 shadow-sm ring-1 ring-gray-200">
                        @csrf
                        <h3 class="font-semibold text-gray-800">Upload material</h3>
                        <input type="text" name="title" required placeholder="Title" class="w-full rounded-lg border-gray-300 shadow-sm">
                        <input type="file" name="file" required class="text-sm">
                        <div><button class="rounded-lg bg-indigo-600 px-4 py-2 text-sm font-semibold text-white hover:bg-indigo-700">Upload</button></div>
                    </form>
                @endif

                <div class="overflow-hidden rounded-xl bg-white shadow-sm ring-1 ring-gray-200">
                    @forelse ($class->materials as $material)
                        <div class="flex items-center justify-between border-t px-4 py-3 text-sm first:border-t-0">
                            <div>
                                <p class="font-medium text-gray-900">{{ $material->title }}</p>
                                <p class="text-xs text-gray-500">{{ $material->original_name }}</p>
                            </div>
                            <div class="flex items-center gap-4">
                                <a href="{{ route('my-classes.materials.download', $material) }}" class="font-semibold text-indigo-600 hover:underline">Download</a>
                                @if ($isTeacher)
                                    <form method="POST" action="{{ route('my-classes.materials.destroy', $material) }}" onsubmit="return confirm('Delete this material?')">
                                        @csrf @method('DELETE')
                                        <button class="font-semibold text-red-600 hover:underline">Delete</button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    @empty
                        <p class="p-4 text-sm text-gray-500">No materials uploaded.</p>
                    @endforelse
                </div>
            </div>

            {{-- Students --}}
            <div x-show="tab === 'students'" x-cloak>
                <div class="overflow-x-auto rounded-xl bg-white shadow-sm ring-1 ring-gray-200">
                    <table class="min-w-full divide-y divide-gray-200 text-sm">
                        <thead class="bg-gray-50 text-left text-xs font-semibold uppercase text-gray-500">
                            <tr>
                                <th class="px-4 py-3">Student</th>
                                @if ($isTeacher)
                                    <th class="px-4 py-3">Student email</th>
                                    <th class="px-4 py-3">Parent(s)</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse ($students as $student)
                                <tr>
                                    <td class="px-4 py-3 font-medium text-gray-900">{{ $student->user->name }}</td>
                                    @if ($isTeacher)
                                        <td class="px-4 py-3">{{ $student->user->email }}</td>
                                        <td class="px-4 py-3">
                                            @forelse ($student->parents as $parent)
                                                <div>{{ $parent->user->name }} — {{ $parent->user->email }}</div>
                                            @empty
                                                <span class="text-gray-400">—</span>
                                            @endforelse
                                        </td>
                                    @endif
                                </tr>
                            @empty
                                <tr><td colspan="3" class="px-4 py-6 text-center text-gray-500">No students in this class.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
