<?php

namespace Urbania\AppleNews\Format;

use Carbon\Carbon;
use Urbania\AppleNews\Assert;

/**
 * The animation whereby a component appears on the screen.
 *
 * @see https://developer.apple.com/documentation/apple_news/appearanimation
 */
class AppearAnimation extends ComponentAnimation
{
    /**
     * This animation’s type is always appear.
     * @var string
     */
    protected $type = 'appear';

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
        return array_merge(parent::toArray(), [
            'type' => $this->type
        ]);
    }
}
