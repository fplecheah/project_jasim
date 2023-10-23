<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    //
    public function create(Request $request){
        $validation_rules = [
            'username' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:8',
        ];
        $validator = Validator::make($request->all(), $validation_rules );
        if($validator->fails()) {
            return response()->json([
                'message' => 'Please fix the error',
                'validate_err'=> $validator->messages(),
                'status'=>false
            ]);
        }

        
        $user = User::create([
            'name' => $request->username,
            'email' => $request->email,
            'password' => $request->password
        ]);
        
        
        return response()->json([
            'message'=>'User registered successfully',
            'data'=> $user,
            'status'=> true
        ],200);
    }
}
