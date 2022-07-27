<?php
use App\Http\Controllers\NotificationController;

Route::middleware('role:Administrator,Tech,Help Desk')->group(function(){
    Route::get('notifications', [NotificationController::class, 'index'])->name('notifications.index');
});