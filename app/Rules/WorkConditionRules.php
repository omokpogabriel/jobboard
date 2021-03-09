<?php

namespace App\Rules;

use App\Models\WorkCondition;
use Illuminate\Contracts\Validation\Rule;

class WorkConditionRules implements Rule
{
    private $conditions;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->conditions = WorkCondition::pluck('work_condition')->toArray();
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
        if( in_array(strtolower($value), $this->conditions)){
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
        return ':attribute can only be '.implode(',' , $this->conditions);
    }
}
