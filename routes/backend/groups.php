<?php
use App\Http\Controllers\GroupController;

Route::middleware('role:Administrator,Tech,Help Desk')->group(function(){
    Route::get('groups', [GroupController::class, 'index'])->name('groups.index');
    Route::get('groups/view/{id}', [GroupController::class, 'showPlayers'])->name('groups.players')->whereNumber('id');
});

Route::middleware('role:Administrator,Tech,Help Desk,Supervisor')->group(function(){
    Route::get('groups/report/{id}', [GroupController::class, 'showTrackingLogs'])->name('groups.tracking-logs')->whereNumber('id');
});