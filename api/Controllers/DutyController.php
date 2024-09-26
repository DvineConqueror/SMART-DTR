<?php

namespace App\Http\Controllers;

use App\Models\Duty;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class DutyController extends Controller
{
    // Store a new duty/appointment
    public function store(Request $request)
    {
        try{
        $validatedData = $request->validate([
            'teacher_id' => 'required|exists:teachers,id',
            'student_id' => 'nullable|exists:students,id',
            'subject' => 'required|string|max:255',
            'room' => 'required|string|max:255',
            'date' => 'required|date',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'status' => 'required|in:pending,finished,canceled',
        ]);

        // Attempt to create the duty
        $duty = duty::create($validatedData);

        //return the created duty
        return response()->json($duty,201);
        }catch (\Exception $e){
            //exception message
            \Log::error($e->getMessage());

            //response if creating duty failed
            return response()->json('Failed to create duty.', 500);
        }
    }

    // Get upcoming duties/appointments
    public function getUpcomingDuties()
    {
        $upcomingDuties = Duty::upcoming()->get();
        return response()->json($upcomingDuties);
    }

    // Get completed duties/appointments
    public function getCompletedDuties()
    {
        $completedDuties = Duty::completed()->get();
        return response()->json($completedDuties);
    }

    // Update a duty/appointment
    public function update(Request $request, $id)
    {
        $duty = Duty::findOrFail($id);

        $validatedData = $request->validate([
            'teacher_id' => 'required|exists:teachers,id',
            'student_id' => 'nullable|exists:students,id',
            'subject' => 'required|string|max:255',
            'room' => 'required|string|max:255',
            'date' => 'required|date',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'status' => 'required|in:pending,finished,canceled',
        ]);

        $duty->update($validatedData);

        return response()->json(['message' => 'Duty updated successfully']);
    }

    // Delete a duty/appointment
    public function destroy($id)
    {
        $duty = Duty::findOrFail($id);
        $duty->delete();

        return response()->json(['message' => 'Duty deleted successfully']);
    }
}