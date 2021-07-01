<?php

namespace App\Http\Requests\Brand;

use Illuminate\Foundation\Http\FormRequest;

class BrandCreateRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|max:60|min:2',
            'slug' => 'required|max:60|min:2',
        ];
    }
    public function messages()
    {
        return [
            'name.max' => 'The brand name must not be more than 60 characters.',
            'slug.required' => 'The brand slug field is required.',
            'slug.max' => 'The brand slug must not be more than 60 characters.',
        ];
    }
}
