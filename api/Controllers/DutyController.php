<?php

namespace App\Http\Controllers;

use App\Models\Duty;
use Illuminate\Http\Request;

class DutyController extends Controller
{
    public function index()
    {
        $duties = Duty::with('student')->get();
        return response()->json($duties);
    }

    public function store(Request $request)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'date' => 'required|date',
            'time' => 'required|date_format:H:i',
            'subject' => 'required|string|max:255',
            'teacher' => 'required|string|max:255',
            'room' => 'required|string|max:255',
        ]);

        $duty = Duty::create($request->all());
        return response()->json($duty, 201);
    }

    public function show($id)
    {
        $duty = Duty::with('student')->findOrFail($id);
        return response()->json($duty);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'student_id' => 'sometimes|required|exists:students,id',
            'date' => 'sometimes|required|date',
            'time' => 'sometimes|required|date_format:H:i',
            'subject' => 'sometimes|required|string|max:255',
            'teacher' => 'sometimes|required|string|max:255',
            'room' => 'sometimes|required|string|max:255',
        ]);

        $duty = Duty::findOrFail($id);
        $duty->update($request->all());
        return response()->json($duty);
    }

    public function destroy($id)
    {
        $duty = Duty::findOrFail($id);
        $duty->delete();
        return response()->json(null, 204);
    }
}
