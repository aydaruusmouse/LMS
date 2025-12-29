<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CurrencyRequest extends FormRequest
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

    public function rules()
    {
        return [
            'name'          => 'required|string|unique:currencies,name,'.$this->id,
            'symbol'        => 'required',
            'code'          => 'required|unique:currencies,code,'.$this->id,
            'exchange_rate' => 'required|numeric',
        ];
    }
}
