<x-app-layout>
    <div class="max-w-2xl p-8 m-3 mx-auto bg-white rounded-2xl shadow-sm border border-gray-200">

        {{-- Header --}}
        <div class="mb-6">
            <h2 class="text-2xl font-bold text-gray-900">Create Teacher</h2>
            <p class="text-sm text-gray-500 mt-2">
                Fill in the information below to add a new teacher.
            </p>
        </div>

        <form action="{{ route('teachers.store') }}" method="POST" class="space-y-5">
            @csrf

            <input type="hidden" name="role" value="teacher">

            {{-- Name --}}
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                    Full Name
                </label>

                <input type="text" id="name" name="name" value="{{ old('name') }}"
                    placeholder="e.g. Ahmed Mohamed" required
                    class="w-full rounded-lg border border-gray-300 px-4 py-3
                        text-gray-900 placeholder-gray-400 shadow-sm
                        focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200
                        outline-none transition">

                @error('name')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Email --}}
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                    Email Address
                </label>

                <input type="email" id="email" name="email" value="{{ old('email') }}"
                    placeholder="e.g. teacher@example.com" required
                    class="w-full rounded-lg border border-gray-300 px-4 py-3
                        text-gray-900 placeholder-gray-400 shadow-sm
                        focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200
                        outline-none transition">

                @error('email')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Password --}}
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                    Password
                </label>

                <input type="password" id="password" name="password" required placeholder="Enter a secure password"
                    class="w-full rounded-lg border border-gray-300 px-4 py-3
                        text-gray-900 placeholder-gray-400 shadow-sm
                        focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200
                        outline-none transition">

                @error('password')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Department & Qualification --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">

                <div>
                    <label for="department" class="block text-sm font-medium text-gray-700 mb-2">
                        Department
                    </label>

                    <input type="text" id="department" name="department" value="{{ old('department') }}"
                        placeholder="e.g. Mathematics" required
                        class="w-full rounded-lg border border-gray-300 px-4 py-3
                            text-gray-900 placeholder-gray-400 shadow-sm
                            focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200
                            outline-none transition">

                    @error('department')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="qualification" class="block text-sm font-medium text-gray-700 mb-2">
                        Qualification
                    </label>

                    <input type="text" id="qualification" name="qualification" value="{{ old('qualification') }}"
                        placeholder="e.g. Bachelor's Degree" required
                        class="w-full rounded-lg border border-gray-300 px-4 py-3
                            text-gray-900 placeholder-gray-400 shadow-sm
                            focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200
                            outline-none transition">

                    @error('qualification')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

            </div>

            {{-- Join Date --}}
            <div>
                <label for="join_date" class="block text-sm font-medium text-gray-700 mb-2">
                    Joining Date
                </label>

                <input type="date" id="join_date" name="join_date" value="{{ old('join_date') }}" required
                    class="w-full rounded-lg border border-gray-300 px-4 py-3
                        text-gray-900 shadow-sm
                        focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200
                        outline-none transition">

                @error('join_date')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Specialization --}}
            <div>
                <label for="specialization" class="block text-sm font-medium text-gray-700 mb-2">
                    Specialization
                </label>

                <input type="text" id="specialization" name="specialization" value="{{ old('specialization') }}"
                    placeholder="e.g. Algebra and Geometry" required
                    class="w-full rounded-lg border border-gray-300 px-4 py-3
                        text-gray-900 placeholder-gray-400 shadow-sm
                        focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200
                        outline-none transition">

                @error('specialization')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Actions --}}
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
                    Add Teacher
                </button>
            </div>

        </form>
    </div>
</x-app-layout>
