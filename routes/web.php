<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DemoController;
use App\Models\User;
use App\Http\Controllers\ProductsController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('demo/',[DemoController::class,'test']);
Route::get('/test', function () {
    return response()->json([
        'name' => 'Abigail',
        'state' => 'CA',
    ]);
});


//calling hello view 
Route::get('/hello_page',function(){
    return view('hello'); 
})->name('hello');

//Route::view('welcome','/welcome');

// Route::get('/post/{id}',function($id){
//     return "<h1> Post id is ".$id."</h1>";
// });



// Route::get('/post/{id?}',function($id = null){
//     return "<h1>The id is : ".$id."</h1>";
// });



// Route::get('/post/{id?}/comment/{comment_id?}',function($id = null,$comment_id = null){

//         if($id){
//             return "<h1>Id is".$id." the comment id is ".$comment_id." </h1>";
//         }else{
//             return "<h1>No id found</h1>";
//         }
// });


// Route::get('/post/{id}',function($id){
// return "<h1>The is is".$id." </h1>";
// })->whereNumber('id');

// Route::get('/post/{id}',function($id){
//     return "<h1>The is is".$id." </h1>";
//     })->whereAlpha('id');

// Route::get('/post/{id}',function($id){
//     return "<h1>The is is".$id." </h1>";
//     })->whereAlphaNumeric('id');


// Route::get('/post/{id}',function($id){
//     return "<h1>The is is".$id." </h1>";
//     })->whereIn('id',['jasim','movie','song']);

// Route::get('/post/{id}',function($id){
//     return "<h1>The is is".$id." </h1>";
//     })->where('id','[0-9]+');

Route::get('/post/{id}',function($id){
    return "<h1>The is is".$id." </h1>";
    })->where('id','[a-zA-Z]+');


