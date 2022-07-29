<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Auth;
use App\Models\ActivityLog;
use App\Models\UserType;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Str;
use App\Models\UserDetails;
use App\Models\Province;
use Carbon\Carbon;
use App\Models\BlackList;
use App\Events\BlackListDetected;
use DB;
use App\Jobs\ProcessBlackListDetected;
use App\Events\DuplicateDetected;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'first_name' =>                 ['required', 'string', 'max:255', 'regex:/^[a-z\d\-_\s]+$/i'],
            'middle_name' =>                ['required','string', 'max:255', 'regex:/^[a-z\d\-_\s]+$/i'],
            'last_name' =>                  ['required', 'string', 'max:255', 'regex:/^[a-z\d\-_\s]+$/i'],
            'username' =>                   ['required', 'string', 'max:255', 'regex:/^[a-z\d\-_\s]+$/i', 'unique:users'],
            'password' =>                   ['required', 'string', 'min:8', 'confirmed'],
            'contact' =>                    ['required', 'digits:11', 'unique:users'],
            'group_code' =>                 ['nullable', 'max:10'],

            'date_of_birth' =>              ['required','date','before:21 years ago'],
            'place_of_birth' =>             ['required', 'max:255'],
            'nationality' =>                ['required', 'max:255'],
            'country' =>                    ['required', 'max:255'],
            'occupation' =>                 ['required', 'max:255'],
            'select_source_of_income' =>    ['required', 'max:255'],
            'source_of_income' =>           ['required', 'max:255'],
            'facebook' =>                   ['required', 'max:255'],
            'valid_id_type' =>              ['required', 'numeric'],
            'id_picture' =>                 ['required', 'mimes:jpeg,JPEG,PNG,png,jpg,JPG,gif,svg', 'max:2048'],
            'selfie_with_id' =>             ['required', 'mimes:jpeg,JPEG,PNG,png,jpg,JPG,gif,svg', 'max:2048'],
            'video_app' =>                  ['required', 'max:255'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $userId = User::insertGetId([
            'uuid' =>           $data['uuid'],
            'first_name' =>     $data['first_name'],
            'middle_name' =>    $data['middle_name'],
            'last_name' =>      $data['last_name'],
            'username' =>       $data['username'],
            'password' =>       Hash::make($data['password']),
            'user_type_id' =>   5, // player
            'is_active' =>      1,
            'status' =>         'pending',
            'contact' =>        $data['contact'],
            'group_code' =>     $data['group_code'],
            'created_at' =>     Carbon::now(),
            'updated_at' =>     Carbon::now()
        ]);

        $id_picture = 'ID'.$userId.time().'.'.$data['id_picture']->extension();  
        $selfie_with_id = 'SID'.$userId.time().'.'.$data['selfie_with_id']->extension();  
        
        if($userId) {
            //ID picture
            $data['id_picture']->move(public_path('img/id_picture'), $id_picture);
            //selfie with id picture
            $data['selfie_with_id']->move(public_path('/img/id_picture_selfie'), $selfie_with_id);
        }

        return UserDetails::create([
            'user_id' =>            $userId,
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
            'source_of_income' =>   json_encode([
                'select_source_of_income'=> $data['select_source_of_income'],
                'source_of_income'=> $data['source_of_income'],
            ]),
            'facebook' =>           $data['facebook'],
            'valid_id_type' =>      $data['valid_id_type'],
            'id_picture' =>         $id_picture,
            'selfie_with_id' =>     $selfie_with_id,
            'video_app' =>          $data['video_app']
        ]);
        

    }

    public function register(Request $request){
        $this->validator($request->all())->validate();
        $checkName = $this->checkBlackList($request->all());
        if ($checkName) {
            return back()->with('error','Registration Failed. Name is included in the black list.');
        }
        $duplicate = $this->checkDuplicate($request->all());
        if ($duplicate) {
            return back()->with('error','Registration Failed. Name have a existing account with the same name.');
        }

        $data = $request->all();
        $data['uuid'] = (string) Str::orderedUuid();
        event(new Registered($user = $this->create($data)));
        // $this->guard()->login($user);
        ActivityLog::create([
            'type' => 'register-player',
            'user_id' => 0, // guest middlware
            'assets' => json_encode([
                'action' => 'Register player account',
                'name' => $request->first_name . ' ' . $request->last_name,
                'username' => $request->username,
                'role' => 'Player'
            ])
        ]);

        return $this->registered($request, $user)
                            ?: back()->with('success','User successfully created. Waiting for account approval.');

    }

    public function showRegistrationForm() {
        $user = Auth::user();
        // $userType = UserType::get();
        // if ($user->user_type_id != '1') {
        //     return redirect('/users')->withError('Permission denied.');
        // }
        $provinces = Province::select('name')->orderBy('name','ASC')->get();
        $countries = config('compliance.countries');
        $valid_ids = config('compliance.valid_ids');
        $video_apps = config('compliance.video');

        return view('auth.register', compact('provinces','countries','valid_ids','video_apps'));
    }

    public function terms()
    {
        return view('players.terms-condition');
    }
    
    public function policy()
    {
        return view('players.privacy-policy');
    }

    public function checkBlackList($data)
    {
        $full_name = $data['first_name'] . ' ' . $data['middle_name'] . ' ' . $data['last_name'];
        $date_of_birth = $data['date_of_birth'];

        $blacklisted = false;
        // dd($full_name);
        $blackListDetected = BlackList::where(DB::raw("CONCAT(bad_first_name,' ',bad_middle_name,' ',bad_last_name)"), 'like' ,"%$full_name%")->first();
        if ($blackListDetected) {
            // event(new BlackListDetected($blackListDetected->id));
            ProcessBlackListDetected::dispatch($blackListDetected->id);
            $blacklisted = true;
        }

        return $blacklisted;
    }

    public function checkDuplicate($data)
    {
        $full_name = $data['first_name'] . ' ' . $data['middle_name'] . ' ' . $data['last_name'];
        $duplicate = false;
        $findDuplicate = User::where(DB::raw("CONCAT(first_name,' ',middle_name,' ',last_name)"), 'like' ,"%$full_name%")
                            ->where('user_type_id', 5)    
                            ->first();
        if ($findDuplicate) {
            ProcessBlackListDetected::dispatch($findDuplicate->id);
            $duplicate = true;
        }

        return $duplicate;
    }
}
