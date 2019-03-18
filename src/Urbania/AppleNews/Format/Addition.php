<?php

namespace Urbania\AppleNews\Format;

use Carbon\Carbon;
use Urbania\AppleNews\Assert;

/**
 * Properties shared by all addition types.
 *
 * @see https://developer.apple.com/documentation/apple_news/addition
 */
class Addition
{
    /**
     * The length of the range of text the component should be anchored to.
     * @var integer
     */
    protected $rangeLength;

    /**
     * The start index of the range of text the component should be anchored
     * to. When a component is anchored to a component with role of body, the
     * text might be flowed around the component.
     * @var integer
     */
    protected $rangeStart;

    /**
     * The type of addition. For example, Link.
     * @var string
     */
    protected $type;

    public function __construct(array $data = [])
    {
        if (isset($data['rangeLength'])) {
            $this->setRangeLength($data['rangeLength']);
        }

        if (isset($data['rangeStart'])) {
            $this->setRangeStart($data['rangeStart']);
        }

        if (isset($data['type'])) {
            $this->setType($data['type']);
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
     * Get the rangeStart
     * @return integer
     */
    public function getRangeStart()
    {
        return $this->rangeStart;
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
     * Set the rangeLength
     * @param integer $rangeLength
     * @return $this
     */
    public function setRangeLength($rangeLength)
    {
        Assert::integer($rangeLength);

        $this->rangeLength = $rangeLength;
        return $this;
    }

    /**
     * Set the rangeStart
     * @param integer $rangeStart
     * @return $this
     */
    public function setRangeStart($rangeStart)
    {
        Assert::integer($rangeStart);

        $this->rangeStart = $rangeStart;
        return $this;
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
            'rangeLength' => $this->rangeLength,
            'rangeStart' => $this->rangeStart,
            'type' => $this->type
        ];
    }
}
