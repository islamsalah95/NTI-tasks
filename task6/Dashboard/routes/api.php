<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Apis\ProductsController;
use App\Http\Controllers\Apis\Auth\LoginController;
use App\Http\Controllers\Apis\Auth\RegisterController;
use App\Http\Controllers\Apis\Auth\EmailVerificationController;


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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});



Route::prefix('products')->middleware(['auth:sanctum','verified:sanctum'])->controller(ProductsController::class)->group(function(){
    Route::get('/','index');
    Route::get('/create','create');
    Route::get('/{id}/edit/','edit');
    Route::post('/store','store');
    Route::post('/update/{id}','update');
    Route::delete('/delete/{id}','delete');
});


Route::get('locale',function(){
    return __('messages.welcome');
});
