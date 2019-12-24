<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

/**
 * The 2 factor validation rule.
 */
class TwoFactorRule implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct() { }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $user = auth()->user();
        if (hash_equals($user->two_factor_code, $value)) {
            if ($user->two_factor_expiry > now()){
                return true;
            }
        }
        return false;
    }

    /**
     * Get the validation error message.
     *
     * @return string Returns the error message.
     */
    public function message()
    {
        return trans('auth.two_factor_code_invalid');
    }
}
