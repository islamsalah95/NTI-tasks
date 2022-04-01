<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\ProductController;
use App\Http\Controllers\Dashboard\DashboardController;

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

Route::get('/', function () {
    return view('welcome');
});
Route::group(['prefix'=>'dashboard','as'=>'dashboard','middleware'=>'verified:admins'],function(){
    Route::get('/',DashboardController::class);
    Route::prefix('products')->controller(ProductController::class)->name('.products.')->group(function(){
        Route::get('/','index')->name('index');
        Route::get('/create','create')->name('create');
        Route::get('/{id}/edit/','edit')->name('edit');
        Route::post('/store','store')->name('store');
        Route::put('/{id}/update','update')->name('update');
        Route::delete('/destroy/{id}','destroy')->name('destroy');
        Route::patch('/toggle/status/{id}','toggleStatus')->name('toggle.status');
    });
});

Auth::routes(['verify'=>true]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

