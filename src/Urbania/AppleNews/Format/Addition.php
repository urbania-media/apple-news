<?php

namespace Urbania\AppleNews\Format;

use Illuminate\Contracts\Support\Arrayable;
use Urbania\AppleNews\Support\Assert;
use Urbania\AppleNews\Support\BaseSdkObject;
use Urbania\AppleNews\Support\Utils;

/**
 * Properties shared by all addition types.
 *
 * @see https://developer.apple.com/tutorials/data/documentation/apple_news/addition.json
 */
class Addition extends BaseSdkObject
{
    /**
     * The type of addition. For example, .
     * @var string
     */
    protected $type;

    /**
     * The number of text characters that will be highlighted as the link.
     * @var integer
     */
    protected $rangeLength;

    /**
     * The starting character index for which the addition is meant. A range
     * starts at  for the first character.
     * If rangeStart is specified, rangeLength is required.
     * @var integer
     */
    protected $rangeStart;

    public function __construct(array $data = [])
    {
        if (isset($data['type'])) {
            $this->setType($data['type']);
        }

        if (isset($data['rangeLength'])) {
            $this->setRangeLength($data['rangeLength']);
        }

        if (isset($data['rangeStart'])) {
            $this->setRangeStart($data['rangeStart']);
        }
    }

    /**
     * Get the rangeLength
     * @return integer
     */
    public function getRangeLength()
    {
        return $this->rangeLength;
    }

    /**
     * Set the rangeLength
     * @param integer $rangeLength
     * @return $this
     */
    public function setRangeLength($rangeLength)
    {
        if (is_null($rangeLength)) {
            $this->rangeLength = null;
            return $this;
        }

        Assert::integer($rangeLength);

        $this->rangeLength = $rangeLength;
        return $this;
    }

    /**
     * Get the rangeStart
     * @return integer
     */
    public function getRangeStart()
    {
        return $this->rangeStart;
    }

    /**
     * Set the rangeStart
     * @param integer $rangeStart
     * @return $this
     */
    public function setRangeStart($rangeStart)
    {
        if (is_null($rangeStart)) {
            $this->rangeStart = null;
            return $this;
        }

        Assert::integer($rangeStart);

        $this->rangeStart = $rangeStart;
        return $this;
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
        Assert::oneOf($type, ['link', 'calendar_event']);

        $this->type = $type;
        return $this;
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
        if (isset($this->rangeLength)) {
            $data['rangeLength'] = $this->rangeLength;
        }
        if (isset($this->rangeStart)) {
            $data['rangeStart'] = $this->rangeStart;
        }
        return $data;
    }
}
