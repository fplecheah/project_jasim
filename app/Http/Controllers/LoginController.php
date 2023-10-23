<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\User;


class LoginController extends Controller
{
    //Login api
    public function login(Request $request)
    {
        $validation_rules = [
            'email' => 'required|email',
            'password' => 'required|string',
        ];
        $validator = Validator::make($request->all(), $validation_rules );
        if($validator->fails()) {
            return response()->json([
                'message' => 'validation_issue',
                'validate_err'=> $validator->messages(),
            ]);
        }
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $email = $request->input('email');
            $user = User::where('email', $email)->first();
        
                if ($user) {
                    // Update the remember_token field to 'yes'
                    $user->update(['is_loggedin' => 1]);
        
                    $token = $user->createToken('auth_token')->plainTextToken;
        
                    return response()->json(['user' => $user, 'token' => $token], 200);
                } else {
                    // User not found with the provided email
                    return response()->json(['message' => 'User not found'], 404);
                }
            
        }

        // Authentication failed
        return response()->json(['message' => 'Invalid credentials'], 401);
    }

    public function logout(Request $request)
{
    $user = auth()->user();
    $user = User::where('id', $user->id)->first();
    $user->update(['is_loggedin' => 0]);
    $request->user()->currentAccessToken()->delete();
    return response()->json(['message' => 'Successfully logged out'], 200);
}
}
