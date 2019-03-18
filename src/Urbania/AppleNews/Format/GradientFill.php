<?php

namespace Urbania\AppleNews\Format;

use Carbon\Carbon;
use Urbania\AppleNews\Assert;

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
     * @var ColorStop[]
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
     * @return ColorStop[]
     */
    public function getColorStops()
    {
        return $this->colorStops;
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
     * Set the colorStops
     * @param ColorStop[] $colorStops
     * @return $this
     */
    public function setColorStops($colorStops)
    {
        Assert::isArray($colorStops);
        Assert::allIsInstanceOfOrArray(
            $colorStops,
            Urbania\AppleNews\ColorStop::class
        );

        $items = [];
        foreach ($colorStops as $key => $item) {
            $items[$key] = is_array($item)
                ? new Urbania\AppleNews\ColorStop($item)
                : $item;
        }
        $this->colorStops = $items;
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
        return array_merge(parent::toArray(), [
            'colorStops' => !is_null($this->colorStops)
                ? array_reduce(
                    array_keys($this->colorStops),
                    function ($items, $key) {
                        $items[$key] = is_object($this->colorStops[$key])
                            ? $this->colorStops[$key]->toArray()
                            : $this->colorStops[$key];
                        return $items;
                    },
                    []
                )
                : $this->colorStops,
            'type' => $this->type
        ]);
    }
}
