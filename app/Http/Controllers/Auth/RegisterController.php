<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

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
            'firstname' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone' => ['required','numeric','unique:users','regex:/^[7-9][0-9]{9}$/','min:10'], //'','max:10'
            'password' => ['required', 'string','min:6', 'confirmed','regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/'],
        ],
        [
            'firstname.required'=>'First Name is required!',
            'lastname.required'=>'Last Name is required!',
            'email.email'=>'Please enter a valid email!',
            'phone.numeric'=>'Invalid phone number, only digits allowed!',
            'password.regex'=>'Invalid password, must contain atleast one uppercase,one lowercase,one numeric and one special character!'
           // 'phone.min'=>'Invalid phone number, minimum 10 digits required!',
           // 'phone.max'=>'Invalid phone number, digits exceeded!',
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
    //    dd(User::all()->toArray());
        return User::create([
    
            "firstname" => $data['firstname'],
            "lastname" => $data['lastname'],
            "email" => $data['email'],
            "phone" => $data['phone'],
            'password' => Hash::make($data['password']),
          ]

    );
    }
}
