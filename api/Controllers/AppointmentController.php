<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public function index()
    {
        $appointments = Appointment::with('teacher')->get();
        return response()->json($appointments);
    }

    public function store(Request $request)
    {
        $request->validate([
            'teacher_id' => 'required|exists:teachers,id',
            'date' => 'required|date',
            'time' => 'required|date_format:H:i',
            'subject' => 'required|string|max:255',
            'room' => 'required|string|max:255',
            'students' => 'required|array',
        ]);

        $appointment = Appointment::create($request->all());
        return response()->json($appointment, 201);
    }

    public function show($id)
    {
        $appointment = Appointment::with('teacher')->findOrFail($id);
        return response()->json($appointment);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'teacher_id' => 'sometimes|required|exists:teachers,id',
            'date' => 'sometimes|required|date',
            'time' => 'sometimes|required|date_format:H:i',
            'subject' => 'sometimes|required|string|max:255',
            'room' => 'sometimes|required|string|max:255',
            'students' => 'sometimes|required|array',
        ]);

        $appointment = Appointment::findOrFail($id);
        $appointment->update($request->all());
        return response()->json($appointment);
    }

    public function destroy($id)
    {
        $appointment = Appointment::findOrFail($id);
        $appointment->delete();
        return response()->json(null, 204);
    }
}
