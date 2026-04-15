<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StudentDashboardController;
use App\Http\Controllers\SuperadminDashboardController;
use App\Http\Controllers\PublicDepartmentController;
use App\Http\Controllers\PublicProgramController;
use App\Http\Controllers\PublicFacultyController;
use App\Http\Controllers\PublicResearchController;
use App\Http\Controllers\PublicNewsEventController;
use App\Http\Controllers\PublicAboutController;
use App\Http\Controllers\PublicCurriculumController;
use App\Http\Controllers\OAuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageContentController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

// Public Routes (accessible without authentication)
Route::get('/departments', [PublicDepartmentController::class, 'index'])->name('view.departments');
Route::get('/departments/{department:slug}', [PublicDepartmentController::class, 'show'])->name('view.departments.show');

// About Section Routes
Route::get('/about/college', [PublicAboutController::class, 'college'])->name('view.about.college');
Route::get('/about/history', [PublicAboutController::class, 'history'])->name('view.about.history');
Route::get('/about/mission', [PublicAboutController::class, 'mission'])->name('view.about.mission');

// Academics Routes
Route::get('/academics/programs', [PublicProgramController::class, 'index'])->name('view.academics.programs');
Route::get('/academics/departments', [PublicDepartmentController::class, 'index'])->name('view.academics.departments');
Route::get('/academics/research', [PublicResearchController::class, 'academy'])->name('view.academics.research');
Route::get('/academics/curriculum', [PublicCurriculumController::class, 'index'])->name('view.academics.curriculum');

// Faculty & Staff Routes
Route::get('/faculty/directory', [PublicFacultyController::class, 'index'])->name('view.faculty.directory');
Route::get('/faculty/departments', [PublicDepartmentController::class, 'index'])->name('view.faculty.departments');
Route::get('/faculty/consultation', [PublicFacultyController::class, 'consultation'])->name('view.faculty.consultation');

// Student Routes
Route::get('/student/rules', [PublicAboutController::class, 'rules'])->name('view.student.rules');
Route::get('/student/downloads', [PublicAboutController::class, 'downloads'])->name('view.student.downloads');
Route::get('/student/portal', function () {
    return redirect('https://portal.uphsl.edu.ph', 301);
})->name('view.student.portal');

// Legacy routes (kept for backward compatibility)
Route::get('/about', [PublicAboutController::class, 'index'])->name('view.about');

// Test route
Route::get('/test-content', function () {
    return view('test-content');
});

// OAuth routes
Route::get('/auth/{provider}/redirect', [OAuthController::class, 'redirect'])->name('oauth.redirect');
Route::get('/auth/{provider}/callback', [OAuthController::class, 'callback'])->name('oauth.callback');

Route::get('/programs', [PublicProgramController::class, 'index'])->name('view.programs');
Route::get('/programs/{program:slug}', [PublicProgramController::class, 'show'])->name('view.programs.show');

Route::get('/faculty', [PublicFacultyController::class, 'index'])->name('view.faculty');
Route::get('/faculty/{faculty}', [PublicFacultyController::class, 'show'])->name('view.faculty.show');



Route::get('/news', [PublicNewsEventController::class, 'index'])->name('view.news');
Route::get('/news/all', [PublicNewsEventController::class, 'index'])->name('view.news.all');
Route::get('/news/{newsEvent:slug}', [PublicNewsEventController::class, 'show'])->name('view.news.show');

// Research Routes
Route::get('/research', [PublicResearchController::class, 'index'])->name('view.research');
Route::get('/research/all', [PublicResearchController::class, 'index'])->name('view.research.all');
Route::get('/research/{researchCenter:slug}', [PublicResearchController::class, 'show'])->name('view.research.show');

// Authenticated routes
Route::middleware('auth')->group(function () {
    // Role-based dashboards
    Route::get('/student/dashboard', StudentDashboardController::class)
        ->middleware('role:student')
        ->name('student.dashboard');

    Route::get('/superadmin/dashboard', SuperadminDashboardController::class)
        ->middleware('role:superadmin')
        ->name('superadmin.dashboard');

    // Redirect /dashboard to appropriate role dashboard
    Route::get('/dashboard', function () {
        $user = auth()->user();

        return match ($user->role) {
            'student' => redirect()->route('student.dashboard'),
            'admin' => redirect('/admin'),
            'superadmin' => redirect('/admin'),
            default => redirect()->route('home'),
        };
    })->name('dashboard');

    // Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Page Content API routes (admin only)
    Route::post('/api/page-content/update', [PageContentController::class, 'update'])->name('page-content.update');
    Route::get('/api/page-content/{pageSlug}/{sectionKey}', [PageContentController::class, 'show'])->name('page-content.show');
});

require __DIR__ . '/auth.php';
