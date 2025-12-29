<?php

namespace App\Http\Requests\Instructor;

use Illuminate\Foundation\Http\FormRequest;

class InstructorRequest extends FormRequest
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
        $rules = [
            'first_name'  => 'required|string',
            'last_name'   => 'required|string',
            'phone'       => 'required|numeric|unique:users,phone,'.Request()->id,
            'email'       => 'required|email|unique:users,email,'.Request()->id,
            'designation' => 'required|string',
            'image'       => 'mimes:jpg,JPG,JPEG,jpeg,png,PNG,webp,WEBP|max:5120',
        ];
        if ($this->method() == 'PUT' || $this->method() == 'PATCH') {
            $rules['password'] = 'nullable|min:6|confirmed';
        } else {
            $rules['password'] = 'required|min:6|confirmed';
        }

        return $rules;
    }
}
