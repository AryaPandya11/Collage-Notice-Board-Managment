<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\NoticeController;

Route::get('/', function () {
    if (\Illuminate\Support\Facades\Auth::check()) {
        $role = \Illuminate\Support\Facades\Auth::user()->role;
        if ($role === 'admin') return redirect()->route('admin.dashboard');
        if ($role === 'faculty') return redirect()->route('faculty.dashboard');
        return redirect()->route('student.dashboard');
    }
    return redirect()->route('login');
});

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::middleware('role:admin')->prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
        Route::resource('categories', CategoryController::class);
        Route::get('/notices', [AdminController::class, 'notices'])->name('notices.index');
        Route::patch('/notices/{notice}/status', [AdminController::class, 'updateStatus'])->name('notices.update_status');
    });

    Route::middleware('role:faculty')->prefix('faculty')->name('faculty.')->group(function () {
        Route::get('/dashboard', [NoticeController::class, 'facultyDashboard'])->name('dashboard');
        Route::resource('notices', NoticeController::class)->except(['show', 'index', 'destroy']);
        Route::delete('/notices/{notice}', [NoticeController::class, 'destroy'])->name('notices.destroy');
    });

    Route::middleware('role:student,faculty,admin')->prefix('student')->name('student.')->group(function () {
        Route::get('/dashboard', [NoticeController::class, 'studentDashboard'])->name('dashboard')->middleware('role:student');
        Route::get('/notices/{notice}', [NoticeController::class, 'show'])->name('notices.show');
        Route::get('/attachments/{attachment}/download', [NoticeController::class, 'downloadAttachment'])->name('notices.download');
    });
});
