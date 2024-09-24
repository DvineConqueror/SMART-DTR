<?php

namespace App\Http\Controllers;

use App\Models\History;
use Illuminate\Http\Request;

class HistoryController extends Controller
{
    public function index()
    {
        $histories = History::with(['student', 'duty'])->get();
        return response()->json($histories);
    }

    public function store(Request $request)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'duty_id' => 'required|exists:duties,id',
        ]);

        $history = History::create($request->all());
        return response()->json($history, 201);
    }

    public function show($id)
    {
        $history = History::with(['student', 'duty'])->findOrFail($id);
        return response()->json($history);
    }

    public function destroy($id)
    {
        $history = History::findOrFail($id);
        $history->delete();
        return response()->json(null, 204);
    }
}
