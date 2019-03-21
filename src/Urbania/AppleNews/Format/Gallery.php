<?php

namespace Urbania\AppleNews\Format;

use Carbon\Carbon;
use Illuminate\Contracts\Support\Arrayable;
use Urbania\AppleNews\Contracts\Componentable;
use Urbania\AppleNews\Support\Assert;
use Urbania\AppleNews\Support\BaseSdkObject;

/**
 * The component for displaying a sequence of images in a specific order
 * as a horizontal strip.
 *
 * @see https://developer.apple.com/documentation/apple_news/gallery
 */
class Gallery extends Component
{
    /**
     * An array of the images that will appear in the gallery. The order used
     * in the array is the order of the images in the gallery. Gallery items
     * can be JPEG (with .jpg or .jpeg extension), PNG, or GIF images.
     * @var Format\GalleryItem[]
     */
    protected $items = [];

    /**
     * This component always has a role of gallery.
     * @var string
     */
    protected $role = 'gallery';

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
        return $this->setItems(array_merge($this->items, [$item]));
    }

    /**
     * Add items to items
     * @param array $items
     * @return $this
     */
    public function addItems($items)
    {
        Assert::isArray($items);
        return $this->setItems(array_merge($this->items, $items));
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
