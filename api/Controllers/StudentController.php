<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\JsonResponse;

class StudentController extends Controller
{   

    //LOGIN
    public function login(Request $request): JsonResponse
    {
         // Validate request input
         $request->validate([
             'email' => 'required|string|email|max:255',
             'password' => 'required|string|min:8',
         ]);

         $student = Student::where('email',$request->email)->first();

         if(!$student || !Hash::check($request->password, $student->password))
         {
            return response()->json([
                'message' => 'The provided credentials are incorrect'
            ],401);
         }
 
         // Generate a Sanctum token for the student
         $token = $student->createToken('auth_token',  ['*'])->plainTextToken;
 
         // Return message with the generated token
         return response()->json([
            'message' => 'Login Successful',
            'token_type' => 'Bearer',
            'token' => $token,
         ],200);
    }

    //LOGOUT
    public function logout(Request $request)
    {
        $student = Student::where('id', $request->user()->id)->first();

        if($student)
        {
            $student->tokens()->delete();

            return response()->json([
                'message' => 'Logged out successfuly',
             ],200);
        }
        else
        {
            return response()->json([
                'message' => 'Not found',
             ],404);
        }
    }

    // CREATE a new user (student)
    public function store(Request $request)
    {
        // Validate common fields except password, email, and student_id
        $request->validate([
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'mobile_number' => 'required|string',
            'date_of_birth' => 'required|date',
            'year_level' => 'required|integer',
            'sex' => 'required|in:male,female,other',
        ]);

        //Checks if the password is above the minimum of 8 char
        if (strlen($request->password) < 8) {
            return response()->json([
                'message' => 'Password must be at least 8 characters long.',
            ], 400);
        }

        //Checks if the email already exists
        if (Student::where('email', $request->email)->exists()) {
            return response()->json([
                'message' => 'Email is already in use. Please use a different email.',
            ], 400);
        }

        //Checks if the student ID already exists
        if (Student::where('student_id', $request->student_id)->exists()) {
            return response()->json([
                'message' => 'Student ID is already in use. Please use a different student ID.',
            ], 400);
        }

        //Attempt to create the student
        $student = Student::create([
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'email' => $request->email,
            'password' => Hash::make($request->password), // Hash the password
            'student_id' => $request->student_id,
            'mobile_number' => $request->mobile_number,
            'date_of_birth' => $request->date_of_birth,
            'year_level' => $request->year_level,
            'sex' => $request->sex,
        ]);

        if ($student) {
            //Generate a Sanctum token for the student
            $token = $student->createToken('auth_token', ['*'])->plainTextToken;

            return response()->json([
                'message' => 'Student created successfully',
                'token_type' => 'Bearer',
                'token' => $token,
            ], 201);
        } else {
            return response()->json([
                'message' => 'Failed to create student.',
            ], 500);
        }
    }


    public function profile(Request $request)
    {
        $student = $request->user();

        if ($student) {
            return response()->json([
                'message' => 'Profile fetched',
                'data' => $student,
            ], 200);
        }
        else
        {
            return response()->json([
                'message' => 'Not authenticated',
             ],401);
        }
    }

    //GET all user(student)
    public function index()
    {
        return Student::all();
    }

    //GET user(student) by their id/GET specific user(student)
    public function show($id)
    {   
        // Find the student by ID
        $student = Student::find($id);

        // Check if the student exists
        if (!$student) {
            return response()->json([
                'message' => 'Student not found.',
            ], 404);
        }

        return Student::findOrFail($id);
    }

    // UPDATE user (student)
    public function update(Request $request, $id)
    {
        // Find the student by ID
        $student = Student::find($id);

        // Check if the student exists
        if (!$student) {
            return response()->json([
                'message' => 'Student not found.',
            ], 404);
        }

        // Check if the request contains a password
        if ($request->has('password')) {
            // Custom validation for password length
            if (strlen($request->password) < 8) {
                return response()->json([
                    'message' => 'Password must be at least 8 characters long.',
                ], 400);
            }

            // Hash the password if valid
            $request->merge(['password' => Hash::make($request->password)]);
        }

        // Attempt to update the student
        if ($student->update($request->all())) {
            return response()->json([
                'message' => 'Student updated successfully',
                'data' => $student,
            ], 200);
        } else {
            return response()->json([
                'message' => 'Failed to update the student.',
            ], 500);
        }
    }

    //DELETE user(student)
    public function destroy($id)
    {   
        // Find the student by ID
        $student = Student::find($id);

        // Check if the student exists
        if (!$student) {
            return response()->json([
                'message' => 'Student not found.',
            ], 404);
        }

        Student::destroy($id);

        return response()->json([
            'message' => 'Student deleted successfully',
        ], 200);
    }

}