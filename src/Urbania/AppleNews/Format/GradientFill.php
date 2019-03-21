<?php

namespace Urbania\AppleNews\Format;

use Carbon\Carbon;
use Illuminate\Contracts\Support\Arrayable;
use Urbania\AppleNews\Contracts\Componentable;
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

        $items = [];
        foreach ($colorStops as $key => $item) {
            $items[$key] = is_array($item) ? new ColorStop($item) : $item;
        }
        $this->colorStops = $items;
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
