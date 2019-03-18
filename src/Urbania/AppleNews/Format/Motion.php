<?php

namespace Urbania\AppleNews\Format;

use Carbon\Carbon;
use Urbania\AppleNews\Assert;

/**
 * The behavior whereby a component reacts to the motion of the user’s
 * device.
 *
 * @see https://developer.apple.com/documentation/apple_news/motion
 */
class Motion extends Behavior
{
    /**
     * his behavior’s type is always motion.
     * @var string
     */
    protected $type = 'motion';

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
