<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Carbon\Carbon;
use Illuminate\Console\View\Components\Alert;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;

class UrlController extends Controller
{
    public function url_share($key)
    {
        $data = Contact::where("key", $key)->first();
        // dd($data);
        if ($data->status == 0) {
            abort(403, "Cannot generate link!Status is inactive!");
        } else {
            $link = '';
            return view('linkform', ['link' => $link, 'key' => $key]);
        }
    }

    public function url_gen(Request $request)
    {
        // check if there is any post data

        // if yes then generate the link and return the view with generated link

        // if no then return the empty string in link in view


        // $request->validate(
        //     [
        //         'datetime'=>['required'],
        //     ]
        // );

        // dd($request->datetime);
        date_default_timezone_set('Asia/Kolkata');
        $a = Carbon::parse($request->datetime);
        $current = date('Y-m-d H:i:s');
        $curr = Carbon::parse($current);
        $diff_in_sec = $a->diffInSeconds($curr);
        // dd($a,$current);
        //    dd($diff_in_sec);
        if ($request->datetime == null) {
            // echo"<script>";
            // echo"alert('Please enter Date and Time!')";
            // echo"</script>";
            return back()->with('alert', 'Please enter Date and Time!');
        }
        if ($request->post()) {
            $link = URL::temporarySignedRoute(
                'url',
                now()->addSeconds($diff_in_sec),
                ['key' => $request->key]
            );
        }
        return view('linkform', ['link' => $link]);
    }



    public function url($key)
    {
        $data = Contact::where("key", $key)->first();
        if ($data->status == 0) {
            abort(403, "Cannot use URL!Status is inactive!");
        } else {
            return view('sharedContact', ['contacts' => $data]);
        }
    }
}
