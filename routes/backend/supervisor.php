<?php
use App\Http\Controllers\SupervisorController;


Route::middleware('role:Supervisor')->group(function(){
    Route::get('/supervisor', [SupervisorController::class, 'index']);
});