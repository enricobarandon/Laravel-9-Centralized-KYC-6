<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserDetails;
use App\Models\ActivityLog;
use Auth;
use App\Models\GroupStatistics;

class HelpDeskController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $players = User::select('users.id','first_name','middle_name','last_name','email','user_types.role as role','users.created_at as created_at','is_active','status','username')
                                ->join('user_types', 'user_types.id','users.user_type_id')
                                ->where('user_type_id', 5)
                                ->where('status', 'verified')
                                ->get();
        return view('helpdesk.index', compact('players'));
    }

    public function forApproval()
    {
        $players = User::select('users.id','first_name','middle_name','last_name','email','user_types.role as role','users.created_at as created_at','is_active','status','username')
                                ->join('user_types', 'user_types.id','users.user_type_id')
                                ->where('user_type_id', 5)
                                ->where('status', 'pending')
                                ->get();
        return view('helpdesk.for-approval', compact('players'));
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
}
