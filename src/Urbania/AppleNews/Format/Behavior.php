<?php

namespace Urbania\AppleNews\Format;

use Carbon\Carbon;
use Urbania\AppleNews\Assert;

/**
 * Properties shared by all the behaviors you can use to affect how
 * components react to device motion and scrolling.
 *
 * @see https://developer.apple.com/documentation/apple_news/behavior
 */
class Behavior
{
    /**
     * The type of behavior, for example, parallax.
     * @var string
     */
    protected $type;

    public function __construct(array $data = [])
    {
        if (isset($data['type'])) {
            $this->setType($data['type']);
        }
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
     * Set the type
     * @param string $type
     * @return $this
     */
    public function setType($type)
    {
        Assert::string($type);

        $this->type = $type;
        return $this;
    }

    /**
     * Get the object as array
     * @return array
     */
    public function toArray()
    {
        return [
            'type' => $this->type
        ];
    }
}
