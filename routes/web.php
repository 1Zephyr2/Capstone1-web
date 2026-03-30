<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\CustomerRegisterController;
use App\Http\Controllers\PetController;
use App\Http\Controllers\VisitController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\GoogleCalendarController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CustomerDashboardController;
use App\Models\Patient;

// Homepage - Shows login options
Route::get('/', function () {
    return view('welcome');
})->name('home');

// Public Pages
Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/services', function () {
    return view('services');
})->name('services');

// Authentication Routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Customer Registration Routes
Route::get('/register', [CustomerRegisterController::class, 'show'])->name('customer.register.show');
Route::post('/register', [CustomerRegisterController::class, 'store'])->name('customer.register.store');

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

// Customer Routes
Route::middleware(['auth', 'customer'])->prefix('customer')->name('customer.')->group(function () {
    Route::get('/dashboard', [CustomerDashboardController::class, 'dashboard'])->name('dashboard');
    Route::get('/pets', [CustomerDashboardController::class, 'pets'])->name('pets.index');
    Route::get('/pets/create', [PetController::class, 'create'])->name('pets.create');
    Route::post('/pets', [PetController::class, 'store'])->name('pets.store');
    Route::get('/pets/{patient}', [CustomerDashboardController::class, 'showPet'])->name('pets.show');
    Route::get('/pets/{patient}/edit', [PetController::class, 'edit'])->name('pets.edit');
    Route::match(['put', 'patch'], '/pets/{patient}', [PetController::class, 'update'])->name('pets.update');
    Route::get('/appointments', [CustomerDashboardController::class, 'appointments'])->name('appointments.index');
    Route::get('/appointments/{appointment}', [CustomerDashboardController::class, 'showAppointment'])->name('appointments.show');
    
    // Notification Routes
    Route::get('/notifications', [\App\Http\Controllers\NotificationController::class, 'index'])->name('notifications');
    Route::post('/notifications/mark-all-read', [\App\Http\Controllers\NotificationController::class, 'markAllAsRead'])->name('notifications.mark-all-read');
    Route::post('/notifications/{notification}/read', [\App\Http\Controllers\NotificationController::class, 'markAsRead'])->name('notifications.mark-read');
});

