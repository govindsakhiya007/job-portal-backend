<?php

use Illuminate\Support\Facades\Route;

// Auth routes
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    // Jobs routes
    Route::get('jobs', [JobController::class, 'index']);
    Route::get('jobs/{id}', [JobController::class, 'show']);
    Route::post('jobs', [JobController::class, 'store'])->middleware('role:employer');
    Route::post('jobs/{id}/apply', [ApplicationController::class, 'applyJob'])->middleware('role:applicant');

    // Applications routes
    Route::get('applications', [ApplicationController::class, 'index'])->middleware('role:employer');
    Route::patch('applications/{id}/status', [ApplicationController::class, 'update'])->middleware('role:employer');;
});
