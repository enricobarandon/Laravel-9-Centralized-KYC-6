<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BlackList;
use App\Http\Requests\BlackListRequest;
use App\Models\ActivityLog;
use DB;

class BlackListController extends Controller
{
    public function index(Request $request)
    {
        $players = BlackList::select('id','type','bad_first_name','bad_middle_name','bad_last_name','remarks','bad_date_of_birth','created_at');

        $keyword = $request->keyword;
        if($keyword){
            $players = $players->where(DB::raw('concat(bad_first_name,bad_middle_name,bad_last_name)'), 'like', '%' . $keyword . '%');
        }

        $type = $request->type;
        if($type){
            $players = $players->where('type', $type);
        }

        $players = $players->paginate(20);

        return view('blacklist.index', compact('players','keyword','type'));
    }

    public function show(BlackList $player)
    {
        $types = [
            'blacklisted',
            'whitelisted'
        ];
        return view('blacklist.edit', compact('player','types'));
    }

    public function update(BlackListRequest $request, BlackList $player)
    {
        $auth = auth()->user();
        $arr = $request->validated();
        foreach($arr as $i => $v) {
            if ($i != 'type') {
                $arr['bad_' . $i] = $arr[$i];
                unset($arr[$i]);
            }
        }
        $update = $player->update($arr);
        if ($update) {
            ActivityLog::create([
                'type' => 'update-blacklist-info',
                'user_id' => $auth->id,
                'assets' => json_encode(array_merge([
                    'action' =>  'Change black/white lister info'
                ],$arr))
            ]);
        }
        return back()->with('success','Information updated.');
    }

    public function add()
    {
        return view('blacklist.add');
    }

    
    public function store(BlackListRequest $request, BlackList $player)
    {
        $auth = auth()->user();
        $arr = $request->validated();
        foreach($arr as $i => $v) {
            if ($i != 'type') {
                $arr['bad_' . $i] = $arr[$i];
                unset($arr[$i]);
            }
        }
        
        $create = $player->create($arr);
        if ($create) {
            ActivityLog::create([
                'type' => 'create-blacklist-info',
                'user_id' => $auth->id,
                'assets' => json_encode(array_merge([
                    'action' =>  'Create Blacklist Player'
                ],$arr))
            ]);
            return back()->with('success','Information Added to Blacklist.');
        }else{
            return back()->with('error','Something went wrong!');
        }
    }
}
