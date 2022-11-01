<?php

namespace App\Http\Controllers;

use App\Exports\ContactsExport;
use App\Http\Requests\FormDataRequest;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\Mime\Part\Multipart\FormDataPart;

class ContactController extends Controller
{
    //

    // protected function validator(Request $data)
    // {
    //    return $data->validate( [
    //         'firstname' => ['required', 'string', 'max:255'],
    //         'lastname' => ['required', 'string', 'max:255'],
    //         'email' => ['required', 'string', 'email', 'max:255'],
    //         'phone' => ['required','numeric','regex:/^[7-9][0-9]{9}$/','min:10'], //'','max:10'
    //         'address'=>['string','max:255'],
    //         'nickname'=>['string','max:255'],
    //         'company'=>['string','max:255'],
    //         'status'=>['boolean','max:255'],

    //     ],
    //     [
    //         'firstname.required'=>'First Name is required!',
    //         'lastname.required'=>'Last Name is required!',
    //         'email.email'=>'Please enter a valid email!',
    //         'phone.numeric'=>'Invalid phone number, only digits allowed!',
    //        // 'phone.min'=>'Invalid phone number, minimum 10 digits required!',
    //        // 'phone.max'=>'Invalid phone number, digits exceeded!',
    //     ]);
    // }


    public function __construct()
    {
        $this->middleware(['auth','verified']);
    }

    
    public function add_form() {
        return view('contact');
    }

    public function show(){
      $current_user = Auth::user()->id;  
      $data = Contact::where('user_id',$current_user)->get();
      return view('list',['contacts'=>$data]);
    }

    public function add(FormDataRequest $req){
        $contact = new Contact();
        $contact->user_id = Auth::user()->id;
        $contact->firstname = $req->firstname;
        $contact->lastname = $req->lastname;
        $contact->email = $req->email;
        $contact->phone = $req->phone;
        $contact->address = $req->address;
        $contact->nickname = $req->nickname;
        $contact->company = $req->company;
        if ($req->status=="Active") {
        $contact->status =true;
        } else {
            $contact->status =false;
        }
        $contact->save();
    
        return redirect('list');
    }

    public function index($id){
        $data = Contact::find($id);
        return response()->json($data, 200);
    }

   
    function update(Request $req){

        $data = Contact::find($req->id);
        $data->firstname = $req->firstname;
        $data->lastname = $req->lastname;
        $data->email = $req->email;
        $data->phone = $req->phone;
        $data->address = $req->address;
        $data->nickname = $req->nickname;
        $data->company = $req->company;
        if ($req->status=="Active") {
            $data->status =true;
            } else {
                $data->status =false;
            }
        $data->save();
        return redirect('list');
    }

    public function export() 
    {
        return Excel::download(new ContactsExport, 'contacts.csv');
    }
}

