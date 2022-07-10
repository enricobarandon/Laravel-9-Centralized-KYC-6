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
use Carbon\Carbon;

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
            'first_name' =>     ['required', 'string', 'max:255'],
            'middle_name' =>    ['required','string', 'max:255'],
            'last_name' =>      ['required', 'string', 'max:255'],
            'username' =>       ['required', 'string', 'max:255', 'unique:users'],
            'password' =>       ['required', 'string', 'min:8', 'confirmed'],
            'contact' =>        ['required', 'digits:11', 'unique:users'],

            'date_of_birth' =>  ['required'],
            'place_of_birth' => ['required'],
            'nationality' =>    ['required'],
            'country' =>        ['required'],
            'id_picture' =>     ['required', 'mimes:jpeg,JPEG,PNG,png,jpg,JPG,gif,svg|max:2048'],
            'selfie_with_id' => ['required', 'mimes:jpeg,JPEG,PNG,png,jpg,JPG,gif,svg|max:2048'],
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
            'is_active' =>      0,
            'status' =>         'pending',
            'contact' =>        $data['contact'],
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
            ]),
            'province' =>           $data['province'],
            'occupation' =>         $data['occupation'],
            'source_of_income' =>   $data['source_of_income'],
            'facebook' =>           $data['facebook'],
            'valid_id_type' =>      $data['valid_id_type'],
            'id_picture' =>         $id_picture,
            'selfie_with_id' =>     $selfie_with_id,
        ]);
        

    }

    public function register(Request $request){
        $this->validator($request->all())->validate();
        $data = $request->all();
        $data['uuid'] = (string) Str::orderedUuid();
        event(new Registered($user = $this->create($data)));
        // $this->guard()->login($user);
        ActivityLog::create([
            'type' => 'create-user',
            'user_id' => 0, // guest middlware
            'assets' => json_encode([
                'action' => 'created a user account',
                'name' => $request->first_name . ' ' . $request->last_name,
                'email' => $request->email,
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
        return view('auth.register');
    }
}
