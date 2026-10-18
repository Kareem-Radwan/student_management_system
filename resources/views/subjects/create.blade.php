<x-app-layout>
    <div class="max-w-2xl p-8 m-3 mx-auto bg-white rounded-2xl shadow-sm border border-gray-200">

        <div class="mb-6">
            <h2 class="text-2xl font-bold text-gray-900">Create Subject</h2>
            <p class="text-sm text-gray-500 mt-2">
                Fill in the information below to add a new subject.
            </p>
        </div>

        <form action="{{ route('subjects.store') }}" method="POST" class="space-y-5">
            @csrf

            {{-- Subject Name --}}
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                    Subject Name
                </label>

                <input type="text" id="name" name="name" value="{{ old('name') }}"
                    placeholder="e.g. Mathematics" required
                    class="w-full rounded-lg border border-gray-300 px-4 py-3
                        text-gray-900 placeholder-gray-400 shadow-sm
                        focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200
                        outline-none transition">

                @error('name')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Subject Code --}}
            <div>
                <label for="code" class="block text-sm font-medium text-gray-700 mb-2">
                    Subject Code
                </label>

                <input type="text" id="code" name="code" value="{{ old('code') }}"
                    placeholder="e.g. MATH101" required
                    class="w-full rounded-lg border border-gray-300 px-4 py-3
                        text-gray-900 placeholder-gray-400 shadow-sm
                        focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200
                        outline-none transition">

                @error('code')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Description --}}
            <div>
                <label for="description" class="block text-sm font-medium text-gray-700 mb-2">
                    Description
                    <span class="text-gray-400 font-normal">(Optional)</span>
                </label>

                <textarea id="description" name="description" rows="5"
                    placeholder="Write a short description about this subject..."
                    class="w-full rounded-lg border border-gray-300 px-4 py-3
                       text-gray-900 placeholder-gray-400 shadow-sm resize-y
                       focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200
                       outline-none transition">{{ old('description') }}</textarea>

                @error('description')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Submit Button --}}
            <div class="flex items-center justify-end gap-3 pt-3">
                <a href="{{ url()->previous() }}"
                    class="px-5 py-3 rounded-lg border border-gray-300 text-gray-700
                       font-medium hover:bg-gray-50 transition">
                    Cancel
                </a>

                <button type="submit"
                    class="px-6 py-3 rounded-lg bg-indigo-600 text-white font-semibold
                       hover:bg-indigo-700 focus:ring-4 focus:ring-indigo-200
                       transition shadow-sm">
                    Add Subject
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
