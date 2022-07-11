<?php
use App\Http\Controllers\HelpDeskController;

// Route::get('/users/{id}', [UserController::class, 'index'])->whereNumber('id');
Route::middleware('role:Administrator,Help Desk')->group(function(){
    Route::get('helpdesk', [HelpDeskController::class, 'index'])->name('helpdesk.index');
    Route::get('helpdesk/for-approval', [HelpDeskController::class, 'forApproval'])->name('helpdesk.for-approval');
    Route::get('helpdesk/user/{user}', [HelpDeskController::class, 'showPlayerDetails'])->name('helpdesk.showPlayerDetails')->whereNumber('user');
    Route::post('helpdesk/approve/{user}', [HelpDeskController::class, 'changeStatus'])->name('helpdesk.changeStatus');
});