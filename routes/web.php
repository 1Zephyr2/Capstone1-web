<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\VisitController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ProfileController;

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
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('auth')->name('dashboard');

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
    
    // Import routes
    Route::get('/patients/import/form', [PatientController::class, 'showImportForm'])->name('patients.import.form');
    Route::post('/patients/import', [PatientController::class, 'import'])->name('patients.import');
    Route::get('/patients/import/template', [PatientController::class, 'downloadTemplate'])->name('patients.download-template');
    
    // Visit Management Routes
    Route::resource('visits', VisitController::class);
    Route::get('/visits-today', [VisitController::class, 'index'])->name('visits.today');
    
    // Report Routes
    Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
    Route::get('/reports/generate', [ReportController::class, 'generate'])->name('reports.generate');
    Route::get('/reports/overdue-immunizations', [ReportController::class, 'overdueImmunizations'])->name('reports.overdue-immunizations');
    Route::get('/reports/high-risk-prenatal', [ReportController::class, 'highRiskPrenatal'])->name('reports.high-risk-prenatal');
    
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

    // Appointment Routes (placeholder - to be implemented)
    Route::get('/appointments/book', function () {
        return view('appointments.book');
    })->name('appointments.book');

    Route::get('/appointments/today', function () {
        return view('appointments.today');
    })->name('appointments.today');

    Route::get('/appointments/schedule', function () {
        return view('appointments.schedule');
    })->name('appointments.schedule');

    Route::get('/appointments/queue', function () {
        return view('appointments.queue');
    })->name('appointments.queue');

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
    Route::get('/ai-support', function () {
        return view('ai-support');
    })->name('ai.support');
});

