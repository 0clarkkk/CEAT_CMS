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
use App\Http\Controllers\PublicDownloadController;
use App\Http\Controllers\OAuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageContentController;
use App\Http\Controllers\Student\ConsultationController as StudentConsultationController;
use App\Http\Controllers\Advisor\ConsultationManagementController;
use App\Http\Controllers\Faculty\AdvisorProfileController;
use App\Http\Controllers\Faculty\DashboardController as FacultyDashboardController;
use App\Http\Controllers\Faculty\ProfileController as FacultyProfileController;
use App\Http\Controllers\Faculty\ConsultationController as FacultyConsultationController;
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
Route::get('/downloads', [PublicAboutController::class, 'downloads'])->name('view.student.downloads');
Route::get('/student/portal', function () {
    return redirect('https://portal.uphsl.edu.ph', 301);
})->name('view.student.portal');

// Legacy routes (kept for backward compatibility)
Route::get('/about', [PublicAboutController::class, 'index'])->name('view.about');

// Downloads Routes
Route::get('/downloads', [PublicDownloadController::class, 'index'])->name('view.downloads');
Route::get('/downloads/{downloadCategory:slug}', [PublicDownloadController::class, 'show'])->name('view.downloads.category');
Route::get('/download/{downloadableForm}', [PublicDownloadController::class, 'download'])->name('download.form');

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

    Route::get('/faculty/dashboard', [FacultyDashboardController::class, 'index'])
        ->middleware('role:faculty')
        ->name('faculty.dashboard');

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

    // Student Consultation Routes
    Route::middleware('role:student')->prefix('student')->name('student.')->group(function () {
        Route::get('consultations/dashboard', [StudentConsultationController::class, 'dashboard'])->name('consultations.dashboard');
        Route::get('consultations', [StudentConsultationController::class, 'index'])->name('consultations.index');
        Route::get('consultations/create', [StudentConsultationController::class, 'create'])->name('consultations.create');
        Route::post('consultations', [StudentConsultationController::class, 'store'])->name('consultations.store');
        Route::get('consultations/{consultation}', [StudentConsultationController::class, 'show'])->name('consultations.show');
        Route::post('consultations/{consultation}/cancel', [StudentConsultationController::class, 'cancel'])->name('consultations.cancel');
        Route::get('consultations/status/{status}', [StudentConsultationController::class, 'byStatus'])->name('consultations.by-status');
        Route::get('api/advisor-slots', [StudentConsultationController::class, 'getAdvisorSlots'])->name('api.advisor-slots');
    });

    // Advisor Consultation Management Routes (available to faculty members who are advisors)
    Route::middleware('role:faculty')->prefix('advisor')->name('advisor.')->group(function () {
        Route::get('consultations/dashboard', [ConsultationManagementController::class, 'dashboard'])->name('consultations.dashboard');
        Route::get('consultations', [ConsultationManagementController::class, 'index'])->name('consultations.index');
        Route::get('consultations/{consultation}', [ConsultationManagementController::class, 'show'])->name('consultations.show');
        Route::post('consultations/{consultation}/approve', [ConsultationManagementController::class, 'approve'])->name('consultations.approve');
        Route::get('consultations/{consultation}/reject', [ConsultationManagementController::class, 'rejectForm'])->name('consultations.reject-form');
        Route::post('consultations/{consultation}/reject', [ConsultationManagementController::class, 'reject'])->name('consultations.reject');
        Route::get('consultations/{consultation}/schedule', [ConsultationManagementController::class, 'scheduleForm'])->name('consultations.schedule-form');
        Route::post('consultations/{consultation}/schedule', [ConsultationManagementController::class, 'schedule'])->name('consultations.schedule');
        Route::get('consultations/{consultation}/reschedule', [ConsultationManagementController::class, 'rescheduleForm'])->name('consultations.reschedule-form');
        Route::post('consultations/{consultation}/reschedule', [ConsultationManagementController::class, 'reschedule'])->name('consultations.reschedule');
        Route::post('consultations/{consultation}/complete', [ConsultationManagementController::class, 'complete'])->name('consultations.complete');
        Route::post('consultations/{consultation}/cancel', [ConsultationManagementController::class, 'cancel'])->name('consultations.cancel');

        // Availability Management Routes
        Route::prefix('availability')->name('consultations.availability.')->group(function () {
            Route::get('/', [ConsultationManagementController::class, 'availabilityIndex'])->name('index');
            Route::get('create', [ConsultationManagementController::class, 'createSlotForm'])->name('create');
            Route::post('/', [ConsultationManagementController::class, 'storeSlots'])->name('store');
            Route::get('{slot}/edit', [ConsultationManagementController::class, 'editSlotForm'])->name('edit');
            Route::patch('{slot}', [ConsultationManagementController::class, 'updateSlot'])->name('update');
            Route::delete('{slot}', [ConsultationManagementController::class, 'deleteSlot'])->name('delete');
        });
        Route::get('api/upcoming-slots', [ConsultationManagementController::class, 'getUpcomingSlots'])->name('api.upcoming-slots');
    });

    // Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Faculty Advisor Profile Routes
    Route::middleware('role:faculty')->prefix('faculty')->name('faculty.')->group(function () {
        // Profile Management
        Route::get('profile/edit', [FacultyProfileController::class, 'edit'])->name('profile.edit');
        Route::put('profile', [FacultyProfileController::class, 'update'])->name('profile.update');
        Route::get('profile/preview', [FacultyProfileController::class, 'preview'])->name('profile.preview');
        Route::get('profile/history', [FacultyProfileController::class, 'changeHistory'])->name('profile.history');

        // Advisor Profile Routes
        Route::get('advisor-profile', [AdvisorProfileController::class, 'show'])->name('advisor-profile.show');
        Route::get('advisor-profile/edit', [AdvisorProfileController::class, 'edit'])->name('advisor-profile.edit');
        Route::patch('advisor-profile', [AdvisorProfileController::class, 'update'])->name('advisor-profile.update');
        Route::post('advisor-profile/toggle', [AdvisorProfileController::class, 'toggleStatus'])->name('advisor-profile.toggle');

        // Consultation Management Routes
        Route::prefix('consultations')->name('consultations.')->group(function () {
            Route::get('/', [FacultyConsultationController::class, 'index'])->name('index');
            Route::get('{consultation}', [FacultyConsultationController::class, 'show'])->name('show');
            Route::post('{consultation}/approve', [FacultyConsultationController::class, 'approve'])->name('approve');
            Route::get('{consultation}/reject', [FacultyConsultationController::class, 'rejectForm'])->name('reject-form');
            Route::post('{consultation}/reject', [FacultyConsultationController::class, 'reject'])->name('reject');
            Route::get('{consultation}/schedule', [FacultyConsultationController::class, 'scheduleForm'])->name('schedule-form');
            Route::post('{consultation}/schedule', [FacultyConsultationController::class, 'schedule'])->name('schedule');
            Route::get('{consultation}/reschedule', [FacultyConsultationController::class, 'rescheduleForm'])->name('reschedule-form');
            Route::patch('{consultation}/reschedule', [FacultyConsultationController::class, 'reschedule'])->name('reschedule');
            Route::post('{consultation}/complete', [FacultyConsultationController::class, 'complete'])->name('complete');
            Route::post('{consultation}/cancel', [FacultyConsultationController::class, 'cancel'])->name('cancel');
        });
    });

    // Page Content API routes (admin only)
    Route::post('/api/page-content/update', [PageContentController::class, 'update'])->name('page-content.update');
    Route::get('/api/page-content/{pageSlug}/{sectionKey}', [PageContentController::class, 'show'])->name('page-content.show');
});

// Public faculty profile route (catch-all must come after authenticated routes)
Route::get('/faculty/{faculty}', [PublicFacultyController::class, 'show'])->name('view.faculty.show');

require __DIR__ . '/auth.php';
