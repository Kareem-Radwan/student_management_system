<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ClassJoinRequest;
use App\Models\SchoolClass;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class ClassController extends Controller
{
    public function index()
    {
        $classes = SchoolClass::with(['teacher.user', 'schedules'])
            ->withCount(['students', 'joinRequests as pending_requests_count' => fn($q) => $q->where('status', 'pending')])
            ->latest()
            ->get();

        return view('admin.classes.index', compact('classes'));
    }

    public function create()
    {
        return view('admin.classes.create', $this->formData());
    }

    public function store(Request $request)
    {
        $validated = $this->validated($request);

        DB::transaction(function () use ($validated) {
            $class = SchoolClass::create([
                'name' => $validated['name'],
                'department' => $validated['department'],
                'teacher_id' => $validated['teacher_id'],
                'subject_id' => $validated['subject'],
                'description' => $validated['description'] ?? null,
            ]);

            $this->syncSchedules($class, $validated['schedules']);
            $this->syncStudents($class, $validated['student_ids'] ?? []);
        });

        return redirect()->route('classes.index')->with('success', 'Class created successfully.');
    }

    public function show(SchoolClass $schoolClass)
    {
        $schoolClass->load(['teacher.user', 'schedules', 'students.user', 'students.parents.user', 'joinRequests.student.user']);

        return view('admin.classes.show', ['class' => $schoolClass]);
    }

    public function edit(SchoolClass $schoolClass)
    {
        $schoolClass->load(['schedules', 'students']);

        return view('admin.classes.edit', $this->formData() + ['class' => $schoolClass]);
    }

    public function update(Request $request, SchoolClass $schoolClass)
    {
        $validated = $this->validated($request);

        DB::transaction(function () use ($validated, $schoolClass) {
            $schoolClass->update([
                'name' => $validated['name'],
                'department' => $validated['department'],
                'teacher_id' => $validated['teacher_id'],
                'description' => $validated['description'] ?? null,
            ]);

            $this->syncSchedules($schoolClass, $validated['schedules']);
            $this->syncStudents($schoolClass, $validated['student_ids'] ?? []);
        });

        return redirect()->route('classes.show', $schoolClass)->with('success', 'Class updated successfully.');
    }

    public function destroy(SchoolClass $schoolClass)
    {
        $schoolClass->delete();

        return redirect()->route('classes.index')->with('success', 'Class deleted successfully.');
    }

    public function acceptRequest(SchoolClass $schoolClass, ClassJoinRequest $joinRequest)
    {
        abort_unless($joinRequest->school_class_id === $schoolClass->id, 404);

        DB::transaction(function () use ($schoolClass, $joinRequest) {
            $schoolClass->students()->syncWithoutDetaching([$joinRequest->student_id]);
            $joinRequest->update(['status' => 'accepted']);
        });

        return back()->with('success', 'Request accepted. The student was added to the class.');
    }

    public function rejectRequest(SchoolClass $schoolClass, ClassJoinRequest $joinRequest)
    {
        abort_unless($joinRequest->school_class_id === $schoolClass->id, 404);

        $schoolClass->students()->detach($joinRequest->student_id);
        $joinRequest->update(['status' => 'rejected']);

        return back()->with('success', 'Request rejected.');
    }

    private function formData(): array
    {
        $teachers = Teacher::with('user')->get()->map(fn(Teacher $teacher) => [
            'id' => $teacher->id,
            'name' => $teacher->user->name,
            'specialization' => $teacher->specialization,
            'department' => strtolower(trim((string) $teacher->department)),
        ])->values();

        $students = Student::with('user')->where('is_active', true)->get()
            ->sortBy(fn(Student $student) => $student->user->name)->values();

        $subjects = Subject::all();
        return [
            'departments' => SchoolClass::DEPARTMENTS,
            'days' => SchoolClass::DAYS,
            'teachers' => $teachers,
            'students' => $students,
            'subjects' => $subjects
        ];
    }

    private function validated(Request $request): array
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'department' => ['required', Rule::in(SchoolClass::DEPARTMENTS)],
            'teacher_id' => ['required', 'exists:teachers,id'],
            'subject' => ['required','exists:subjects,id'],
            'description' => ['nullable', 'string'],
            'schedules' => ['required', 'array', 'min:1'],
            'schedules.*.day' => ['required', Rule::in(SchoolClass::DAYS)],
            'schedules.*.start_time' => ['required', 'date_format:H:i'],
            'schedules.*.end_time' => ['required', 'date_format:H:i'],
            'student_ids' => ['nullable', 'array'],
            'student_ids.*' => ['exists:students,id'],
        ]);

        foreach ($validated['schedules'] as $index => $slot) {
            if ($slot['end_time'] <= $slot['start_time']) {
                back()->withInput()->withErrors(["schedules.$index.end_time" => 'End time must be after start time.'])
                    ->throwResponse();
            }
        }

        $teacher = Teacher::findOrFail($validated['teacher_id']);
        if (strtolower(trim((string) $teacher->department)) !== strtolower($validated['department'])) {
            back()->withInput()->withErrors(['teacher_id' => 'The teacher must belong to the selected department.'])
                ->throwResponse();
        }

        return $validated;
    }

    private function syncSchedules(SchoolClass $class, array $slots): void
    {
        $class->schedules()->delete();
        $class->schedules()->createMany(array_map(fn($slot) => [
            'day' => $slot['day'],
            'start_time' => $slot['start_time'],
            'end_time' => $slot['end_time'],
        ], array_values($slots)));
    }

    private function syncStudents(SchoolClass $class, array $studentIds): void
    {
        $class->students()->sync($studentIds);

        // Students added by hand have their pending requests marked as accepted.
        $class->joinRequests()->where('status', 'pending')->whereIn('student_id', $studentIds)
            ->update(['status' => 'accepted']);
    }
}
