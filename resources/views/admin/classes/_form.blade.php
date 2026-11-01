@php
    $existingSchedules = old(
        'schedules',
        isset($class)
            ? $class->schedules
                ->map(
                    fn($s) => [
                        'day' => $s->day,
                        'start_time' => substr($s->start_time, 0, 5),
                        'end_time' => substr($s->end_time, 0, 5),
                    ],
                )
                ->all()
            : [['day' => '', 'start_time' => '', 'end_time' => '']],
    );
    $selectedStudents = collect(old('student_ids', isset($class) ? $class->students->pluck('id')->all() : []))
        ->map(fn($id) => (int) $id)
        ->all();
    $input = 'w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500';
@endphp

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

<form action="{{ $action }}" method="POST" x-data="{
    department: @js(old('department', $class->department ?? '')),
    teacherId: @js((string) old('teacher_id', $class->teacher_id ?? '')),
    teachers: @js($teachers),
    schedules: @js($existingSchedules),
    get filteredTeachers() {
        return this.teachers.filter(t => t.department === this.department.toLowerCase());
    },
    add() { this.schedules.push({ day: '', start_time: '', end_time: '' }); },
    remove(i) { if (this.schedules.length > 1) this.schedules.splice(i, 1); }
}">
    @csrf
    @isset($method)
        @method($method)
    @endisset

    <div class="mb-8">
        <h2 class="mb-4 border-b pb-3 text-lg font-semibold text-gray-800">Class Information</h2>
        <div class="grid grid-cols-1 gap-5 md:grid-cols-2">
            <div>
                <label for="name" class="mb-1 block text-sm font-medium text-gray-700">Class Name <span
                        class="text-red-500">*</span></label>
                <input type="text" id="name" name="name" value="{{ old('name', $class->name ?? '') }}"
                    required class="{{ $input }}">
            </div>

            <div>
                <label for="department" class="mb-1 block text-sm font-medium text-gray-700">Department <span
                        class="text-red-500">*</span></label>
                <select id="department" name="department" x-model="department" @change="teacherId = ''" required
                    class="{{ $input }}">
                    <option value="">Select a department</option>
                    @foreach ($departments as $department)
                        <option value="{{ $department }}">{{ $department }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="subject" class="mb-1 block text-sm font-medium text-gray-700">Subject <span
                        class="text-red-500">*</span></label>
                <select id="subject" name="subject" x-model="subject" required
                    class="{{ $input }}">
                    <option value="">Select a Subject</option>
                    @foreach ($subjects as $subject)
                        <option value="{{ $subject->id }}">{{ $subject->name }} | {{ $subject->code }} </option>
                    @endforeach
                </select>
            </div>


            <div class="md:col-span-2">
                <label for="teacher_id" class="mb-1 block text-sm font-medium text-gray-700">Teacher <span
                        class="text-red-500">*</span></label>
                <select id="teacher_id" name="teacher_id" x-model="teacherId" :disabled="!department" required
                    class="{{ $input }}">
                    <option value=""
                        x-text="department ? (filteredTeachers.length ? 'Select a teacher' : 'No teachers in this department') : 'Choose a department first'">
                    </option>
                    <template x-for="teacher in filteredTeachers" :key="teacher.id">
                        <option :value="teacher.id" :selected="String(teacher.id) === teacherId"
                            x-text="teacher.name + ' — ' + (teacher.specialization || 'No specialization')"></option>
                    </template>
                </select>
            </div>

            <div class="md:col-span-2">
                <label for="description" class="mb-1 block text-sm font-medium text-gray-700">Description</label>
                <textarea id="description" name="description" rows="3" class="{{ $input }}">{{ old('description', $class->description ?? '') }}</textarea>
            </div>
        </div>
    </div>

    <div class="mb-8">
        <div class="mb-4 flex items-center justify-between border-b pb-3">
            <h2 class="text-lg font-semibold text-gray-800">Schedule</h2>
            <button type="button" @click="add()"
                class="rounded-lg bg-indigo-50 px-3 py-2 text-sm font-semibold text-indigo-700 hover:bg-indigo-100">
                + Add day / time
            </button>
        </div>

        <div class="space-y-3">
            <template x-for="(slot, i) in schedules" :key="i">
                <div class="grid grid-cols-1 items-end gap-3 sm:grid-cols-4">
                    <div>
                        <label class="mb-1 block text-xs font-medium text-gray-500">Day</label>
                        <select :name="`schedules[${i}][day]`" x-model="slot.day" required class="{{ $input }}">
                            <option value="">Select day</option>
                            @foreach ($days as $day)
                                <option value="{{ $day }}">{{ $day }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="mb-1 block text-xs font-medium text-gray-500">Start time</label>
                        <input type="time" :name="`schedules[${i}][start_time]`" x-model="slot.start_time" required
                            class="{{ $input }}">
                    </div>
                    <div>
                        <label class="mb-1 block text-xs font-medium text-gray-500">End time</label>
                        <input type="time" :name="`schedules[${i}][end_time]`" x-model="slot.end_time" required
                            class="{{ $input }}">
                    </div>
                    <div>
                        <button type="button" @click="remove(i)" :disabled="schedules.length === 1"
                            class="rounded-lg border border-red-200 px-3 py-2 text-sm font-medium text-red-600 hover:bg-red-50 disabled:opacity-40">
                            Remove
                        </button>
                    </div>
                </div>
            </template>
        </div>
    </div>

    <div class="mb-8">
        <h2 class="mb-4 border-b pb-3 text-lg font-semibold text-gray-800">Students <span
                class="text-sm font-normal text-gray-500">(optional)</span></h2>
        <p class="mb-2 text-sm text-gray-500">
            Select one or more students (hold Ctrl / Cmd to pick several). Students can also apply from their dashboard
            and be accepted from the class page.
        </p>
        <select name="student_ids[]" multiple size="8" class="{{ $input }}">
            @foreach ($students as $student)
                <option value="{{ $student->id }}" @selected(in_array($student->id, $selectedStudents, true))>
                    {{ $student->user->name }} ({{ $student->student_id }})
                </option>
            @endforeach
        </select>
    </div>

    <div class="flex justify-end gap-3">
        <a href="{{ route('classes.index') }}"
            class="rounded-lg border border-gray-300 px-5 py-3 text-sm font-semibold text-gray-700 hover:bg-gray-50">Cancel</a>
        <button type="submit"
            class="rounded-lg bg-indigo-600 px-5 py-3 text-sm font-semibold text-white shadow-sm hover:bg-indigo-700">{{ $submit }}</button>
    </div>
</form>
