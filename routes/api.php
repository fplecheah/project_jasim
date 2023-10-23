<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DemoController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserSettingsController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\TaskController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/new_login',[AuthController::class,'login']);
Route::post('/new_register',[AuthController::class,'register']);
Route::post('new_logout',[AuthController::class,'logout']);
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//testing og task 
//Route::get('task',[TaskController::class,'index']);
Route::apiResource('/tasks',TaskController::class);
Route::get('/demo',[DemoController::class ,'index']);
//Register api's
Route::post('create',[RegisterController::class ,'create']);
//Login api's
Route::post('login',[LoginController::class , 'login']);


//products api's
Route::post('product_create',[ProductsController::class ,'store']);

Route::group(['middleware' => 'auth:sanctum'],function(){
    Route::get('userDetails',[UserController::class,'userDetails']);
    Route::get('/users',[UserController::class ,'index']);
    Route::get('/users/{user}',[UserController::class ,'show']);
    Route::put('/users/{user}',[UserController::class ,'update']);
    Route::post('/users',[UserController::class ,'store']);

    //userSetting api's
Route::post('settingStore',[UserSettingsController::class ,'store']);
Route::post('settingDisplay',[UserSettingsController::class ,'display']);
Route::get('settingDisplay/{id}',[UserSettingsController::class ,'displayGet']);
Route::patch('settingUpdate/{id}',[UserSettingsController::class ,'update']);
Route::put('/settingRemove/{id}',[UserSettingsController::class ,'destroy']);
//update widthdraw
Route::put('/settingStoreWithdraw/{id}',[UserSettingsController::class ,'storeWithdraw']);
Route::post('/settingStoreWithdrawPost',[UserSettingsController::class ,'storeWithdrawPost']); 

//User Profile api's
Route::get('userProfile',[UserProfileController::class , 'fetch']);
Route::patch('updateUserProfile/{id}',[UserProfileController::class , 'update']);

Route::post('logout', [LoginController::class , 'logout']);
});