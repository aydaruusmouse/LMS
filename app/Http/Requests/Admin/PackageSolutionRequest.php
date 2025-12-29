<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class PackageSolutionRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'         => 'required|unique:package_solutions,name,'.$this->id,
            'description'  => 'required',
            'price'        => 'required|numeric',
            'price'        => 'required|numeric',
            'validity'     => 'required|numeric',
            'upload_limit' => 'required|numeric',
            'add_limit'    => 'required|numeric',
            'bundle'       => 'required|numeric',

        ];
    }
}
