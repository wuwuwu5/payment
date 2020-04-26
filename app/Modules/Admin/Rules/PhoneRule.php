<?php

namespace App\Modules\Admin\Rules;

use App\Modules\Admin\Rules\Parses\PhoneParse;
use Illuminate\Contracts\Validation\Rule;

class PhoneRule implements Rule
{
    /**
     * Determine if the validation rule passes.
     *
     * @param string $attribute
     * @param mixed $value
     *
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return PhoneParse::passes($value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return '无效的手机号';
    }
}
