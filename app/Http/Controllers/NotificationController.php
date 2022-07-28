<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notification;

class NotificationController extends Controller
{
    public function index()
    {
        $notifications = Notification::with('black_list')->orderBy('id','desc')->get();
        return view('notifications.index', compact('notifications'));
    }

    public function getData()
    {
        $notifications = Notification::select('id','type')->where('is_read',0)->get();
        return json_encode([
            'notificationsCount' => $notifications->count()
        ]);
    }
}
