<?php

namespace Urbania\AppleNews\Format;

use Carbon\Carbon;
use Urbania\AppleNews\Support\Assert;
use Urbania\AppleNews\Support\BaseSdkObject;

/**
 * An object containing component text style defaults as well as
 * component text styles that components in the article can use.
 *
 * @see https://developer.apple.com/documentation/apple_news/articledocument/componenttextstyles
 */
class ComponentTextStyles extends BaseSdkObject
{
    /**
     * A component text style, with a name you define that can be referred to
     * by components within this document.
     * @var array
     */
    protected $styles;

    public function __construct(array $data = [])
    {
        $this->setStyles($data);
    }

    /**
     * Get the styles
     * @return array
     */
    public function getStyles()
    {
        return $this->styles;
    }

    /**
     * Set the styles
     * @param array $styles
     * @return $this
     */
    public function setStyles($styles)
    {
        if (is_null($styles)) {
            $this->styles = null;
            return $this;
        }

        Assert::isMap($styles);
        Assert::allIsInstanceOfOrArray($styles, ComponentTextStyle::class);

        $items = [];
        foreach ($styles as $key => $item) {
            $items[$key] = is_array($item)
                ? new ComponentTextStyle($item)
                : $item;
        }
        $this->styles = $items;
        return $this;
    }

    /**
     * Get the object as array
     * @return array
     */
    public function toArray()
    {
        $styles = [];
        foreach ($this->styles as $key => $style) {
            $styles[$key] = !is_null($style) ? $style->toArray() : null;
        }
        return $styles;
    }
}
