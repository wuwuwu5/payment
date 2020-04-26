<?php

namespace App\Modules\Admin\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Modules\Admin\Rules\Parses\IdCardParse;

class IdCardRule implements Rule
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
        return IdCardParse::passes($value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return '无效的身份证号码';
    }
}
