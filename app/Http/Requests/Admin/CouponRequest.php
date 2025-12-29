<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CouponRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title'         => 'required|unique:coupons,title,'.$this->id,
            'type'          => 'required',
            'discount'      => 'required',
            'discount_type' => 'required',
            'dateRange'     => 'required',
        ];
    }
}
