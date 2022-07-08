<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use \Milon\Barcode\DNS1D;
use \Milon\Barcode\DNS2D;

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
        // return view('home');
        if (Auth::check()) {
            $uuid = auth()->user()->uuid;
            $qrcode = new DNS2D();
            $qrCode = $qrcode->getBarcodeHTML($uuid, 'QRCODE');
            return view('home', ['img' => $qrCode]);
        } else {
            return view('login');
        }
    }
}
