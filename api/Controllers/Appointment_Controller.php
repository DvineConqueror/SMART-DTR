<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public function createAppointment(Request $request)
    {
        $request->validate([
            'teacher_id' => 'required|exists:teachers,id',
            'student_id' => 'required|exists:students,id',
            'duty_id' => 'required|exists:duties,id',
            'appointment_date' => 'required|date',
            'appointment_time' => 'required',
        ]);

        $appointment = Appointment::create([
            'teacher_id' => $request->teacher_id,
            'student_id' => $request->student_id,
            'duty_id' => $request->duty_id,
            'appointment_date' => $request->appointment_date,
            'appointment_time' => $request->appointment_time,
        ]);

        return response()->json($appointment, 201);
    }

    public function getAppointments()
    {
        $appointments = Appointment::all();
        return response()->json($appointments);
    }
}