<?php

use App\Http\Controllers\Admin\SubjectController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TeacherController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
        return match(auth()->user()->role) {
                    'admin' => view("admin.dashboard"),
                    'teacher' => view("teacher.dashboard"),
                    'student' => view("student.dashboard"),
                    'parent' => view("parent.dashboard"),
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
});

require __DIR__.'/auth.php';
