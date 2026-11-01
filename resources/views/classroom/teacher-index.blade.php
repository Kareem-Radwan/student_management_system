<x-app-layout>
    <div class="min-h-screen bg-gray-50 py-10">
        <div class="mx-auto max-w-5xl px-4 sm:px-6 lg:px-8">
            <h1 class="mb-6 text-3xl font-bold text-gray-900">My Classes</h1>
            <div class="grid grid-cols-1 gap-5 md:grid-cols-2">
                @forelse ($classes as $class)
                    <a href="{{ route('my-classes.show', $class) }}" class="block rounded-xl bg-white p-6 shadow-sm ring-1 ring-gray-200 hover:ring-indigo-300">
                        <h2 class="text-lg font-semibold text-gray-900">{{ $class->name }}</h2>
                        <p class="text-sm text-gray-500">{{ $class->department }} · {{ $class->students_count }} students</p>
                        <div class="mt-3 space-y-1 text-sm text-gray-600">
                            @foreach ($class->schedules as $slot)
                                <div>{{ $slot->label() }}</div>
                            @endforeach
                        </div>
                    </a>
                @empty
                    <p class="text-sm text-gray-500">You have not been assigned any classes yet.</p>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>
