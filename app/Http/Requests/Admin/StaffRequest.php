<?php

namespace App\Http\Requests\Admin;

use GuzzleHttp\Psr7\Request;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules;

class StaffRequest extends FormRequest
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
            'first_name' => 'required|string|max:255',
            'last_name'  => 'required|max:255',
            'email'      => 'required|email|unique:users,email'.Request()->id,
            'phone'      => 'required|unique:users,phone'.Request()->id,
            'password'   => ['required', 'confirmed', Rules\Password::defaults()],
            'role_id'    => 'required',
        ];
    }
}
