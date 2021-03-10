<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User;
use App\Http\Controllers\ATGController;
use App\Http\Controllers\TaskController;
use Illuminate\Http\Request;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
use Webpatser\Uuid\Uuid;
Route::group(['middleware'=>['redi']] ,function(){
	Route::get('/',function(){
	    return view('first');
    });
});
Route::group(['middleware'=>['AtgAuth']] ,function(){
	Route::post('todo/add','App\Http\Controllers\TaskController@store');
    Route::post('todo/status','App\Http\Controllers\TaskController@update');
});
Route::post('user/dashboard','App\Http\Controllers\ATGController@store');
Route::get('logout', function () {
    if(session()->has('LoggedUser')){
    	session()->forget('LoggedUser');
    	//session()->validate();
    	return redirect('/');
    }
})->name('logout');
Route::group(['middleware'=>['AuthCheck']] ,function(){
	Route::get('dash',function(){
	    return view('success');
    });
});
Route::get('token',function(){
	   print_r(Uuid::generate()->string);
});