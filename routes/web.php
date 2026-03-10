<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\Admin\InmateController;
use App\Http\Controllers\Admin\VisitorController as AdminVisitorController;
use App\Http\Controllers\Admin\VisitRequestController as AdminVisitRequestController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Visitor\DashboardController as VisitorDashboard;
use App\Http\Controllers\Visitor\VisitRequestController as VisitorRequestController;
use App\Http\Controllers\Guard\DashboardController as GuardDashboard;
use App\Http\Controllers\Guard\VisitScheduleController;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
*/

Auth::routes();

Route::get('/change-password', [PasswordController::class, 'show'])->name('password.change')->middleware('auth');
Route::put('/change-password', [PasswordController::class, 'update'])->name('password.update')->middleware('auth');
/*
|--------------------------------------------------------------------------
| Default Redirect After Login
|--------------------------------------------------------------------------
*/
Route::get('/', [App\Http\Controllers\WelcomeController::class, 'index'])->name('welcome');

Route::get('/dashboard', function () {
    $user = auth()->user();
    if ($user->role === 'super_admin' || $user->role === 'admin') {
        return redirect()->route('admin.dashboard');
    } elseif ($user->role === 'guard') {
        return redirect()->route('guard.dashboard');
    } else {
        return redirect()->route('visitor.dashboard');
    }
})->middleware('auth')->name('dashboard');

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->name('admin.')->middleware(['auth', 'role:admin,super_admin'])->group(function () {

    // Dashboard
    Route::get('/dashboard', [AdminDashboard::class, 'index'])->name('dashboard');

    // Inmates
    Route::resource('inmates', InmateController::class);

    // Visitors
    Route::get('/visitors', [AdminVisitorController::class, 'index'])->name('visitors.index');
    Route::get('/visitors/{visitor}', [AdminVisitorController::class, 'show'])->name('visitors.show');
    Route::post('/visitors/{visitor}/verify', [AdminVisitorController::class, 'verify'])->name('visitors.verify');
    Route::post('/visitors/{visitor}/blacklist', [AdminVisitorController::class, 'blacklist'])->name('visitors.blacklist');
    Route::post('/visitors/{visitor}/unblacklist', [AdminVisitorController::class, 'unblacklist'])->name('visitors.unblacklist');

    // Visit Requests
    Route::get('/visits', [AdminVisitRequestController::class, 'index'])->name('visits.index');
    Route::get('/visits/{visitRequest}', [AdminVisitRequestController::class, 'show'])->name('visits.show');
    Route::post('/visits/{visitRequest}/approve', [AdminVisitRequestController::class, 'approve'])->name('visits.approve');
    Route::post('/visits/{visitRequest}/reject', [AdminVisitRequestController::class, 'reject'])->name('visits.reject');

    // Reports
    Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
    Route::get('/reports/visit-history', [ReportController::class, 'visitHistory'])->name('reports.visit-history');
    Route::get('/reports/visitors', [ReportController::class, 'visitorReport'])->name('reports.visitors');
    Route::get('/reports/schedules', [ReportController::class, 'scheduleReport'])->name('reports.schedules');

    Route::resource('users', UserController::class);
    Route::post('/users/{user}/toggle-status', [UserController::class, 'toggleStatus'])->name('users.toggle-status');
    Route::post('/users/{user}/reset-password', [UserController::class, 'resetPassword'])->name('users.reset-password');
});

/*
|--------------------------------------------------------------------------
| Visitor Routes
|--------------------------------------------------------------------------
*/
Route::prefix('visitor')->name('visitor.')->middleware(['auth', 'role:visitor'])->group(function () {

    // Dashboard
    Route::get('/dashboard', [VisitorDashboard::class, 'index'])->name('dashboard');

    // Visit Requests
    Route::get('/requests', [VisitorRequestController::class, 'index'])->name('requests.index');
    Route::get('/requests/create', [VisitorRequestController::class, 'create'])->name('requests.create');
    Route::post('/requests', [VisitorRequestController::class, 'store'])->name('requests.store');
    Route::get('/requests/{visitRequest}', [VisitorRequestController::class, 'show'])->name('requests.show');
    Route::post('/requests/{visitRequest}/cancel', [VisitorRequestController::class, 'cancel'])->name('requests.cancel');

    // Profile
    Route::get('/profile', [App\Http\Controllers\Visitor\ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/create', [App\Http\Controllers\Visitor\ProfileController::class, 'create'])->name('profile.create');
    Route::post('/profile', [App\Http\Controllers\Visitor\ProfileController::class, 'store'])->name('profile.store');
    Route::get('/profile/edit', [App\Http\Controllers\Visitor\ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [App\Http\Controllers\Visitor\ProfileController::class, 'update'])->name('profile.update');
});

/*
|--------------------------------------------------------------------------
| Guard Routes
|--------------------------------------------------------------------------
*/
Route::prefix('guard')->name('guard.')->middleware(['auth', 'role:guard'])->group(function () {

    // Dashboard
    Route::get('/dashboard', [GuardDashboard::class, 'index'])->name('dashboard');

    // Schedules
    Route::get('/schedules', [VisitScheduleController::class, 'index'])->name('schedules.index');
    Route::post('/schedules/{visitSchedule}/check-in', [VisitScheduleController::class, 'checkIn'])->name('schedules.check-in');
    Route::post('/schedules/{visitSchedule}/check-out', [VisitScheduleController::class, 'checkOut'])->name('schedules.check-out');
    Route::post('/schedules/{visitSchedule}/no-show', [VisitScheduleController::class, 'noShow'])->name('schedules.no-show');
});
