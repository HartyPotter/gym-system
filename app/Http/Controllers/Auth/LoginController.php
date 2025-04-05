<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request; // Import the correct Request class

class LoginController extends Controller
{
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
        $this->middleware('auth')->only('logout');
    }

    /**
     * Get the needed authorization credentials from the request.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    protected function credentials(Request $request)
    {
        $password = $request->input('password');
        $login = $request->input('email'); 
        
        if (is_numeric($login)) {
            return [
                'phone' => $login,
                'password' => $password,
            ]; 
        } elseif (filter_var($login, FILTER_VALIDATE_EMAIL)) {
            return [
                'email' => $login,
                'password' => $password,
            ];
        } else {
            return [
                'username' => $login,
                'password' => $password,
            ];
        }
    }
}
