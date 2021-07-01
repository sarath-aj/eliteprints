<?php

namespace App\Http\Requests\Auth;

// use Illuminate\Foundation\Http\FormRequest;

use App\Http\Requests\Auth\FormRequest;

class UserUpdateRequest extends FormRequest
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
            'name'                   => ['required', 'string', 'max:60', 'min:2'],
        ];
    }
    public function messages()
    {
        return [
            'name.max' => 'The name must not be more than 60 characters.',
        ];
    }
}
