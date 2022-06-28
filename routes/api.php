<?php

use App\Http\Controllers\CityController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\OfficeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LangController;
use App\Http\Controllers\OrderController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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


Route::middleware("localization")->group(function () {

    Route::resource('user',UserController::class);
    Route::post('login',[UserController::class,'login']);
    Route::post('registration',[UserController::class,'store']);
   


    Route::resource('cities',CityController::class);
    Route::resource('lang',LangController::class);

    Route::middleware(['auth:sanctum'])->group(function () {
        Route::resource('comment',CommentController::class);

        Route::post('update/user',[UserController::class,'update']);
        Route::get('user',[UserController::class,'show']);

        Route::resource('offices',OfficeController::class);
        Route::resource('order',OrderController::class);
    });

});