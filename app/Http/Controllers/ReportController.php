<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\GroupStatistics;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $verified = User::where('status','verified')->where('user_type_id', 5)->count();
        $pending =  User::where('status','pending')->where('user_type_id', 5)->count();
        $disapproved =  User::where('status','disapproved')->where('user_type_id', 5)->count();
        $totalregistered =  User::where('user_type_id', 5)->count();
        $loggedTotay = GroupStatistics::whereDate('created_at', date('Y-m-d', time()))->sum('total_player_logged_in');
        $groupsStatistics = GroupStatistics::with('group','group.province');

        $groupCode = $request->group;
        if($groupCode){
            $groupsStatistics = $groupsStatistics->where('group_code', 'like', '%' . $groupCode . '%');
        }

        $filterDate = '';

        $date = $request->date;
        if($date){
            $groupsStatistics = $groupsStatistics->whereDate('created_at', date('Y-m-d', strtotime($date)));
            $filterDate = $date;
        }else{
            $groupsStatistics = $groupsStatistics->whereDate('created_at', date('Y-m-d', time()));
            $filterDate = date("M d, Y", time());
        }

        $groupsStatistics = $groupsStatistics->paginate(100);
        
        return view('reports.index', compact(
            'verified',
            'pending',
            'groupsStatistics',
            'filterDate',
            'groupCode',
            'date',
            'loggedTotay',
            'disapproved',
            'totalregistered'
        ));
    }
}
