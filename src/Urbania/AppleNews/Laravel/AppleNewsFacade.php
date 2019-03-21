<?php

namespace Urbania\AppleNews\Laravel;

use Illuminate\Support\Facades\Facade;

class AppleNewsFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'apple-news';
    }
}
