<?php
use App\Http\Controllers\SupervisorController;

Route::get('/supervisor', [SupervisorController::class, 'index']);