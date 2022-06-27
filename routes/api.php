<?php

use App\Http\Controllers\CityController;
use App\Http\Controllers\OfficeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LangController;
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
    Route::get('cities',[CityController::class,'index']);
    Route::get('lang',[LangController::class,'index']);

    Route::middleware(['auth:sanctum'])->group(function () {
        Route::resource('offices',OfficeController::class);
        Route::put('rent/office/{id}',[OfficeController::class,'rent']);
    });

});