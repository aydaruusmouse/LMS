<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class LiveClassRequest extends FormRequest
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
            'user_id'          => ['required'],
            'course_id'        => ['required'],
            'title'            => ['required', 'string'],
            'meeting_link'     => ['required'],
            'meeting_id'       => ['required'],
            'meeting_password' => ['required'],
        ];
    }
}
