<?php

use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\Admin\SubjectController;
use App\Http\Controllers\Admin\ParentController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TeacherController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
        return match(auth()->user()->role) {
                    'admin' => app(DashboardController::class)->adminDashboard(),
                    'teacher' => app(DashboardController::class)->teacherDashboard(),
                    'student' => app(DashboardController::class)->studentDashboard(),
                    'parent' => app(DashboardController::class)->parentDashboard(),
                    'default' => abort(403)
                    };
        })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::resource('subjects', SubjectController::class);
    Route::resource('teachers', TeacherController::class);
    Route::resource('admins', AdminController::class);

    Route::resource('students', StudentController::class);
    Route::post('students/{student}/link-parent', [StudentController::class, 'linkParent'])->name("students.link-parent");
    Route::delete('students/{student}/unlink-parent/{parent}', [StudentController::class, 'unlinkParent'])->name("students.unlink-parent");

    Route::resource('parents', ParentController::class);
    Route::post('parents/{parent}/link-student', [ParentController::class, 'linkStudent'])->name("parents.link-student");
    Route::delete('parents/{parent}/unlink-student/{student}', [ParentController::class, 'unlinkStudent'])->name("parents.unlink-student");

});

require __DIR__.'/auth.php';
