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
        return view("teacher.dashboard");
    }
    public function studentDashboard()
    {
        return view("student.dashboard");

    }
    public function parentDashboard()
    {
        return view("parent.dashboard");

    }

}
