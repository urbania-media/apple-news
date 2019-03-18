<?php

namespace Urbania\AppleNews;

class Utils
{
    public static function studlyCase($value)
    {
        $value = ucwords(str_replace(['-', '_'], ' ', $value));
        return str_replace(' ', '', $value);
    }
}
