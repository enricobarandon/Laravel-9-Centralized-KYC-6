<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Group;
use DB;

class GroupController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $groups = Group::select('groups.name','group_type','code','is_active','provinces.name as province','provinces.site')
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
}
