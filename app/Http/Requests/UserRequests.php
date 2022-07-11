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
            'first_name' =>     ['required', 'string', 'max:255'],
            'last_name' =>      ['required', 'string', 'max:255'],
            'username' =>       ['required', 'string', 'max:255', 'unique:users'],
            'password' =>       ['required', 'string', 'min:8', 'confirmed'],
            'contact' =>        ['required', 'digits:11', 'unique:users'],
            'user_type_id' =>   ['required'],
            'group_code' =>     ['required','string','max:8'] // required for Authenticated user store method
        ];
    }
}
