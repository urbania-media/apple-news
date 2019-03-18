<?php

namespace Urbania\AppleNews\Format;

use Carbon\Carbon;
use Urbania\AppleNews\Assert;

/**
 * The object for defining the space above and below a component.
 *
 * @see https://developer.apple.com/documentation/apple_news/margin
 */
class Margin implements \JsonSerializable
{
    /**
     * The bottom margin in points, or with any of the units of measure for
     * components. See Specifying Measurements for Components.
     * @var string|integer
     */
    protected $bottom;

    /**
     * The top margin in points, or with any of the units of measure for
     * components. See Specifying Measurements for Components.
     * @var string|integer
     */
    protected $top;

    public function __construct(array $data = [])
    {
        if (isset($data['bottom'])) {
            $this->setBottom($data['bottom']);
        }

        if (isset($data['top'])) {
            $this->setTop($data['top']);
        }
    }

    /**
     * Get the bottom
     * @return string|integer
     */
    public function getBottom()
    {
        return $this->bottom;
    }

    /**
     * Set the bottom
     * @param string|integer $bottom
     * @return $this
     */
    public function setBottom($bottom)
    {
        Assert::isSupportedUnits($bottom);

        $this->bottom = $bottom;
        return $this;
    }

    /**
     * Get the top
     * @return string|integer
     */
    public function getTop()
    {
        return $this->top;
    }

    /**
     * Set the top
     * @param string|integer $top
     * @return $this
     */
    public function setTop($top)
    {
        Assert::isSupportedUnits($top);

        $this->top = $top;
        return $this;
    }

    /**
     * Convert the object into something JSON serializable.
     * @return array
     */
    public function jsonSerialize()
    {
        return $this->toArray();
    }

    /**
     * Convert the instance to JSON.
     * @param  int  $options
     * @return string
     */
    public function toJson(int $options = 0)
    {
        return json_encode($this->jsonSerialize(), $options);
    }

    /**
     * Get the object as array
     * @return array
     */
    public function toArray()
    {
        $data = [];
        if (isset($this->bottom)) {
            $data['bottom'] = is_object($this->bottom)
                ? $this->bottom->toArray()
                : $this->bottom;
        }
        if (isset($this->top)) {
            $data['top'] = is_object($this->top)
                ? $this->top->toArray()
                : $this->top;
        }
        return $data;
    }
}
