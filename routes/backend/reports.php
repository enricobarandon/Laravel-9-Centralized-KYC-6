<?php
use App\Http\Controllers\ReportController;

Route::middleware('role:Administrator,Tech,Help Desk')->group(function(){
    Route::get('reports', [ReportController::class, 'index'])->name('reports.index');
});