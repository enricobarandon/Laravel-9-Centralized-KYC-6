<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BlackList;
use App\Http\Requests\BlackListRequest;
use App\Models\ActivityLog;

class BlackListController extends Controller
{
    public function index()
    {
        $players = BlackList::all();
        return view('blacklist.index', compact('players'));
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
}
