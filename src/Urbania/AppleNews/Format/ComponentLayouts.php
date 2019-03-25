<?php

namespace Urbania\AppleNews\Format;

use Illuminate\Contracts\Support\Arrayable;
use Urbania\AppleNews\Support\Assert;
use Urbania\AppleNews\Support\BaseSdkObject;

/**
 * An object containing component layout objects that components in the
 * article can refer to.
 *
 * @see https://developer.apple.com/documentation/apple_news/articledocument/componentlayouts
 */
class ComponentLayouts extends BaseSdkObject
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
        if (is_null($layouts)) {
            $this->layouts = null;
            return $this;
        }

        if (is_array($layouts) && sizeof($layouts) > 0) {
            Assert::isMap($layouts);
        }
        Assert::allIsSdkObject($layouts, ComponentLayout::class);

        $this->layouts = array_reduce(
            array_keys($layouts),
            function ($array, $key) use ($layouts) {
                $item = $layouts[$key];
                $array[$key] = is_array($item)
                    ? new ComponentLayout($item)
                    : $item;
                return $array;
            },
            []
        );
        return $this;
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
