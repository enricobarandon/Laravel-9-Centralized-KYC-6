<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

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
}
