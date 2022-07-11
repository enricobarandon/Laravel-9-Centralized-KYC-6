<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserType;
use App\Http\Requests\UserRequests;
use App\Models\ActivityLog;
use Auth;
use App\Models\Group;

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

    public function index()
    {
        $users = User::select('users.id','first_name','middle_name','last_name','email','users.created_at as created_at','is_active','status','username','user_type_id')
                                ->whereIn('user_type_id', [1,2,3,4])
                                ->get();

        $userTypes = UserType::select('id','role')->get()->pluck('role','id')->toArray();

        return view('users.index', compact('users','userTypes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $userTypes = UserType::select('id','role')->where('role','!=','Player')->get();
        $groups = Group::select('code','name')->where('is_active',1)->whereNotNull('code')->get();
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
        // dd($request->validated());
        $create = User::create($request->validated());
        $user = Auth::User();
        if ($create) {
            ActivityLog::create([
                'type' => 'create-user',
                'user_id' => $user->id, // guest middlware
                'assets' => json_encode([
                    'action' => 'created a user account',
                    'name' => $request->first_name . ' ' . $request->last_name,
                    'email' => $request->email,
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
}
