<?php

namespace Urbania\AppleNews\Format;

use Carbon\Carbon;
use Urbania\AppleNews\Assert;

/**
 * The scene that briefly keeps a header at the top of the screen as the
 * user scrolls through the article.
 *
 * @see https://developer.apple.com/documentation/apple_news/fadingstickyheader
 */
class FadingStickyHeader extends Scene
{
    /**
     * The color the header background will fade to, defined as a 3- to
     * 8-character hexadecimal string or a color name string.
     * @var string
     */
    protected $fadeColor;

    /**
     * This scene always has the type fading_sticky_header.
     * @var string
     */
    protected $type = 'fading_sticky_header';

    public function __construct(array $data = [])
    {
        parent::__construct($data);

        if (isset($data['fadeColor'])) {
            $this->setFadeColor($data['fadeColor']);
        }
    }

    /**
     * Get the fadeColor
     * @return string
     */
    public function getFadeColor()
    {
        return $this->fadeColor;
    }

    /**
     * Get the type
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set the fadeColor
     * @param string $fadeColor
     * @return $this
     */
    public function setFadeColor($fadeColor)
    {
        Assert::isColor($fadeColor);

        $this->fadeColor = $fadeColor;
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
        $data = parent::toArray();
        if (isset($this->fadeColor)) {
            $data['fadeColor'] = is_object($this->fadeColor)
                ? $this->fadeColor->toArray()
                : $this->fadeColor;
        }
        if (isset($this->type)) {
            $data['type'] = $this->type;
        }
        return $data;
    }
}
