<?php

namespace App\Rules;

use Hash;
use Auth;

use Illuminate\Contracts\Validation\Rule;

class CurrentPasswordMatch implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        if (!(Hash::check(request()->password, Auth::user()->password))) {
            return false;
        }
        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Your current password does not matches with the password you provided. Please try again.';
    }
}