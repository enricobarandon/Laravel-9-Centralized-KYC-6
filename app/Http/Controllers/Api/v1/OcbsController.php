<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Group;
use App\Models\Province;

class OcbsController extends Controller
{
    

    public function update(Request $request)
    {
        // function for receiving update from kiosk app
        // to update groups
        $uuid = $request->uuid;

        $table = $request->table;

        if ($table == 'groups') {
            // dd($request->except(['table','operation']));
            $update = Group::where('uuid', $uuid)->update($request->except(['table']));

        }

        if ($update) {

            return response(json_encode([
                'status' => 'ok',
                'message' => 'Updated'
            ]), 200);

        } else {

            return response(json_encode([
                'status' => 'error',
                'message' => 'Something went wrong'
            ]), 200);

        }
        
    }
}
