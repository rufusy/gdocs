<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class IntegerArray implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param string $attribute
     * @param mixed $value
     * @param Closure $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $integerOnly = collect($value)->every(fn ($element) => is_int($element));
        if(!$integerOnly) {
            $fail(':attribute can only be integers.');
        }
    }
}
