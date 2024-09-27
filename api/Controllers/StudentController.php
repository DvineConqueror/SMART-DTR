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

    // CREATE a new user(student)
    public function store(Request $request)
    {   
        $request->validate([
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

        // Attempt to create the user(student)
        $student = Student::create([
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'student_id' => $request->student_id,
            'mobile_number' => $request->mobile_number,
            'date_of_birth' => $request->date_of_birth,
            'year_level' => $request->year_level,
            'sex' => $request->sex,
        ]);
    
        if($student)
        {
             // Generate a Sanctum token for the student
         $token = $student->createToken('auth_token',  ['*'])->plainTextToken;

         return response()->json([
            'message' => 'Student created successfully',
            'token_type' => 'Bearer',
            'token' => $token,
         ],201);
        }
        else
        {
         return response()->json([
            'message' => 'Failed to create student.',
         ],500);
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
        return Student::findOrFail($id);
    }

    //UPDATE user(student)
    public function update(Request $request, $id)
    {

        $student = Student::findOrFail($id);

        if ($request->has('password')) {
            // Hash the new password
            $request->merge(['password' => Hash::make($request->password)]);
        }

        // Update the student with the new data
        $student->update($request->all());

        return response()->json([
            'message' => 'Student updated successfully',
            'data' => $student,
        ], 200);
    }

    //DELETE user(student)
    public function destroy($id)
    {
        Student::destroy($id);

        return response()->json([
            'message' => 'Student deleted successfully',
        ], 200);
    }

}