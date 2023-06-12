<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\RegisterController;
use App\Http\Controllers\Api\StatusFillsController;
use App\Http\Controllers\Api\ProfileController;
use App\Http\Controllers\Api\FoodMenuController;


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
    Route::post('client-register', 'clientRegisterEmail');
    Route::post('client-login', 'clientLoginEmail');
    Route::post('client-otp-login', 'clientOtpLogin');
    Route::post('vender-register', 'venderRegisterEmail');
    Route::post('vender-login', 'venderLoginEmail');
    Route::post('vender-otp-login', 'venderOtpLogin');
    Route::post('vender-otp-request', 'venderOtpRequest');
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();

    
});

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/profile-info', [ProfileController::class,'profile'])->name('profile');


    Route::post('/vender-menu-store', [FoodMenuController::class,'store'])->name('vender-menu-store');
    Route::post('/vender-menu-edit', [FoodMenuController::class,'edit'])->name('vender-menu-edit');
    Route::post('/vender-menu-delete', [FoodMenuController::class,'delete'])->name('vender-menu-delete');
    Route::post('/vender-menu-image-upload', [FoodMenuController::class,'imageUpload'])->name('vender-menu-image-upload');
    Route::post('/vender-menu-image-delete', [FoodMenuController::class,'imageDelete'])->name('vender-menu-image-delete');
    Route::post('/vender-menu-set-default-image', [FoodMenuController::class,'imageSetDefault'])->name('vender-menu-set-default-image');
    Route::post('/vender-menu-fetch-all', [FoodMenuController::class,'fetchAllItems'])->name('vender-menu-fetch-all');
    Route::post('/vender-menu-fetch-single', [FoodMenuController::class,'fetchSingleItem'])->name('vender-menu-fetch-single');


    

   // Route::get('/staus-message', [StatusFillsController::class, 'status']);
   // Route::get('/users-role', [StatusFillsController::class, 'userRole']);
});

Route::get('/staus-message', [StatusFillsController::class, 'status']);
Route::get('/users-role', [StatusFillsController::class, 'userRole']);


/*
Route::middleware('auth:sanctum')->group(function () {
  //  Route::post('/logout', LogoutAction::class)->name('auth.logout');

    Route::get('/staus-message', [StatusFillsController::class, 'status']);
    Route::get('/users-role', [StatusFillsController::class, 'userRole']);
});

/*
Route::get('/staus-message', [StatusFillsController::class, 'status']);
Route::get('/users-role', [StatusFillsController::class, 'userRole']);


/*

Route::controller(RegisterController::class)->group(function(){

    Route::post('register', 'register');

    Route::post('login', 'login');

});

*/