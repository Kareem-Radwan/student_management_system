<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $teachers = Teacher::all();
        return view("teacher.index", ["teachers" => $teachers]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("teacher.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            "name" => ['required', 'string'],
            "email" => ['required', 'string', 'email', 'unique:users,email'],
            'password' => ['required', 'string', Password::defaults()],
            'role' => ['required', 'in:teacher'],

            'department' => ['nullable', 'string'],
            'qualification' => ['nullable', 'string'],
            'specialization' => ['nullable', 'string'],
            'join_date' => ['nullable', 'date']
        ]);

        DB::transaction(function () use ($validated) {
            $user = User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'role' => $validated['role'],
                'password' => Hash::make($validated['password']),
            ]);

            $user->teacher()->create([
                'department' => $validated['department'],
                'qualification' => $validated['qualification'],
                'specialization' => $validated['specialization'],
                'join_date' => $validated['join_date'],
            ]);
        });

        return redirect()->route('teachers.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $teacher = Teacher::find($id);
        return view('teacher.show', ['teacher' => $teacher]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $teacher = Teacher::findOrFail($id);

        DB::transaction(function () use ($teacher) {
            $user = $teacher->user;

            $teacher->delete();
            $user?->delete();
        });

        return redirect()
            ->route('teachers.index')
            ->with('success', 'Teacher deleted successfully.');
    }
}
