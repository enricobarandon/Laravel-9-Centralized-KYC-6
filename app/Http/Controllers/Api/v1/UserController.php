<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\TrackingLog;
use App\Models\GroupStatistics;
use App\Models\ActivityLog;

class UserController extends Controller
{
    public function show()
    {
        $uuid = request()->qrcode;
        $playerInfo = User::with('user_details')
                        ->where('user_type_id',5)
                        ->where('uuid', $uuid)
                        ->first();
        // $playerInfo = User::with('user_details')->get();
        return $playerInfo;
    }

    public function approve()
    {
        $user = auth()->user();
        $params = request()->params;
        $userId = $params['userId'];
        $uuid = $params['uuid'];

        $updatePlayerGroupCode = User::where('id', $userId)->update(['group_code' => $user->group_code]);
        
        $form = [
            'user_id' =>        $userId,
            'approved_by' =>    $user->id,
            'group_code' =>     $user->group_code,
            'data' =>           json_encode([
                    'uuid' => $uuid
            ])
        ];

        $groupStatModel = new GroupStatistics();
        $incrementGroupStat = $groupStatModel->incrementGroupStat($userId, $user->group_code);
        $insert = TrackingLog::create($form);

        if($insert){
            $playerinfo = User::where('id', $userId)->first();
            ActivityLog::create([
                'type' => 'approved-player-login',
                'user_id' => $user->id,
                'assets' => json_encode([
                    'action' => 'Supervisor approved player login',
                    'username' => $playerinfo->username,
                    'group_code' => $user->group_code
                ])
            ]);
        }

        return $insert;
    }
}
