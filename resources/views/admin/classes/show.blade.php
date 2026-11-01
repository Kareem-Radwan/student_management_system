<x-app-layout>
    <div class="min-h-screen bg-gray-50 py-10">
        <div class="mx-auto max-w-5xl space-y-6 px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col justify-between gap-4 sm:flex-row sm:items-center">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">{{ $class->name }}</h1>
                    <p class="mt-1 text-sm text-gray-500">{{ $class->department }} · {{ $class->teacher->user->name }}
                        @if ($class->teacher->specialization) ({{ $class->teacher->specialization }}) @endif
                    </p>
                </div>
                <div class="flex gap-3">
                    <a href="{{ route('classes.index') }}" class="rounded-lg border border-gray-300 px-4 py-2 text-sm font-semibold text-gray-700 hover:bg-gray-50">Back</a>
                    <a href="{{ route('classes.edit', $class) }}" class="rounded-lg bg-indigo-600 px-4 py-2 text-sm font-semibold text-white hover:bg-indigo-700">Edit</a>
                </div>
            </div>

            @if (session('success'))
                <div class="rounded-lg border border-green-200 bg-green-50 p-4 text-sm font-medium text-green-700">{{ session('success') }}</div>
            @endif

            @if ($class->description)
                <div class="rounded-xl bg-white p-6 text-sm text-gray-700 shadow-sm ring-1 ring-gray-200">{{ $class->description }}</div>
            @endif

            <div class="rounded-xl bg-white p-6 shadow-sm ring-1 ring-gray-200">
                <h2 class="mb-3 text-lg font-semibold text-gray-800">Schedule</h2>
                <ul class="space-y-1 text-sm text-gray-700">
                    @foreach ($class->schedules as $slot)
                        <li>{{ $slot->label() }}</li>
                    @endforeach
                </ul>
            </div>

            @php($requests = $class->joinRequests->sortByDesc('created_at'))
            <div class="rounded-xl bg-white p-6 shadow-sm ring-1 ring-gray-200">
                <h2 class="mb-3 text-lg font-semibold text-gray-800">Join Requests</h2>
                @forelse ($requests as $joinRequest)
                    <div class="flex flex-col justify-between gap-2 border-t py-3 text-sm first:border-t-0 sm:flex-row sm:items-center">
                        <div>
                            <span class="font-medium text-gray-900">{{ $joinRequest->student->user->name }}</span>
                            <span class="ml-2 text-gray-500">{{ $joinRequest->student->user->email }}</span>
                            <span @class([
                                'ml-2 rounded-full px-2 py-1 text-xs font-semibold',
                                'bg-yellow-100 text-yellow-800' => $joinRequest->status === 'pending',
                                'bg-green-100 text-green-800' => $joinRequest->status === 'accepted',
                                'bg-red-100 text-red-800' => $joinRequest->status === 'rejected',
                            ])>{{ ucfirst($joinRequest->status) }}</span>
                        </div>
                        @if ($joinRequest->status === 'pending')
                            <div class="flex gap-2">
                                <form method="POST" action="{{ route('classes.requests.accept', [$class, $joinRequest]) }}">
                                    @csrf
                                    <button class="rounded-lg bg-green-600 px-3 py-1.5 font-semibold text-white hover:bg-green-700">Accept</button>
                                </form>
                                <form method="POST" action="{{ route('classes.requests.reject', [$class, $joinRequest]) }}">
                                    @csrf
                                    <button class="rounded-lg bg-red-600 px-3 py-1.5 font-semibold text-white hover:bg-red-700">Reject</button>
                                </form>
                            </div>
                        @endif
                    </div>
                @empty
                    <p class="text-sm text-gray-500">No requests.</p>
                @endforelse
            </div>

            <div class="rounded-xl bg-white p-6 shadow-sm ring-1 ring-gray-200">
                <h2 class="mb-3 text-lg font-semibold text-gray-800">Students ({{ $class->students->count() }})</h2>
                @forelse ($class->students as $student)
                    <div class="border-t py-2 text-sm first:border-t-0">
                        <span class="font-medium text-gray-900">{{ $student->user->name }}</span>
                        <span class="ml-2 text-gray-500">{{ $student->user->email }}</span>
                    </div>
                @empty
                    <p class="text-sm text-gray-500">No students enrolled.</p>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>
