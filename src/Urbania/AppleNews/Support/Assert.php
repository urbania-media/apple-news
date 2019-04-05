<?php

namespace Urbania\AppleNews\Support;

use Webmozart\Assert\Assert as BaseAssert;
use Carbon\Carbon;
use Illuminate\Contracts\Support\Arrayable;

class Assert extends BaseAssert
{
    const REGEXP_ISO8601 = '/^([\+-]?\d{4}(?!\d{2}\b))((-?)((0[1-9]|1[0-2])(\3([12]\d|0[1-9]|3[01]))?|W([0-4]\d|5[0-2])(-?[1-7])?|(00[1-9]|0[1-9]\d|[12]\d{2}|3([0-5]\d|6[1-6])))([T\s]((([01]\d|2[0-3])((:?)[0-5]\d)?|24\:?00)([\.,]\d+(?!:))?)?(\17[0-5]\d([\.,]\d+)?)?([zZ]|([\+-])([01]\d|2[0-3]):?([0-5]\d)?)?)?)?$/';

    const REGEXP_SUPPORTED_UNITS = '/^\d+(vw|vmin|vmax|vh|dg|dm|cw|gut|pt)?$/';

    const REGEXP_COLOR = '/^#([0-9A-F]{3}|[0-9A-F]{4}|[0-9A-F]{6}|[0-9A-F]{8}|aliceblue|antiquewhite|aqua|aquamarine|azure|beige|bisque|black|blanchedalmond|blue|blueviolet|brown|burlywood|cadetblue|chartreuse|chocolate|coral|cornflowerblue|cornsilk|crimson|cyan|darkblue|darkcyan|darkgoldenrod|darkgray|darkgreen|darkgrey|darkkhaki|darkmagenta|darkolivegreen|darkorange|darkorchid|darkred|darksalmon|darkseagreen|darkslateblue|darkslategray|darkslategrey|darkturquoise|darkviolet|deeppink|deepskyblue|dimgray|dimgrey|dodgerblue|firebrick|floralwhite|forestgreen|fuchsia|gainsboro|ghostwhite|gold|goldenrod|gray|green|greenyellow|grey|honeydew|hotpink|indianred|indigo|ivory|khaki|lavender|lavenderblush|lawngreen|lemonchiffon|lightblue|lightcoral|lightcyan|lightgoldenrodyellow|lightgray|lightgreen|lightgrey|lightpink|lightsalmon|lightseagreen|lightskyblue|lightslategray|lightslategrey|lightsteelblue|lightyellow|lime|limegreen|linen|magenta|maroon|mediumaquamarine|mediumblue|mediumorchid|mediumpurple|mediumseagreen|mediumslateblue|mediumspringgreen|mediumturquoise|mediumvioletred|midnightblue|mintcream|mistyrose|moccasin|navajowhite|navy|oldlace|olive|olivedrab|orange|orangered|orchid|palegoldenrod|palegreen|paleturquoise|palevioletred|papayawhip|peachpuff|peru|pink|plum|powderblue|purple|rebeccapurple|red|rosybrown|royalblue|saddlebrown|salmon|sandybrown|seagreen|seashell|sienna|silver|skyblue|slateblue|slategray|slategrey|snow|springgreen|steelblue|tan|teal|thistle|tomato|turquoise|violet|wheat|white|whitesmoke|yellow|yellowgreen)$/i';

    public static function isComponent($value, $message = '')
    {
        if (is_array($value)) {
            static::keyExists($value, 'role', $message);
        } else {
            static::isInstanceOfAny(
                $value,
                [
                    \Urbania\AppleNews\Format\Component::class,
                    \Urbania\AppleNews\Contracts\Componentable::class
                ],
                $message
            );
        }
    }

    public static function isColor($value, $message = '')
    {
        static::regex($value, static::REGEXP_COLOR, $message);
    }

    public static function isSupportedUnits($value, $message = '')
    {
        if (is_string($value)) {
            static::regex($value, static::REGEXP_SUPPORTED_UNITS, $message);
        } elseif (!is_float($value) && !is_integer($value)) {
            static::reportInvalidArgument(
                sprintf(
                    $message ?: 'Expected a number. Got: %s',
                    static::typeToString($value)
                )
            );
        }
    }

    public static function isDate($value, $message = '')
    {
        if (is_object($value)) {
            static::isInstanceOf($value, Carbon::class, $message);
        } else {
            static::regex($value, static::REGEXP_ISO8601, $message);
        }
    }

    public static function number($value, $message = '')
    {
        if (!is_float($value) && !is_integer($value)) {
            static::reportInvalidArgument(
                sprintf(
                    $message ?: 'Expected a number. Got: %s',
                    static::typeToString($value)
                )
            );
        }
    }

    public static function isSdkObject($value, $class, $message = '')
    {
        if (!($value instanceof $class) && !is_array($value)) {
            static::reportInvalidArgument(
                sprintf(
                    $message ?:
                    'Expected an instance of %2$s or an array. Got: %s',
                    static::typeToString($value),
                    $class
                )
            );
        }
    }

    public static function isAnySdkObject($value, $classes, $message = '')
    {
        if (is_array($value)) {
            return;
        }

        foreach ($classes as $class) {
            if ($value instanceof $class) {
                return;
            }
        }

        static::reportInvalidArgument(
            sprintf(
                $message ?:
                'Expected an instance of any of %2$s or an array. Got: %s',
                static::typeToString($value),
                implode(', ', $classes)
            )
        );
    }

    public static function searchArticlesQuery($value, $message = '')
    {
        static::isArray($value);
        if (isset($value['fromDate'])) {
            static::isDate($value['fromDate']);
        }
        if (isset($value['toDate'])) {
            static::isDate($value['toDate']);
        }
        if (isset($value['pageSize'])) {
            static::range($value['pageSize'], 1, 100);
        }
        if (isset($value['pageToken'])) {
            static::string($value['pageToken']);
        }
        if (isset($value['sortDir'])) {
            static::oneOf($value['sortDir'], ['ASC', 'DESC']);
        }
    }

    public static function uri($value, $message = '')
    {
        if (!filter_var($value, FILTER_VALIDATE_URL)) {
            static::reportInvalidArgument(
                sprintf(
                    $message ?: 'Expected an url. Got: %s',
                    $value
                )
            );
        }
    }
}
