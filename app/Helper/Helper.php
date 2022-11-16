<?php
namespace App\Helper;
use App\Models\User;

use Illuminate\Http\Request;
use App\Models\UserVerify;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;

class Helper
{
//     public function getMail(User $request){
//         $token = Str::random(64);
//         UserVerify::create([
//           'user_id' => $request->id,
//           'token' => $token
//         ]);
//         Mail::send('email.emailverify', ['token' => $token], function ($message) use ($request) {
//           $message->to($request->email);
//           $message->subject('Email Verification ');
//         });
//         return true;
//     }
}

?>