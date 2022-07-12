<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ActivityLog;

class ActivityLogsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $activityLogs = ActivityLog::select('type','assets','activity_logs.created_at','users.username','user_types.role')
                            ->leftjoin('users','users.id','activity_logs.user_id')
                            ->leftjoin('user_types','user_types.id','users.user_type_id')
                            ->orderBy('activity_logs.id','desc')
                            ->paginate(20);

        return view('activitylogs.index', compact('activityLogs'));
    }
}
