<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Models\ActivityLog;
use App\Models\UserType;
use Auth;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
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
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {

        $this->validateLogin($request);

        if ($this->attemptLogin($request)) {
            if ($request->hasSession()) {
                $request->session()->put('auth.password_confirmed_at', time());
            }

            $user = Auth::user();

            ActivityLog::create([
                'type' => 'login',
                'user_id' => Auth::id(),
                'assets' => json_encode([
                    'action' => 'User login',
                    'email' => $user->email,
                    'user_role' => UserType::getUserRole($user->user_type_id)->role
                ])
            ]);

            if (Auth::user()->is_active == 0) {
                Auth::logout();
                $request->session()->flush();
                $request->session()->regenerate();
                return back()
                    ->withErrors([
                        'error' => 'User account is Deactivated. Please contact a administrator to activate your account.',
                ]);
            }

            // if (Auth::user()->status == 'pending') {
            //     Auth::logout();
            //     $request->session()->flush();
            //     $request->session()->regenerate();
            //     return back()
            //         ->withErrors([
            //             'error' => 'Your account is waiting for approval.',
            //     ]);
            // }

            return $this->sendLoginResponse($request);
        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
    }

    protected function validateLogin(Request $request)
    {
        $request->validate([
            $this->username() => 'required|string',
            'password' => 'required|string',
        ]);
    }

    protected function attemptLogin(Request $request)
    {
        return $this->guard()->attempt(
            $this->credentials($request), $request->filled('remember')
        );
    }

    protected function sendLoginResponse(Request $request)
    {
        // $request->session()->regenerate();
        $request->session()->regenerate();
        $previous_session = Auth::user()->session_id;
        if ($previous_session) {
            \Session::getHandler()->destroy($previous_session);
        }
        Auth::user()->session_id = \Session::getId();
        Auth::user()->save();

        $this->clearLoginAttempts($request);

        if ($response = $this->authenticated($request, $this->guard()->user())) {
            return $response;
        }

        return $request->wantsJson()
                    ? new JsonResponse([], 204)
                    : redirect()->intended($this->redirectPath());
    }

    public function username()
    {
        return 'username';
    }

}
