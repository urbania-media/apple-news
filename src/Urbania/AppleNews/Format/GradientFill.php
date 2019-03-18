<?php

namespace Urbania\AppleNews\Format;

use Carbon\Carbon;
use Urbania\AppleNews\Assert;

/**
 * The properties shared by all gradient fill types.
 *
 * @see https://developer.apple.com/documentation/apple_news/gradientfill
 */
class GradientFill extends Fill implements \JsonSerializable
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
        Assert::allIsInstanceOfOrArray($colorStops, ColorStop::class);

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
        $data = parent::toArray();
        if (isset($this->colorStops)) {
            $data['colorStops'] = !is_null($this->colorStops)
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
                : $this->colorStops;
        }
        if (isset($this->type)) {
            $data['type'] = $this->type;
        }
        return $data;
    }
}
