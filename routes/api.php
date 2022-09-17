<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth;
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
/*
|  JWT JSON WEB TOKEN use for authorization users detail 
|  installation
|   composer require tymon/jwt-auth:dev-develop --prefer-source  or 
|    "tymon/jwt-auth": "dev-develop", inside 
composer.json then update composer
 // "tymon/jwt-auth": "dev-develop"
|composer require tymon/jwt-auth:^1.0.2
*/
// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::group(['middleware' => 'cors'], function () {
// });
Route::group(['middleware' => 'api'], function($router) {

Route::post('/profile',[Auth\LoginController::class,'get_user']);
Route::post('/login',[Auth\LoginController::class,'loging']);
Route::get('delete/{delete_id}',[TableController::class,'delete']);
Route::get('table/{user_id}',[App\Http\Controllers\TableController::class,'edittable']);
Route::get('table',[App\Http\Controllers\TableController::class,'fetchtable']);
});
