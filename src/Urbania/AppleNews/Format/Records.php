<?php

namespace Urbania\AppleNews\Format;

use Carbon\Carbon;
use Illuminate\Contracts\Support\Arrayable;
use Urbania\AppleNews\Contracts\Componentable;
use Urbania\AppleNews\Support\Assert;
use Urbania\AppleNews\Support\BaseSdkObject;

/**
 * Define and provide data records that fit within the structure defined
 * by descriptors for a data table.
 *
 * @see https://developer.apple.com/documentation/apple_news/recordstore/records
 */
class Records extends BaseSdkObject
{
    public function __construct(array $data = [])
    {
    }

    /**
     * Get the object as array
     * @return array
     */
    public function toArray()
    {
        $data = [];
        return $data;
    }
}
