<?php

namespace App\Http\Controllers;

use App\Models\Duty;
use Illuminate\Http\Request;

class DutyController extends Controller
{
    public function createDuty(Request $request)
    {
        $request->validate([
            'subject' => 'required|string',
            'room' => 'required|string',
            'teacher_id' => 'required|exists:teachers,id',
            'date' => 'required|date',
            'time' => 'required',
        ]);

        $duty = Duty::create([
            'subject' => $request->subject,
            'room' => $request->room,
            'teacher_id' => $request->teacher_id,
            'date' => $request->date,
            'time' => $request->time,
            'status' => 'pending',
        ]);

        return response()->json($duty, 201);
    }

    public function getDuties()
    {
        $duties = Duty::all();
        return response()->json($duties);
    }
}