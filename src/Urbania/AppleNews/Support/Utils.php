<?php

namespace Urbania\AppleNews\Support;

class Utils
{
    public static function isAssociativeArray($value)
    {
        return is_array($value) &&
            ((function_exists('array_is_list') && !array_is_list($value)) ||
                array_keys($value) !== range(0, count($value) - 1));
    }

    public static function studlyCase($value)
    {
        $value = ucwords(str_replace(['-', '_'], ' ', $value));
        return str_replace(' ', '', $value);
    }

    public static function snakeCase($value, $separator = '_')
    {
        if (!ctype_lower($value)) {
            $value = preg_replace('/\s+/u', '', ucwords($value));
            $value = mb_strtolower(
                preg_replace('/(.)(?=[A-Z])/u', '$1' . $separator, $value),
                'utf-8'
            );
        }
        return $value;
    }
}
