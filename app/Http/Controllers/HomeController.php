<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use \Milon\Barcode\DNS1D;
use \Milon\Barcode\DNS2D;
use App\Models\User;
use App\Models\UserDetails;

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
            $qrCode = $qrcode->getBarcodeHTML($uuid, 'QRCODE');

            $verified = User::where('status','verified')->where('user_type_id', 5)->count();
            $pending =  User::where('status','pending')->where('user_type_id', 5)->count();

            return view('home', [
                'img' =>        $qrCode,
                'verified' =>   $verified,
                'pending' =>    $pending,
                'userInfo' =>   $userInfo,
                'userDetails' => $userDetails
            ]);
        } else {
            return view('login');
        }
    }
}
