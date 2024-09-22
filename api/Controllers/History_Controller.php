<?php

namespace App\Http\Controllers;

use App\Models\History;
use Illuminate\Http\Request;

class HistoryController extends Controller
{
    public function getHistory($student_id)
    {
        $history = History::where('student_id', $student_id)->get();
        return response()->json($history);
    }

    public function addHistory(Request $request)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'duty_id' => 'required|exists:duties,id',
            'date_completed' => 'required|date',
        ]);

        $history = History::create([
            'student_id' => $request->student_id,
            'duty_id' => $request->duty_id,
            'date_completed' => $request->date_completed,
        ]);

        return response()->json($history, 201);
    }
}