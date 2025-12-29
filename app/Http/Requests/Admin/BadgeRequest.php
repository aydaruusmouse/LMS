<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class BadgeRequest extends FormRequest
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
            'name'        => 'required|max:150|unique:badges,name,'.Request()->badge_id,
            'description' => 'required',
            // 'from_day' => 'required|date',
            // 'to_day' => 'required|date',
            // 'logo' => 'required|image',
        ];
    }
}
