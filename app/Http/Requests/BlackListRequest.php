<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BlackListRequest extends FormRequest
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
            'type' =>                   ['required','alpha'],
            'first_name' =>             ['required','alpha'],
            'middle_name' =>            ['required','alpha'],
            'last_name' =>              ['required','alpha'],
            'date_of_birth' =>          ['required','date_format:Y-m-d'],
        ];
    }
}
