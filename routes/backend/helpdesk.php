<?php
use App\Http\Controllers\HelpDeskController;

// Route::get('/users/{id}', [UserController::class, 'index'])->whereNumber('id');
Route::middleware('role:Administrator,Help Desk,Tech')->group(function(){
    Route::get('helpdesk', [HelpDeskController::class, 'index'])->name('helpdesk.index');
    Route::get('helpdesk/for-approval', [HelpDeskController::class, 'forApproval'])->name('helpdesk.for-approval');
    Route::get('helpdesk/user/{user}', [HelpDeskController::class, 'showPlayerDetails'])->name('helpdesk.showPlayerDetails')->whereNumber('user');
    Route::post('helpdesk/approve/{user}', [HelpDeskController::class, 'changeStatus'])->name('helpdesk.changeStatus')->whereNumber('user');
    Route::post('helpdesk/snapshot/{user}', [HelpDeskController::class, 'saveSnapshot'])->name('helpdesk.saveSnapshot')->whereNumber('user');
    Route::post('helpdesk/updateInterviewDetails/{user}', [HelpDeskController::class, 'updateInterviewDetails']);
});