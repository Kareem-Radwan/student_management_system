<x-app-layout>
    <div class="min-h-screen bg-gray-50 py-10">
        <div class="mx-auto max-w-5xl px-4 sm:px-6 lg:px-8">
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-gray-900">Create Class</h1>
                <p class="mt-2 text-sm text-gray-600">Choose a department, assign a teacher, set the schedule and add students.</p>
            </div>
            <div class="rounded-xl bg-white p-6 shadow-sm ring-1 ring-gray-200 sm:p-8">
                @include('admin.classes._form', ['action' => route('classes.store'), 'submit' => 'Create Class'])
            </div>
        </div>
    </div>
</x-app-layout>
