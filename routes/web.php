<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;

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

// Patient Management Routes
Route::get('/patients/new', function () {
    return view('patients.new');
})->middleware('auth')->name('patients.new');

Route::get('/patients/search', function () {
    return view('patients.search');
})->middleware('auth')->name('patients.search');

Route::get('/patients/all', function () {
    return view('patients.all');
})->middleware('auth')->name('patients.all');

Route::get('/patients/today', function () {
    return view('patients.today');
})->middleware('auth')->name('patients.today');

Route::get('/patients/list', function () {
    return view('patients.list');
})->middleware('auth')->name('patients.list');

Route::get('/medical-records', function () {
    return view('medical-records');
})->middleware('auth')->name('medical.records');

// Appointment Routes
Route::get('/appointments/book', function () {
    return view('appointments.book');
})->middleware('auth')->name('appointments.book');

Route::get('/appointments/today', function () {
    return view('appointments.today');
})->middleware('auth')->name('appointments.today');

Route::get('/appointments/schedule', function () {
    return view('appointments.schedule');
})->middleware('auth')->name('appointments.schedule');

Route::get('/appointments/queue', function () {
    return view('appointments.queue');
})->middleware('auth')->name('appointments.queue');

// Services Routes
Route::get('/immunizations', function () {
    return view('immunizations.index');
})->middleware('auth')->name('immunizations.index');

Route::get('/prenatal-care', function () {
    return view('prenatal-care');
})->middleware('auth')->name('prenatal.care');

Route::get('/general-checkup', function () {
    return view('general-checkup');
})->middleware('auth')->name('general.checkup');

// Tools Routes
Route::get('/ai-support', function () {
    return view('ai-support');
})->middleware('auth')->name('ai.support');

Route::get('/reports', function () {
    return view('reports');
})->middleware('auth')->name('reports');
