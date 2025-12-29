<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class MobileAppRequest extends FormRequest
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
            'android_current_version_name' => 'required_if:mobile_app,android',
            'android_current_version_code' => 'required_if:mobile_app,android',
            'android_app_url'              => 'required_if:mobile_app,android',
            'android_whats_new'            => 'required_if:mobile_app,android',

            'ios_current_version_name'     => 'required_if:mobile_app,ios',
            'ios_current_version_code'     => 'required_if:mobile_app,ios',
            'ios_app_url'                  => 'required_if:mobile_app,ios',
            'ios_whats_new'                => 'required_if:mobile_app,ios',
        ];
    }
}
