<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\RegisterController;
use App\Http\Controllers\Api\StatusFillsController;

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

Route::controller(RegisterController::class)->group(function(){
    Route::post('client/register', 'clientRegister');
    Route::post('client/login', 'clientLogin');
    Route::post('vender/register', 'venderRegister');
    Route::post('vender/login', 'venderLogin');
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
   // return $request->user();
    return $request->user();
    
});


Route::middleware('auth:sanctum')->group(function () {
  //  Route::post('/logout', LogoutAction::class)->name('auth.logout');

    Route::get('/staus-message', [StatusFillsController::class, 'status']);
    Route::get('/users-role', [StatusFillsController::class, 'userRole']);
});


Route::get('/staus-message', [StatusFillsController::class, 'status']);
Route::get('/users-role', [StatusFillsController::class, 'userRole']);


/*

Route::controller(RegisterController::class)->group(function(){

    Route::post('register', 'register');

    Route::post('login', 'login');

});

*/