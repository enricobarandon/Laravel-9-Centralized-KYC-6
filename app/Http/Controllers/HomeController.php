<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use \Milon\Barcode\DNS1D;
use \Milon\Barcode\DNS2D;
use App\Models\User;
use App\Models\UserDetails;
use App\Models\GroupStatistics;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (Auth::check()) {
            $userInfo = auth()->user();
            $userDetails = UserDetails::where('user_id', $userInfo->id)->first();
            $uuid = auth()->user()->uuid;
            $qrcode = new DNS2D();
            $qrCode = $qrcode->getBarcodePNG($uuid, 'QRCODE',15,15);

            $verified = User::where('status','verified')->where('user_type_id', 5)->count();
            $pending =  User::where('status','pending')->where('user_type_id', 5)->count();
            $disapproved =  User::where('status','disapproved')->where('user_type_id', 5)->count();
            $totalregistered =  User::where('user_type_id', 5)->count();
            $loggedTotay = GroupStatistics::whereDate('created_at', date('Y-m-d', time()))->sum('total_player_logged_in');

            return view('home', [
                'img' =>        $qrCode,
                'verified' =>   $verified,
                'pending' =>    $pending,
                'userInfo' =>   $userInfo,
                'userDetails' => $userDetails,
                'loggedTotay' => $loggedTotay,
                'disapproved' => $disapproved,
                'totalregistered' => $totalregistered
            ]);
        } else {
            return view('login');
        }
    }
}
