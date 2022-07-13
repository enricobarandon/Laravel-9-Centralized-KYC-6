<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InterviewDetailsRequest extends FormRequest
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
            'interview_description' => ['required'],
            'interview_link'        => ['required','url'],
            'interview_date_time'    => ['required']
        ];
    }
}
