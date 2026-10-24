<x-app-layout>
    <div class="max-w-2xl p-8 m-3 mx-auto bg-white rounded-2xl shadow-sm border border-gray-200">

        {{-- Header --}}
        <div class="mb-6">
            <h2 class="text-2xl font-bold text-gray-900">Create Admin</h2>
            <p class="mt-2 text-sm text-gray-500">
                Fill in the information below to create a new administrator account.
            </p>
        </div>

        <form action="{{ route('admins.store') }}" method="POST" class="space-y-5">
            @csrf

            <input type="hidden" name="role" value="admin">

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
                    placeholder="e.g. admin@example.com" required
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

                <input type="password" id="password" name="password" placeholder="Enter a secure password" required
                    autocomplete="new-password"
                    class="w-full rounded-lg border border-gray-300 px-4 py-3
                        text-gray-900 placeholder-gray-400 shadow-sm
                        focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200
                        outline-none transition">

                @error('password')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Admin Role Notice --}}
            <div class="rounded-lg border border-indigo-100 bg-indigo-50 p-4">
                <p class="text-sm font-semibold text-indigo-900">
                    Administrator Account
                </p>
                <p class="mt-1 text-sm text-indigo-700">
                    This account will be assigned the admin role and should only be
                    created by an authorized administrator.
                </p>
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
                    Add Admin
                </button>
            </div>

        </form>
    </div>
</x-app-layout>
