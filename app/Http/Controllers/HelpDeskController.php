<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserDetails;
use App\Models\ActivityLog;
use Auth;
use App\Models\GroupStatistics;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\InterviewDetailsRequest;
use DB;

class HelpDeskController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $players = User::select('users.id','first_name','middle_name','last_name','email','user_types.role as role','users.created_at as created_at','is_active','status','username','group_code')
                                ->join('user_types', 'user_types.id','users.user_type_id')
                                ->where('user_type_id', 5)
                                ->where('status', 'verified');

        $keyword = $request->keyword;

        if($keyword){
            $players = $players->where(DB::raw('concat(first_name,last_name,username)'), 'like', '%' . $keyword . '%');
        }

        $code = $request->group_code;

        if($code){
            $players = $players->where('users.group_code', $code);
        }

        $status = $request->player_status;

        if($status != ''){
            $players = $players->where('users.is_active', $status);
        }

        $players = $players->paginate(20);

        return view('helpdesk.index', compact('players','keyword','status','code'));
    }

    public function forApproval(Request $request)
    {
        $players = User::select('users.id','first_name','middle_name','last_name','email','user_types.role as role','users.created_at as created_at','is_active','status','username')
                                ->join('user_types', 'user_types.id','users.user_type_id')
                                ->where('user_type_id', 5)
                                ->where('status', 'pending');
            
        $keyword = $request->keyword;

        if($keyword){
            $players = $players->where(DB::raw('concat(first_name,last_name,username)'), 'like', '%' . $keyword . '%');
        }

        $status = $request->player_status;

        if($status != ''){
            $players = $players->where('users.is_active', $status);
        }

        $players = $players->paginate(20);

        return view('helpdesk.for-approval', compact('players','keyword','status'));
    }

    public function showPlayerDetails(User $user)
    {
        $userDetails = UserDetails::where('user_id', $user->id)->first();

        return view('helpdesk.user-details', compact('user','userDetails'));
    }

    public function changeStatus(User $user)
    {
        $auth = auth()->user();
        
        $changeStatus = User::where('id', $user->id)->update(['users.status' => 'verified']);

        if($changeStatus){

            ActivityLog::create([
                'type' => 'approved-player',
                'user_id' => $auth->id,
                'assets' => json_encode([
                    'action' => 'Approved Player Account',
                    'username' => $user->username
                ])
            ]);

            return back()->with('success','Player account approved');
        }else{
            return back()->with('success','Something went wrong');
        }
    }

    public function saveSnapshot(Request $request){

        $auth = auth()->user();
        // dd($auth->id);

        $saveSnapshot = '';
        
        $validator = Validator::make($request->all(), [
            'snapshot' => ['required', 'mimes:jpeg,JPEG,PNG,png,jpg,JPG,gif,svg', 'max:2048']
        ]);
        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }else{
            $snapshot = 'SS'.$auth->id.time().'.'.$request->snapshot->extension();  
            $saveSnapshot = UserDetails::where('user_id', $request->hdnId)->update(['snapshot' => $snapshot]);
        }

        if($saveSnapshot){
            $request->snapshot->move(public_path('img/snapshot'), $snapshot);
            
            return back()->with('success','Snapshot successfully saved');
        }else{
            return back()->with('error','Something went wrong');
        }
    }

    public function updateInterviewDetails(InterviewDetailsRequest $request, User $user)
    {
        $auth = auth()->user();

        $interviewDetails = [
            "interview_description" => $request['interview_description'],
            "interview_link" => $request['interview_link'],
            "interview_date_time" => date("Y-m-d H:i:s",strtotime($request['interview_date_time']))
        ];
        
        $update = UserDetails::where('user_id', $user->id)->update($interviewDetails);
        if($update){
            return back()->with('success','Interview details successfully updated');
        }else{
            return back()->with('error','Something went wrong');
        }
    }
}
