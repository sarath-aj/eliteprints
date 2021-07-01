<?php

namespace App\Http\Requests\Auth;

// use Illuminate\Foundation\Http\FormRequest;

use App\Http\Requests\Auth\FormRequest;

class RegisterRequest extends FormRequest
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
            'email'                  => ['required', 'max:60', 'min:6', 'email', 'unique:users,email'],
            'name'                   => ['required', 'string', 'max:60', 'min:2'],
            'password'               => ['required', 'min:6'],
            'password_confirmation'  => ['required', 'same:password'],
            'terms'                  => ['accepted'],
        ];
    }
    public function messages()
    {
        return [
            'name.max' => 'The name must not be more than 60 characters.',
            'email.max' => 'The email must not be more than 60 characters.',
            'password_confirmation.same' => 'The password should match.',
            'terms.accepted' => 'You must agree to our terms & Policy.',
        ];
    }
}
