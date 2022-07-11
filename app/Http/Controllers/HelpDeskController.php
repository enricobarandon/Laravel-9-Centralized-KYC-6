<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserDetails;

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
                                ->get();
        return view('helpdesk.index', compact('players'));
    }

    public function showPlayerDetails(User $user)
    {
        $userDetails = UserDetails::where('user_id', $user->id)->first();

        return view('helpdesk.user-details', compact('user','userDetails'));
    }
}
