<?php

namespace App\Http\Requests\Customer;

use Illuminate\Foundation\Http\FormRequest;

// use App\Http\Requests\Auth\FormRequest;

class EditAccountRequest extends FormRequest
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
    public function rules(): array
    {
        return [
            'name'      => ['required', 'string', 'max:60', 'min:2'],
            'mobile'    => ['required', 'regex:/^([0-9\s\-\+\(\)]*)$/', 'min:10','max:20'],
        ];
    }
    public function messages()
    {
        return [
            'name.max' => 'The name must not be more than 60 characters.',
            'mobile.regex' => 'The mobile number cannot contain characters.',
            'mobile.max' => 'The mobile number must not be more than 20 digits.',
        ];
    }
}
