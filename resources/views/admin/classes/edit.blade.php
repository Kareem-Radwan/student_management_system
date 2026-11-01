<x-app-layout>
    <div class="min-h-screen bg-gray-50 py-10">
        <div class="mx-auto max-w-5xl px-4 sm:px-6 lg:px-8">
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-gray-900">Edit Class</h1>
                <p class="mt-2 text-sm text-gray-600">Update the class details, teacher, schedule or students.</p>
            </div>
            <div class="rounded-xl bg-white p-6 shadow-sm ring-1 ring-gray-200 sm:p-8">
                @include('admin.classes._form', ['action' => route('classes.update', $class), 'method' => 'PUT', 'submit' => 'Save Changes'])
            </div>
        </div>
    </div>
</x-app-layout>
