<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class mobile_no_rule implements Rule
{
    public function passes($attribute, $value)
    {
        return preg_match('/^(?:\+63|0|63)?9\d{9}$/', $value);
    }

    public function message()
    {
        return 'The :attribute format is invalid.';
    }
}
