<?php

namespace App\Modules\Admin\Rules\Parses;

class PhoneParse
{


    /**
     * Determine if the gieved idcard is passed.
     *
     * @param string $value
     *
     * @return bool
     */
    public static function passes($phone)
    {
        if (!preg_match('/^1\d{10}$/', $phone)) {
            return false;
        }

        return true;
    }
}
