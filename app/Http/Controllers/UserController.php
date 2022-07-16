<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserType;
use App\Http\Requests\UserRequests;
use App\Models\ActivityLog;
use Auth;
use App\Models\Group;
use Illuminate\Support\Facades\Hash;
use DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $users = User::select('users.id','first_name','middle_name','last_name','email','users.created_at as created_at','is_active','status','username','user_type_id','group_code')
                                ->whereIn('user_type_id', [1,2,3,4]);
                                
        $keyword = $request->keyword;

        if($request->keyword){
            $users = $users->where(DB::raw('concat(first_name,last_name,username,group_code)'), 'like', '%' . $request->keyword . '%');
        }
        
        $userType = $request->userType;

        if($request->userType){
            $users = $users->where('users.user_type_id', $request->userType);
        }

        $userStatus = $request->userStatus;

        if($request->userStatus != ''){
            $users = $users->where('users.is_active', $request->userStatus);
        }

        $users = $users->paginate(20);

        $userTypes = UserType::select('id','role')->get()->pluck('role','id')->toArray();

        $displayRole = UserType::get();

        return view('users.index', compact('users','userTypes','userType','displayRole','userStatus','keyword'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $userTypes = UserType::select('id','role')->where('role','!=','Player')->get();
        $groups = Group::select('code','name')->where('code','!=','')->whereNotNull('code')->get();
        return view('users.create', compact('userTypes','groups'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequests $request)
    {
        $form = $request->validated();
        $form['password'] = Hash::make($form['password']);
        $form['uuid'] = (string) Str::orderedUuid();
        $create = User::create($form);
        $user = Auth::User();
        if ($create) {
            ActivityLog::create([
                'type' => 'create-user',
                'user_id' => $user->id, // guest middlware
                'assets' => json_encode([
                    'action' => 'created a user account',
                    'name' => $request->first_name . ' ' . $request->last_name,
                    'username' => $request->username,
                    'role' => 'Player'
                ])
            ]);
            return redirect('/users')->with('success','New user account created.');
        }
        return redirect('/users')->with('error','Something went wrong!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    public function toggleIsActive(User $user)
    {
        $auth = auth()->user();
        $userId = $user->id;
        $update = User::where('id', $userId)->update(['is_active' => DB::raw('!is_active')]);
        
        
        if ($update) {

            if (!$user->is_active == 0) {
                \Session::getHandler()->destroy($user->session_id);
            }

            ActivityLog::create([
                'type' => 'change-user-status',
                'user_id' => $auth->id,
                'assets' => json_encode([
                    'action' => 'Change user status',
                    'username' => $user->username,
                    'old status' => $user->is_active == '0' ? 'deactivated' : 'active',
                    'new status' => !$user->is_active == '0' ? 'deactivated' : 'active'
                ])
            ]);
            return back()->with('success','User status updated');
        }else {
            return back()->with('error','Something went wrong');
        }
    }

    public function updateUser(Request $request){
        $userTypes = UserType::select('id','role')->where('role','!=','Player')->get();
        
        $groups = Group::select('code','name')->where('code','!=','')->whereNotNull('code')->get();

        $userId = $request->segment(3);

        $operation =  $request->segment(4);

        $usersInfo = User::select('id','first_name','last_name','user_type_id','contact','group_code')
                    ->where('users.id', $userId)
                    ->first();
        return view('users.update', compact('usersInfo','userTypes','operation','groups'));
    }

    public function submitUser(User $user, Request $request){

        $auth = auth()->user();
        
        $updateUsers = '';

        $logs = '';

        if($request->operation == 'info'){
            $validator = Validator::make($request->all(), [
                'first_name' => 'required|max:255|regex:/^[a-z\d\-_\s]+$/i',
                'last_name' => 'required|max:255|regex:/^[a-z\d\-_\s]+$/i',
                'contact' => 'required|numeric|unique:users,contact,'.$request->id,
                'user_type_id' => 'required|numeric',
                'group_code' => 'required|string|max:8'
            ]);
            if ($validator->fails()) {
                return redirect('/users/update/'.$request->id.'/info')
                    ->withErrors($validator)
                    ->withInput();
            }else{
                $updateUsers = User::where('users.id', $request->id)->update(
                    array(
                        'first_name' => $request->first_name,
                        'last_name' => $request->last_name,
                        'contact' => $request->contact,
                        'user_type_id' => $request->user_type_id,
                        'group_code' => $request->group_code
                    )
                );
                $logs = array(
                    'action' => 'Update Users Details',
                    'first_name' => $request->first_name,
                    'last_name' => $request->last_name,
                    'contact' => $request->contact,
                    'username' => $user->username
                );
            }
        }else{
            $validator = Validator::make($request->all(), [
                'cpassword' => 'required|min:8',
                'ccpassword' => 'required',
            ]);
            if ($validator->fails()) {
                return redirect('/users/update/'.$request->id.'/password')
                    ->withErrors($validator)
                    ->withInput();
            }else{
                if($request->cpassword == $request->ccpassword){

                    $newPassword = Hash::make($request->cpassword);

                    $updateUsers = User::where('users.id', $request->id)->update(
                        array(
                            'password' => $newPassword
                        )
                    );
                    $logs = array(
                        'action' => 'Update password',
                        'username' => $user->username
                    );
                }else{
                    return redirect('/users/update/'.$request->id.'/password')
                    ->withErrors('Password and Confirm password not match!');
                }
            }

        }
        
        if($updateUsers){
            ActivityLog::create([
                'type' => 'update-user',
                'user_id' => $auth->id,
                'assets' => json_encode($logs)
            ]);
            return redirect('/users')->with('success','User successfully updated.');
        }
    }
}
