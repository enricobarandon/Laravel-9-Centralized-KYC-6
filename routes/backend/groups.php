<?php
use App\Http\Controllers\GroupController;

Route::middleware('role:Administrator,Tech')->group(function(){
    Route::get('groups', [GroupController::class, 'index'])->name('groups.index');
    Route::get('groups/{id}', [GroupController::class, 'showPlayers'])->name('groups.showPlayers');
});