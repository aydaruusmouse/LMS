<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class BrandRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'order_no'       => 'required|numeric|unique:brands,order_no,'.$this->id,
            'brand_media_id' => 'required|numeric',
        ];
    }
}
