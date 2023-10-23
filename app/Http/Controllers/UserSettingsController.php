<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\UserSetting;

class UserSettingsController extends Controller
{
    
    //to insert data inside usersetting table
    public function store(Request $request)
    {
        $validation_rules = [
            'user_id' => 'required|numeric',
            'name' => 'required|string',
            'value' => 'required|string',
        ];
        $validator = Validator::make($request->all(), $validation_rules );
        if($validator->fails()) {
            return response()->json([
                'message' => 'Please fix the error',
                'error'=> $validator->messages(),
            ]);
        }
        $user_settings = UserSetting::create($request->all());
        return response()->json([
            'message' => 'success',
            'data'=> $user_settings
        ]);
    }

    //to get single recore via POST
    public function display(Request $request)
    {
        $user_settings = UserSetting::find($request->id);
        return response()->json([
            'message' => 'success',
            'data'=> $user_settings
        ]);
    }

    //to get single record via GET
    public function displayGet($id)
    {
        $user_settings_get = UserSetting::find($id);
        return response()->json([
            'message' => 'success',
            'data'=> $user_settings_get
        ]);
    }


    public function update(Request $request, $id)
    {
        $validation_rules = [
            'user_id' => 'sometimes|numeric',
            'name' => 'sometimes|string',
            'value' => 'sometimes|string',
        ];
        $validator = Validator::make($request->all(), $validation_rules );
        if($validator->fails()) {
            return response()->json([
                'message' => 'Please fix the issue',
                'validate_err'=> $validator->messages(),
            ]);
        }
        
        $user_settings = UserSetting::find($id);
        $user_settings->update($request->all());
        return response()->json([
            'message' => 'success',
            'data'=> $user_settings
        ]);

        
    }


    public function destroy($id)
    {
        $user_settings = UserSetting::find($id);
        $user_settings->delete();
        return response()->json(['message' => 'Row Deleted successfully']);
    }

    
    public function storeWithdraw(Request $request,$id)
    {
        $validation_rules = [
            'withdrawable' => 'numeric'
        ];
        $validator = Validator::make($request->all(), $validation_rules );
        if($validator->fails()) {
            return response()->json([
                'message' => 'Please fix the issue',
                'validate_err'=> $validator->messages(),
            ]);
        }

        $user_settings = UserSetting::where('user_id', $id)->first();
        $user_settings->update($request->all());
        return response()->json([
            'success' => 'user',
            'user'=> $user_settings
        ]);
    }

    public function storeWithdrawPost(Request $request)
    {
        $validation_rules = [
            'withdrawable' => 'numeric'
        ];
        $validator = Validator::make($request->all(), $validation_rules );
        if($validator->fails()) {
            return response()->json([
                'message' => 'Please fix the issue',
                'validate_err'=> $validator->messages(),
            ]);
        }
        $user = auth()->user();
        $user_id = $user->id;
        $user_settings = UserSetting::where('user_id',$user_id)->first();
        $user_settings->update($request->all()); 
        return response()->json([
            'success' => 'user',
            'user'=> $user_settings
        ]);
    }
}
