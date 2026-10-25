<x-app-layout>
    <div class="min-h-screen bg-gray-50 py-10">
        <div class="mx-auto max-w-5xl px-4 sm:px-6 lg:px-8">

            <div class="mb-8">
                <h1 class="text-3xl font-bold text-gray-900">Create Student</h1>
                <p class="mt-2 text-sm text-gray-600">
                    Create a student account and enter the student's academic information.
                </p>
            </div>

            <div class="rounded-xl bg-white p-6 shadow-sm ring-1 ring-gray-200 sm:p-8">

                @if ($errors->any())
                    <div class="mb-6 rounded-lg border border-red-200 bg-red-50 p-4 text-red-700">
                        <p class="font-semibold">Please correct the following errors:</p>
                        <ul class="mt-2 list-inside list-disc text-sm">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('students.store') }}" method="POST">
                    @csrf

                    {{-- Account Information --}}
                    <div class="mb-8">
                        <h2 class="mb-4 border-b pb-3 text-lg font-semibold text-gray-800">
                            Account Information
                        </h2>

                        <div class="grid grid-cols-1 gap-5 md:grid-cols-2">

                            <div>
                                <label for="name" class="mb-1 block text-sm font-medium text-gray-700">
                                    Full Name <span class="text-red-500">*</span>
                                </label>
                                <input type="text" id="name" name="name" value="{{ old('name') }}" required
                                    class="w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                @error('name')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="email" class="mb-1 block text-sm font-medium text-gray-700">
                                    Email Address <span class="text-red-500">*</span>
                                </label>
                                <input type="email" id="email" name="email" value="{{ old('email') }}" required
                                    class="w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                @error('email')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="password" class="mb-1 block text-sm font-medium text-gray-700">
                                    Password <span class="text-red-500">*</span>
                                </label>
                                <input type="password" id="password" name="password" required
                                    autocomplete="new-password"
                                    class="w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                @error('password')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                        </div>
                    </div>

                    {{-- Personal Information --}}
                    <div class="mb-8">
                        <h2 class="mb-4 border-b pb-3 text-lg font-semibold text-gray-800">
                            Personal Information
                        </h2>

                        <div class="grid grid-cols-1 gap-5 md:grid-cols-2">

                            <div>
                                <label for="student_id" class="mb-1 block text-sm font-medium text-gray-700">
                                    Student ID <span class="text-red-500">*</span>
                                </label>
                                <input type="text" id="student_id" name="student_id" value="{{ old('student_id') }}"
                                    required
                                    class="w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                @error('student_id')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="date_of_birth" class="mb-1 block text-sm font-medium text-gray-700">
                                    Date of Birth <span class="text-red-500">*</span>
                                </label>
                                <input type="date" id="date_of_birth" name="date_of_birth"
                                    value="{{ old('date_of_birth') }}" max="{{ date('Y-m-d') }}" required
                                    class="w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                @error('date_of_birth')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="gender" class="mb-1 block text-sm font-medium text-gray-700">
                                    Gender <span class="text-red-500">*</span>
                                </label>
                                <select id="gender" name="gender" required
                                    class="w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                    <option value="">Select gender</option>
                                    <option value="male" @selected(old('gender') === 'male')>Male</option>
                                    <option value="female" @selected(old('gender') === 'female')>Female</option>
                                </select>
                                @error('gender')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="phone" class="mb-1 block text-sm font-medium text-gray-700">
                                    Phone Number
                                </label>
                                <input type="tel" id="phone" name="phone" value="{{ old('phone') }}"
                                    maxlength="20"
                                    class="w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                @error('phone')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="emergency_contact" class="mb-1 block text-sm font-medium text-gray-700">
                                    Emergency Contact
                                </label>
                                <input type="text" id="emergency_contact" name="emergency_contact"
                                    value="{{ old('emergency_contact') }}"
                                    class="w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                @error('emergency_contact')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="address" class="mb-1 block text-sm font-medium text-gray-700">
                                    Address
                                </label>
                                <textarea id="address" name="address" rows="3"
                                    class="w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('address') }}</textarea>
                                @error('address')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                        </div>
                    </div>

                    {{-- Academic Information --}}
                    <div class="mb-8">
                        <h2 class="mb-4 border-b pb-3 text-lg font-semibold text-gray-800">
                            Academic Information
                        </h2>

                        <div class="grid grid-cols-1 gap-5 md:grid-cols-2">

                            <div>
                                <label for="admission_date" class="mb-1 block text-sm font-medium text-gray-700">
                                    Admission Date
                                </label>
                                <input type="date" id="admission_date" name="admission_date"
                                    value="{{ old('admission_date') }}"
                                    class="w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                @error('admission_date')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="class" class="mb-1 block text-sm font-medium text-gray-700">
                                    Class
                                </label>
                                <input type="text" id="class" name="class" value="{{ old('class') }}"
                                    class="w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                @error('class')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="section" class="mb-1 block text-sm font-medium text-gray-700">
                                    Section
                                </label>
                                <input type="text" id="section" name="section" value="{{ old('section') }}"
                                    class="w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                @error('section')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="roll_number" class="mb-1 block text-sm font-medium text-gray-700">
                                    Roll Number
                                </label>
                                <input type="text" id="roll_number" name="roll_number"
                                    value="{{ old('roll_number') }}"
                                    class="w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                @error('roll_number')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="md:col-span-2">
                                <label for="is_active" class="flex items-center gap-3">
                                    <input type="checkbox" id="is_active" name="is_active" value="1"
                                        @checked(old('is_active', '1') == '1')
                                        class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                                    <span class="text-sm font-medium text-gray-700">
                                        Active Student
                                    </span>
                                </label>
                                @error('is_active')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                        </div>
                    </div>

                    {{-- Parents Link --}}
                    <div class="mb-8">
                        <h2 class="mb-4 border-b pb-3 text-lg font-semibold text-gray-800">Link Parents</h2>

                        @php
                            $selectedParents = old('parent_ids', []);
                        @endphp

                        @forelse ($parents as $parent)
                            <div
                                class="mb-3 flex items-center gap-3 rounded-lg border border-gray-200 bg-white p-4 hover:bg-gray-50">
                                <input type="checkbox" name="parent_ids[]" value="{{ $parent->id }}"
                                    {{ in_array($parent->id, $selectedParents) ? 'checked' : '' }}
                                    class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">

                                <div>
                                    <h3 class="font-medium text-gray-900">{{ ucfirst($parent->user->name) }}</h3>
                                    <p class="text-sm text-gray-500">{{ $parent->relationship }}</p>
                                </div>
                            </div>
                        @empty
                            <p class="rounded-lg bg-gray-50 p-4 text-sm text-gray-500">No Parents Found</p>
                        @endforelse

                        @error('parent_ids')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                        @error('parent_ids.*')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror

                        <div class="mt-5">
                            <label for="primary_parent_id"
                                class="mb-2 block text-sm font-medium text-gray-700">Primary Parent</label>
                            <select name="primary_parent_id" id="primary_parent_id"
                                class="w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                <option value="">Select Primary Parent</option>
                                @foreach ($parents as $parent)
                                    <option value="{{ $parent->id }}"
                                        {{ old('primary_parent_id') == $parent->id ? 'selected' : '' }}>
                                        {{ $parent->user->name }} ({{ $parent->relationship }})
                                    </option>
                                @endforeach
                            </select>
                            @error('primary_parent_id')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    {{-- Actions --}}
                    <div class="flex flex-col-reverse gap-3 border-t pt-6 sm:flex-row sm:justify-end">
                        <a href="{{ route('students.index') }}"
                            class="inline-flex justify-center rounded-lg border border-gray-300 px-5 py-2.5 text-sm font-semibold text-gray-700 hover:bg-gray-50">
                            Cancel
                        </a>

                        <button type="submit"
                            class="inline-flex justify-center rounded-lg bg-indigo-600 px-5 py-2.5 text-sm font-semibold text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                            Create Student
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</x-app-layout>
