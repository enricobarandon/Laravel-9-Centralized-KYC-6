<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Group;

class SupervisorController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $auth = auth()->user();

        $group = Group::select('id','code','name')->where('code', $auth->group_code)->first();
        
        return view('supervisor.index', compact('group'));
    }
}
