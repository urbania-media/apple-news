<?php

namespace Urbania\AppleNews;

use Webmozart\Assert\Assert as BaseAssert;
use Carbon\Carbon;

class Assert extends BaseAssert
{
    const REGEXP_ISO8601 = '/^(-?(?:[1-9][0-9]*)?[0-9]{4})-(1[0-2]|0[1-9])-(3[01]|0[1-9]|[12][0-9])T(2[0-3]|[01][0-9]):([0-5][0-9]):([0-5][0-9])(\\.[0-9]+)?(Z)?$/';

    const REGEXP_SUPPORTED_UNITS = '/^\d+(vw|vmin|vmax|vh|dg|dm|cw|gut|pt)?$/';

    const REGEXP_COLOR = '/^#([0-9A-F]{3}|[0-9A-F]{4}|[0-9A-F]{6}|[0-9A-F]{8}|aliceblue|antiquewhite|aqua|aquamarine|azure|beige|bisque|black|blanchedalmond|blue|blueviolet|brown|burlywood|cadetblue|chartreuse|chocolate|coral|cornflowerblue|cornsilk|crimson|cyan|darkblue|darkcyan|darkgoldenrod|darkgray|darkgreen|darkgrey|darkkhaki|darkmagenta|darkolivegreen|darkorange|darkorchid|darkred|darksalmon|darkseagreen|darkslateblue|darkslategray|darkslategrey|darkturquoise|darkviolet|deeppink|deepskyblue|dimgray|dimgrey|dodgerblue|firebrick|floralwhite|forestgreen|fuchsia|gainsboro|ghostwhite|gold|goldenrod|gray|green|greenyellow|grey|honeydew|hotpink|indianred|indigo|ivory|khaki|lavender|lavenderblush|lawngreen|lemonchiffon|lightblue|lightcoral|lightcyan|lightgoldenrodyellow|lightgray|lightgreen|lightgrey|lightpink|lightsalmon|lightseagreen|lightskyblue|lightslategray|lightslategrey|lightsteelblue|lightyellow|lime|limegreen|linen|magenta|maroon|mediumaquamarine|mediumblue|mediumorchid|mediumpurple|mediumseagreen|mediumslateblue|mediumspringgreen|mediumturquoise|mediumvioletred|midnightblue|mintcream|mistyrose|moccasin|navajowhite|navy|oldlace|olive|olivedrab|orange|orangered|orchid|palegoldenrod|palegreen|paleturquoise|palevioletred|papayawhip|peachpuff|peru|pink|plum|powderblue|purple|rebeccapurple|red|rosybrown|royalblue|saddlebrown|salmon|sandybrown|seagreen|seashell|sienna|silver|skyblue|slateblue|slategray|slategrey|snow|springgreen|steelblue|tan|teal|thistle|tomato|turquoise|violet|wheat|white|whitesmoke|yellow|yellowgreen)$/i';


    public static function isColor($value, $message = '')
    {
        static::regex($value, static::REGEXP_COLOR, $message);
    }

    public static function isSupportedUnits($value, $message = '')
    {
        if (is_string($value)) {
            static::regex($value, static::REGEXP_SUPPORTED_UNITS, $message);
        } elseif (!is_float($value) && !is_integer($value)) {
            static::reportInvalidArgument(sprintf(
                $message ?: 'Expected a number. Got: %s',
                static::typeToString($value)
            ));
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
            static::reportInvalidArgument(sprintf(
                $message ?: 'Expected a number. Got: %s',
                static::typeToString($value),
            ));
        }
    }

    public static function isInstanceOfOrArray($value, $class, $message = '')
    {
        if (!($value instanceof $class) && !is_array($value)) {
            static::reportInvalidArgument(sprintf(
                $message ?: 'Expected an instance of %2$s or an array. Got: %s',
                static::typeToString($value),
                $class
            ));
        }
    }
}
