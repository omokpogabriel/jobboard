<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class JobType implements Rule
{
    private $job_type;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->job_type= \App\Models\JobType::pluck('job_type')->toArray();
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
        if(in_array(strtolower($value), $this->job_type)){
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
        return ':attribute can only be '.implode(',' , $this->job_type);
    }
}
