<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequests extends FormRequest
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
            'first_name' =>     ['required', 'string', 'max:255', 'regex:/^[a-z\d\-_\s]+$/i'],
            'last_name' =>      ['required', 'string', 'max:255', 'regex:/^[a-z\d\-_\s]+$/i'],
            'username' =>       ['required', 'string', 'max:255', 'regex:/^[a-z\d\-_\s]+$/i', 'unique:users'],
            'password' =>       ['required', 'string', 'min:8', 'confirmed'],
            'contact' =>        ['required', 'digits:11', 'unique:users', 'numeric'],
            'user_type_id' =>   ['required'],
            'group_code' =>     ['required','string','max:8'] // required for Authenticated user store method
        ];
    }
}