// Protected routes group
Route::middleware('auth')->group(function () {
    
    // Profile Routes
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::match(['put', 'post'], '/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile/picture', [ProfileController::class, 'deleteProfilePicture'])->name('profile.delete-picture');
    
    // API Routes
    Route::get('/api/notifications', [\App\Http\Controllers\NotificationController::class, 'getNotifications'])->name('api.notifications');
    
    // Pet Management Routes
    Route::get('/pets/import/form', [PetController::class, 'showImportForm'])->name('pets.import.form');
    Route::post('/pets/import', [PetController::class, 'import'])->name('pets.import');
    Route::get('/pets/import/template', [PetController::class, 'downloadTemplate'])->name('pets.download-template');
    Route::resource('pets', PetController::class)
        ->parameters(['pets' => 'patient'])
        ->names('pets');
    Route::get('/api/pets/search', [PetController::class, 'search'])->name('pets.search.api');
    Route::get('/api/species/{speciesId}', [PetController::class, 'getSpeciesCharacteristics'])->name('api.species.characteristics');

    // Legacy patient routes (kept for compatibility)
    Route::get('/api/patients/search', [PetController::class, 'search'])->name('patients.search.api');
    Route::get('/patients/import/form', function () {
        return redirect()->route('pets.import.form');
    })->name('patients.import.form');
    Route::post('/patients/import', [PetController::class, 'import'])->name('patients.import');
    Route::get('/patients/import/template', [PetController::class, 'downloadTemplate'])->name('patients.download-template');
    Route::get('/patients', function () {
        return redirect()->route('pets.index');
    })->name('patients.index');
    Route::get('/patients/create', function () {
        return redirect()->route('pets.create');
    })->name('patients.create');
    Route::post('/patients', [PetController::class, 'store'])->name('patients.store');
    Route::get('/patients/{patient}', function (Patient $patient) {
        return redirect()->route('pets.show', $patient);
    })->name('patients.show');
    Route::get('/patients/{patient}/edit', function (Patient $patient) {
        return redirect()->route('pets.edit', $patient);
    })->name('patients.edit');
    Route::match(['put', 'patch'], '/patients/{patient}', [PetController::class, 'update'])->name('patients.update');
    Route::delete('/patients/{patient}', [PetController::class, 'destroy'])->name('patients.destroy');
    
    // Visit Management Routes
    Route::resource('visits', VisitController::class);
    Route::get('/visits-today', [VisitController::class, 'index'])->name('visits.today');
    Route::get('/visits/calendar/view', [VisitController::class, 'calendar'])->name('visits.calendar');
    Route::get('/api/visits/by-date', [VisitController::class, 'getVisitsByDate'])->name('visits.by-date');
    Route::get('/api/visits/{visit}/details', [VisitController::class, 'getDetails'])->name('visits.getDetails');
    
    // Report Routes (Basic access for all authenticated users)
    Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
    
    // Advanced Report Routes (Admin only)
    Route::middleware('admin')->group(function () {
        Route::get('/reports/generate', [ReportController::class, 'generate'])->name('reports.generate');
        
        // Insight Center (Admin only)
        Route::get('/analytics', [\App\Http\Controllers\InsightCenterController::class, 'index'])->name('analytics.index');
        
        // Action Hub (Admin only)
        Route::get('/automation-support', [\App\Http\Controllers\ActionHubController::class, 'index'])->name('automation.support');
    });

    // Legacy routes (keeping for compatibility)
    Route::get('/patients/new', function () {
        return redirect()->route('pets.create');
    })->name('patients.new');

    Route::get('/patients/search', function () {
        return redirect()->route('pets.index');
    })->name('patients.search');

    Route::get('/patients/all', function () {
        return redirect()->route('pets.index');
    })->name('patients.all');

    Route::get('/patients/today', [VisitController::class, 'index'])->name('patients.today');

    Route::get('/patients/list', function () {
        return redirect()->route('pets.index');
    })->name('patients.list');

    Route::get('/pet-records', function () {
        return view('pet-records');
    })->name('pet.records');

    Route::get('/medical-records', function () {
        return redirect()->route('pet.records');
    })->name('medical.records');

    // Appointment Routes
    Route::resource('appointments', AppointmentController::class);
    Route::patch('/appointments/{appointment}/quick-update', [AppointmentController::class, 'quickUpdate'])->name('appointments.quick-update');
    Route::get('/appointments/calendar/data', [AppointmentController::class, 'calendar'])->name('appointments.calendar.data');
    Route::get('/appointments-today', [AppointmentController::class, 'today'])->name('appointments.today');
    Route::get('/appointments/conflicts', [AppointmentController::class, 'conflicts'])->name('appointments.conflicts');
    
    // Appointment Request Routes - Customers (must come first before wildcard routes)
    Route::get('/appointment-requests/create', [\App\Http\Controllers\AppointmentRequestController::class, 'create'])->name('appointment-requests.create');
    Route::post('/appointment-requests', [\App\Http\Controllers\AppointmentRequestController::class, 'store'])->name('appointment-requests.store');
    Route::patch('/appointment-requests/{appointmentRequest}/cancel', [\App\Http\Controllers\AppointmentRequestController::class, 'cancel'])->name('appointment-requests.cancel');

    // Appointment Request Routes - Staff/Admin Only
    Route::get('/appointment-requests', [\App\Http\Controllers\AppointmentRequestController::class, 'index'])->name('appointment-requests.index');
    Route::get('/appointment-requests/{appointmentRequest}', [\App\Http\Controllers\AppointmentRequestController::class, 'show'])->name('appointment-requests.show');
    Route::patch('/appointment-requests/{appointmentRequest}/approve', [\App\Http\Controllers\AppointmentRequestController::class, 'approve'])->name('appointment-requests.approve');
    Route::patch('/appointment-requests/{appointmentRequest}/reject', [\App\Http\Controllers\AppointmentRequestController::class, 'reject'])->name('appointment-requests.reject');
    
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



    // Tools Routes
    Route::get('/automation-support', [\App\Http\Controllers\ActionHubController::class, 'index'])->name('automation.support');
    Route::get('/analytics', [\App\Http\Controllers\InsightCenterController::class, 'index'])->name('analytics.index');
});

