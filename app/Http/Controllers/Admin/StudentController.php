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

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $students = Student::with(['user', 'parents'])->get();
        return view('admin.students.index', compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $parents = ParentModel::with(['user'])->where("is_active", true)->get();
        return view('admin.students.create', ["parents" => $parents]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string'],
            'email' => ['required', 'string', 'email', 'unique:users,email'],
            'password' => ['required', 'string', Password::defaults()],
            'student_id' => ['required', 'string', 'max:255', 'unique:students,student_id'],
            'date_of_birth' => ['required', 'date', 'before:today'],
            'gender' => ['required', 'in:male,female'],
            'address' => ['nullable', 'string'],
            'phone' => ['nullable', 'string', 'max:20'],
            'emergency_contact' => ['nullable', 'string', 'max:255'],
            'admission_date' => ['nullable', 'date'],
            'class' => ['nullable', 'string', 'max:255'],
            'section' => ['nullable', 'string', 'max:255'],
            'roll_number' => ['nullable', 'string', 'max:255'],
            'is_active' => ['sometimes', 'boolean'],

            'parent_ids' => ['nullable', 'array'],
            // هام جدا جدا جدا جدا جدا جدا جدا جدا
            'parent_ids.*' => ['exists:parents,id'],
            'primary_parent_id' => ['nullable', 'exists:parents,id']
        ]);

        DB::beginTransaction();
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password'])
        ]);

        $student = Student::create([
            'user_id' => $user->id,
            'student_id' => $validated['student_id'],
            'date_of_birth' => $validated['date_of_birth'],
            'gender' => $validated['gender'],
            'address' => $validated['address'] ?? null,
            'phone' => $validated['phone'] ?? null,
            'emergency_contact' => $validated['emergency_contact'] ?? null,
            'admission_date' => $validated['admission_date'] ?? null,
            'class' => $validated['class'] ?? null,
            'section' => $validated['section'] ?? null,
            'roll_number' => $validated['roll_number'] ?? null,
            'is_active' => $validated['is_active'] ?? true,
        ]);

        // PLEASE FOCUS!
        if (!empty($validated['parent_ids'])) {
            $linkParentToStudent = [];
            foreach ($validated['parent_ids'] as $parentId) {
                $linkParentToStudent[$parentId] = [
                    'is_primary' => ($parentId == $validated['primary_parent_id'])
                ];
            }
            $student->parents()->attach($linkParentToStudent);
        }
        DB::commit();

        return redirect()->route("students.index");
    }

    /**
     * Display the specified resource.
     */
    public function show(Student $student)
    {
        $student->load(['user', 'parents.user']);
        $availableParents = ParentModel::with('user')->where('is_active', true)->get();
        return view('admin.students.show', ["student" => $student, "availableParents" => $availableParents]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student)
    {
        DB::beginTransaction();
        $user = $student->user;
        $student->delete();
        $user->delete;
        DB::commit();

        return redirect()->route("students.index");
    }

    public function linkParent(Request $request, Student $student)
    {
        $validated = $request->validate([
            'parent_id' => ['required', 'exists:parents,id'],
            'is_primary' => ['boolean']
        ]);

        if ($student->parents()->where('parent_student.parent_id', $validated['parent_id'])->exists()) {
            return back()->with('error', 'This student already have this parent');
        }

        $student->parents()->attach($validated['parent_id'], [
            'is_primary' => $validated['is_primary'] ?? false
        ]);

        return back()->with('success', 'student is linked to this parent');
    }

    public function unlinkParent(Student $student, ParentModel $parent)
    {
        $student->parents()->detach($parent->id);
        return back()->with('success', 'student is unlinked from this parent');
    }
}
