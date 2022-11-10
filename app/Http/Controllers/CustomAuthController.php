<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserVerify;
use Illuminate\Contracts\Session\Session as SessionSession;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use PDO;

class CustomAuthController extends Controller
{
  //yt

  public function login()
  {
    return view('auth1.login1');
  }

  public function registration()
  {
    return view('auth1.registration1');
  }

  public function registerUser(Request $req)
  {
    $req->validate(
      [
        'firstname' => ['required', 'string', 'max:255'],
        'lastname' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        'phone' => ['required', 'numeric', 'unique:users', 'regex:/^[7-9][0-9]{9}$/', 'min:10'], //'','max:10'
        'password' => ['required', 'string', 'min:6', 'confirmed', 'regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/'],
      ],
      [
        'firstname.required' => 'First Name is required!',
        'lastname.required' => 'Last Name is required!',
        'email.email' => 'Please enter a valid email!',
        'phone.numeric' => 'Invalid phone number, only digits allowed!',
        'password.regex' => 'Invalid password, must contain atleast one uppercase,one lowercase,one numeric and one special character!'
        // 'phone.min'=>'Invalid phone number, minimum 10 digits required!',
        // 'phone.max'=>'Invalid phone number, digits exceeded!',
      ]
    );

    $data = new User();
    $data->firstname = $req->firstname;
    $data->lastname = $req->lastname;
    $data->email = $req->email;
    $data->phone = $req->phone;
    $data->password = Hash::make($req->password);

    $resp = $data->save();

    if ($resp) {
      $token = Str::random(64);
      UserVerify::create([
        'user_id' => $data->id,
        'token' => $token
      ]);
      Mail::send('email.emailverify', ['token' => $token], function ($message) use ($req) {
        $message->to($req->email);
        $message->subject('Email Verification ');
      });
      return back()->with('success', 'We have sent email link to ' . $req->email);
    } else {
      return back()->with('fail', 'Something wrong!');
    }
  }

  public function loginUser(Request $req)
  {

    $req->validate(
      [
        'email_phone' => ['required'],
        // 'phone' => ['required','regex:/^[7-9][0-9]{9}$/'], //'','max:10'
        'password' => ['required', 'min:6'],
      ],
      [
        // 'email_phone.email'=>'Please enter a valid email!',
        // 'phone.numeric'=>'Invalid phone number, only digits allowed!',
        // 'password.regex'=>'Invalid password, must contain atleast one uppercase,one lowercase,one numeric and one special character!'
      ]
    );


    $var = false;
    if (is_numeric($req->get('email_phone')) || (filter_var($req->get('email_phone'), FILTER_VALIDATE_EMAIL))) {
      $var = true;
    } else {
      return back()->with('fail', 'Please enter a valid email/phone number!');
    }
    if ($var) {
      $user = User::where('email', '=', $req->email_phone)
        ->orWhere('phone', '=', $req->email_phone)
        ->first();
      if ($user) {
        if (Hash::check($req->password, $user->password)) {
          // $user_details = ["firstname"=>$user->firstname];
          $req->session()->put('firstname', $user->firstname);
          $req->session()->put('loginId', $user->id);
          if ($user->is_email_verified == 0) {
            $token = Str::random(64);
            UserVerify::create([
              'user_id' => $user->id,
              'token' => $token
            ]);
            Mail::send('email.emailverify', ['token' => $token], function ($message) use ($req) {
              $message->to($req->email_phone);
              $message->subject('Email Verification ');
            });
            return back()->with('fail', 'Your email is not verified yet.Please check your mail');
          }
          return redirect('dashboard');
        } else {
          return back()->with('fail', 'Password not matching!');
        }
      } else {
        return back()->with('fail', 'User not found. Please register!');
      }
    }
  }

  public function dashboard()
  {
    $data = array();
    if (Session::has('loginId')) {
      $data = User::where('id', '=', Session::get('loginId'))->first();
    }
    return view('dashboard', compact('data'));
  }

  public function verifyAccount($token)
  {
    $verifyUser = UserVerify::where('token', $token)->first();
    $message = 'Sorry your email cannot be identified.';
    if (!is_null($verifyUser)) {
      $user = $verifyUser->user;
      if (!$user->is_email_verified) {
        $verifyUser->user->is_email_verified = 1;
        $verifyUser->user->save();
        $message = "Your e-mail is verified. You can now login.";
      } else {
        $message = "Your e-mail is already verified. You can now login.";
      }
    }
    return redirect('login1')->with('message', $message);
  }

  public function logout()
  {
    if (Session::has('loginId')) {
      Session::pull('loginId');
    }

    return redirect('login1');
  }
}
