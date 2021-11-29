<?php

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

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::post('/register', [\App\Http\Controllers\UserController::class, 'register']);
Route::post('/login', [\App\Http\Controllers\UserController::class, 'login']);

Route::middleware(['bearer', 'isAdmin'])->group(function () {
    Route::post('/addNewAudience', [\App\Http\Controllers\AudienceController::class, 'addNewAudience']);
    Route::post('/deleteAudience', [\App\Http\Controllers\AudienceController::class, 'deleteAudience']);
    Route::post('/addNewGroup', [\App\Http\Controllers\GroupController::class, 'addNewGroup']);
    Route::post('/deleteGroup', [\App\Http\Controllers\GroupController::class, 'deleteGroup']);
});
