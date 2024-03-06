<?php

namespace Urbania\AppleNews\Format;

use Illuminate\Contracts\Support\Arrayable;
use Urbania\AppleNews\Support\Assert;
use Urbania\AppleNews\Support\BaseSdkObject;
use Urbania\AppleNews\Support\Utils;

/**
 * The object for defining the space above and below a component.
 *
 * @see https://developer.apple.com/tutorials/data/documentation/apple_news/margin.json
 */
class Margin extends BaseSdkObject
{
    /**
     * The bottom margin in points, or with any of the units of measure for
     * components. See .
     * @var string|integer|float
     */
    protected $bottom;

    /**
     * The top margin in points, or with any of the units of measure for
     * components. See .
     * @var string|integer|float
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
     * @return string|integer|float
     */
    public function getBottom()
    {
        return $this->bottom;
    }

    /**
     * Set the bottom
     * @param string|integer|float $bottom
     * @return $this
     */
    public function setBottom($bottom)
    {
        if (is_null($bottom)) {
            $this->bottom = null;
            return $this;
        }

        Assert::isSupportedUnits($bottom);

        $this->bottom = $bottom;
        return $this;
    }

    /**
     * Get the top
     * @return string|integer|float
     */
    public function getTop()
    {
        return $this->top;
    }

    /**
     * Set the top
     * @param string|integer|float $top
     * @return $this
     */
    public function setTop($top)
    {
        if (is_null($top)) {
            $this->top = null;
            return $this;
        }

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
        $data = [];
        if (isset($this->bottom)) {
            $data['bottom'] =
                $this->bottom instanceof Arrayable ? $this->bottom->toArray() : $this->bottom;
        }
        if (isset($this->top)) {
            $data['top'] = $this->top instanceof Arrayable ? $this->top->toArray() : $this->top;
        }
        return $data;
    }
}
