<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class ProductMainImageRequest extends FormRequest
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
            'main_image' => 'required|image|mimes:jpeg,png,jpg|max:2048',

        ];
    }
    public function messages()
    {
        return [
            'main_image.required' => 'Main image is required.',
            'main_image.*.image' => 'Main image must be of image type jpeg, png, jpg',
            'main_image.*.max' => 'Main image size must not be greater than 2 MB',
        ];
    }
}
