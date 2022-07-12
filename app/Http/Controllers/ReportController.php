<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\GroupStatistics;

class ReportController extends Controller
{
    public function index()
    {
        $verified = User::where('status','verified')->where('user_type_id', 5)->count();
        $pending =  User::where('status','pending')->where('user_type_id', 5)->count();
        $groupsStatistics = GroupStatistics::with('group','group.province')->whereDate('created_at', date('Y-m-d', time()))->get();
        $currentDate = date("M d, Y", time());
        return view('reports.index', compact(
            'verified',
            'pending',
            'groupsStatistics',
            'currentDate'
        ));
    }
}
