<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/me', function () {
    return view('me');
});

Auth::routes();

Route::post('/all_categories',[App\Http\Controllers\VTUcontroller::class,'product_categories'])->name("all_categories");
Route::get('/all_service',[App\Http\Controllers\VTUcontroller::class,'allServices'])->name("all_service");
Route::get('/',[App\Http\Controllers\VTUcontroller::class,'index']);
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post('/',[App\Http\Controllers\TextController::class,'text'])->name('texter');