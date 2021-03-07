<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class WorkConditionRules implements Rule
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
        $conditions = ['remote','part remote', 'on-premise'];
        if( in_array(strtolower($value), $conditions)){
            return true;
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return ':attribute can only be remote,part remote, on-premise';
    }
}
