<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FormDataRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            //
            'firstname' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'phone' => ['required','numeric','regex:/^[7-9][0-9]{9}$/','min:10'], //'','max:10'
            'address'=>['string','max:255'],
            'nickname'=>['max:255'],
            'company'=>['string','max:255'],

        ];
    }

    public function messages()
    {
        return [
            'firstname.required'=>'First Name is required!',
            'lastname.required'=>'Last Name is required!',
            'email.email'=>'Please enter a valid email!',
            'phone.numeric'=>'Invalid phone number, only digits allowed!',
        ];
    }
}
