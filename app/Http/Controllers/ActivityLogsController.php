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

    public function index(Request $request)
    {
        $activityLogs = ActivityLog::select('type','assets','activity_logs.created_at','users.username','user_types.role')
                            ->leftjoin('users','users.id','activity_logs.user_id')
                            ->leftjoin('user_types','user_types.id','users.user_type_id')
                            ->orderBy('activity_logs.id','desc');

        $keyword = $request->keyword;

        if($keyword){
            $activityLogs = $activityLogs->where('activity_logs.type', 'like', '%' . $request->keyword . '%')
                                            ->orWhere('activity_logs.assets', 'like', '%' . $request->keyword . '%')
                                            ->orWhere('users.username', 'like', '%' . $request->keyword . '%')
                                            ->orWhere('user_types.role', 'like', '%' . $request->keyword . '%');
        }

        $datepicker = $request->date;
        
        if($datepicker){
            $activityLogs = $activityLogs->whereBetween('activity_logs.created_at', [
                                            date("Y-m-d",strtotime($request->date)) . ' 00:00:00',
                                            date("Y-m-d",strtotime($request->date)) . ' 23:59:59',
                                        ]);
        }
        
        $activityLogs = $activityLogs->paginate(20);

        return view('activitylogs.index', compact('activityLogs','keyword','datepicker'));
    }
}
