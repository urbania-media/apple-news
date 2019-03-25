<?php

namespace Urbania\AppleNews\Support;

class Utils
{
    public static function studlyCase($value)
    {
        $value = ucwords(str_replace(['-', '_'], ' ', $value));
        return str_replace(' ', '', $value);
    }

    public static function snakeCase($value, $separator = '_')
    {
        if (!ctype_lower($value)) {
            $value = preg_replace('/\s+/u', '', ucwords($value));
            $value = mb_strtolower(preg_replace('/(.)(?=[A-Z])/u', '$1'.$separator, $value), 'utf-8');
        }
        return $value;
    }
}
