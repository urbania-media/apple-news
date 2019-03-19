<?php

namespace Urbania\AppleNews\Parsers;

use Urbania\AppleNews\Article;

abstract class Parser
{
    abstract public function parse($html);

    public function createArticle()
    {
        return new Article();
    }
}
