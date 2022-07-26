<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BlackList;
use App\Http\Requests\BlackListRequest;

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
        $arr = $request->validated();
        foreach($arr as $i => $v) {
            if ($i != 'type') {
                $arr['bad_' . $i] = $arr[$i];
                unset($arr[$i]);
            }
        }
        $player->update($arr);
        return back()->with('success','Information updated.');
    }
}
