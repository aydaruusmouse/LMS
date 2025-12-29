<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CountryRequest extends FormRequest
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
            'name'            => 'required|string|unique:countries,name,'.$this->id,
            'iso3'            => 'required|max:3|unique:countries,iso3,'.$this->id,
            'iso2'            => 'required|max:2|unique:countries,iso2,'.$this->id,
            'phonecode'       => 'required|unique:countries,phonecode,'.$this->id,
            'currency'        => 'required',
            'currency_symbol' => 'required',
        ];
    }
}
