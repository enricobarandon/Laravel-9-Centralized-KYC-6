<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserDetails;
use App\Models\Province;
use Illuminate\Support\Facades\Validator;
use Auth;

class PlayerController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        if(Auth::user()->status == 'verified'){
            return back()->with('error','Account is already verified');
        }
        $id = $request->segment(2);

        $playerInfo = User::where('id', $id)->first();

        $playerDetails = UserDetails::where('user_id', $id)->first();

        $provinces = Province::select('name')->orderBy('name','ASC')->get();
        $countries = config('compliance.countries');
        $valid_ids = config('compliance.valid_ids');

        return view('players.index', compact(
                    'provinces',
                    'countries',
                    'valid_ids',
                    'playerInfo',
                    'playerDetails'
                ));
    }

    
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'first_name' =>     ['required', 'string', 'max:255'],
            'middle_name' =>    ['required','string', 'max:255'],
            'last_name' =>      ['required', 'string', 'max:255'],
            
            'date_of_birth' =>  ['required','date','before:21 years ago'],
            'place_of_birth' => ['required', 'max:255'],
            'nationality' =>    ['required', 'max:255'],
            'country' =>        ['required', 'max:255'],
            'occupation' =>         ['required', 'max:255'],
            'source_of_income' =>   ['required', 'max:255'],
            'facebook' =>           ['required', 'max:255'],
            'valid_id_type' =>      ['required'],
            'id_picture' =>     ['mimes:jpeg,JPEG,PNG,png,jpg,JPG,gif,svg', 'max:2048'],
            'selfie_with_id' => ['mimes:jpeg,JPEG,PNG,png,jpg,JPG,gif,svg', 'max:2048'],
        ]);
    }

    public function updatePlayer(Request $request)
    {
        $this->validator($request->all())->validate();

        $data = $request->all();
        
        $playerId = Auth::user()->id;

        $updatePlayer = User::where('id',$playerId)->update([
            'first_name' =>     $data['first_name'],
            'middle_name' =>    $data['middle_name'],
            'last_name' =>      $data['last_name'],
            'status' =>         'pending',
        ]);

        
        if($updatePlayer) {

            UserDetails::where('user_id',$playerId)->update([
                'date_of_birth' =>      date("Y-m-d",strtotime($data['date_of_birth'])),
                'place_of_birth' =>     $data['place_of_birth'],
                'nationality' =>        $data['nationality'],
                'country' =>            $data['country'],
                'present_address' =>    json_encode([
                    'house_number' =>   $data['house_number'],
                    'street' =>         $data['street'],
                    'barangay' =>       $data['barangay'],
                    'city' =>           $data['city'],
                    'zipcode' =>        $data['zipcode'],
                    'province' =>       $data['province'],
                ]),
                'permanent_address' =>    json_encode([
                    'house_number' =>   $data['p_house_number'],
                    'street' =>         $data['p_street'],
                    'barangay' =>       $data['p_barangay'],
                    'city' =>           $data['p_city'],
                    'zipcode' =>        $data['p_zipcode'],
                    'province' =>       $data['p_province'],
                ]),
                'occupation' =>         $data['occupation'],
                'source_of_income' =>   $data['source_of_income'],
                'facebook' =>           $data['facebook'],
                'valid_id_type' =>      $data['valid_id_type'],
            ]);

            //if id picture has change
            if (!empty($_FILES['id_picture']['name'])){
                $id_picture = 'ID'.$playerId.time().'.'.$data['id_picture']->extension();  
                //ID picture
                $data['id_picture']->move(public_path('img/id_picture'), $id_picture);

                UserDetails::where('user_id',$playerId)->update(['id_picture' => $id_picture]);
            
            }

            //if selfie with id picture has change
            if (!empty($_FILES['selfie_with_id']['name'])){
                $selfie_with_id = 'SID'.$playerId.time().'.'.$data['selfie_with_id']->extension();  
                //selfie with id picture
                $data['selfie_with_id']->move(public_path('/img/id_picture_selfie'), $selfie_with_id);
                
                UserDetails::where('user_id',$playerId)->update(['selfie_with_id' => $selfie_with_id]);
            }
            
        }

        return back()->with('success','Successfully update player information');
    }
}
