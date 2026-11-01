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
                    {{ __("You're logged in Parent!") }}
                </div>
            </div>

            @foreach ($children as $child)
                <div class="mt-6 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <h3 class="mb-3 text-lg font-semibold">{{ $child->user->name }} — Grades</h3>
                        @forelse ($child->grades as $grade)
                            <div class="border-t py-3 text-sm first:border-t-0">
                                <p class="font-medium">
                                    {{ $grade->post->schoolClass->name }}:
                                    {{ rtrim(rtrim($grade->marks, '0'), '.') }} / {{ $grade->post->max_marks }}
                                </p>
                                <p class="text-gray-500">{{ \Illuminate\Support\Str::limit($grade->post->caption, 80) }}</p>
                                @if ($grade->notes)<p class="text-gray-600">Note: {{ $grade->notes }}</p>@endif
                            </div>
                        @empty
                            <p class="text-sm text-gray-500">No grades yet.</p>
                        @endforelse
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
