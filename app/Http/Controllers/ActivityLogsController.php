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
        $actions = [
            'approved-player' => 'Approved Player',
            'approved-player-login' => 'Approved Player Login',
            'attempt-login' => 'Attempt Login Deactivated Account',
            'change-user-blacklist-status' => 'Change User Blacklist Status',
            'change-user-status' => 'Change User Status',
            'create-user' => 'Create User Account',
            'disapprove-player' => 'Disapprove Player',
            'login' => 'User Login',
            'pending-player' => 'Pending Player',
            'register-player' => 'Register Player',
            'returned-player' => 'Returned Player',
            'review-account' => 'Review Players Account',
            'reviewed-player' => 'Reviewed Player',
            'sms-failed' => 'SMS Failed',
            'update-blacklist-info' => 'Change black/white lister info',
            'update-snapshot' => 'Update Snapshot of Player',
            'update-interview-details' => 'Update Interview Details',
            'Update-player-information' => 'Update Player Account Information',
            'update-password' => 'Update Password',
            'update-user' => 'Update User',
        ];

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

        $action = $request->action;

        if($action){
            $activityLogs = ActivityLog::where('type',$action);
        }

        $datepicker = $request->date;

        if($datepicker){
            $activityLogs = $activityLogs->whereBetween('activity_logs.created_at', [
                                            date("Y-m-d",strtotime($request->date)) . ' 00:00:00',
                                            date("Y-m-d",strtotime($request->date)) . ' 23:59:59',
                                        ]);
        }

        $activityLogs = $activityLogs->paginate(20);

        return view('activitylogs.index', compact('activityLogs','keyword','datepicker','actions','action'));
    }
}
