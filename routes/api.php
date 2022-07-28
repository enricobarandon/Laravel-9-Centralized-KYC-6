<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\v1\UserController;
use App\Http\Controllers\NotificationController;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::middleware(['auth:sanctum'])->group(function(){
    Route::get('/users',[UserController::class, 'show']);
    Route::post('users/approve', [UserController::class, 'approve']);
    
    Route::get('notifications', [NotificationController::class, 'getData']);
});


Route::put('/ocbs', [\App\Http\Controllers\Api\v1\OcbsController::class, 'update'])->name('ocbs.update');