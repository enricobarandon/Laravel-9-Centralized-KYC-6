<?php
use App\Http\Controllers\BlackListController;

Route::middleware('role:Administrator,Help Desk')->group(function(){
    Route::get('blacklist', [BlackListController::class, 'index'])->name('blacklist.index');
    Route::get('blacklist/edit/{player}', [BlackListController::class, 'show'])->name('blacklist.show');
    Route::put('blacklist/update/{player}', [BlackListController::class, 'update'])->name('blacklist.update');
});