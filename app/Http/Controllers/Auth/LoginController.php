<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request as FacadesRequest;

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
    protected function credentials(Request $request)
    {
        // dd($request);
        if (is_numeric($request->get('email_phone'))) {
            return ['phone' => $request->get('email_phone'), 'password' => $request->get('password')];
        }
        //   elseif (filter_var($request->get('email'), FILTER_VALIDATE_EMAIL)) {
        return ['email' => $request->get('email_phone'), 'password' => $request->get('password')];
        //   }
        //   return ['username' => $request->get('email'), 'password'=>$request->get('password')];
    }

    protected $maxAttempts = 3; // Default is 5
    protected $decayMinutes = 1; // Default is 1
    /**
     * Create a new controller instance.
     *
     * 
     * 
     * 
     * @return void
     */


    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
