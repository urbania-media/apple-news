<?php

namespace Urbania\AppleNews\Format;

use Carbon\Carbon;
use Urbania\AppleNews\Assert;

/**
 * An object containing component layout objects that components in the
 * article can refer to.
 *
 * @see https://developer.apple.com/documentation/apple_news/articledocument/componentlayouts
 */
class ComponentLayouts
{
    /**
     * A component layout, with a name you define that can be referred to by
     * components within this document.
     * @var array
     */
    protected $layouts;

    public function __construct(array $data = [])
    {
        $this->setLayouts($data);
    }

    /**
     * Get the layouts
     * @return array
     */
    public function getLayouts()
    {
        return $this->layouts;
    }

    /**
     * Set the layouts
     * @param array $layouts
     * @return $this
     */
    public function setLayouts($layouts)
    {
        Assert::isMap($layouts);
        Assert::allIsInstanceOfOrArray($layouts, ComponentLayout::class);

        $items = [];
        foreach ($layouts as $key => $item) {
            $items[$key] = is_array($item) ? new ComponentLayout($item) : $item;
        }
        $this->layouts = $items;
        return $this;
    }

    /**
     * Convert the object into something JSON serializable.
     * @return array
     */
    public function jsonSerialize(int $options)
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
        $layouts = [];
        foreach ($this->layouts as $key => $layout) {
            $layouts[$key] = !is_null($layout) ? $layout->toArray() : null;
        }
        return $layouts;
    }
}
