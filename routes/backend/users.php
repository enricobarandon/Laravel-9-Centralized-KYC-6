<?php
use App\Http\Controllers\UserController;

// Route::get('/users/{id}', [UserController::class, 'index'])->whereNumber('id');

Route::middleware('role:Administrator')->group(function(){
    Route::resource('users',UserController::class);
    Route::get('users/update/{id}/info', [UserController::class, 'updateUser'])->name('users.updateInfo');
});
Route::middleware('role:Administrator,Help Desk')->group(function(){
    Route::post('users/is_active/{user}', [UserController::class, 'toggleIsActive'])->name('users.toggleIsActive');
    Route::get('users/update/{id}/password', [UserController::class, 'updateUser'])->name('users.updatePassword');
    Route::post('submitUser', [UserController::class, 'submitUser'])->name('users.updateStatus');

    Route::post('users/is_black_listed/{user}', [UserController::class, 'toggleIsBlackListed'])->name('users.toggleIsBlackListed');
});