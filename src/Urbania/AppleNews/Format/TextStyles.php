<?php

namespace Urbania\AppleNews\Format;

use Illuminate\Contracts\Support\Arrayable;
use Urbania\AppleNews\Support\Assert;
use Urbania\AppleNews\Support\BaseSdkObject;
use Urbania\AppleNews\Support\Utils;

/**
 * An object containing text style objects that can be referred to inline
 * in text.
 *
 * @see https://developer.apple.com/tutorials/data/documentation/apple_news/articledocument/textstyles.json
 */
class TextStyles extends BaseSdkObject
{
    /**
     * A text style, with a name you define that can be referred to by
     * components within this document.
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

        if (is_array($styles) && sizeof($styles) > 0) {
            Assert::isMap($styles);
        }
        Assert::allIsSdkObject($styles, TextStyle::class);

        $this->styles = is_array($styles)
            ? array_reduce(
                array_keys($styles),
                function ($array, $key) use ($styles) {
                    $item = $styles[$key];
                    $array[$key] = Utils::isAssociativeArray($item) ? new TextStyle($item) : $item;
                    return $array;
                },
                []
            )
            : $styles;
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
