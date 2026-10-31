<x-app-layout>
    <div class="min-h-screen bg-gray-50 py-10">
        <div class="mx-auto max-w-5xl px-4 sm:px-6 lg:px-8">

            <div class="mb-8">
                <h1 class="text-3xl font-bold text-gray-900">Create Parent</h1>
                <p class="mt-2 text-sm text-gray-600">
                    Create a parent account and link them to their students.
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

                <form action="{{ route('parents.store') }}" method="POST">
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
                                    class="w-full rounded-lg border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500">
                                @error('name')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="email" class="mb-1 block text-sm font-medium text-gray-700">
                                    Email Address <span class="text-red-500">*</span>
                                </label>
                                <input type="email" id="email" name="email" value="{{ old('email') }}" required
                                    class="w-full rounded-lg border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500">
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
                                    class="w-full rounded-lg border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500">
                                @error('password')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="relationship" class="mb-1 block text-sm font-medium text-gray-700">
                                    Relationship <span class="text-red-500">*</span>
                                </label>
                                <select id="relationship" name="relationship" required
                                    class="w-full rounded-lg border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500">
                                    <option value="">Select relationship</option>
                                    <option value="father" @selected(old('relationship') === 'father')>Father</option>
                                    <option value="mother" @selected(old('relationship') === 'mother')>Mother</option>
                                    <option value="guardian" @selected(old('relationship') === 'guardian')>Guardian</option>
                                </select>
                                @error('relationship')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                        </div>
                    </div>

                    {{-- Contact Information --}}
                    <div class="mb-8">
                        <h2 class="mb-4 border-b pb-3 text-lg font-semibold text-gray-800">
                            Contact Information
                        </h2>

                        <div class="grid grid-cols-1 gap-5 md:grid-cols-2">

                            <div>
                                <label for="phone" class="mb-1 block text-sm font-medium text-gray-700">
                                    Phone Number
                                </label>
                                <input type="tel" id="phone" name="phone" value="{{ old('phone') }}"
                                    maxlength="20"
                                    class="w-full rounded-lg border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500">
                                @error('phone')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="occupation" class="mb-1 block text-sm font-medium text-gray-700">
                                    Occupation
                                </label>
                                <input type="text" id="occupation" name="occupation" value="{{ old('occupation') }}"
                                    class="w-full rounded-lg border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500">
                                @error('occupation')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="emergency_contact" class="mb-1 block text-sm font-medium text-gray-700">
                                    Emergency Contact
                                </label>
                                <input type="text" id="emergency_contact" name="emergency_contact"
                                    value="{{ old('emergency_contact') }}"
                                    class="w-full rounded-lg border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500">
                                @error('emergency_contact')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="address" class="mb-1 block text-sm font-medium text-gray-700">
                                    Address
                                </label>
                                <textarea id="address" name="address" rows="3"
                                    class="w-full rounded-lg border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500">{{ old('address') }}</textarea>
                                @error('address')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="md:col-span-2">
                                <label for="is_primary_contact" class="flex items-center gap-3">
                                    <input type="checkbox" id="is_primary_contact" name="is_primary_contact" value="1"
                                        @checked(old('is_primary_contact', '0') == '1')
                                        class="rounded border-gray-300 text-pink-600 shadow-sm focus:ring-pink-500">
                                    <span class="text-sm font-medium text-gray-700">
                                        Primary Contact for All Students
                                    </span>
                                </label>
                                @error('is_primary_contact')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="md:col-span-2">
                                <label for="is_active" class="flex items-center gap-3">
                                    <input type="checkbox" id="is_active" name="is_active" value="1"
                                        @checked(old('is_active', '1') == '1')
                                        class="rounded border-gray-300 text-pink-600 shadow-sm focus:ring-pink-500">
                                    <span class="text-sm font-medium text-gray-700">
                                        Active Parent
                                    </span>
                                </label>
                                @error('is_active')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                        </div>
                    </div>

                    {{-- Link Students --}}
                    <div class="mb-8">
                        <h2 class="mb-4 border-b pb-3 text-lg font-semibold text-gray-800">Link Students</h2>

                        @php
                            $selectedStudents = old('student_ids', []);
                        @endphp

                        @forelse ($students as $student)
                            <div
                                class="mb-3 flex items-center gap-3 rounded-lg border border-gray-200 bg-white p-4 hover:bg-gray-50">
                                <input type="checkbox" name="student_ids[]" value="{{ $student->id }}"
                                    {{ in_array($student->id, $selectedStudents) ? 'checked' : '' }}
                                    class="h-4 w-4 rounded border-gray-300 text-pink-600 focus:ring-pink-500">

                                <div>
                                    <h3 class="font-medium text-gray-900">{{ ucfirst($student->user->name) }}</h3>
                                    <p class="text-sm text-gray-500">{{ $student->student_id }} - {{ $student->class ?? 'N/A' }}</p>
                                </div>
                            </div>
                        @empty
                            <p class="rounded-lg bg-gray-50 p-4 text-sm text-gray-500">No Students Found</p>
                        @endforelse

                        @error('student_ids')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                        @error('student_ids.*')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror

                        @if ($students->count() > 0)
                            <div class="mt-5">
                                <label for="primary_student_id"
                                    class="mb-2 block text-sm font-medium text-gray-700">Primary Student</label>
                                <select name="primary_student_id" id="primary_student_id"
                                    class="w-full rounded-lg border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500">
                                    <option value="">Select Primary Student</option>
                                    @foreach ($students as $student)
                                        <option value="{{ $student->id }}"
                                            {{ old('primary_student_id') == $student->id ? 'selected' : '' }}>
                                            {{ $student->user->name }} ({{ $student->student_id }})
                                        </option>
                                    @endforeach
                                </select>
                                @error('primary_student_id')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        @endif
                    </div>

                    {{-- Actions --}}
                    <div class="flex flex-col-reverse gap-3 border-t pt-6 sm:flex-row sm:justify-end">
                        <a href="{{ route('parents.index') }}"
                            class="inline-flex justify-center rounded-lg border border-gray-300 px-5 py-2.5 text-sm font-semibold text-gray-700 hover:bg-gray-50">
                            Cancel
                        </a>

                        <button type="submit"
                            class="inline-flex justify-center rounded-lg bg-pink-600 px-5 py-2.5 text-sm font-semibold text-white hover:bg-pink-700 focus:outline-none focus:ring-2 focus:ring-pink-500 focus:ring-offset-2">
                            Create Parent
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</x-app-layout>
