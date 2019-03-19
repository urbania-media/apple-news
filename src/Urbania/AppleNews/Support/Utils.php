<?php

namespace Urbania\AppleNews\Support;

class Utils
{
    public static function studlyCase($value)
    {
        $value = ucwords(str_replace(['-', '_'], ' ', $value));
        return str_replace(' ', '', $value);
    }
}
