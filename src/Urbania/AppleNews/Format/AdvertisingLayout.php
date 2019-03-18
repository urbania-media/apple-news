<?php

namespace Urbania\AppleNews\Format;

use Carbon\Carbon;
use Urbania\AppleNews\Assert;

/**
 * The object for defining the margin above and below advertising
 * components.
 *
 * @see https://developer.apple.com/documentation/apple_news/advertisinglayout
 */
class AdvertisingLayout
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
            Assert::isInstanceOf($margin, Margin::class);
        } elseif (!is_array($margin)) {
            Assert::integer($margin);
        }

        $this->margin = is_array($margin) ? new Margin($margin) : $margin;
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
        $data = [];
        if (isset($this->margin)) {
            $data['margin'] = is_object($this->margin)
                ? $this->margin->toArray()
                : $this->margin;
        }
        return $data;
    }
}
