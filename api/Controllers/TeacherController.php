<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class TeacherController extends Controller
{
    public function index()
    {
        return Teacher::all();
    }

    public function store(Request $request)
    {   
        $validatedData = $request->validate([
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:teachers',
            'password' => 'required|string|min:8',
            'teacher_id' => 'required|string|unique:teachers',
            'mobile_number' => 'required|string',
            'date_of_birth' => 'required|date',
            'sex' => 'required|in:male,female,other',
        ]);
        // Hash the password before saving
        $validatedData['password'] = Hash::make($validatedData['password']);

        // Attempt to create the student
        $teacher = Teacher::create($validatedData);
    }

    public function show($id)
    {
        return Teacher::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $teacher = Teacher::findOrFail($id);
        $teacher->update($request->all());
        return $teacher;
    }

    public function destroy($id)
    {
        Teacher::destroy($id);
        return response()->noContent();
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        if (!auth()->attempt($request->only('email', 'password'))) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $teacher = auth()->user();

        return response()->json(['teacher' => $teacher]);
    }

    // Additional methods for handling teacher-specific actions can be added here
}
