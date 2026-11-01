<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in, Student!") }}
                </div>
            </div>

            <div class="mt-6 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="mb-3 flex items-center justify-between">
                        <h3 class="text-lg font-semibold">My Classes</h3>
                        <a href="{{ route('my-classes.index') }}" class="text-sm font-semibold text-indigo-600 hover:underline">View all</a>
                    </div>
                    @forelse ($classes as $class)
                        <a href="{{ route('my-classes.show', $class) }}" class="block border-t py-3 text-sm first:border-t-0 hover:bg-gray-50">
                            <span class="font-medium">{{ $class->name }}</span>
                            <span class="text-gray-500">· {{ $class->department }}</span>
                        </a>
                    @empty
                        <p class="text-sm text-gray-500">No classes yet.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
