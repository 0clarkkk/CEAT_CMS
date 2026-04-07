<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StudentDashboardController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\SuperadminDashboardController;
use App\Http\Controllers\PublicDepartmentController;
use App\Http\Controllers\PublicProgramController;
use App\Http\Controllers\PublicFacultyController;
use App\Http\Controllers\PublicResearchCenterController;
use App\Http\Controllers\PublicNewsEventController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

// Public Routes (accessible without authentication)
Route::get('/departments', [PublicDepartmentController::class, 'index'])->name('view.departments');
Route::get('/departments/{department:slug}', [PublicDepartmentController::class, 'show'])->name('view.departments.show');

Route::get('/programs', [PublicProgramController::class, 'index'])->name('view.programs');
Route::get('/programs/{program:slug}', [PublicProgramController::class, 'show'])->name('view.programs.show');

Route::get('/faculty', [PublicFacultyController::class, 'index'])->name('view.faculty');
Route::get('/faculty/{faculty}', [PublicFacultyController::class, 'show'])->name('view.faculty.show');

Route::get('/research', [PublicResearchCenterController::class, 'index'])->name('view.research');
Route::get('/research/{researchCenter:slug}', [PublicResearchCenterController::class, 'show'])->name('view.research.show');

Route::get('/news', [PublicNewsEventController::class, 'index'])->name('view.news');
Route::get('/news/{newsEvent:slug}', [PublicNewsEventController::class, 'show'])->name('view.news.show');

// Authenticated routes
Route::middleware('auth')->group(function () {
    // Role-based dashboards
    Route::get('/student/dashboard', StudentDashboardController::class)
        ->middleware('role:student')
        ->name('student.dashboard');

    Route::get('/admin/dashboard', AdminDashboardController::class)
        ->middleware('role:admin,superadmin')
        ->name('admin.dashboard');

    Route::get('/superadmin/dashboard', SuperadminDashboardController::class)
        ->middleware('role:superadmin')
        ->name('superadmin.dashboard');

    // Redirect /dashboard to appropriate role dashboard
    Route::get('/dashboard', function () {
        $user = auth()->user();

        return match ($user->role) {
            'student' => redirect()->route('student.dashboard'),
            'admin' => redirect()->route('admin.dashboard'),
            'superadmin' => redirect()->route('superadmin.dashboard'),
            default => redirect()->route('home'),
        };
    })->name('dashboard');

    // Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
