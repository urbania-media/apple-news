<?php

namespace Urbania\AppleNews\Format;

use Carbon\Carbon;
use Urbania\AppleNews\Assert;

/**
 * The object for defining the space above and below a component.
 *
 * @see https://developer.apple.com/documentation/apple_news/margin
 */
class Margin
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
     * Get the top
     * @return string|integer
     */
    public function getTop()
    {
        return $this->top;
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
     * Get the object as array
     * @return array
     */
    public function toArray()
    {
        return [
            'bottom' => is_object($this->bottom)
                ? $this->bottom->toArray()
                : $this->bottom,
            'top' => is_object($this->top) ? $this->top->toArray() : $this->top
        ];
    }
}
