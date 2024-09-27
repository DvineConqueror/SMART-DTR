<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\JsonResponse;

class TeacherController extends Controller
{   

    //LOGIN
    public function login(Request $request): JsonResponse
    {
         // Validate request input
         $request->validate([
             'email' => 'required|string|email|max:255',
             'password' => 'required|string|min:8',
         ]);

         $teacher = Teacher::where('email',$request->email)->first();

         if(!$teacher || !Hash::check($request->password, $teacher->password))
         {
            return response()->json([
                'message' => 'The provided credentials are incorrect'
            ],401);
         }
 
         // Generate a Sanctum token for the teacher
         $token = $teacher->createToken('auth_token',  ['*'])->plainTextToken;
 
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
        $teacher = Teacher::where('id', $request->user()->id)->first();

        if($teacher)
        {
            $teacher->tokens()->delete();

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

    // CREATE a new user(teacher)
    public function store(Request $request)
    {   
        $request->validate([
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:teachers',
            'password' => 'required|string|min:8',
            'teacher_id' => 'required|string|unique:teachers',
            'mobile_number' => 'required|string',
            'date_of_birth' => 'required|date',
            'sex' => 'required|in:male,female,other',
        ]);

        //CREATE the user(teacher)
        $teacher = Teacher::create([
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'teacher_id' => $request->teacher_id,
            'mobile_number' => $request->mobile_number,
            'date_of_birth' => $request->date_of_birth,
            'sex' => $request->sex,
        ]);
    
        if($teacher)
        {
             // Generate a Sanctum token for the teacher
         $token = $teacher->createToken('auth_token',  ['*'])->plainTextToken;

         return response()->json([
            'message' => 'Teacher created successfully',
            'token_type' => 'Bearer',
            'token' => $token,
         ],201);
        }
        else
        {
         return response()->json([
            'message' => 'Failed to create teacher.',
         ],500);
        }
    }

    public function profile(Request $request)
    {
        $teacher = $request->user();

        if ($teacher) {
            return response()->json([
                'message' => 'Profile fetched',
                'data' => $teacher,
            ], 200);
        }
        else
        {
            return response()->json([
                'message' => 'Not authenticated',
             ],401);
        }
    }

    //GET all user(teacher)
    public function index()
    {
        return Teacher::all();
    }

    // GET user(teacher) by their id/GET specific user(teacher)
    public function show($id)
    {
        return Teacher::findOrFail($id);
    }

    // UPDATE the user(teacher)
    public function update(Request $request, $id)
    {
        $teacher = Teacher::findOrFail($id);
        if ($request->has('password')) {
            // Hash the new password
            $request->merge(['password' => Hash::make($request->password)]);
        }

        // Update the teacher with the new data
        $teacher->update($request->all());

        return response()->json([
            'message' => 'Teacher updated successfully',
            'data' => $teacher,
        ], 200);
    }

    //DELETE the user(teacher)
    public function destroy($id)
    {
        Teacher::destroy($id);

        return response()->json([
            'message' => 'Teacher deleted successfully',
        ], 200);
    }
}