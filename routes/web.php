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

// Route::get('/', function () {
//     return view('welcome');
//     // echo DNS2D::getBarcodeHTML('4445645656', 'QRCODE');
// });

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('login.page');

Auth::routes();


Route::middleware(['auth'])->group(function(){
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    
    Route::get('/api-data', [App\Http\Controllers\ApiDataController::class, 'index'])->name('home');
    Route::post('/api-data/groups', [App\Http\Controllers\ApiDataController::class, 'getGroups'])->name('api.getGroups');
});

