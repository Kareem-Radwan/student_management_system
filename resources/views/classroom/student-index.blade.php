<x-app-layout>
    <div class="min-h-screen bg-gray-50 py-10">
        <div class="mx-auto max-w-5xl space-y-10 px-4 sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="rounded-lg border border-green-200 bg-green-50 p-4 text-sm font-medium text-green-700">{{ session('success') }}</div>
            @endif
            @if (session('error'))
                <div class="rounded-lg border border-red-200 bg-red-50 p-4 text-sm font-medium text-red-700">{{ session('error') }}</div>
            @endif

            <section>
                <h1 class="mb-4 text-3xl font-bold text-gray-900">My Classes</h1>
                <div class="grid grid-cols-1 gap-5 md:grid-cols-2">
                    @forelse ($myClasses as $class)
                        <a href="{{ route('my-classes.show', $class) }}" class="block rounded-xl bg-white p-6 shadow-sm ring-1 ring-gray-200 hover:ring-indigo-300">
                            <h2 class="text-lg font-semibold text-gray-900">{{ $class->name }}</h2>
                            <p class="text-sm text-gray-500">{{ $class->department }} · {{ $class->teacher->user->name }}</p>
                            <div class="mt-3 space-y-1 text-sm text-gray-600">
                                @foreach ($class->schedules as $slot)
                                    <div>{{ $slot->label() }}</div>
                                @endforeach
                            </div>
                        </a>
                    @empty
                        <p class="text-sm text-gray-500">You are not in any class yet. Apply to one below.</p>
                    @endforelse
                </div>
            </section>

            <section>
                <h2 class="mb-4 text-2xl font-bold text-gray-900">Available Classes</h2>
                <div class="grid grid-cols-1 gap-5 md:grid-cols-2">
                    @forelse ($available as $class)
                        @php($request = $requests->get($class->id))
                        <div class="rounded-xl bg-white p-6 shadow-sm ring-1 ring-gray-200">
                            <h3 class="text-lg font-semibold text-gray-900">{{ $class->name }}</h3>
                            <p class="text-sm text-gray-500">{{ $class->department }} · {{ $class->teacher->user->name }}</p>
                            <div class="mt-3 space-y-1 text-sm text-gray-600">
                                @foreach ($class->schedules as $slot)
                                    <div>{{ $slot->label() }}</div>
                                @endforeach
                            </div>
                            <div class="mt-4">
                                @if ($request && $request->status === 'pending')
                                    <span class="rounded-full bg-yellow-100 px-3 py-1 text-xs font-semibold text-yellow-800">Request pending</span>
                                @else
                                    @if ($request && $request->status === 'rejected')
                                        <span class="mr-2 rounded-full bg-red-100 px-3 py-1 text-xs font-semibold text-red-800">Not added</span>
                                    @endif
                                    <form method="POST" action="{{ route('my-classes.apply', $class) }}" class="inline">
                                        @csrf
                                        <button class="rounded-lg bg-indigo-600 px-4 py-2 text-sm font-semibold text-white hover:bg-indigo-700">
                                            {{ $request ? 'Apply again' : 'Apply to join' }}
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    @empty
                        <p class="text-sm text-gray-500">No other classes available.</p>
                    @endforelse
                </div>
            </section>

            <section>
                <h2 class="mb-4 text-2xl font-bold text-gray-900">My Requests</h2>
                <div class="overflow-hidden rounded-xl bg-white shadow-sm ring-1 ring-gray-200">
                    @forelse ($requests as $request)
                        @php($requested = \App\Models\SchoolClass::find($request->school_class_id))
                        @php($joined = $myClasses->contains('id', $request->school_class_id))
                        <div class="flex items-center justify-between border-t px-4 py-3 text-sm first:border-t-0">
                            <span class="font-medium text-gray-900">{{ $requested?->name }}</span>
                            @if ($joined)
                                <span class="rounded-full bg-green-100 px-3 py-1 text-xs font-semibold text-green-800">Added</span>
                            @elseif ($request->status === 'pending')
                                <span class="rounded-full bg-yellow-100 px-3 py-1 text-xs font-semibold text-yellow-800">Pending</span>
                            @else
                                <span class="rounded-full bg-red-100 px-3 py-1 text-xs font-semibold text-red-800">Not added</span>
                            @endif
                        </div>
                    @empty
                        <p class="p-4 text-sm text-gray-500">You have not applied to any class.</p>
                    @endforelse
                </div>
            </section>
        </div>
    </div>
</x-app-layout>
