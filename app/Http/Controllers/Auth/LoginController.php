<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

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
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $data)
    {
        $credentials =[
            'name' => $data->name,
            'password' => $data->password
        ];

        $user = User::where('name', '=', $data->name)->first();

        if (Auth::attempt($credentials, $data->remember_me)) {
            if ($user->level == 'admin') {
                return Redirect::to(env('ADMIN'));
            } elseif ($user->level == 'user') {
                return Redirect::to(env('USER'));
            } else {
                return redirect()->route('login');
            }

            return redirect()->route('register');
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->route('login')->with(['success' => 'Logout Berhasil']);
    }
}
