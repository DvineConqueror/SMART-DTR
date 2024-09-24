<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\DutyController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\HistoryController;

// Routes for Students
Route::prefix('students')->group(function () {
    Route::get('/', [StudentController::class, 'index']);          // Get all students
    Route::post('/', [StudentController::class, 'store']);         // Create a new student
    Route::get('{id}', [StudentController::class, 'show']);        // Get a specific student
    Route::put('{id}', [StudentController::class, 'update']);      // Update an existing student
    Route::delete('{id}', [StudentController::class, 'destroy']);  // Delete a student
});

// Routes for Teachers
Route::prefix('teachers')->group(function () {
    Route::get('/', [TeacherController::class, 'index']);          // Get all teachers
    Route::post('/', [TeacherController::class, 'store']);         // Create a new teacher
    Route::get('{id}', [TeacherController::class, 'show']);        // Get a specific teacher
    Route::put('{id}', [TeacherController::class, 'update']);      // Update an existing teacher
    Route::delete('{id}', [TeacherController::class, 'destroy']);  // Delete a teacher
});

// Other routes for Duties, Appointments, and History
Route::prefix('duties')->group(function () {
    Route::get('/', [DutyController::class, 'index']);
    Route::post('/', [DutyController::class, 'store']);
    Route::get('{id}', [DutyController::class, 'show']);
    Route::put('{id}', [DutyController::class, 'update']);
    Route::delete('{id}', [DutyController::class, 'destroy']);
});

Route::prefix('appointments')->group(function () {
    Route::get('/', [AppointmentController::class, 'index']);
    Route::post('/', [AppointmentController::class, 'store']);
    Route::get('{id}', [AppointmentController::class, 'show']);
    Route::put('{id}', [AppointmentController::class, 'update']);
    Route::delete('{id}', [AppointmentController::class, 'destroy']);
});

Route::prefix('history')->group(function () {
    Route::get('/', [HistoryController::class, 'index']);
    Route::post('/', [HistoryController::class, 'store']);
    Route::get('{id}', [HistoryController::class, 'show']);
    Route::delete('{id}', [HistoryController::class, 'destroy']);
});

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
