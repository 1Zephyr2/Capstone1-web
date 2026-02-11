<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\VisitController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\GoogleCalendarController;
use App\Http\Controllers\AdminController;

// Redirect root to login
Route::get('/', function () {
    return redirect('/login');
});

// Authentication Routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Password Reset Routes (placeholder for now)
Route::get('/password/reset', function () {
    return view('auth.passwords.email');
})->name('password.request');

// Dashboard (protected route)
Route::get('/dashboard', [\App\Http\Controllers\DashboardController::class, 'index'])->middleware('auth')->name('dashboard');

// Admin Routes
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/users', [AdminController::class, 'users'])->name('users.index');
    Route::get('/users/create', [AdminController::class, 'createUser'])->name('users.create');
    Route::post('/users', [AdminController::class, 'storeUser'])->name('users.store');
    Route::get('/users/{user}/edit', [AdminController::class, 'editUser'])->name('users.edit');
    Route::put('/users/{user}', [AdminController::class, 'updateUser'])->name('users.update');
    Route::delete('/users/{user}', [AdminController::class, 'destroyUser'])->name('users.destroy');
    Route::get('/settings', [AdminController::class, 'settings'])->name('settings');
});

// Protected routes group
Route::middleware('auth')->group(function () {
    
    // Profile Routes
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile/picture', [ProfileController::class, 'deleteProfilePicture'])->name('profile.delete-picture');
    
    // Patient Management Routes
    Route::resource('patients', PatientController::class);
    Route::get('/api/patients/search', [PatientController::class, 'search'])->name('patients.search.api');
    Route::get('/api/patients/{patient}/vital-signs/last', [PatientController::class, 'getLastVitalSigns'])->name('patients.vital-signs.last');
    
    // Visit Management Routes
    Route::resource('visits', VisitController::class);
    Route::get('/visits-today', [VisitController::class, 'index'])->name('visits.today');
    Route::get('/visits/calendar/view', [VisitController::class, 'calendar'])->name('visits.calendar');
    Route::get('/api/visits/by-date', [VisitController::class, 'getVisitsByDate'])->name('visits.by-date');
    
    // Report Routes (Basic access for all authenticated users)
    Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
    
    // Advanced Report Routes (Admin only)
    Route::middleware('admin')->group(function () {
        Route::get('/reports/generate', [ReportController::class, 'generate'])->name('reports.generate');
        Route::get('/reports/overdue-immunizations', [ReportController::class, 'overdueImmunizations'])->name('reports.overdue-immunizations');
        Route::get('/reports/high-risk-prenatal', [ReportController::class, 'highRiskPrenatal'])->name('reports.high-risk-prenatal');
        
        // Data Analytics (Admin only)
        Route::get('/analytics', [\App\Http\Controllers\AnalyticsController::class, 'index'])->name('analytics.index');
        
        // Automation Support (Admin only)
        Route::get('/automation-support', [\App\Http\Controllers\AutomationController::class, 'index'])->name('automation.support');
        
        // Patient Import (Admin only)
        Route::get('/patients/import/form', [PatientController::class, 'showImportForm'])->name('patients.import.form');
        Route::post('/patients/import', [PatientController::class, 'import'])->name('patients.import');
        Route::get('/patients/import/template', [PatientController::class, 'downloadTemplate'])->name('patients.download-template');
    });
    
    // Legacy routes (keeping for compatibility)
    Route::get('/patients/new', function () {
        return redirect()->route('patients.create');
    })->name('patients.new');

    Route::get('/patients/search', function () {
        return redirect()->route('patients.index');
    })->name('patients.search');

    Route::get('/patients/all', function () {
        return redirect()->route('patients.index');
    })->name('patients.all');

    Route::get('/patients/today', [VisitController::class, 'index'])->name('patients.today');

    Route::get('/patients/list', function () {
        return redirect()->route('patients.index');
    })->name('patients.list');

    Route::get('/medical-records', function () {
        return view('medical-records');
    })->middleware('auth')->name('medical.records');

    // Appointment Routes
    Route::resource('appointments', AppointmentController::class);
    Route::get('/appointments/calendar/data', [AppointmentController::class, 'calendar'])->name('appointments.calendar.data');
    Route::get('/appointments-today', [AppointmentController::class, 'today'])->name('appointments.today');
    
    // Legacy appointment routes for backward compatibility
    Route::get('/appointments/book', [AppointmentController::class, 'create'])->name('appointments.book');
    Route::get('/appointments/schedule', function () {
        return view('appointments.schedule');
    })->name('appointments.schedule');
    Route::get('/appointments/queue', function () {
        return view('appointments.queue');
    })->name('appointments.queue');

    // Google Calendar Integration Routes
    Route::get('/google/auth', [GoogleCalendarController::class, 'redirectToGoogle'])->name('google.auth');
    Route::get('/google/callback', [GoogleCalendarController::class, 'handleGoogleCallback'])->name('google.callback');
    Route::post('/google/disconnect', [GoogleCalendarController::class, 'disconnect'])->name('google.disconnect');
    Route::get('/google/status', [GoogleCalendarController::class, 'checkConnection'])->name('google.status');
    Route::post('/google/events', [GoogleCalendarController::class, 'createEvent'])->name('google.events.create');
    Route::put('/google/events/{eventId}', [GoogleCalendarController::class, 'updateEvent'])->name('google.events.update');
    Route::delete('/google/events/{eventId}', [GoogleCalendarController::class, 'deleteEvent'])->name('google.events.delete');

    // Services Routes (placeholder - to be implemented)
    Route::get('/immunizations', function () {
        return view('immunizations.index');
    })->name('immunizations.index');

    Route::get('/prenatal-care', function () {
        return view('prenatal-care');
    })->name('prenatal.care');

    Route::get('/general-checkup', function () {
        return view('general-checkup');
    })->name('general.checkup');

    // Tools Routes
    Route::get('/automation-support', [\App\Http\Controllers\AutomationController::class, 'index'])->name('automation.support');
    Route::get('/analytics', [\App\Http\Controllers\AnalyticsController::class, 'index'])->name('analytics.index');
});

