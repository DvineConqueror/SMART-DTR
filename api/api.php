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


Route::prefix('duties')->group(function () {
    Route::post('/', [DutyController::class, 'store']);                    // Store new duty/appointment
    Route::get('/upcoming', [DutyController::class, 'getUpcomingDuties']);  // Get upcoming duties/appointments
    Route::get('/completed', [DutyController::class, 'getCompletedDuties']); // Get completed duties/appointments
    Route::put('/{id}', [DutyController::class, 'update']);                 // Update a duty/appointment
    Route::delete('/{id}', [DutyController::class, 'destroy']);             // Delete a duty/appointment
});

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
