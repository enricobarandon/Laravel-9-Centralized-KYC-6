<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Group;
use App\Models\Province;

class ApiDataController extends Controller
{
    public function index()
    {
        return view('api-data.index');
    }

    public function getGroups()
    {
        $environment = env('APP_ENV');
        if ($environment == 'production') {



            // get both api endpoint for site A and B then array_merge the result





        } else {
            $apiURL = 'https://development.wpc2040.live/api/v4/groups';
        }
        
        $postInput = [
            'api_key' => '4e829e510539afcc43365a18acc91ede41fb555e'
        ];
  
        $headers = [
            'X-header' => 'value',
            'Content-Type' => 'application/json',
            'accepts' => 'application/json'
        ];
  
        $response = Http::withHeaders($headers)->get($apiURL, $postInput);
  
        $statusCode = $response->status();

        $responseBody = json_decode($response->getBody(), true);


        // get both api endpoint for site A and B then array_merge the result



        // dd($responseBody);
        if ($responseBody['status'] == 'ok') {

            foreach($responseBody['data'] as $data){

                $provinceInfo = Province::where('name', $data['province'])->first();

                $newGroupArr = [
                    'uuid' => $data['uuid'],
                    'name' => $data['group_name'],
                    'owner' => $data['owner'],
                    'contact' => $data['contact'],
                    'is_active' => $data['is_active'],
                    'province_id' => $provinceInfo->id,
                    'group_type' => $data['type'],
                    'code' => $data['code'],
                    'address' => $data['address'],
                    'guarantor' => $data['guarantor']
                ];

                Group::create($newGroupArr);

            }

            return back()->with(['success' => 'groups api request done']);

        }
    }
}
