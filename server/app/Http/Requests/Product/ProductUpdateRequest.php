<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class ProductUpdateRequest extends FormRequest
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
            'product_code' => 'required|max:255',
            'name' => 'required|max:255',
            'slug' => 'required|max:255',
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
            'occasion.required' => 'Please select occassion.',
            'sleeve.required' => 'Please select sleeve type.',
            'neck.required' => 'Please select neck type.',
            'fit.required' => 'Please select fit type.',
        ];
    }
}
