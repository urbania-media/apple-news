<?php

namespace Urbania\AppleNews\Format;

use Illuminate\Contracts\Support\Arrayable;
use Urbania\AppleNews\Support\Assert;
use Urbania\AppleNews\Support\BaseSdkObject;

/**
 * The object for displaying components side by side in a Container
 * component.
 *
 * @see https://developer.apple.com/documentation/apple_news/horizontalstackdisplay
 */
class HorizontalStackDisplay extends BaseSdkObject
{
    /**
     * Always horizontal_stack for this object.
     * @var string
     */
    protected $type = 'horizontal_stack';

    public function __construct(array $data = [])
    {
    }

    /**
     * Get the type
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Get the object as array
     * @return array
     */
    public function toArray()
    {
        $data = [];
        if (isset($this->type)) {
            $data['type'] = $this->type;
        }
        return $data;
    }
}
