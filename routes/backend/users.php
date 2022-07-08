<?php
use App\Http\Controllers\UserController;

// Route::get('/users/{id}', [UserController::class, 'index'])->whereNumber('id');
Route::resource('users',UserController::class);