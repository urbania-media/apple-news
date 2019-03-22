<?php

namespace Urbania\AppleNews\Format;

use Illuminate\Contracts\Support\Arrayable;
use Urbania\AppleNews\Support\Assert;
use Urbania\AppleNews\Support\BaseSdkObject;

/**
 * The behavior whereby the background of a component moves slightly
 * slower than the user’s scroll speed.
 *
 * @see https://developer.apple.com/documentation/apple_news/backgroundparallax
 */
class BackgroundParallax extends Behavior
{
    /**
     * This behavior’s type is always background_parallax.
     * @var string
     */
    protected $type = 'background_parallax';

    public function __construct(array $data = [])
    {
        parent::__construct($data);
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
        $data = parent::toArray();
        if (isset($this->type)) {
            $data['type'] = $this->type;
        }
        return $data;
    }
}
