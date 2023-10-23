<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Collection;

class DemoController extends Controller
{
    //
    public function index(){
        $array = [
            [
                'name'=>'jasim',
                'email'=>'jasim@gmail.com'
            ],
            [
                'name'=>'ahmed',
                'email'=>'ahmed@gmail.com'
            ]
        ];

        return response()->json([
            'message'=>'2 users found',
            'data'=> $array,
            'status'=>true 
        ],200);
    }


    public function test(Request $request){
        dd($request->name);
    }
}
