<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\DutyController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\HistoryController;


//Routes for Students
Route::prefix('students')->group(function () {
    Route::get('/get', [StudentController::class, 'index']);          //GET all user(student)
    Route::post('/', [StudentController::class, 'store']);         //CREATE a new user(student)
    Route::get('{id}', [StudentController::class, 'show']);        //GET a specific user(student)
    Route::put('{id}', [StudentController::class, 'update']);      //UPDATE an existing user(student)
    Route::delete('{id}', [StudentController::class, 'destroy']);  //DELETE a user(student)

    // Login route
    Route::post('/login', [StudentController::class, 'login']);    //user(student) login

    // Sanctum protected routes
    Route::middleware(['auth:sanctum'])->group(function () {
        Route::post('/logout', [StudentController::class, 'logout']);
        Route::get('/student/profile', [StudentController::class, 'profile']);
    });
});

//Routes for Teachers
Route::prefix('teachers')->group(function () {
    Route::get('/', [TeacherController::class, 'index']);          //GET all user(teacher)
    Route::post('/', [TeacherController::class, 'store']);         //CREATE a new user(teacher)
    Route::get('{id}', [TeacherController::class, 'show']);        //GET a specific user(teacher)
    Route::put('{id}', [TeacherController::class, 'update']);      //UPDATE an existing user(teacher)
    Route::delete('{id}', [TeacherController::class, 'destroy']);  // DELETE a user(teacher)

    
    Route::post('/login', [TeacherController::class, 'login']);       //user(teacher) login
    
    // Sanctum protected routes
    Route::middleware(['auth:sanctum'])->group(function () {
        Route::post('/logout', [TeacherController::class, 'logout']);
        Route::get('/teacher/profile', [TeacherController::class, 'profile']);
    });
    
});

//Routes for Duties
Route::prefix('duties')->group(function () {
    Route::post('/', [DutyController::class, 'store']);                         //CREATE new duty
    Route::get('/', [DutyController::class, 'index']);                          //GET all duties
    Route::get('/upcoming', [DutyController::class, 'getUpcomingDuties']);      //GET upcoming duties
    Route::get('/completed', [DutyController::class, 'getCompletedDuties']);    //GET completed duties
    Route::put('/{id}', [DutyController::class, 'update']);                     //UPDATE a duty
    Route::delete('/{id}', [DutyController::class, 'destroy']);                 //DELETE a duty
});

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
