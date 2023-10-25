
<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserSettingResource;
use App\Models\UserSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userSettings = UserSetting::all();
        return UserSettingResource::collection($userSettings);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
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
                'message' => 'validation_issue',
                'validate_err'=> $validator->messages(),
            ]);
        }
        
        $userSettings = UserSetting::create($request->all());

        return new UserSettingResource($userSettings);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $userSettings = UserSetting::find($id);
        return new UserSettingResource($userSettings);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validation_rules = [
            'user_id' => 'sometimes|numeric',
            'name' => 'sometimes|string',
            'value' => 'sometimes|string',
        ];
        $validator = Validator::make($request->all(), $validation_rules );
        if($validator->fails()) {
            return response()->json([
                'message' => 'validation_issue',
                'validate_err'=> $validator->messages(),
            ]);
        }
        
        $userSettings = UserSetting::find($id);
        $userSettings->update($request->all());

        return new UserSettingResource($userSettings);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $userSettings = UserSetting::find($id);
        $userSettings->delete();
        return response()->json(['message' => 'successfully the row has been deleted']);
    }
}
