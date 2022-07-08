<?php
use App\Http\Controllers\HelpDeskController;

// Route::get('/users/{id}', [UserController::class, 'index'])->whereNumber('id');
Route::get('helpdesk', [HelpDeskController::class, 'index'])->name('helpdesk.index');
Route::get('helpdesk/user/{user}', [HelpDeskController::class, 'showPlayerDetails'])->name('helpdesk.showPlayerDetails')->whereNumber('user');