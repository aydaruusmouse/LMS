<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class PayoutRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'amount'               => 'required|numeric',
            'payment_method'       => 'required',
            'terms_and_conditions' => 'required',
            'organization'         => 'required',
        ];
    }
}
