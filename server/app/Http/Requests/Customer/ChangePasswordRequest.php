<?php

namespace App\Http\Requests\Customer;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\PasswordCannotNotBeFromPasswordHistory;
use App\Rules\CurrentPasswordMatch;
use App\Models\User;
use Auth;

// use App\Http\Requests\Auth\FormRequest;

class ChangePasswordRequest extends FormRequest
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
            'password'                   => ['required', 'string', new CurrentPasswordMatch()],
            'new_password'               => ['required', 'string', 'min:6', new PasswordCannotNotBeFromPasswordHistory(Auth::user(), 5)],
            'new_password_confirmation'  => ['required', 'string', 'same:new_password'],
        ];
    }
    public function messages()
    {
        return [
            'new_password.min' => 'The password length should be atleast 6 characters.',
            'new_password_confirmation.same' => 'The password should match.',
        ];
    }
}
