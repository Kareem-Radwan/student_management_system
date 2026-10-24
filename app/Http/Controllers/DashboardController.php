<?php

namespace App\Http\Controllers;

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
        return view("admin.dashboard", [
            "admins" => $admins,
            "teachers" => $teachers,
            "subjects" => $subjects
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
