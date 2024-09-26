<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{   

    public function index()
    {
        return Student::all();
    }

    public function store(Request $request)
    {   
        try{
            $validatedData = $request->validate([
                'firstname' => 'required|string|max:255',
                'lastname' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:students',
                'password' => 'required|string|min:8',
                'student_id' => 'required|string|unique:students',
                'mobile_number' => 'required|string',
                'date_of_birth' => 'required|date',
                'year_level' => 'required|integer',
                'sex' => 'required|in:male,female,other',
            ]);
            // Hash the password before saving
            $validatedData['password'] = Hash::make($validatedData['password']);

            // Attempt to create the student
            $student = Student::create($validatedData);
            
            //return the created student
            return response()->json($student,201);
        }catch (\Exception $e){
            //exception message
            \Log::error($e->getMessage());

            //response if creating student failed
            return response()->json('Failed to create student.', 500);
        }
    }

    public function show($id)
    {
        return Student::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $student = Student::findOrFail($id);
        $student->update($request->all());
        return $student;
    }

    public function destroy($id)
    {
        Student::destroy($id);
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

        $student = auth()->user();

        return response()->json(['student' => $student]);
    }
}
