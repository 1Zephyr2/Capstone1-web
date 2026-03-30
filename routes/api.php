<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\DashboardStatsController;

Route::get('/dashboard/today-stats', [DashboardStatsController::class, 'todayStats']);
Route::get('/visits/today', [DashboardStatsController::class, 'getTodaysVisits']);
