<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Models\JobCategory as Jobs;

class JobCategory implements Rule
{
    private  $job_category;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->job_category = Jobs::pluck('job_category')->toArray();
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
        if(in_array(strtolower($value), $this->job_category)){
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
        return ":attribute can only be ".implode(',', $this->job_category);
    }
}
