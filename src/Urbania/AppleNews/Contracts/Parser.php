<?php

namespace Urbania\AppleNews\Contracts;

interface Parser
{
    public function parse($data, $article = null);
}
