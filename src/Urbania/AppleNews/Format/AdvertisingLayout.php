<?php

namespace Urbania\AppleNews\Format;

use Illuminate\Contracts\Support\Arrayable;
use Urbania\AppleNews\Support\Assert;
use Urbania\AppleNews\Support\BaseSdkObject;
use Urbania\AppleNews\Support\Utils;

/**
 * The object for defining the margin above and below advertising
 * components.
 *
 * @see https://developer.apple.com/tutorials/data/documentation/apple_news/advertisinglayout.json
 */
class AdvertisingLayout extends BaseSdkObject
{
    /**
     * Describes margins on top and bottom as a single integer or as an
     * object containing separate properties for top and bottom margins.
     * Version 1.1
     * @var \Urbania\AppleNews\Format\Margin|integer
     */
    protected $margin;

    public function __construct(array $data = [])
    {
        if (isset($data['margin'])) {
            $this->setMargin($data['margin']);
        }
    }

    /**
     * Get the margin
     * @return \Urbania\AppleNews\Format\Margin|integer
     */
    public function getMargin()
    {
        return $this->margin;
    }

    /**
     * Set the margin
     * @param \Urbania\AppleNews\Format\Margin|array|integer $margin
     * @return $this
     */
    public function setMargin($margin)
    {
        if (is_object($margin) || Utils::isAssociativeArray($margin)) {
            Assert::isSdkObject($margin, Margin::class);
        } else {
            Assert::integer($margin);
        }

        $this->margin = Utils::isAssociativeArray($margin) ? new Margin($margin) : $margin;
        return $this;
    }

    /**
     * Get the object as array
     * @return array
     */
    public function toArray()
    {
        $data = [];
        if (isset($this->margin)) {
            $data['margin'] =
                $this->margin instanceof Arrayable ? $this->margin->toArray() : $this->margin;
        }
        return $data;
    }
}
