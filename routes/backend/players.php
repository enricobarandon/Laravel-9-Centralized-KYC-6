<?php
use App\Http\Controllers\PlayerController;

Route::middleware('role:Administrator,Player')->group(function(){
    Route::get('player/{id}', [PlayerController::class, 'index'])->name('players.index');
    Route::post('updatePlayer', [PlayerController::class, 'updatePlayer'])->name('players.updatePlayer');
});