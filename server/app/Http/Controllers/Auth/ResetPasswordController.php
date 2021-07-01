<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use App\Rules\PasswordCannotNotBeFromPasswordHistory;
use App\Models\User;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Get the password reset validation rules.
     *
     * @return array
     */
    protected function rules()
    {
        return [
            'token' => 'required',
            'email' => 'required|email',
            'password'                   => ['required', 'string', 'confirmed', new PasswordCannotNotBeFromPasswordHistory(User::whereEmail(request()->email)->first(), 5)],
            'new_password'               => ['required', 'string', 'min:6'],
            'new_password_confirmation'  => ['required', 'string', 'same:new_password'],

        ];
    }
}
