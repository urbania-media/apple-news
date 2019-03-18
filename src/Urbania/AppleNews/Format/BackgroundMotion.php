<?php

namespace Urbania\AppleNews\Format;

use Carbon\Carbon;
use Urbania\AppleNews\Assert;

/**
 * The behavior whereby the background of a component moves in the
 * opposite direction from the motion of the device.
 *
 * @see https://developer.apple.com/documentation/apple_news/backgroundmotion
 */
class BackgroundMotion extends Behavior
{
    /**
     * This behavior’s type is always background_motion.
     * @var string
     */
    protected $type = 'background_motion';

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
