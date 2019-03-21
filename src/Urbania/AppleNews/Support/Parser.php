<?php

namespace Urbania\AppleNews\Support;

use Urbania\AppleNews\Contracts\Parser as ParserContract;

abstract class Parser implements ParserContract
{
    abstract public function parse($data, $defaults = []);
}
