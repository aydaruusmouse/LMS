<?php

namespace App\Http\Requests\Admin;

use GuzzleHttp\Psr7\Request;
use Illuminate\Foundation\Http\FormRequest;

class LanguageRequest extends FormRequest
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
        $rules = [
            'name'           => 'required|max:100|unique:languages,name,'.Request()->id,
            'flag'           => 'required',
            'locale'         => 'required|min:1|max:10|unique:languages,locale,'.Request()->id,
            'text_direction' => 'nullable',
        ];
        if (Request()->id) {
            $rules['locale'] = '';
        }

        return $rules;
    }
}
