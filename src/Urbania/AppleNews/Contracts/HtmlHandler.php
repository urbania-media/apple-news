<?php

namespace Urbania\AppleNews\Contracts;

interface HtmlHandler
{
    public function canHandle($block);

    public function handle($block);
}
