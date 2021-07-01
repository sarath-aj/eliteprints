<?php

namespace App\Http\Requests\Addresses;

use Illuminate\Foundation\Http\FormRequest;

class AddressesRequest extends FormRequest
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
            'address' => 'required|max:120',
            'state' => 'required|max:120',
            'city' => 'required|max:120',
            'postal_code' => 'required|string|max:10',
            'country_id' => 'required|integer',
            'is_default' => 'required|integer|in:1,0',
        ];
    }
    public function messages()
    {
        return [
            'name.max' => 'The name must not be more than 60 characters.',
            'address.max' => 'The address must not be more than 120 characters.',
            'state.max' => 'The state must not be more than 120 characters.',
            'city.max' => 'The city must not be more than 120 characters.',
            'postal_code.max' => 'The postal code must not be more than 10 characters.',
            'country_id.required' => 'Please select country.',
        ];
    }
}
