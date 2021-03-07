<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class JobType implements Rule
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
        $job_type = ['full-time','temporary','contract','permanent','internship','volunteer'];
        if(in_array(strtolower($value), $job_type)){
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
        return ':attribute can only be Full-time, Temporary, Contract, Permanent, Internship, Volunteer';
    }
}
