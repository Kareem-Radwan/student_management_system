<?php

namespace App\Http\Controllers;

use App\Models\ClassJoinRequest;
use App\Models\ClassMaterial;
use App\Models\ClassPost;
use App\Models\PostGrade;
use App\Models\SchoolClass;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ClassroomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();

        if ($user->role == 'teacher') {
            $classes = $user->teacher->classes()->with('schedules')->withCount('students')->latest()->get();
            return view('classroom.teacher-index', ['classes' => $classes]);
        }

        $student = $user->student;
        abort_unless($student, 403);

        $myClasses = $student->classes()->with(['schedules', 'teacher.user'])->get();
        $requests = $student->joinRequests()->get()->keyBy('school_class_id');
        $available = SchoolClass::with(['schedules', 'teacher.user'])
            ->whereNotIn('id', $myClasses->pluck('id'))
            ->latest()
            ->get();

        return view('classroom.student-index', compact('myClasses', 'requests', 'available'));
    }

    /**
     * Display the specified resource.
     */
    public function show(SchoolClass $schoolClass)
    {
        $this->authorizeClassAccess($schoolClass);

        $schoolClass->load('schedules', 'materials', 'posts', 'teacher.user');
        $isTeacher = auth()->user()->role == 'teacher';
        $students = $schoolClass->students()->with(['parents.user', 'user'])->get();

        $studentId = $isTeacher ? null : auth()->user()->student_id;

        $grades = $studentId ? PostGrade::where('student_id', $studentId)
            ->whereIn('class_post_id', $schoolClass->posts->pluck('id'))
            ->get()->keyBy('class_post_id') : collect();

        return view('classroom.show', [
            'class' => $schoolClass,
            'students' => $students,
            'isTeacher' => $isTeacher,
            'myGrades' => $grades
        ]);
    }

    public function applyClass(SchoolClass $schoolClass)
    {
        $student = auth()->user()->student;
        abort_unless($student, 403);

        if ($schoolClass->students()->whereKey($student->id)->exists()) {
            return back()->with('error', 'You Are Already Enrolled');
        }

        ClassJoinRequest::updateOrCreate(
            ['school_class_id' => $schoolClass->id, 'student_id' => $student->id],
            ['status' => 'pending']
        );

        return back()->with('success', 'Your request was sent to the admin.');
    }

    public function storeMaterial(Request $request, SchoolClass $schoolClass)
    {
        $this->authorizeTeacher($schoolClass);

        $validated = $request->validate([
            'title' => ['required', 'string'],
            'file' => ['required', 'file', 'max:20000']
        ]);

        $file = $request->file('file');

        $schoolClass->materials()->create([
            'title' => $validated['title'],
            'file_path' => $file->store("classes/{$schoolClass->id}/materials"),
            'original_name' => $file->getClientOriginalName()
        ]);

        return back()->with('success', 'Material Uploaded');
    }

    public function destroyMaterial(ClassMaterial $material)
    {
        $this->authorizeTeacher($material->schoolClass);

        Storage::delete($material->file_path);
        $material->delete();

        return back()->with('success', 'Material Deleted');
    }

    public function downloadMaterial(ClassMaterial $material): StreamedResponse
    {
        $this->authorizeClassAccess($material->schoolClass);

        return Storage::download($material->file_path, $material->original_name);
    }

    public function storePost(Request $request, SchoolClass $schoolClass)
    {
        $this->authorizeTeacher($schoolClass);

        $validated = $request->validate([
            'caption' => ['required', 'string'],
            'image' => ['nullable', 'image', 'max:10240'],
            'max_marks' => ['required', 'integer', 'min:1', 'max:1000'],
        ]);

        $schoolClass->posts()->create([
            'caption' => $validated['caption'],
            'max_marks' => $validated['max_marks'],
            'image_path' => $request->hasFile('image')
                ? $request->file('image')->store("classes/{$schoolClass->id}/posts")
                : null,
        ]);

        return back()->with('success', 'Post published.');
    }

    public function destroyPost(ClassPost $post)
    {
        $this->authorizeTeacher($post->schoolClass);

        if ($post->image_path) {
            Storage::delete($post->image_path);
        }
        $post->delete();

        return back()->with('success', 'Post deleted.');
    }

    public function postImage(ClassPost $post)
    {
        $this->authorizeClassAccess($post->schoolClass);
        abort_unless($post->image_path && Storage::exists($post->image_path), 404);

        return Storage::response($post->image_path);
    }

    public function showPost(ClassPost $post)
    {
        $class = $post->schoolClass;
        $this->authorizeTeacher($class);

        $students = $class->students()->with(['user', 'parents.user'])->get();
        $grades = $post->grades()->get()->keyBy('student_id');

        return view('classroom.grade-post', compact('class', 'post', 'students', 'grades'));
    }

    public function storeGrades(Request $request, ClassPost $post)
    {
        $class = $post->schoolClass;
        $this->authorizeTeacher($class);

        $validated = $request->validate([
            'grades' => ['required', 'array'],
            'grades.*.marks' => ['nullable', 'numeric', 'min:0', 'max:' . $post->max_marks],
            'grades.*.notes' => ['nullable', 'string'],
        ]);

        $enrolled = $class->students()->pluck('students.id')->all();

        foreach ($validated['grades'] as $studentId => $data) {
            if (!in_array((int) $studentId, $enrolled, true)) {
                continue;
            }

            if (($data['marks'] ?? '') === '' || $data['marks'] === null) {
                continue;
            }

            $post->grades()->updateOrCreate(
                ['student_id' => $studentId],
                ['marks' => $data['marks'], 'notes' => $data['notes'] ?? null]
            );
        }

        return back()->with('success', 'Grades saved.');
    }

    private function authorizeTeacher(SchoolClass $class): void
    {
        $user = auth()->user();

        abort_unless($user->role === 'teacher' && $user->teacher && $user->teacher->id === $class->teacher_id, 403);
    }

    private function authorizeClassAccess(SchoolClass $class): void
    {
        $user = auth()->user();

        $allowed = match ($user->role) {
            'admin' => true,
            'teacher' => $user->teacher && $user->teacher->id === $class->teacher_id,
            'student' => $user->student && $class->students()->whereKey($user->student->id)->exists(),
            default => false,
        };

        abort_unless($allowed, 403);
    }
}
