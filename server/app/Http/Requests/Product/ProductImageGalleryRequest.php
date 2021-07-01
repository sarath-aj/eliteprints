<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class ProductImageGalleryRequest extends FormRequest
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
            'image_gallery' => 'required',
            'image_gallery.*' => 'image|mimes:jpeg,png,jpg|max:2048',

        ];
    }
    public function messages()
    {
        return [
            'image_gallery.required' => 'Main image is required.',
            'image_gallery.*.image' => 'Main image must be of image type jpeg, png, jpg',
            'image_gallery.*.max' => 'Main image size must not be greater than 2 MB',
        ];
    }
}
