<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;

class UrlController extends Controller
{
    //
    public function url_share($key){
        $data = Contact::find($key);
        if ($data->status==0){
        //    return back()->with('alert','Cannot share URL! Status inactive!');
        echo "<script>";
        echo "alert('Cannot share/use URL! Status inactive!');";
        echo "</script>";
        return;

        // return redirect('/');
        }

        else{
        return URL::temporarySignedRoute(
            'url', now()->addHour(), ['key' => $key]
        );
    }
    }

    public function url($key) {
        $data = Contact::find($key);
        if ($data->status==0){
            // return back()->with('alert','Cannot share URL! Status inactive!');
            echo "<script>";
            echo "alert('Cannot use URL! Status inactive!');";
            echo "</script>";
            return;
            // return back();
            }    
            else {
        return view('sharedContact',['contacts'=>$data]);
            }
    }
}
