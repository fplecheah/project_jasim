<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\PersonalAccessToken;

class UserController extends Controller
{
    //To get all the users
    public function index(){
        
        if (Auth::check()) {
            $users = DB::table('users')->get();

        return response()->json([
            'message'=>count($users).'users found',
            'data'=>$users,
            'status'=>true
        ],200);
        }
        return Response(['data' => 'Unauthorized'],401);
        
    } 

    //to get the single users data
    public function show($id){
        $user = User::find($id);
        if($user != null){
            return response()->json([
                'message'=>'Record Found',
                'data'=>$user,
                'status'=>true
            ],200);
        }else{
            return response()->json([
                'message'=>'Record not Found',
                'data'=>[],
                'status'=>false
            ],200);
        }
    }

    //to insert data inside db
    public function store(Request $request){
        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'email'=> 'required|email',
            'password'=> 'required'
        ]);

        if($validator->fails()){
            return response()->json([
                'message'=>'Please fix the error',
                'error'=>$validator->errors(),
                'status'=>false
            ],200);
        }

        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();

        return response()->json([
            'message'=>'User added successfully',
            'data'=> $user,
            'status'=> true
        ],200);

    }



    //to update record
    public function update(Request $request,$id){
        $user = User::find($id);

        if($user == null){
            return response()->json([
                'message'=>'User not found',
                'status'=>false
            ],200);
        }

        $validator = Validator::make($request->all(),[
            'name'=>'required',
            'email'=>'required|email'
        ]);

        if($validator->fails()){
            return response()->json([
                'message'=>'Please fix the error',
                'errors'=>$validator->errors(),
                'status'=> false
            ],200);
        }

        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();

        return response()->json([
            'message'=>'user updated successfully',
            'data'=>$user,
            'status'=>true
        ],200);
    }


    public function userDetails()
    {
             /* Current Login User Details */
             $user = auth()->user();
             return response()->json([
                'message'=>'Profile Details of '.$user->name.' ',
                'user_id'=>$user->id,
                'username'=>$user->name,
                'email'=>$user->email,
                'status'=>true
            ],200);

            // $loggedInUsers = User::where('is_loggedin', 1)->get();
            // return response()->json($loggedInUsers);    
    }
}
