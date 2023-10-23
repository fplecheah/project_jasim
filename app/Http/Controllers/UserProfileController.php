<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserSetting;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class UserProfileController extends Controller
{
    //Fetch all details from user setting and users tabe
    public function fetch()
    {
        $users = DB::table('user_settings')
    ->join('users', 'user_settings.user_id', '=', 'users.id')
    ->select('users.name', 'users.email', 'user_settings.gender', 'user_settings.withdrawable') 
    ->where('withdrawable',1)
    ->get();
        return response()->json([
            'message' => 'success',
            'data'=> $users,
        ]);
    }


    public function update(Request $request,$id)
    {   
        $userData = $request->only('username', 'email','password');
        return response()->json([
            'request'=>$request
        ]);

        $validation_rules = [
            'username' => 'sometimes|string|unique:users',
            'email' => 'sometimes|email|unique:users',
            'user_settings' => 'sometimes|array',
            'user_settings.*.id' => 'sometimes|numeric',
            'user_settings.*.name' => 'sometimes|string',
            'user_settings.*.value' => 'sometimes|string',
        ];
        $validator = Validator::make($request->all(), $validation_rules );
        if($validator->fails()) {
            return response()->json([
                'message' => 'validation_issue',
                'validate_err'=> $validator->messages(),
            ]);
        }
        $userData = $request->only('username', 'email','password');
        if($userData){
            $user = User::find($id);
            $user->update($userData);
        }
        foreach($request->user_settings as $item){
            $userSettingId = $item['id'];
            unset($item['id']);
            $userSettings= UserSetting::where(['id'=>$userSettingId,'user_id'=>$id])->first();
            if($userSettings){
                $userSettings->update($item);
            }
        }
        $user = User::where('id',$id)->with('user_settings')->first();
        return response()->json([
            'message' => 'success',
            'data'=> $user,
        ]);
    }

}
