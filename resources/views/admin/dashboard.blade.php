<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800 leading-tight">
            Admin Dashboard
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Welcome Section --}}
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-gray-900">
                    Welcome, Admin
                </h1>
                <p class="mt-2 text-gray-600">
                    Manage subjects, teachers, and administrators.
                </p>
            </div>

            {{-- Dashboard Buttons --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

                {{-- Create Subject --}}
                <a href="{{ route('subjects.create') }}"
                    class="block bg-white p-6 rounded-xl shadow-sm border
                            border-gray-200 hover:shadow-md hover:border-blue-400
                            transition">

                    <div class="flex items-center gap-4">
                        <div class="p-3 bg-blue-100 text-blue-600 rounded-lg">
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4v16m8-8H4" />
                            </svg>
                        </div>

                        <div>
                            <h3 class="text-lg font-bold text-gray-900">
                                Create Subject
                            </h3>
                            <p class="text-sm text-gray-500 mt-1">
                                Add a new subject
                            </p>
                        </div>
                    </div>
                </a>

                {{-- Create Teacher --}}
                <a href="{{ route('teachers.create') }}"
                    class="block bg-white p-6 rounded-xl shadow-sm border
                            border-gray-200 hover:shadow-md hover:border-green-400
                            transition">

                    <div class="flex items-center gap-4">
                        <div class="p-3 bg-green-100 text-green-600 rounded-lg">
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 21v-2a4 4 0 00-4-4H8a4 4 0
                                      00-4 4v2m16 0v-2a4 4 0 00-3-3.87
                                      M12 7a4 4 0 11-8 0 4 4 0 018 0
                                      m8 4a4 4 0 10-3-6.87" />
                            </svg>
                        </div>

                        <div>
                            <h3 class="text-lg font-bold text-gray-900">
                                Create Teacher
                            </h3>
                            <p class="text-sm text-gray-500 mt-1">
                                Create a teacher account and password
                            </p>
                        </div>
                    </div>
                </a>

                {{-- Create Admin --}}
                <a href="{{ route('admins.create') }}"
                    class="block bg-white p-6 rounded-xl shadow-sm border
                          border-gray-200 hover:shadow-md hover:border-purple-400
                          transition">

                    <div class="flex items-center gap-4">
                        <div class="p-3 bg-purple-100 text-purple-600 rounded-lg">
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 11c1.657 0 3-1.567 3-3.5S13.657
                                      4 12 4 9 5.567 9 7.5 10.343 11
                                      12 11zm-6 9v-2a6 6 0 0112 0v2
                                      M19 8h3m-1.5-1.5v3" />
                            </svg>
                        </div>

                        <div>
                            <h3 class="text-lg font-bold text-gray-900">
                                Create Admin
                            </h3>
                            <p class="text-sm text-gray-500 mt-1">
                                Create another admin account
                            </p>
                        </div>
                    </div>
                </a>

            </div>

            {{-- View All Section --}}
            <div class="mt-8">
                <h2 class="text-xl font-bold text-gray-900 mb-4">
                    View All
                </h2>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

                    {{-- View All Subjects --}}
                    <a href="{{ route('subjects.index') }}"
                        class="block bg-white p-6 rounded-xl shadow-sm border border-gray-200
                        hover:shadow-md hover:border-blue-400 transition">

                        <div class="flex items-center gap-4">
                            <div class="p-3 bg-blue-100 text-blue-600 rounded-lg">
                                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5
                                            7.5 5S4.168 5.477 3 6.253v13C4.168 18.477
                                            5.754 18 7.5 18s3.332.477 4.5 1.253m0-13
                                            C13.168 5.477 14.754 5 16.5 5S19.832
                                            5.477 21 6.253v13C19.832 18.477 18.246
                                            18 16.5 18s-3.332.477-4.5 1.253" />
                                </svg>
                            </div>

                            <div>
                                <h3 class="text-lg font-bold text-gray-900">
                                    All Subjects
                                </h3>
                                <p class="text-sm text-gray-500 mt-1">
                                    View and manage subjects
                                </p>
                            </div>
                        </div>
                    </a>

                    {{-- View All Teachers --}}
                    <a href="{{ route('teachers.index') }}"
                        class="block bg-white p-6 rounded-xl shadow-sm border border-gray-200
                   hover:shadow-md hover:border-green-400 transition">

                        <div class="flex items-center gap-4">
                            <div class="p-3 bg-green-100 text-green-600 rounded-lg">
                                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a4 4 0 00-5-3.87M9 20H2v-2
                              a4 4 0 017.75-1.25M15 7a3 3 0 11-6 0
                              3 3 0 016 0zm6 3a3 3 0 10-6 0
                              3 3 0 006 0z" />
                                </svg>
                            </div>

                            <div>
                                <h3 class="text-lg font-bold text-gray-900">
                                    All Teachers
                                </h3>
                                <p class="text-sm text-gray-500 mt-1">
                                    View and manage teachers
                                </p>
                            </div>
                        </div>
                    </a>

                    {{-- View All Admins --}}
                    <a href="{{ route('admins.index') }}"
                        class="block bg-white p-6 rounded-xl shadow-sm border border-gray-200
                   hover:shadow-md hover:border-purple-400 transition">

                        <div class="flex items-center gap-4">
                            <div class="p-3 bg-purple-100 text-purple-600 rounded-lg">
                                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 11a4 4 0 100-8 4 4 0 000 8zm-7
                              10v-2a7 7 0 0114 0v2m2-13v6m3-3h-6" />
                                </svg>
                            </div>

                            <div>
                                <h3 class="text-lg font-bold text-gray-900">
                                    All Admins
                                </h3>
                                <p class="text-sm text-gray-500 mt-1">
                                    View and manage administrators
                                </p>
                            </div>
                        </div>
                    </a>

                </div>
            </div>

            {{-- Information Section --}}
            <div class="mt-8 bg-white rounded-xl border border-gray-200 p-6">
                <h2 class="text-lg font-semibold text-gray-900">
                    Administration
                </h2>

                <p class="mt-2 text-sm text-gray-600">
                    Use the cards above to manage your school's subjects
                    and user accounts.
                </p>
            </div>

        </div>
    </div>
</x-app-layout>
