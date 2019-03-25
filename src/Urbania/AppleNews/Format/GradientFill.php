<?php

namespace Urbania\AppleNews\Format;

use Illuminate\Contracts\Support\Arrayable;
use Urbania\AppleNews\Support\Assert;
use Urbania\AppleNews\Support\BaseSdkObject;

/**
 * The properties shared by all gradient fill types.
 *
 * @see https://developer.apple.com/documentation/apple_news/gradientfill
 */
class GradientFill extends Fill
{
    /**
     * An array of color stops. Each stop sets a color and location along the
     * gradient.
     * @var Format\ColorStop[]
     */
    protected $colorStops;

    /**
     * The type of gradient; for example linear_gradient.
     * @var string
     */
    protected $type;

    public function __construct(array $data = [])
    {
        parent::__construct($data);

        if (isset($data['colorStops'])) {
            $this->setColorStops($data['colorStops']);
        }

        if (isset($data['type'])) {
            $this->setType($data['type']);
        }
    }

    /**
     * Add an item to colorStops
     * @param \Urbania\AppleNews\Format\ColorStop|array $item
     * @return $this
     */
    public function addColorStop($item)
    {
        return $this->setColorStops(
            !is_null($this->colorStops)
                ? array_merge($this->colorStops, [$item])
                : [$item]
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
            !is_null($this->colorStops)
                ? array_merge($this->colorStops, $items)
                : $items
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

        $this->colorStops = array_reduce(
            array_keys($colorStops),
            function ($array, $key) use ($colorStops) {
                $item = $colorStops[$key];
                $array[$key] = is_array($item) ? new ColorStop($item) : $item;
                return $array;
            },
            []
        );
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
        return $data;
    }
}
