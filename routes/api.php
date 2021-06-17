<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AccountController;

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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group(['module' => 'User', 'middleware' => ['api'], 'namespace' => 'App\Http\Controllers'], function() {
    Route::resource('user', 'AccountController');
    Route::get('/user/get/all', [AccountController::class, 'getAll'])->name('get-all');
});

Route::get('/token', function () {
    return csrf_token(); 
});