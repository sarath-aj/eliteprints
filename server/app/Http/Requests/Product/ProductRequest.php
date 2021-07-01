<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'product_code' => 'required|max:255|unique:products',
            'name' => 'required|max:255|unique:products',
            'slug' => 'required|max:255|unique:products',
            'description' => 'required|max:400',
            'price' => 'required|numeric',
            'featured' => 'required|integer|in:1,0',
            'occasion' => 'required|string',
            'brand_id'=> 'required|integer',
            'gender' => 'required|string',
            'sleeve' => 'required|string',
            'neck' => 'required|string',
            'color' => 'required|string|max:60',
            'fit' => 'required|string',
            'main_image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'image_gallery.*' => 'image|mimes:jpeg,png,jpg|max:2048',
        ];
    }
    public function messages()
    {
        return [
            'name.max'=> 'The product name must not be more than 255 characters.',
            'product_code.max'=> 'The product code must not be more than 255 characters.',
            'slug.max'=> 'The product slug must not be more than 255 characters.',
            'description.max'=> 'The product description must not be more than 400 characters.',
            'color.max' => 'The color field must not be more than 60 characters.',
            'brand_id.required'=> 'Please select brand.',
            'gender.required' => 'Please select gender.',
            'occasion.required' => 'Please select occasion.',
            'sleeve.required' => 'Please select sleeve type.',
            'neck.required' => 'Please select neck type.',
            'fit.required' => 'Please select fit type.',
            'main_image.required' => 'Main image is required.',
            'main_image.*.image' => 'Main image must be of image type jpeg, png, jpg',
            'main_image.*.max' => 'Main image size must not be greater than 2 MB',
            'image_gallery.*.image' => 'Image Gallery must be of image type jpeg, png, jpg',
            'image_gallery.*.max' => 'Each image size in image gallery must not be greater than 2 MB',
        ];
    }
}
