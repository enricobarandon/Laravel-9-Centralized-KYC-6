<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\TrackingLog;

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
        
        $form = [
            'user_id' =>        $userId,
            'approved_by' =>    $user->id,
            'group_code' =>     $user->group_code,
            'data' =>           json_encode([
                    'uuid' => $uuid
            ])
        ];

        $insert = TrackingLog::create($form);
        return $insert;
    }
}
