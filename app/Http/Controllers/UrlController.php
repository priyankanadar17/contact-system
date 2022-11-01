<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;

class UrlController extends Controller
{
    //
    public function url_share($id){
        return URL::temporarySignedRoute(
            'url', now()->addHour(), ['id' => $id]
        );
    }

    public function url($id) {
        $data = Contact::find($id);

        return view('sharedContact',['contacts'=>$data]);
    }
}
