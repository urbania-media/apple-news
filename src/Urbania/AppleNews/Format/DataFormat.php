<?php

namespace Urbania\AppleNews\Format;

use Carbon\Carbon;
use Urbania\AppleNews\Assert;

/**
 * Properties shared by all data format obejct types.
 *
 * @see https://developer.apple.com/documentation/apple_news/dataformat
 */
class DataFormat
{
    /**
     * The type of format. This must be float for a FloatDataFormat object or
     * image for an ImageDataFormat object.
     * @var string
     */
    protected $type = 'float';

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
        return [
            'type' => $this->type
        ];
    }
}
