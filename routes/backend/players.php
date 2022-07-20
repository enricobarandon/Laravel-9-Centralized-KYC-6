<?php
use App\Http\Controllers\PlayerController;

Route::middleware('role:Administrator,Player')->group(function(){
    Route::get('player/{id}', [PlayerController::class, 'index'])->name('players.index');
    Route::post('updatePlayer', [PlayerController::class, 'updatePlayer'])->name('players.updatePlayer');
});


Route::middleware('role:Player')->group(function(){
    Route::get('update-password', [PlayerController::class, 'updatePassword'])->name('players.update-password');
    Route::post('submitPassword', [PlayerController::class, 'submitPassword'])->name('players.submitPassword');
});