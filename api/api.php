<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Student_Controller;
use App\Http\Controllers\Teacher_Controller;
use App\Http\Controllers\Duty_Controller;
use App\Http\Controllers\Appointment_Controller;
use App\Http\Controllers\History_Controller;

Route::post('student/register', [Student_Controller::class, 'register']);
Route::post('student/login', [Student_Controller::class, 'login']);

Route::post('teacher/register', [Teacher_Controller::class, 'register']);
Route::post('teacher/login', [Teacher_Controller::class, 'login']);

Route::post('duty/create', [Duty_Controller::class, 'createDuty']);
Route::get('duties', [Duty_Controller::class, 'getDuties']);

Route::post('appointment/create', [Appointment_Controller::class, 'createAppointment']);
Route::get('appointments', [Appointment_Controller::class, 'getAppointments']);

Route::get('history/{student_id}', [History_Controller::class, 'getHistory']);
Route::post('history/add', [History_Controller::class, 'addHistory']);

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
