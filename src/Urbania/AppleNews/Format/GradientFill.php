<?php

namespace Urbania\AppleNews\Format;

use Illuminate\Contracts\Support\Arrayable;
use Urbania\AppleNews\Support\Assert;
use Urbania\AppleNews\Support\BaseSdkObject;
use Urbania\AppleNews\Support\Utils;

/**
 * The properties shared by all gradient fill types.
 *
 * @see https://developer.apple.com/tutorials/data/documentation/apple_news/gradientfill.json
 */
class GradientFill extends Fill
{
    /**
     * An array of color stops. Each stop sets a color and location along the
     * gradient.
     * Provide at least 2 colorStop items.
     * @var Format\ColorStop[]
     */
    protected $colorStops;

    /**
     * The type of gradient; for example linear_gradient.
     * @var string
     */
    protected $type;

    /**
     * A string that indicates how the fill should behave when a user
     * scrolls.
     * Valid values:
     * @var string
     */
    protected $attachment;

    public function __construct(array $data = [])
    {
        parent::__construct($data);

        if (isset($data['colorStops'])) {
            $this->setColorStops($data['colorStops']);
        }

        if (isset($data['type'])) {
            $this->setType($data['type']);
        }

        if (isset($data['attachment'])) {
            $this->setAttachment($data['attachment']);
        }
    }

    /**
     * Get the attachment
     * @return string
     */
    public function getAttachment()
    {
        return $this->attachment;
    }

    /**
     * Set the attachment
     * @param string $attachment
     * @return $this
     */
    public function setAttachment($attachment)
    {
        if (is_null($attachment)) {
            $this->attachment = null;
            return $this;
        }

        Assert::oneOf($attachment, ['fixed', 'scroll']);

        $this->attachment = $attachment;
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
        if (isset($this->attachment)) {
            $data['attachment'] = $this->attachment;
        }
        return $data;
    }
}
