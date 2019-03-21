<?php

namespace Urbania\AppleNews\Format;

use Carbon\Carbon;
use Illuminate\Contracts\Support\Arrayable;
use Urbania\AppleNews\Contracts\Componentable;
use Urbania\AppleNews\Support\Assert;
use Urbania\AppleNews\Support\BaseSdkObject;

/**
 * The object for defining the margin above and below advertising
 * components.
 *
 * @see https://developer.apple.com/documentation/apple_news/advertisinglayout
 */
class AdvertisingLayout extends BaseSdkObject
{
    /**
     * Describes margins on top and bottom as a single integer or as an
     * object containing separate properties for top and bottom margins.
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
        if (is_object($margin)) {
            Assert::isSdkObject($margin, Margin::class);
        } elseif (!is_array($margin)) {
            Assert::integer($margin);
        }

        $this->margin = is_array($margin) ? new Margin($margin) : $margin;
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
                $this->margin instanceof Arrayable
                    ? $this->margin->toArray()
                    : $this->margin;
        }
        return $data;
    }
}
