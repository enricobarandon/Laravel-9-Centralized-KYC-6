<?php
use App\Http\Controllers\UserController;

// Route::get('/users/{id}', [UserController::class, 'index'])->whereNumber('id');

Route::middleware('role:Administrator')->group(function(){
    Route::resource('users',UserController::class);
    Route::get('users/update/{id}/info', [UserController::class, 'updateUser'])->name('users.update');
    Route::get('users/update/{id}/password', [UserController::class, 'updateUser'])->name('users.update');
    Route::post('submitUser', [UserController::class, 'submitUser'])->name('users.update');
});
Route::middleware('role:Administrator,Help Desk')->group(function(){
    Route::post('users/is_active/{user}', [UserController::class, 'toggleIsActive'])->name('users.toggleIsActive');
});