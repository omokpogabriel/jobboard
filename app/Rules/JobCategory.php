<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class JobCategory implements Rule
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
        $job_category = ['tech','health care','hospitality','customer service','marketing'];
        if(in_array(strtolower($value), $job_category)){
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
        return ':attribute can only be Tech, Health care , Hospitality, Customer service, Marketing ';
    }
}
