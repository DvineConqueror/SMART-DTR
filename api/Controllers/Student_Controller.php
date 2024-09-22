<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'lastname' => 'required|string|max:255',
            'firstname' => 'required|string|max:255',
            'school_email' => 'required|string|email|max:255|unique:students',
            'password' => 'required|string|min:8|confirmed',
            'student_id' => 'required|string|unique:students',
            'mobile_number' => 'required|string|max:15',
            'birthdate' => 'required|date',
            'year_level' => 'required|integer',
            'sex' => 'required|in:male,female',
        ]);

        $student = Student::create([
            'lastname' => $request->lastname,
            'firstname' => $request->firstname,
            'school_email' => $request->school_email,
            'password' => Hash::make($request->password),
            'student_id' => $request->student_id,
            'mobile_number' => $request->mobile_number,
            'birthdate' => $request->birthdate,
            'year_level' => $request->year_level,
            'sex' => $request->sex,
        ]);

        return response()->json($student, 201);
    }

    public function login(Request $request)
    {
        $request->validate([
            'school_email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        $student = Student::where('school_email', $request->school_email)->first();

        if (!$student || !Hash::check($request->password, $student->password)) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        return response()->json(['message' => 'Login successful']);
    }
}