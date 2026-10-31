<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ParentModel;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\ValidationException;

class ParentController extends Controller
{
    /**
     * Display a listing of parents.
     */
    public function index()
    {
        $parents = ParentModel::with(['user', 'students'])->get();

        return view('admin.parents.index', compact('parents'));
    }

    /**
     * Show the form for creating a new parent.
     */
    public function create()
    {
        $students = Student::with(['user'])
            ->where('is_active', true)
            ->get();

        return view('admin.parents.create', compact('students'));
    }

    /**
     * Store a newly created parent.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            // User information
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'unique:users,email'],
            'password' => ['required', 'string', Password::defaults()],

            // Parent information
            'parent_id' => ['required', 'string', 'max:255', 'unique:parents,parent_id'],
            'relationship' => ['required', 'in:father,mother,guardian'],
            'address' => ['nullable', 'string'],
            'phone' => ['nullable', 'string', 'max:20'],
            'occupation' => ['nullable', 'string', 'max:255'],
            'work_address' => ['nullable', 'string'],
            'national_id' => ['nullable', 'integer'],
            'is_primary_contact' => ['sometimes', 'boolean'],
            'is_active' => ['sometimes', 'boolean'],

            // Student relationships
            'student_ids' => ['nullable', 'array'],
            'student_ids.*' => ['required', 'exists:students,id'],
            'primary_student_id' => ['nullable', 'exists:students,id'],
        ]);

        // The primary student must be among the selected students.
        if (
            !empty($validated['primary_student_id']) &&
            !in_array(
                $validated['primary_student_id'],
                $validated['student_ids'] ?? []
            )
        ) {
            throw ValidationException::withMessages([
                'primary_student_id' => 'The primary student must be selected.',
            ]);
        }

        DB::transaction(function () use ($validated) {

            // Create user account
            $user = User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']),
            ]);

            // Create parent record
            $parent = ParentModel::create([
                'user_id' => $user->id,
                'parent_id' => $validated['parent_id'],
                'relationship' => $validated['relationship'],
                'address' => $validated['address'] ?? null,
                'phone' => $validated['phone'] ?? null,
                'occupation' => $validated['occupation'] ?? null,
                'work_address' => $validated['work_address'] ?? null,
                'national_id' => $validated['national_id'] ?? null,
                'is_primary_contact' => $validated['is_primary_contact'] ?? false,
                'is_active' => $validated['is_active'] ?? true,
            ]);

            // Link parent to selected students
            if (!empty($validated['student_ids'])) {

                $linkStudents = [];

                foreach ($validated['student_ids'] as $studentId) {
                    $linkStudents[$studentId] = [
                        'is_primary' => (
                            $studentId == ($validated['primary_student_id'] ?? null)
                        ),
                    ];
                }

                $parent->students()->attach($linkStudents);
            }
        });

        return redirect()
            ->route('parents.index')
            ->with('success', 'Parent created successfully.');
    }

    /**
     * Display the specified parent.
     */
    public function show(ParentModel $parent)
    {
        $parent->load(['user', 'students.user']);

        return view('admin.parents.show', compact('parent'));
    }

    /**
     * Remove the specified parent.
     */
    public function destroy(ParentModel $parent)
    {
        DB::transaction(function () use ($parent) {

            $user = $parent->user;

            // Delete parent record
            $parent->delete();

            // Delete associated user account
            if ($user) {
                $user->delete();
            }
        });

        return redirect()
            ->route('parents.index')
            ->with('success', 'Parent deleted successfully.');
    }

    /**
     * Link an existing student to a parent.
     */
    public function linkStudent(Request $request, ParentModel $parent)
    {
        $validated = $request->validate([
            'student_id' => ['required', 'exists:students,id'],
            'is_primary' => ['sometimes', 'boolean'],
        ]);

        if (
            $parent->students()
                ->where('parent_student.student_id', $validated['student_id'])
                ->exists()
        ) {
            return back()->with(
                'error',
                'This student is already linked to this parent.'
            );
        }

        $parent->students()->attach($validated['student_id'], [
            'is_primary' => $validated['is_primary'] ?? false,
        ]);

        return back()->with(
            'success',
            'Student linked to parent successfully.'
        );
    }

    /**
     * Unlink a student from a parent.
     */
    public function unlinkStudent(ParentModel $parent, Student $student)
    {
        $parent->students()->detach($student->id);

        return back()->with(
            'success',
            'Student unlinked from parent successfully.'
        );
    }
}
