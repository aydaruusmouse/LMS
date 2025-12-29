<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmailConfigureRequest extends FormRequest
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
            'mail_server'          => 'required',
            'smtp_server_address'  => 'required_if:mail_server,smtp',
            'smtp_mail_port'       => 'nullable|required_if:mail_server,smtp|numeric',
            'smtp_user_name'       => 'nullable|required_if:mail_server,smtp',
            'smtp_mail_from_name'  => 'nullable|required_if:mail_server,smtp',
            'smtp_password'        => 'nullable|required_if:mail_server,smtp|min:2',
            'smtp_encryption_type' => 'nullable|in:tls,ssl',
            'mail_signature'       => 'nullable',
        ];
    }
}
