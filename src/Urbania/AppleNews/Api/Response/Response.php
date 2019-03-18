<?php

namespace Urbania\AppleNews\Api\Response;

use Urbania\AppleNews\Utils;

class Response
{
    public function __get($name)
    {
        $method = 'get'.Utils::studlyCase($name);
        if (!method_exists($this, $method)) {
            $trace = debug_backtrace();
            trigger_error(
                'Undefined property : '.$name.' in '.$trace[0]['file'].' at line '.$trace[0]['line'],
                E_USER_NOTICE
            );
            return null;
        }
        return call_user_func([$this, $method]);
    }
}
