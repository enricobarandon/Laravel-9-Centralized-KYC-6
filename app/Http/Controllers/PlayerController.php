<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserDetails;
use App\Models\Province;
use App\Models\ActivityLog;
use Illuminate\Support\Facades\Validator;
use Auth;
use Illuminate\Support\Facades\Hash;

class PlayerController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $auth = auth()->user();

        $id = $request->segment(2);

        $playerInfo = User::where('id', $id)->first();

        if($playerInfo->user_type_id != 5){
            return redirect('/home')->with('error','Page Not Found!');
        }

        if($auth->user_type_id == 5){
            if($auth->id != $id){
                return redirect('/home')->with('error','Page Not Found!');
            }

            if($auth->status == 'disapproved' || $auth->site_status == 'returned'){
                //can access
            }else{
                return redirect('/home')->with('error','Access Denied!');
            }
        }

        $playerDetails = UserDetails::where('user_id', $id)->first();

        $provinces = Province::select('name')->orderBy('name','ASC')->get();
        $countries = config('compliance.countries');
        $valid_ids = config('compliance.valid_ids');
        $video_apps = config('compliance.video');

        return view('players.index', compact(
                    'provinces',
                    'countries',
                    'valid_ids',
                    'playerInfo',
                    'playerDetails',
                    'video_apps'
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
            'select_source_of_income' =>   ['required', 'max:255'],
            'source_of_income' =>   ['required', 'max:255'],
            'facebook' =>           ['required', 'max:255'],
            'valid_id_type' =>      ['required'],
            'id_picture' =>     ['mimes:jpeg,JPEG,PNG,png,jpg,JPG,gif,svg', 'max:2048'],
            'selfie_with_id' => ['mimes:jpeg,JPEG,PNG,png,jpg,JPG,gif,svg', 'max:2048'],
            'video_app' =>      ['required'],
        ]);
    }

    public function updatePlayer(Request $request)
    {
        $auth = auth()->user();

        $this->validator($request->all())->validate();

        $data = $request->all();

        $playerId = $request->hdnId;

        $playerInfo = User::where('id', $playerId)->first();

        $siteStatus = '';
        $status = '';

        if($auth->user_type_id == 5){
            if(in_array($playerInfo->site_status, ['rejected','returned'])){
                $siteStatus = 'pending';
                $status = 'pending';
            }else{
                $siteStatus = $playerInfo->site_status;
                $status = 'pending';
            }
        }else{
            $siteStatus = $playerInfo->site_status;
            $status = $playerInfo->status;
        }

        $updatePlayer = User::where('id',$playerId)->update([
            'first_name' =>     $data['first_name'],
            'middle_name' =>    $data['middle_name'],
            'last_name' =>      $data['last_name'],
            'status' =>         $status,
            'site_status' =>    $siteStatus
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
                    'region' =>         $data['region'],
                ]),
                'permanent_address' =>    json_encode([
                    'house_number' =>   $data['p_house_number'],
                    'street' =>         $data['p_street'],
                    'barangay' =>       $data['p_barangay'],
                    'city' =>           $data['p_city'],
                    'zipcode' =>        $data['p_zipcode'],
                    'province' =>       $data['p_province'],
                    'region' =>         $data['p_region'],
                ]),
                'occupation' =>         $data['occupation'],
                'source_of_income' =>   json_encode([
                    'select_source_of_income'=> $data['select_source_of_income'],
                    'source_of_income'=> $data['source_of_income'],
                ]),
                'facebook' =>           $data['facebook'],
                'valid_id_type' =>      $data['valid_id_type'],
                'video_app' =>          $data['video_app'],
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

            ActivityLog::create([
                'type' => 'Update-player-information',
                'user_id' => $auth->id, // guest middlware
                'assets' => json_encode([
                    'action' => 'Update player account information',
                    'name' => $data['first_name'] . ' ' . $data['last_name'] ,
                    'role' => 'Player'
                ])
            ]);

        }

        return redirect('/home')->with('success','Successfully update player information');
    }

    public function updatePassword(Request $request)
    {
        $usersInfo = auth()->user();

        return view('players.update-password', compact('usersInfo'));
    }

    public function submitPassword(Request $request)
    {
        $auth = auth()->user();

        $validator = Validator::make($request->all(), [
            'password' => 'required|min:8',
            'confirm_password' => 'required',
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }else{
            if($request->password == $request->confirm_password){

                $newPassword = Hash::make($request->password);

                $updatePassword = User::where('users.id', $auth->id)->update(
                    array(
                        'password' => $newPassword
                    )
                );
                $logs = array(
                    'action' => 'Update password',
                    'username' => $auth->username,
                    'name' => $auth->first_name. ' ' . $auth->last_name
                );
            }else{
                return back()->withErrors('Password and Confirm password not match!');
            }
        }

        if($updatePassword){
            ActivityLog::create([
                'type' => 'update-password',
                'user_id' => $auth->id,
                'assets' => json_encode($logs)
            ]);

            return redirect('/home')->with('success','Password successfully updated.');
        }
    }
}
