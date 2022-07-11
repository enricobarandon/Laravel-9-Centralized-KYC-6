<?php
use App\Http\Controllers\UserController;

// Route::get('/users/{id}', [UserController::class, 'index'])->whereNumber('id');

Route::middleware('role:Administrator')->group(function(){
    Route::resource('users',UserController::class);
    Route::post('users/is_active/{user}', [UserController::class, 'toggleIsActive'])->name('users.toggleIsActive');
});