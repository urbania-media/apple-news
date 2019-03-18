<?php

namespace Urbania\AppleNews\Format;

use Carbon\Carbon;
use Urbania\AppleNews\Assert;

/**
 * The component for displaying a set of images as tiles in no particular
 * order.
 *
 * @see https://developer.apple.com/documentation/apple_news/mosaic
 */
class Mosaic extends Component implements \JsonSerializable
{
    /**
     * An array of the images that will appear in the mosaic. The order used
     * in the array may affect layout and positioning in the mosaic,
     * depending on the device or width. Gallery items can be JPEG (with .jpg
     * or .jpeg extension), PNG, or GIF images. If the GIF is animated, the
     * animation plays only in full screen.
     * @var Format\GalleryItem[]
     */
    protected $items;

    /**
     * This component always has a role of mosaic.
     * @var string
     */
    protected $role = 'mosaic';

    public function __construct(array $data = [])
    {
        parent::__construct($data);

        if (isset($data['items'])) {
            $this->setItems($data['items']);
        }
    }

    /**
     * Get the items
     * @return Format\GalleryItem[]
     */
    public function getItems()
    {
        return $this->items;
    }

    /**
     * Set the items
     * @param Format\GalleryItem[] $items
     * @return $this
     */
    public function setItems($items)
    {
        Assert::isArray($items);
        Assert::allIsInstanceOfOrArray($items, GalleryItem::class);

        $items = [];
        foreach ($items as $key => $item) {
            $items[$key] = is_array($item) ? new GalleryItem($item) : $item;
        }
        $this->items = $items;
        return $this;
    }

    /**
     * Get the role
     * @return string
     */
    public function getRole()
    {
        return $this->role;
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
        if (isset($this->items)) {
            $data['items'] = !is_null($this->items)
                ? array_reduce(
                    array_keys($this->items),
                    function ($items, $key) {
                        $items[$key] = is_object($this->items[$key])
                            ? $this->items[$key]->toArray()
                            : $this->items[$key];
                        return $items;
                    },
                    []
                )
                : $this->items;
        }
        if (isset($this->role)) {
            $data['role'] = $this->role;
        }
        return $data;
    }
}
