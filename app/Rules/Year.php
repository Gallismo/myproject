<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class Year implements Rule
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
    public function passes($attribute, $value): bool
    {
        $exp = '/^[1-3][0-9][0-9][0-9]$/';
        return (boolean) preg_match($exp, $value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Годы должны быть в формате ГГГГ, допущены значения от 1000 до 3999';
    }
}
