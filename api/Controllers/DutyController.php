<?php

namespace App\Http\Controllers;

use App\Models\Duty;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class DutyController extends Controller
{

    //GET all duty
    public function index()
    {
        return Duty::all();
    }

    //CREATE a new duty and upload it to the database
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

        //Attempt to create the duty
        $duty = duty::create($validatedData);

        //return the created duty
        return response()->json($duty,201);
        
        }catch (\Exception $e){

            //Exception message
            \Log::error($e->getMessage());

            //response if creating duty failed
            return response()->json('Failed to create duty.', 500);
        }
    }

    //GET upcoming duties
    public function getUpcomingDuties()
    {
        $upcomingDuties = Duty::upcoming()->get();
        return response()->json($upcomingDuties);
    }

    //GET completed duties
    public function getCompletedDuties()
    {
        $completedDuties = Duty::completed()->get();
        return response()->json($completedDuties);
    }

    //UPDATE a duty
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

    //Delete a duty
    public function destroy($id)
    {
        $duty = Duty::findOrFail($id);
        $duty->delete();

        return response()->json(['message' => 'Duty deleted successfully']);
    }
}