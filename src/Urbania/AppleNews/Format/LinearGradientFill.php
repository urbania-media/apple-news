<?php

namespace Urbania\AppleNews\Format;

use Illuminate\Contracts\Support\Arrayable;
use Urbania\AppleNews\Support\Assert;
use Urbania\AppleNews\Support\BaseSdkObject;
use Urbania\AppleNews\Support\Utils;

/**
 * The object for displaying a linear gradient as a component background.
 *
 * @see https://developer.apple.com/tutorials/data/documentation/apple_news/lineargradientfill.json
 */
class LinearGradientFill extends GradientFill
{
    /**
     * An array of color stops. Each stop sets a color and percentage.
     * Provide at least 2 colorStop items.
     * @var Format\ColorStop[]
     */
    protected $colorStops;

    /**
     * Always linear_gradient for this object.
     * @var string
     */
    protected $type = 'linear_gradient';

    /**
     * The angle of the gradient fill, in degrees. Use the angle to set the
     * direction of the gradient. For example, a value of 180 defines a
     * gradient that changes color from top to bottom. An angle of 90 defines
     * a gradient that changes color from left to right.
     * If angle is omitted, an angle of 180 (top to bottom) is used.
     * @var integer|float
     */
    protected $angle;

    public function __construct(array $data = [])
    {
        parent::__construct($data);

        if (isset($data['colorStops'])) {
            $this->setColorStops($data['colorStops']);
        }

        if (isset($data['angle'])) {
            $this->setAngle($data['angle']);
        }
    }

    /**
     * Get the angle
     * @return integer|float
     */
    public function getAngle()
    {
        return $this->angle;
    }

    /**
     * Set the angle
     * @param integer|float $angle
     * @return $this
     */
    public function setAngle($angle)
    {
        if (is_null($angle)) {
            $this->angle = null;
            return $this;
        }

        Assert::number($angle);

        $this->angle = $angle;
        return $this;
    }

    /**
     * Add an item to colorStops
     * @param \Urbania\AppleNews\Format\ColorStop|array $item
     * @return $this
     */
    public function addColorStop($item)
    {
        return $this->setColorStops(
            !is_null($this->colorStops) ? array_merge($this->colorStops, [$item]) : [$item]
        );
    }

    /**
     * Add items to colorStops
     * @param array $items
     * @return $this
     */
    public function addColorStops($items)
    {
        Assert::isArray($items);
        return $this->setColorStops(
            !is_null($this->colorStops) ? array_merge($this->colorStops, $items) : $items
        );
    }

    /**
     * Get the colorStops
     * @return Format\ColorStop[]
     */
    public function getColorStops()
    {
        return $this->colorStops;
    }

    /**
     * Set the colorStops
     * @param Format\ColorStop[] $colorStops
     * @return $this
     */
    public function setColorStops($colorStops)
    {
        Assert::isArray($colorStops);
        Assert::allIsSdkObject($colorStops, ColorStop::class);

        $this->colorStops = is_array($colorStops)
            ? array_reduce(
                array_keys($colorStops),
                function ($array, $key) use ($colorStops) {
                    $item = $colorStops[$key];
                    $array[$key] = Utils::isAssociativeArray($item) ? new ColorStop($item) : $item;
                    return $array;
                },
                []
            )
            : $colorStops;
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
     * Get the object as array
     * @return array
     */
    public function toArray()
    {
        $data = parent::toArray();
        if (isset($this->colorStops)) {
            $data['colorStops'] = !is_null($this->colorStops)
                ? array_reduce(
                    array_keys($this->colorStops),
                    function ($items, $key) {
                        $items[$key] =
                            $this->colorStops[$key] instanceof Arrayable
                                ? $this->colorStops[$key]->toArray()
                                : $this->colorStops[$key];
                        return $items;
                    },
                    []
                )
                : $this->colorStops;
        }
        if (isset($this->type)) {
            $data['type'] = $this->type;
        }
        if (isset($this->angle)) {
            $data['angle'] = $this->angle;
        }
        return $data;
    }
}
