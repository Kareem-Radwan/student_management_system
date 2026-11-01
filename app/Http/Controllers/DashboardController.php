<?php

namespace App\Http\Controllers;

use App\Models\ParentModel;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function adminDashboard()
    {
        $admins = User::all()->where("role", "admin")->count();
        $teachers = Teacher::count("id");
        $subjects = Subject::count("id");
        $students = Student::count("id");
        $parents = ParentModel::count("id");
        return view("admin.dashboard", [
            "admins" => $admins,
            "teachers" => $teachers,
            "subjects" => $subjects,
            "students" => $students,
            "parents" => $parents
        ]);
    }

    public function teacherDashboard()
    {
        $classes = auth()->user()->teacher->classes()->with('schedules')->withCount('students')->latest()->get();

        return view("teacher.dashboard", compact('classes'));
    }
    public function studentDashboard()
    {
        $classes = auth()->user()->student->classes()->with(['schedules', 'teacher.user'])->get();
        return view("student.dashboard", compact('classes'));
    }
    public function parentDashboard()
    {
        $children = auth()->user()->parent->students()->with(['user', 'classes', 'grades.post.schoolClass'])->get();
        return view("parent.dashboard", compact('children'));
    }
}
