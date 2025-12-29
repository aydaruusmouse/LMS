<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class OrganizationRequest extends FormRequest
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
            'org_name'           => 'required|string|unique:organizations,org_name,'.\Request()->id,
            'phone'              => 'required|numeric',
            'email'              => 'required|email',
            'country_id'         => 'required',
            'address'            => 'required',
            'person_name'        => 'nullable|string',
            'person_designation' => 'nullable|string',
            'person_phone'       => 'nullable',
            'person_email'       => 'nullable|email',
        ];
    }
}
