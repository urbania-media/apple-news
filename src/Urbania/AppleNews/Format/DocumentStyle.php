<?php

namespace Urbania\AppleNews\Format;

use Carbon\Carbon;
use Urbania\AppleNews\Assert;

/**
 * The object for setting the background color for your article.
 *
 * @see https://developer.apple.com/documentation/apple_news/documentstyle
 */
class DocumentStyle
{
    /**
     * The article’s background color.
     * @var string
     */
    protected $backgroundColor;

    public function __construct(array $data = [])
    {
        if (isset($data['backgroundColor'])) {
            $this->setBackgroundColor($data['backgroundColor']);
        }
    }

    /**
     * Get the backgroundColor
     * @return string
     */
    public function getBackgroundColor()
    {
        return $this->backgroundColor;
    }

    /**
     * Set the backgroundColor
     * @param string $backgroundColor
     * @return $this
     */
    public function setBackgroundColor($backgroundColor)
    {
        Assert::isColor($backgroundColor);

        $this->backgroundColor = $backgroundColor;
        return $this;
    }

    /**
     * Get the object as array
     * @return array
     */
    public function toArray()
    {
        return [
            'backgroundColor' => is_object($this->backgroundColor)
                ? $this->backgroundColor->toArray()
                : $this->backgroundColor
        ];
    }
}
