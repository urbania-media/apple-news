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
     * Get the object as array
     * @return array
     */
    public function toArray()
    {
        return array_merge(parent::toArray(), [
            'fadeColor' => is_object($this->fadeColor)
                ? $this->fadeColor->toArray()
                : $this->fadeColor,
            'type' => $this->type
        ]);
    }
}
