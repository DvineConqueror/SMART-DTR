<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class TeacherController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'lastname' => 'required|string|max:255',
            'firstname' => 'required|string|max:255',
            'school_email' => 'required|string|email|max:255|unique:teachers',
            'password' => 'required|string|min:8|confirmed',
            'employee_id' => 'required|string|unique:teachers',
            'mobile_number' => 'required|string|max:15',
        ]);

        $teacher = Teacher::create([
            'lastname' => $request->lastname,
            'firstname' => $request->firstname,
            'school_email' => $request->school_email,
            'password' => Hash::make($request->password),
            'employee_id' => $request->employee_id,
            'mobile_number' => $request->mobile_number,
        ]);

        return response()->json($teacher, 201);
    }

    public function login(Request $request)
    {
        $request->validate([
            'school_email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        $teacher = Teacher::where('school_email', $request->school_email)->first();

        if (!$teacher || !Hash::check($request->password, $teacher->password)) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        return response()->json(['message' => 'Login successful']);
    }
}