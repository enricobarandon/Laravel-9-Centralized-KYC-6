<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notification;
use App\Jobs\ProcessViewedNotif;

class NotificationController extends Controller
{
    public function index()
    {
        $notifications = Notification::with(['black_list','same_user'])->orderBy('id','desc')->get();
        return view('notifications.index', compact('notifications'));
    }

    public function getData()
    {
        $notifications = Notification::select('id','type')->where('is_read',0)->get();
        return json_encode([
            'notificationsCount' => $notifications->count()
        ]);
    }

    public function read(Notification $notif)
    {
        $notif->is_read = 1;
        $notif->save();
        ProcessViewedNotif::dispatch();

        return;
    }
}
