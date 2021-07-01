<?php

namespace App\Http\Requests\Settings;

use Illuminate\Foundation\Http\FormRequest;

class SettingsRequest extends FormRequest
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
            'shop_name' => 'required|string|max:60|min:2',
            'description' => 'required|string|max:200|min:100',
            'email' => 'required|email',
            'phone' => 'required',
            'address' => 'required|max:120',
            'state' => 'required|max:120',
            'city' => 'required|max:120',
            'postal_code' => 'required|string|max:10',
            'country_id' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'shop_name.max' => 'The shop name must not be more than 60 characters.',
            'description.max' => 'The shop description must not be more than 200 characters.',
            'address.max' => 'The address must not be more than 120 characters.',
            'state.max' => 'The state must not be more than 120 characters.',
            'city.max' => 'The city must not be more than 120 characters.',
            'postal_code.max' => 'The postal code must not be more than 10 characters.',
            'country_id.required' => 'Please select country.',
        ];
    }
}
