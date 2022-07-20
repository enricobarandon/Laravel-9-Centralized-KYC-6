<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Group;
use App\Models\User;
use App\Models\TrackingLog;
use DB;

class GroupController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $groups = Group::select('groups.id','groups.name','group_type','code','is_active','provinces.name as province','provinces.site')
                        ->where('code','!=', '')
                        ->leftjoin('provinces','provinces.id','groups.province_id');

        $status = $request->status;
        if($status != ''){
            $groups = $groups->where('is_active',$status);
        }
        
        $keyword = $request->keyword;
        if($keyword){
            $groups = $groups->where(DB::raw('concat(groups.name,group_type,site,provinces.name)'), 'like', '%' . $keyword . '%');
        }

        $groups = $groups->paginate(50);
        
        return view('groups.index', compact('groups','status','keyword'));
    }

    public function showPlayers(Request $request)
    {
        $id = $request->segment(3);

        $groupCode = Group::select('id','code')->where('id',$id)->first();

        $players = User::where('group_code', $groupCode->code)->where('user_type_id', 5)->paginate(20);
        
        $keyword = $request->keyword;

        if($keyword){
            $players = $players->where(DB::raw('concat(first_name,last_name,username)'), 'like', '%' . $keyword . '%');
        }

        $status = $request->player_status;

        if($status != ''){
            $players = $players->where('users.is_active', $status);
        }

        return view('groups.players', compact('players'));
    }

    public function showTrackingLogs(Request $request)
    {
        $auth = auth()->user();

        $id = $request->segment(3);

        $groupCode = Group::select('id','code','name')->where('id',$id)->first();

        if($auth->user_type_id == 4){
            if($auth->group_code != $groupCode->code){
                return redirect('/home')->with('error','Access Denied');
            }
        }

        $trackingLogs = TrackingLog::select('users.first_name','users.last_name','users.username','tracking_logs.created_at','tracking_logs.group_code','tracking_logs.approved_by')
                                            ->join('users','users.id','tracking_logs.user_id')
                                            ->where('tracking_logs.group_code', $groupCode->code);

        $keyword = $request->keyword;
        if($keyword){
            $trackingLogs = $trackingLogs->where(DB::raw('concat(first_name,last_name,username)'), 'like', '%' . $keyword . '%');
        }

        $filterDate = '';

        $date = $request->date;
        if($date){
            $trackingLogs = $trackingLogs->whereDate('tracking_logs.created_at', date('Y-m-d', strtotime($date)));
            $filterDate = $date;
        }else{
            $trackingLogs = $trackingLogs->whereDate('tracking_logs.created_at', date('Y-m-d', time()));
            $filterDate = date("M d, Y", time());
        }

        $trackingLogs = $trackingLogs->paginate(20);
                                            
        $processedBy = User::select('id','username','first_name','last_name')->where('user_type_id', 4)->get()->pluck('username','id')->toArray();

        return view('groups.tracking-logs', compact('trackingLogs','processedBy','id','filterDate','date','groupCode'));
    }
}
