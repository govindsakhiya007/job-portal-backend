<?php

use Illuminate\Support\Facades\Route;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/jobs', [JobController::class, 'index']);
    Route::get('/jobs/{id}', [JobController::class, 'show']);
    Route::post('/jobs', [JobController::class, 'store'])->middleware('role:employer');
    Route::post('/jobs/{id}/apply', [ApplicationController::class, 'applyJob'])->middleware('role:applicant');

    Route::get('/applications', [ApplicationController::class, 'index'])->middleware('role:employer');
    Route::patch('/applications/{id}/status', [ApplicationController::class, 'updateStatus'])->middleware('role:employer');;
});
