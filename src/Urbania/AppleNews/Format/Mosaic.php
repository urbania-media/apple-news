<?php

namespace Urbania\AppleNews\Format;

use Illuminate\Contracts\Support\Arrayable;
use Urbania\AppleNews\Support\Assert;
use Urbania\AppleNews\Support\BaseSdkObject;

/**
 * The component for displaying a set of images as tiles in no particular
 * order.
 *
 * @see https://developer.apple.com/documentation/apple_news/mosaic
 */
class Mosaic extends Component
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
     * Add an item to items
     * @param \Urbania\AppleNews\Format\GalleryItem|array $item
     * @return $this
     */
    public function addItem($item)
    {
        return $this->setItems(
            !is_null($this->items)
                ? array_merge($this->items, [$item])
                : [$item]
        );
    }

    /**
     * Add items to items
     * @param array $items
     * @return $this
     */
    public function addItems($items)
    {
        Assert::isArray($items);
        return $this->setItems(
            !is_null($this->items) ? array_merge($this->items, $items) : $items
        );
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
        Assert::allIsSdkObject($items, GalleryItem::class);

        $this->items = array_reduce(
            array_keys($items),
            function ($array, $key) use ($items) {
                $item = $items[$key];
                $array[$key] = is_array($item) ? new GalleryItem($item) : $item;
                return $array;
            },
            []
        );
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
                        $items[$key] =
                            $this->items[$key] instanceof Arrayable
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
