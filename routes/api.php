<?php

use App\Http\Controllers\CityController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\OfficeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LangController;
use App\Http\Controllers\OrderController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientProfileController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::middleware(['guest'])->group(function () {

});
Route::middleware('auth:sanctum')->group(function () {
    Route::resource('profile',ClientProfileController::class);

    Route::post('profile/link',[ClientProfileController::class,'updateLink']);
    Route::post('profile/phone',[ClientProfileController::class,'updatePhone']);


    Route::put('phone/show/{client_link}',[ClientProfileController::class,'updateVisiblePhone']);
    Route::put('link/show/{client_phone}',[ClientProfileController::class,'updateVisibleLink']);



    Route::delete('delete/phone/{id}',[ClientProfileController::class,'deletePhone']);
    Route::delete('delete/link/{id}',[ClientProfileController::class,'deleteLink']);
});
Route::post('login',[UserController::class,'login']);
Route::post('registration',[UserController::class,'store']);


//
//Route::middleware("localization")->group(function () {
//
//    Route::resource('user',UserController::class);
//    Route::post('login',[UserController::class,'login']);
//    Route::post('registration',[UserController::class,'store']);
//
//
//
//    Route::resource('cities',CityController::class);
//    Route::resource('lang',LangController::class);
//
//    Route::middleware(['auth:sanctum'])->group(function () {
//        Route::resource('comment',CommentController::class);
//
//        Route::resource('offices',OfficeController::class);
//        Route::post('update/user',[UserController::class,'update']);
//        Route::get('user',[UserController::class,'show']);
//
//        Route::resource('offices',OfficeController::class);
//        Route::resource('order',OrderController::class);
//
//        Route::resource('client_profile',ClientProfileController::class);
//    });
//
//});
